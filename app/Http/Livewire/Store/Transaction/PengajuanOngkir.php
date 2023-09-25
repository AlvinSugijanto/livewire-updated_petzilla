<?php

namespace App\Http\Livewire\Store\Transaction;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\DB;

use App\Models\Transaction;
use App\Models\InformasiPengiriman;

class PengajuanOngkir extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectedTransactionId, $selectedTransaction;
    public $currentOngkirModal, $currentDetailTransaksiModal ;
    public $jasa_pengiriman , $biaya_pengiriman;

    protected $listeners = ['cancelTransactionConfirmed' => 'cancelTransaction'];

    public function render()
    {
        $transactions = (new Transaction())->getPengajuanOngkirStore();
        return view('livewire.store.transaction.pengajuan-ongkir', ['transactions' => $transactions]);
    }
    public function openOngkirModal($id)
    {
        $this->selectedTransactionId = $id;
        $this->selectedTransaction = Transaction::where('id_transaction', $id)
                                                ->with('user')
                                                ->with('animal')
                                                ->first();
        $this->currentOngkirModal = 1;
        
    }
    public function submitOngkir()
    {
        $this->validate([
            'jasa_pengiriman' => 'required',
            'biaya_pengiriman' => 'required'
        ]);

        try {
            Transaction::where('id_transaction', $this->selectedTransactionId)
                ->update([
                    'status'            => 'menunggu_pembayaran',
                    'grand_total'       => DB::raw('sub_total + ' . $this->biaya_pengiriman)
                ]);
            InformasiPengiriman::create([
                'biaya_pengiriman'  => $this->biaya_pengiriman,
                'jasa_pengiriman'   => $this->jasa_pengiriman,
                'transaction_id_transaction' => $this->selectedTransactionId
            ]);
            $this->dispatchBrowserEvent('success-notification',['message' => 'Ongkos kirim berhasil ditambahkan, silahkan menunggu pembeli melakukan pembayaran']);
        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('error-modal');
        }
    }
    public function openDetailTransaksiModal($id)
    {
        $this->selectedTransaction = Transaction::where('id_transaction', $id)->first();
        $this->selectedTransaction->alamat = $this->selectedTransaction->user->getAddress($this->selectedTransaction->user->provinsi, $this->selectedTransaction->user->kabupaten, $this->selectedTransaction->user->kecamatan);
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
