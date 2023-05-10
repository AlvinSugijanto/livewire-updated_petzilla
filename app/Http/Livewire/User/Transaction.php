<?php

namespace App\Http\Livewire\User;

use App\Models\BuktiPembayaran;
use Livewire\Component;
use App\Models\Transaction as UserTransaction;
use Auth;

use Livewire\WithFileUploads;

class Transaction extends Component
{

    use WithFileUploads;

    public $pengajuan_ongkir, $pengajuan_ongkir_count;

    public $menunggu_pembayaran, $menunggu_pembayaran_count;
    public $tipe_rekening, $metode_pembayaran, $nama_rekening, $nomor_rekening, $foto_bukti;

    public $currentModalStep, $selectedTransactionId;


    public function render()
    {
        $this->getDataPengajuanOngkir();
        $this->getDataMenungguPembayaran();

        return view('livewire.user.transaction')->layout('livewire.layouts.base');
    }
    public function getDataPengajuanOngkir()
    {

        $this->pengajuan_ongkir = UserTransaction::where('users_id_user', Auth::id())
            ->where('status', 'pengajuan_ongkir')
            ->with('store')
            ->with('animal')
            ->get();

        $this->pengajuan_ongkir = $this->pengajuan_ongkir->map(function ($item, $key) {
            $item->store->alamat = $item->store->getAddress($item->store->provinsi, $item->store->kabupaten, $item->store->kecamatan);
            return $item;
        });
        $this->pengajuan_ongkir_count = count($this->pengajuan_ongkir);
    }
    public function getDataMenungguPembayaran()
    {
        $this->menunggu_pembayaran = UserTransaction::where('users_id_user', Auth::id())
            ->where('status', 'menunggu_pembayaran')
            ->with('store')
            ->with('animal')
            ->with('pengiriman')
            ->get();

        $this->menunggu_pembayaran = $this->menunggu_pembayaran->map(function ($item, $key) {
            $item->store->alamat = $item->store->getAddress($item->store->provinsi, $item->store->kabupaten, $item->store->kecamatan);
            return $item;
        });
        $this->menunggu_pembayaran_count = count($this->menunggu_pembayaran);
    }
    public function openPembayaranModal($id)
    {
        $this->selectedTransactionId = $id;
        $this->currentModalStep = 1;
    }
    public function nextStepModal()
    {
        $this->currentModalStep++;
    }
    public function submitOngkir()
    {
        UserTransaction::where('id_transaction', $this->selectedTransactionId)
            ->update([
                'status'            => 'sedang_diproses',
            ]);
        BuktiPembayaran::create([
            'metode_pembayaran'  => $this->metode_pembayaran,
            'nama_rekening'   => $this->nama_rekening,
            'nomor_rekening'   => $this->nomor_rekening,
            'transaction_id_transaction' => $this->selectedTransactionId
        ]);
    }
}
