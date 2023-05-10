<?php

namespace App\Http\Livewire\Store;

use Livewire\Component;

use App\Models\Transaction as StoreTransaction;
use App\Models\User;
use App\Models\InformasiPengiriman;
use Auth;
use DB;

class Transaction extends Component
{
    protected $queryString = ['type'];
    public $type;

    public $pengajuan_ongkir, $pengajuan_ongkir_count;
    public $menunggu_pembayaran, $menunggu_pembayaran_count;
    public $sedang_diproses, $sedang_diproses_count;

    public $selectedTransactionId;

    public $jasa_pengiriman, $biaya_pengiriman;


    public function mount()
    {
        $this->type = 'ongoing';
    }
    public function render()
    {
        $store = User::find(Auth::id())->store;
        
        $this->getDataPengajuanOngkir($store);
        $this->getDataMenungguPembayaran($store);
        $this->getDataSedangDiProses($store);

        return view('livewire.store.transaction')->layout('livewire.layouts.tes-layout', ['blueButton' => 'transaksi']);
    }
    public function openModal($id)
    {
        $this->selectedTransactionId = $id;
    }
    public function submitOngkir()
    {
        StoreTransaction::where('id_transaction', $this->selectedTransactionId)
            ->update([
                'status'            => 'menunggu_pembayaran',
                'grand_total'       => DB::raw('sub_total + '.$this->biaya_pengiriman)
            ]);
        InformasiPengiriman::create([
            'biaya_pengiriman'  => $this->biaya_pengiriman,
            'jasa_pengiriman'   => $this->jasa_pengiriman,
            'transaction_id_transaction' => $this->selectedTransactionId
        ]);

        $this->dispatchBrowserEvent('success-notification');
    }
    public function getDataPengajuanOngkir($store)
    {

        $this->pengajuan_ongkir = StoreTransaction::where('store_id_store', $store->id_store)
            ->where('status', 'pengajuan_ongkir')
            ->with('user')
            ->with('animal')
            ->get();

        $this->pengajuan_ongkir = $this->pengajuan_ongkir->map(function ($item, $key) {
            $item->user->alamat = $item->user->getAddress($item->user->provinsi, $item->user->kabupaten, $item->user->kecamatan);
            return $item;
        });
        $this->pengajuan_ongkir_count = count($this->pengajuan_ongkir);

    }
    public function getDataMenungguPembayaran($store)
    {
        $this->menunggu_pembayaran = StoreTransaction::where('store_id_store', $store->id_store)
            ->where('status', 'menunggu_pembayaran')
            ->with('user')
            ->with('animal')
            ->with('pengiriman')
            ->get();

        $this->menunggu_pembayaran = $this->menunggu_pembayaran->map(function ($item, $key) {
            $item->user->alamat = $item->user->getAddress($item->user->provinsi, $item->user->kabupaten, $item->user->kecamatan);
            return $item;
        });
        $this->menunggu_pembayaran_count = count($this->menunggu_pembayaran);
    }
    public function getDataSedangDiProses($store)
    {
        $this->sedang_diproses = StoreTransaction::where('store_id_store', $store->id_store)
            ->where('status', 'sedang_diproses')
            ->with('user')
            ->with('animal')
            ->with('pengiriman')
            ->get();

        $this->sedang_diproses = $this->sedang_diproses->map(function ($item, $key) {
            $item->user->alamat = $item->user->getAddress($item->user->provinsi, $item->user->kabupaten, $item->user->kecamatan);
            return $item;
        });
        $this->sedang_diproses_count = count($this->sedang_diproses);
    }
}
