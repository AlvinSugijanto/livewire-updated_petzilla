<?php

namespace App\Http\Livewire\Admin\Transaction;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaction as AdminTransaction;
use App\Models\ListAnimal;
class Transaction extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $transaction = ListAnimal::where('status','menunggu_persetujuan')->get();
        return view('livewire.admin.transaction.transaction',['transaction' => $transaction])->layout('livewire.layouts.admin-layout');
    }
}
