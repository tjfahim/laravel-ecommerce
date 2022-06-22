<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoriesComponent extends Component
{
    public function deleteCategory($id){
        $category=Category::find($id);
        $category->delete();
        session()->flash('message','Category successfully deleted');
    }
    use WithPagination;
    public function render()
    {

        $categories=Category::paginate(5);
        return view('livewire.admin.admin-categories-component',['categories'=>$categories])->layout('layouts.base');
    }
}
