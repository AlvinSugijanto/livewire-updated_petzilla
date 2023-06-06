<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Events\PaymentSuccess;

class Base extends Component
{

    public function render()
    {
        return view('livewire.layouts.base');
    }
}
