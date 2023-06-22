<?php

namespace App\Http\Livewire\Error;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use Livewire\Component;



class UserNotFound extends Component
{

    public function render()
    {
        return view('livewire.error.user-not-found')->layout('livewire.layouts.base');
    }
    public function returnBack()
    {
        return redirect()->to('/home');
    }
}
