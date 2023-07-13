<?php

namespace App\Http\Livewire\Store\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;

class SedangDikirim extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $currentDetailTransaksiModal, $selectedTransaction;

    public function render()
    {
        $transactions = (new Transaction())->getSedangDiKirimStore();

        return view('livewire.store.transaction.sedang-dikirim',['transactions' => $transactions]);
    }
    public function openDetailTransaksiModal($id)
    {
        $this->selectedTransaction = Transaction::where('id_transaction', $id)->first();
        $this->currentDetailTransaksiModal = 1;

    }
}
