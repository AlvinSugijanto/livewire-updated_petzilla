<?php

namespace App\Http\Livewire\Admin\Transaction\TransactionComponent;

use Livewire\Component;

class InformasiLaporan extends Component
{
    public $transaction;
    
    public function render()
    {
        return view('livewire.admin.transaction.transaction-component.informasi-laporan');
    }
}
