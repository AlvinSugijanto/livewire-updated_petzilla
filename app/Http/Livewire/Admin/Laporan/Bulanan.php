<?php

namespace App\Http\Livewire\Admin\Laporan;

use Livewire\Component;

class Bulanan extends Component
{
    public function render()
    {
        return view('livewire.admin.laporan.bulanan')->layout('livewire.layouts.admin-layout');
    }
}
