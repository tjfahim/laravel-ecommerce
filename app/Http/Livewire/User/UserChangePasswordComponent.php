<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserChangePasswordComponent extends Component
{
    public $current_password;
    public $password;
    public $confirm_password;


    // public function updated($fields)
    // {
    //     $this->validate($fields,[
    //         'current_password'=>'required',
    //         'password'=>'required|min:4|confirmed|different:current_password',
    //     ]);
    // }

    public function ChangePassword()
    {
    //    $this->validate([
    //     'current_password'=>'required',
    //     'password'=>'required|min:4|confirmed|different:current_password',
    //     'confirm_password'=>'required'
    //    ]);

       if(Hash::check($this->current_password,Auth::user()->password)){
        $user=User::findOrFail(Auth::user()->id);
        $user->password =Hash::make($this->password);
        $user->save();
        session()->flash('password_success','password has been change successfully');
       }
       else{
        session()->flash('password_error','password does not match');
       }
    }

    public function render()
    {
        return view('livewire.user.user-change-password-component')->layout('layouts.base');
    }
}
