<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;
use App\Models\Transaction;

class DetailReport extends Component
{
    public $transaction, $type;

    protected $queryString = ['type'];

    public function mount($id_transaction)
    {
        $this->type = 'laporan';
        $this->transaction = Transaction::where('id_transaction', $id_transaction)->first();
    }

    public function render()
    {


        return view('livewire.admin.transaction.detail-report')
            ->layout('livewire.layouts.admin-layout');    
    }

    public function updateType($type)
    {
        $this->type = $type;
    }
}
