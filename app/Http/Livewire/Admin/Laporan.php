<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Laporan extends Component
{
    public function render()
    {
        return view('livewire.admin.laporan')->layout('livewire.layouts.admin-layout');
    }
}
