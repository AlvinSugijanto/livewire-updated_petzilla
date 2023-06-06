<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.landing-page')->layout('livewire.layouts.landing-page-layout');
    }
}
