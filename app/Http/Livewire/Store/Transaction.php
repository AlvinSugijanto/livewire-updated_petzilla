<?php

namespace App\Http\Livewire\Store;

use Livewire\Component;

use App\Models\Transaction as StoreTransaction;
use App\Models\User;
use App\Models\InformasiPengiriman;
use App\Models\ListAnimal;

use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Transaction extends Component
{

    use WithFileUploads;

    protected $queryString = ['type'];
    public $type;

    public $pengajuan_ongkir, $pengajuan_ongkir_count;
    public $menunggu_pembayaran, $menunggu_pembayaran_count;
    public $sedang_diproses, $sedang_diproses_count;
    public $sedang_dikirim, $sedang_dikirim_count;
    public $sampai_tujuan;

    public $selectedTransactionId;

    public $jasa_pengiriman, $biaya_pengiriman;
    public $bukti_pengiriman;

    public $completedTransaction;
    public $currentStore;

    public function mount()
    {
        $this->type = 'ongoing';

        $this->currentStore = User::find(Auth::id())->store;

        $transactions = (new StoreTransaction)->getTransactionDataStore($this->currentStore);


        $this->pengajuan_ongkir = $transactions->has('pengajuan_ongkir') ? $transactions['pengajuan_ongkir'] : collect();
        $this->menunggu_pembayaran = $transactions->has('menunggu_pembayaran') ? $transactions['menunggu_pembayaran'] : collect();
        $this->sedang_diproses = $transactions->has('sedang_diproses') ? $transactions['sedang_diproses'] : collect();
        $this->sedang_dikirim = $transactions->has('sedang_dikirim') ? $transactions['sedang_dikirim'] : collect();
        $this->sampai_tujuan = $transactions->has('sampai_tujuan') ? $transactions['sampai_tujuan'] : collect();

        // $this->pengajuan_ongkir = $transactions['pengajuan_ongkir'];
        // $this->menunggu_pembayaran = $transactions['menunggu_pembayaran'];
        // $this->sedang_diproses = $transactions['sedang_diproses'];
        // $this->sedang_dikirim = $transactions['sedang_dikirim'];
        // $this->sampai_tujuan = $transactions['sampai_tujuan'];
    }
    public function render()
    {
        return view('livewire.store.transaction')->layout('livewire.layouts.tes-layout', ['blueButton' => 'transaksi']);
    }
    public function openModal($id)
    {
        $this->selectedTransactionId = $id;
    }
    public function submitOngkir()
    {
        $this->validate([
            'jasa_pengiriman' => 'required',
            'biaya_pengiriman' => 'required'
        ]);

        try {
            StoreTransaction::where('id_transaction', $this->selectedTransactionId)
                ->update([
                    'status'            => 'menunggu_pembayaran',
                    'grand_total'       => DB::raw('sub_total + ' . $this->biaya_pengiriman)
                ]);
            InformasiPengiriman::create([
                'biaya_pengiriman'  => $this->biaya_pengiriman,
                'jasa_pengiriman'   => $this->jasa_pengiriman,
                'transaction_id_transaction' => $this->selectedTransactionId
            ]);
            $this->dispatchBrowserEvent('success-notification');
        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('error-modal');
        }
    }
    public function submitBuktiPengiriman()
    {
        $this->validate([
            'bukti_pengiriman'  => 'required'
        ]);

        try {
            StoreTransaction::where('id_transaction', $this->selectedTransactionId)
                ->update([
                    'status'            => 'sedang_dikirim'
                ]);
            InformasiPengiriman::where('transaction_id_transaction', $this->selectedTransactionId)
                ->update([
                    'bukti_pengiriman'  => Storage::disk('public')->put($this->selectedTransactionId, $this->bukti_pengiriman)
                ]);
            $this->dispatchBrowserEvent('success-notification');

        } catch (\Exception $e) {
            
            $this->dispatchBrowserEvent('error-modal');
        }
    }

    // public function getDataPengajuanOngkir($store)
    // {

    //     $this->pengajuan_ongkir = StoreTransaction::where('store_id_store', $store->id_store)
    //         ->where('status', 'pengajuan_ongkir')
    //         ->with('user')
    //         ->with('animal')
    //         ->get();

    //     $this->pengajuan_ongkir = $this->pengajuan_ongkir->map(function ($item, $key) {
    //         $item->user->alamat = $item->user->getAddress($item->user->provinsi, $item->user->kabupaten, $item->user->kecamatan);
    //         return $item;
    //     });
    //     $this->pengajuan_ongkir_count = count($this->pengajuan_ongkir);
    // }
    // public function getDataMenungguPembayaran($store)
    // {
    //     $this->menunggu_pembayaran = StoreTransaction::where('store_id_store', $store->id_store)
    //         ->where('status', 'menunggu_pembayaran')
    //         ->with('user')
    //         ->with('animal')
    //         ->with('pengiriman')
    //         ->get();

    //     $this->menunggu_pembayaran = $this->menunggu_pembayaran->map(function ($item, $key) {
    //         $item->user->alamat = $item->user->getAddress($item->user->provinsi, $item->user->kabupaten, $item->user->kecamatan);
    //         return $item;
    //     });
    //     $this->menunggu_pembayaran_count = count($this->menunggu_pembayaran);
    // }
    // public function getDataSedangDiProses($store)
    // {
    //     $this->sedang_diproses = StoreTransaction::where('store_id_store', $store->id_store)
    //         ->where('status', 'sedang_diproses')
    //         ->with('user')
    //         ->with('animal')
    //         ->with('pengiriman')
    //         ->get();

    //     $this->sedang_diproses = $this->sedang_diproses->map(function ($item, $key) {
    //         $item->user->alamat = $item->user->getAddress($item->user->provinsi, $item->user->kabupaten, $item->user->kecamatan);
    //         return $item;
    //     });
    //     $this->sedang_diproses_count = count($this->sedang_diproses);
    // }
    // public function getDataSedangDiKirim($store)
    // {
    //     $this->sedang_dikirim = StoreTransaction::where('store_id_store', $store->id_store)
    //         ->where('status', 'sedang_dikirim')
    //         ->with('user')
    //         ->with('animal')
    //         ->with('pengiriman')
    //         ->get();

    //     $this->sedang_dikirim = $this->sedang_dikirim->map(function ($item, $key) {
    //         $item->user->alamat = $item->user->getAddress($item->user->provinsi, $item->user->kabupaten, $item->user->kecamatan);
    //         return $item;
    //     });
    //     $this->sedang_dikirim_count = count($this->sedang_dikirim);
    // }
    public function updateType($aa)
    {
        $this->type = $aa;
    }
}
