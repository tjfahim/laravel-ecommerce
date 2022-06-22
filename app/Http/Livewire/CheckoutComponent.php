<?php

namespace App\Http\Livewire;

use App\Models\OrdarItem;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\Transection;
use Cart;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Stripe;

class CheckoutComponent extends Component
{
    public $ship_to_different;
    public $firstname;
    public $lastname;
    public $email;
    public $mobile;
    public $line1;
    public $line2;
    public $city;
    public $province;
    public $country;
    public $zipcode;

    public $s_firstname;
    public $s_lastname;
    public $s_email;
    public $s_mobile;
    public $s_line1;
    public $s_line2;
    public $s_city;
    public $s_province;
    public $s_country;
    public $s_zipcode;

    public $payment_mode;
    public $thank_you;

    public $card_no;
    public $expiry_month;
    public $expiry_year;
    public $cvc;

    public function updated($fields){
        $this->validateOnly($fields,[
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'mobile'=>'required|numeric',
            'line1'=>'required',
            'city'=>'required',
            'province'=>'required',
            'country'=>'required',
            'zipcode'=>'required',
            'payment_mode'=>'required',
        ]);
        if($this->payment_mode=='card'){
            $this->validateOnly($fields,[
                'card_no'=>'required|numeric',
                'expiry_month'=>'required|numeric',
                'expiry_year'=>'required|numeric',
                'cvc'=>'required|numeric',

            ]);}
        if($this->ship_to_different){
            $this->validateOnly($fields,[
                's_firstname'=>'required',
                's_lastname'=>'required',
                's_email'=>'required|email',
                's_mobile'=>'required|numeric',
                's_line1'=>'required',
                's_city'=>'required',
                's_province'=>'required',
                's_country'=>'required',
                's_zipcode'=>'required',
            ]);}
    }

    public function placeOrder(){
        $this->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'mobile'=>'required|numeric',
            'line1'=>'required',
            'city'=>'required',
            'province'=>'required',
            'country'=>'required',
            'zipcode'=>'required',
            'payment_mode'=>'required',
        ]);
        if($this->payment_mode=='card'){
            $this->validate([
                'card_no'=>'required|numeric',
                'expiry_month'=>'required|numeric',
                'expiry_year'=>'required|numeric',
                'cvc'=>'required|numeric',

            ]);}

        $order= new Order();
        $order->user_id =Auth::user()->id;
        $order->subtotal =session()->get('checkout')['subtotal'];
        $order->discount =session()->get('checkout')['discount'];
        $order->tax =session()->get('checkout')['tax'];
        $order->total =session()->get('checkout')['total'];
        $order->firstname=$this->firstname;
        $order->lastname=$this->lastname;
        $order->email=$this->email;
        $order->mobile=$this->mobile;
        $order->line1=$this->line1;
        $order->line1=$this->line1;
        $order->city=$this->city;
        $order->province=$this->province;
        $order->country=$this->country;
        $order->zipcode=$this->zipcode;
        $order->status='ordered';
        $order->is_shipping_different=$this->ship_to_different ? 1 : 0;
        $order->save();

        foreach(Cart::instance('cart')->content() as $item){
            $orderItam= new OrdarItem();
            $orderItam->product_id=$item->id;
            $orderItam->order_id=$order->id;
            $orderItam->price=$item->price;
            $orderItam->quantity=$item->qty;
            $orderItam->save();
        }

        if($this->ship_to_different){
            $this->validate([
                's_firstname'=>'required',
                's_lastname'=>'required',
                's_email'=>'required|email',
                's_mobile'=>'required|numeric',
                's_line1'=>'required',
                's_city'=>'required',
                's_province'=>'required',
                's_country'=>'required',
                's_zipcode'=>'required',
            ]);

            $shipping= new Shipping();
            $shipping->order_id=$order->id;
            $shipping->firstname=$this->s_firstname;
            $shipping->lastname=$this->s_lastname;
            $shipping->email=$this->s_email;
            $shipping->mobile=$this->s_mobile;
            $shipping->line1=$this->s_line1;
            $shipping->line1=$this->s_line1;
            $shipping->city=$this->s_city;
            $shipping->province=$this->s_province;
            $shipping->country=$this->s_country;
            $shipping->zipcode=$this->s_zipcode;
            $shipping->save();

        }

        if($this->payment_mode=='cod'){
            $this->makeTransection($order->id,'pending');
            $this->resetCart();
        }
        else if($this->payment_mode=='card'){
            $stripe=Stripe::make(env('STRIPE_KEY'));
            try{
                $token=$stripe->tokens()->create([
                    'card'=>[
                        'number'=>$this->card_no,
                        'exp_month'=>$this->expiry_month,
                        'exp_year'=>$this->expiry_year,
                        'cvc'=>$this->cvc,
                    ]
                    ]);
                    if(!isset($token['id'])){
                        session()->flash('stripe_error','The stripe token was not generated correctly');
                        $this->thank_you=0;
                    }
                    $customer= $stripe->customers()->create([
                        'name'=>$this->firstname . ' ' . $this->lastname,
                        'email'=>$this->email,
                        'phone'=>$this->mobile,
                        'address'=>[
                            'line1'=>$this->line1,
                            'postal_code'=>$this->zipcode,
                            'city'=>$this->city,
                            'state'=>$this->province,
                            'country'=>$this->country,
                        ],
                        'shipping'=>[
                            'name'=>$this->firstname . ' ' . $this->lastname,
                            'address'=>[
                                'line1'=>$this->line1,
                                'postal_code'=>$this->zipcode,
                                'city'=>$this->city,
                                'state'=>$this->province,
                                'country'=>$this->country,
                            ],
                        ],
                        'source'=>$token['id']
                    ]);
                    $charge=$stripe->charges()->create([
                        'customer'=>$customer['id'],
                        'currency'=>'USD',
                        'amount'=>session()->get('checkout')['total'],
                        'description'=>'Payment for order no'.$order->id
                    ]);
                    if($charge['status']=='successd'){
                        $this->makeTransection($order->id,'approved');
                        $this->resetCart();
                    }
                    else{
                        session()->flash('stripe_error','Successfull in Transaction');
                        $this->thank_you=1;
                    }
            }catch(Exception $e){
                session()->flash('stripe_error',$e->getMessage());
                $this->thank_you=0;
            }

        }


    }

    public function resetCart(){
        $this->thank_you =1;
        Cart::instance('cart')->destroy();
        session()->forget('checkout');
    }

    public function makeTransection($order_id,$status){
        $transection =new Transection();
        $transection->user_id=Auth::user()->id;
        $transection->order_id=$order_id;
        $transection->mode=$this->payment_mode;
        $transection->status=$status;
        $transection->save();
    }

    public function verifyForCheckout(){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        else if($this->thank_you){
            return redirect()->route('thankyou');
        }
        else if(!session()->get('checkout')){
            return redirect()->route('product.cart');
        }
    }

    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.checkout-component')->layout('layouts.base');
    }
}
