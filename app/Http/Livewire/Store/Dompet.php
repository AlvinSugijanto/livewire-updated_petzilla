<?php

namespace App\Http\Livewire\Store;

use Livewire\Component;

class Dompet extends Component
{
    public function render()
    {
        return view('livewire.store.dompet')->layout('livewire.layouts.tes-layout',['blueButton' => 'wallet']);
    }
}
