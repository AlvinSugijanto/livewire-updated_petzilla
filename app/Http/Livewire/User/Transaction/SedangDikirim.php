<?php

namespace App\Http\Livewire\User\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;

class SedangDikirim extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['modalConfirmed' => 'updateSedangDiKirim'];

    public $currentDetailTransaksiModal, $selectedTransaction;

    public function render()
    {
        $transactions = (new Transaction())->getSedangDiKirim();

        return view('livewire.user.transaction.sedang-dikirim',['transactions' => $transactions]);
    }
    public function updateSedangDiKirim($id)
    {
        Transaction::where('id_transaction', $id)->update([
            'status' => 'sampai_tujuan'
        ]);
    }
    public function openDetailTransaksiModal($id)
    {
        $this->selectedTransaction = Transaction::where('id_transaction', $id)->first();
        $this->selectedTransaction->alamat = $this->selectedTransaction->user->getAddress($this->selectedTransaction->user->provinsi, $this->selectedTransaction->user->kabupaten, $this->selectedTransaction->user->kecamatan);
        // dd($this->selectedTransaction->pengiriman->bukti_pengiriman);
        $this->currentDetailTransaksiModal = 1;
    }
}
