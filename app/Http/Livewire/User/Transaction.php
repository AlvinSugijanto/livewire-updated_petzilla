<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Transaction extends Component
{
    public function render()
    {
        return view('livewire.user.transaction')->layout('livewire.layouts.base');
    }
}
