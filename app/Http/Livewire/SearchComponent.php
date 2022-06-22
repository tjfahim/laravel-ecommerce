<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;
class SearchComponent extends Component
{

    public $sorting;
    public $pagesize;
    public $product_cat;
    public $product_cat_id;
    public $search;


    public function mount(){
        $this->sorting="default";
        $this->pagesize=8;
        $this->fill(request()->only('search','product_cat','product_cat_id'));
    }
    public function store($product_id,$product_name,$product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        Session()->flash('success_message',' Item has been added in card');
        return redirect()->route('product.cart');
    }

    use WithPagination;
    public function render()
    {
        if($this->sorting=='date'){
            $product =Product::where('name','like','%'.$this->search . '%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting=='price'){
            $product =Product::where('name','like','%'.$this->search . '%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else if($this->sorting=='price-desc'){
            $product =Product::where('name','like','%'.$this->search . '%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else {
            $product = Product::where('name','like','%'.$this->search . '%')->where('category_id','like','%'.$this->product_cat_id.'%')->paginate($this->pagesize);
        }
        $categories=Category::all();

        return view('livewire.search-component',['products'=>$product,'categories'=>$categories])->layout('layouts.base');
    }
}
