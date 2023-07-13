<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Events\PaymentSuccess;

class Base extends Component
{

    protected $listeners = ['logout' => 'logoutFunc'];


    public function render()
    {
        return view('livewire.layouts.base');
    }
    public function logoutFunc()
    {
        Auth::logout();

        return redirect('/login');

    }
}
