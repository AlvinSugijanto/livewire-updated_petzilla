<?php

namespace App\Http\Livewire\Admin;

use App\Models\Transaction;
use App\Models\BuktiPembayaran;
use Livewire\Component;
use Livewire\WithPagination;

class VerifikasiPembayaran extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $currentDetailPembayaranModal;
    public $selectedTransaction;

    protected $listeners = ['modalConfirmed' => 'updateStatusTransaksi'];

    public function render()
    {
        $transaction = Transaction::where('status', 'review_pembayaran')
            ->has('pembayaran')
            ->with('pembayaran')
            ->with('user')
            ->paginate(10);
// dd($transaction);
        return view('livewire.admin.verifikasi-pembayaran', ['transactions' => $transaction])->layout('livewire.layouts.admin-layout');
    }
    public function openDetailModal($id)
    {
        $this->currentDetailPembayaranModal = 1;
        $this->selectedTransaction = Transaction::where('id_transaction', $id)
                                                ->where('status', 'review_pembayaran')
                                                ->with('pembayaran')
                                                ->with('animal')
                                                ->first();

                                                // dd($this->selectedTransaction);
    }
    public function updateStatusTransaksi($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = 'sedang_diprose';
        $transaction->save();
    }
}
