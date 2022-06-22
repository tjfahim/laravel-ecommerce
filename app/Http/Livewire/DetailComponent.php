<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Cart;

class DetailComponent extends Component
{
    public $slug;
    public $qty;
    public function mount($slug){
        $this->slug=$slug;
        $this->qty=1;
    }



    public function store($product_id,$product_name,$product_price){
        Cart::instance('cart')->add($product_id,$product_name,$this->qty,$product_price)->associate('App\Models\Product');
        Session()->flash('success_message',' Item added in card');
        return redirect()->route('product.cart');

    }

    public function incrementQty(){
        $this->qty++;
    }
    public function decrementQty(){
        if($this->qty >1)
        {
            $this->qty--;
        }
    }

    public function render()
    {
        $product=Product::where('slug',$this->slug)->first();
        $popular_product=Product::inRandomOrder()->limit(5)->get();
        $related_product=Product::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();
        $sale=Sale::find(1);
        return view('livewire.detail-component',['product'=>$product,'related_product'=>$related_product,'popular_product'=>$popular_product ,'sale'=>$sale])->layout('layouts.base');
    }
}
