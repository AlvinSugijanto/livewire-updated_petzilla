<?php

namespace App\Http\Livewire\User\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;

class PengajuanOngkir extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $currentDetailTransaksiModal, $selectedTransaction;

    protected $listeners = ['cancelTransactionConfirmed' => 'cancelTransaction'];
    
    public function render()
    {
        $transactions = (new Transaction())->getPengajuanOngkir();
        return view('livewire.user.transaction.pengajuan-ongkir',['transactions' => $transactions]);
    }
    public function openDetailTransaksiModal($id)
    {
        $this->selectedTransaction = Transaction::where('id_transaction', $id)->first();
        $this->currentDetailTransaksiModal = 1;
    }
    public function cancelTransaction($id)
    {
        $transaction = Transaction::where('id_transaction', $id)
                                    ->first();

        $transaction->update([
            'status' => 'batal'
        ]);
        $transaction->save();

    }
}
