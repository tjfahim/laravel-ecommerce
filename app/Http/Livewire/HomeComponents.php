<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class HomeComponents extends Component
{
    public function render()
    {
        $slider=HomeSlider::where('status','1')->get();
        $Lproduct=Product::orderBy('created_at','DESC')->get()->take(8);
        $category=HomeCategory::find(1);
        $cats=explode(',',$category->sel_categories);
        $categories=Category::whereIn('id',$cats)->get();
        $no_of_product=$category->no_of_products;
        $sproducts=Product::where('sele_price','>',0)->inRandomOrder()->get()->take(8);
        $sale=Sale::find(1);
        return view('livewire.home-components',['slider'=>$slider,'Lproduct'=>$Lproduct,'categories'=>$categories,'no_of_product'=>$no_of_product,'sproducts'=>$sproducts,'sale'=>$sale])->layout('layouts.base');
    }
}
