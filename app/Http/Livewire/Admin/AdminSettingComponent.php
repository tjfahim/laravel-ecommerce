<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class AdminSettingComponent extends Component
{
    public $email;
    public $phone;
    public $phone2;
    public $address;
    public $map;
    public $twitter;
    public $facebook;
    public $pinterest;
    public $instagram;
    public $linkedin;




    public function mount(){
        $settings=Setting::find(1);
        if($settings){
            $this->email=$settings->email;
            $this->phone=$settings->phone;
            $this->phone2=$settings->phone2;
            $this->address=$settings->address;
            $this->map=$settings->map;
            $this->twitter=$settings->twitter;
            $this->facebook=$settings->facebook;
            $this->pinterest=$settings->pinterest;
            $this->instagram=$settings->instagram;
            $this->linkedin=$settings->linkedin;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'email'=>'required|email',
            'phone'=>'required',
            'phone2'=>'required',
            'address'=>'required',
            'map'=>'required',
            'twitter'=>'required',
            'facebook'=>'required',
            'pinterest'=>'required',
            'instagram'=>'required',
            'linkedin'=>'required',
        ]);
    }

    public function saveSettings(){
        $this->validate([
            'email'=>'required|email',
            'phone'=>'required',
            'phone2'=>'required',
            'address'=>'required',
            'map'=>'required',
            'twitter'=>'required',
            'facebook'=>'required',
            'pinterest'=>'required',
            'instagram'=>'required',
            'linkedin'=>'required',
        ]);
        $setting = Setting::find(1);
        if(!$setting){
            $setting=new Setting();
        }
       $setting->email=$this->email;
       $setting->phone=$this->phone;
       $setting->phone2=$this->phone2;
       $setting->address=$this->address;
       $setting->map=$this->map;
       $setting->twitter=$this->twitter;
       $setting->facebook=$this->facebook;
       $setting->pinterest=$this->pinterest;
       $setting->instagram=$this->instagram;
       $setting->linkedin=$this->linkedin;
       $setting->save();
       session()->flash('message','Settings has been saved successfully');



    }



    public function render()
    {
        return view('livewire.admin.admin-setting-component')->layout('layouts.base');
    }
}
