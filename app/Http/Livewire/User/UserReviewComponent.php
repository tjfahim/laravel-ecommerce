<?php

namespace App\Http\Livewire\User;

use App\Models\OrdarItem;
use App\Models\R_reviews;
use Livewire\Component;

class UserReviewComponent extends Component
{
    public $order_item_id;
    public $rating;
    public $comment;

    public function mount($order_item_id){
        $this->order_item_id=$order_item_id;
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'rating'=>'required',
            'comment'=>'required'
        ]);
    }

    public function addReview(){
        $this->validate([
            'rating'=>'required',
            'comment'=>'required'
        ]);
        $review= new R_reviews();
        $review->rating=$this->rating;
        $review->comment=$this->comment;
        $review->order_item_id=$this->order_item_id;
        $review->save();
        $orderItem=OrdarItem::find($this->order_item_id);
        $orderItem->rstatus=true;
        $orderItem->save();
        session()->flash('message','Your review has been added');
    }

    public function render()
    {
        $orderItem=OrdarItem::find($this->order_item_id);
        return view('livewire.user.user-review-component',['orderItem'=>$orderItem])->layout('layouts.base');
    }
}
