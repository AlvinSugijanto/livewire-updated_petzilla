<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

use Auth;
use App\Services\Tripay;

use App\Models\BuktiPembayaran;
use App\Models\Transaction as UserTransaction;

use Livewire\WithFileUploads;

class Transaction extends Component
{

    use WithFileUploads;

    public $pengajuan_ongkir, $pengajuan_ongkir_count;
    public $menunggu_pembayaran, $menunggu_pembayaran_count;
    public $sedang_diproses, $sedang_diproses_count;
    public $sedang_dikirim, $sedang_dikirim_count;

    public $tipe_rekening, $metode_pembayaran, $nama_rekening, $nomor_rekening, $foto_bukti;

    public $currentModalStep, $selectedTransactionId, $selectedTransaction;

    public $payment_channels;

    public function render()
    {
        $this->getDataPengajuanOngkir();
        $this->getDataMenungguPembayaran();
        $this->getDataSedangDiProses();
        $this->getDataSedangDiKirim();

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
            ->with('user')
            ->get();

        $this->menunggu_pembayaran = $this->menunggu_pembayaran->map(function ($item, $key) {
            $item->store->alamat = $item->store->getAddress($item->store->provinsi, $item->store->kabupaten, $item->store->kecamatan);
            return $item;
        });
        $this->menunggu_pembayaran_count = count($this->menunggu_pembayaran);
    }
    public function getDataSedangDiProses()
    {
        $this->sedang_diproses = UserTransaction::where('users_id_user', Auth::id())
            ->where('status', 'sedang_diproses')
            ->with('store')
            ->with('animal')
            ->with('pengiriman')
            ->with('user')
            ->get();

        $this->sedang_diproses = $this->sedang_diproses->map(function ($item, $key) {
            $item->user->alamat = $item->user->getAddress($item->user->provinsi, $item->user->kabupaten, $item->user->kecamatan);
            return $item;
        });
        $this->sedang_diproses_count = count($this->sedang_diproses);
    }
    public function getDataSedangDiKirim()
    {
        $this->sedang_dikirim = UserTransaction::where('users_id_user', Auth::id())
            ->where('status', 'sedang_dikirim')
            ->with('store')
            ->with('animal')
            ->with('pengiriman')
            ->with('user')
            ->get();

        $this->sedang_dikirim = $this->sedang_dikirim->map(function ($item, $key) {
            $item->user->alamat = $item->user->getAddress($item->user->provinsi, $item->user->kabupaten, $item->user->kecamatan);
            return $item;
        });
        $this->sedang_dikirim_count = count($this->sedang_dikirim);
    }
    public function openPembayaranModal($id)
    {
        $this->selectedTransactionId = $id;
        $this->selectedTransaction = $this->menunggu_pembayaran->where('id_transaction',$id)->first();
        $this->currentModalStep = 1;

        $payment = new Tripay();
        $this->payment_channels = $payment->get_payment_channels();
        // dd($this->payment_channels);
    }
    public function nextStepModal()
    {
        $this->currentModalStep++;
    }
    
    public function create_tripay_transaction()
    {
        $data = $this->menunggu_pembayaran->where('id_transaction', $this->selectedTransactionId)->first();

        $payment = new Tripay();
        $response_data = $payment->request_transaction($data);

        if($response_data)
        {
            UserTransaction::where('id_transaction',$this->selectedTransactionId)->update([
                'payment_reference' => $response_data->reference
            ]);

            return redirect()->to('/user/detail_pembayaran/'.$response_data->reference);

        }
    }
}
