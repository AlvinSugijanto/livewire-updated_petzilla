<?php

namespace App\Http\Livewire\Store;

use Livewire\Component;

class Transaction extends Component
{
    protected $queryString = ['type'];

    public $type;

    public function mount()
    {
        $this->type = 'ongoing';
    }
    public function render()
    {
        return view('livewire.store.transaction')->layout('livewire.layouts.tes-layout',['blueButton' => 'transaksi']);
    }
}
