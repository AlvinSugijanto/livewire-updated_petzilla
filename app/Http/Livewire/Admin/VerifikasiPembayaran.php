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
        $transaction = Transaction::join('bukti_pembayaran', 'transaction.id_transaction', '=', 'bukti_pembayaran.transaction_id_transaction')
            ->where('transaction.status', 'review_pembayaran')
            ->orderBy('bukti_pembayaran.created_at', 'desc')
            ->with('user')
            ->paginate(10);

        return view(
            'livewire.admin.verifikasi-pembayaran',
            ['transactions' => $transaction]
        )
            ->layout('livewire.layouts.admin-layout');
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
        try {
            $transaction = Transaction::find($id);
            $transaction->status = 'sedang_diproses';
            $transaction->save();
        } catch (\Exception $e) {
        }
    }
    public function setujuiPembayaran($id)
    {
        try {
            $transaction = Transaction::find($id);
            $transaction->status = 'sedang_diproses';
            $transaction->save();
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error-modal');
        }
    }
}
