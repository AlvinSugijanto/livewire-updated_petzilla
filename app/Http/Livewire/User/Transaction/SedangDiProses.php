<?php

namespace App\Http\Livewire\User\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;

class SedangDiProses extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $currentDetailTransaksiModal, $selectedTransaction;

    public function render()
    {
        $transactions = (new Transaction())->getSedangDiProses();

        return view('livewire.user.transaction.sedang-di-proses',['transactions' => $transactions]);
    }
    public function openDetailTransaksiModal($id)
    {
        $this->selectedTransaction = Transaction::where('id_transaction', $id)->first();
        $this->currentDetailTransaksiModal = 1;

    }
}
