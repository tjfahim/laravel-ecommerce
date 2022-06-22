<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $status;
    public $image;

    public function mount(){
        $this->status=0;
    }

    public function addSlide(){
        $slider = new HomeSlider();
        $slider-> title = $this->title;
        $slider-> subtitle = $this->subtitle;
        $slider-> price = $this->price;
        $slider-> link = $this->link;
        $slider-> status = $this->status;
        $imageName=Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('sliders',$imageName);
        $slider-> image = $imageName;
        $slider->save();
        session()->flash('message','Slide has been created successfully');

    }

    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component')->layout('layouts.base');
    }
}
