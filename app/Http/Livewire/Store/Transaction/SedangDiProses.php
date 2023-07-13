<?php

namespace App\Http\Livewire\Store\Transaction;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Storage;

use App\Models\Transaction;
use App\Models\InformasiPengiriman;

class SedangDiProses extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $selectedTransactionId, $selectedTransaction, $currentDetailTransaksiModal;
    public $currentProsesModal;
    public $bukti_pengiriman;

    public function render()
    {
        $transactions = (new Transaction())->getSedangDiProsesStore();

        return view('livewire.store.transaction.sedang-di-proses',['transactions' => $transactions]);
    }
    public function openProsesModal($id)
    {
        $this->selectedTransactionId = $id;
        $this->selectedTransaction = Transaction::where('id_transaction', $id)
                                                ->with('user')
                                                ->with('animal')
                                                ->first();
        $this->currentProsesModal = 1;

    }
    public function submitBuktiPengiriman()
    {
        $this->validate([
            'bukti_pengiriman'  => 'required'
        ]);

        try {
            Transaction::where('id_transaction', $this->selectedTransactionId)
                ->update([
                    'status'            => 'sedang_dikirim'
                ]);
            InformasiPengiriman::where('transaction_id_transaction', $this->selectedTransactionId)
                ->update([
                    'bukti_pengiriman'  => Storage::disk('public')->put($this->selectedTransactionId, $this->bukti_pengiriman)
                ]);
            $this->dispatchBrowserEvent('success-notification',['message' => 'Terima kasih telah memproses transaksi, silahkan tetap berhubungan dengan pembeli untuk memastikan hewan sudah datang'] );

        } catch (\Exception $e) {
            
            $this->dispatchBrowserEvent('error-modal');
        }
    }
    public function openDetailTransaksiModal($id)
    {
        $this->selectedTransaction = Transaction::where('id_transaction', $id)->first();
        $this->currentDetailTransaksiModal = 1;

    }
}
