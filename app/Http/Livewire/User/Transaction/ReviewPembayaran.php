<?php

namespace App\Http\Livewire\User\Transaction;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaction;

class ReviewPembayaran extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $currentDetailTransaksiModal, $selectedTransaction;

    public function render()
    {
        $transactions = (new Transaction())->getReviewPembayaran();
        return view('livewire.user.transaction.review-pembayaran',['transactions' => $transactions]);
    }
    public function openDetailTransaksiModal($id)
    {
        $this->selectedTransaction = Transaction::where('id_transaction', $id)->first();
        $this->selectedTransaction->alamat = $this->selectedTransaction->user->getAddress($this->selectedTransaction->user->provinsi, $this->selectedTransaction->user->kabupaten, $this->selectedTransaction->user->kecamatan);
        $this->currentDetailTransaksiModal = 1;
        
    }
}
