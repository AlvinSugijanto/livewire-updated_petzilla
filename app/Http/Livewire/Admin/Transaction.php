<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Transaction extends Component
{
    public function render()
    {
        return view('livewire.admin.transaction')->layout('livewire.layouts.admin-layout');
    }
}
