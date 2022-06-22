<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $status;
    public $image;
    public $newimage;
    public $slide_id;

    public function mount($slide_id){
        $slider =HomeSlider::find($slide_id);
        $this->title=$slider->title;
        $this->subtitle=$slider->subtitle;
        $this->price=$slider->price;
        $this->link=$slider->link;
        $this->image=$slider->image;
        $this->status=$slider->status;
        $this->slide_id=$slider->id;
    }

    public function updateSlide(){
        $slider=HomeSlider::find($this->slide_id);
        $slider->title=$this->title;
        $slider->subtitle=$this->subtitle;
        $slider->price=$this->price;
        $slider->link=$this->link;
        $slider->status=$this->status;
        if($this->newimage){
            $imageName=Carbon::now()->timestamp.'.'.$this->newimage->extension();
            $this->newimage->storeAs('sliders',$imageName);
            $slider->image=$imageName;
        }
        $slider->save();
        session()->flash('message','Slider has been updated');
    }


    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout('layouts.base');
    }
}
