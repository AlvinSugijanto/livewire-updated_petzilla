<?php

namespace App\Http\Livewire\User;

use App\Libraries\Races\Cat;
use Livewire\Component;

use App\Services\Tripay;

use App\Models\BuktiPembayaran;
use App\Models\Transaction as UserTransaction;
use App\Models\ProductReport;
use App\Models\ProductReportPhoto;
use App\Models\Rating;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Transaction extends Component
{

    use WithFileUploads;

    protected $queryString = ['type','status'];
    public $type, $status;

    public $pengajuan_ongkir, $menunggu_pembayaran, $sedang_diproses, $sedang_dikirim, $sampai_tujuan;

    public $tipe_rekening, $jenis_rekening, $nama_rekening, $nomor_rekening, $bukti_pembayaran;
    public $komentar, $complain_photo;
    public $rating, $review;

    public $currentModalStep, $selectedTransactionId, $selectedTransaction, $currentReportModal, $currentRatingModal;

    public $payment_channels;
    public $completedTransaction;

    public $currentUser;



    public function mount()
    {

        $this->type = 'ongoing';
        $this->status = 'pengajuan_ongkir';
    }
    public function render()
    {
        // $this->currentUser = Auth::user();
        // $this->currentUser->alamat = $this->currentUser->getAddress($this->currentUser->provinsi, $this->currentUser->kabupaten, $this->currentUser->kecamatan);

        // $transactions = (new UserTransaction)->getTransactionData($this->currentUser);

        // $this->pengajuan_ongkir = $transactions->has('pengajuan_ongkir') ? $transactions['pengajuan_ongkir'] : collect();
        // $this->menunggu_pembayaran = $transactions->has('menunggu_pembayaran') ? $transactions['menunggu_pembayaran'] : collect();
        // $this->sedang_diproses = $transactions->has('sedang_diproses') ? $transactions['sedang_diproses'] : collect();
        // $this->sedang_dikirim = $transactions->has('sedang_dikirim') ? $transactions['sedang_dikirim'] : collect();
        // $this->sampai_tujuan = $transactions->has('sampai_tujuan') ? $transactions['sampai_tujuan'] : collect();

        
        return view('livewire.user.transaction')->layout('livewire.layouts.base');
    }

    // public function openPembayaranModal($id)
    // {
    //     $this->selectedTransactionId = $id;
    //     $this->selectedTransaction = $this->menunggu_pembayaran->where('id_transaction', $id)->first();
    //     $this->currentModalStep = 1;

    //     $payment = new Tripay();
    //     $this->payment_channels = $payment->get_payment_channels();
    //     dd($this->payment_channels);
    // }
    // public function nextStepModal()
    // {
    //     $this->currentModalStep++;
    // }
    // public function previousStepModal()
    // {
    //     $this->currentModalStep--;
    // }

    // public function submitPembayaran()
    // {
    //     $data = $this->validate([
    //         'tipe_rekening' => 'required',
    //         'jenis_rekening' => 'required',
    //         'nama_rekening'  => 'required',
    //         'nomor_rekening' => 'required',
    //         'bukti_pembayaran' => 'required'
    //     ]);


    //     try {
    //         $data['bukti_pembayaran'] = Storage::disk('public')->put($this->selectedTransactionId, $this->bukti_pembayaran);
    //         $data['transaction_id_transaction'] = $this->selectedTransactionId;

    //         BuktiPembayaran::create($data);

    //         $this->selectedTransaction->update([
    //             'status' => 'review_pembayaran'
    //         ]);

    //         $this->dispatchBrowserEvent('success-modal');
    //     } catch (\Exception $e) {

    //         $this->dispatchBrowserEvent('error-modal');
    //     }
    // }
    // public function create_tripay_transaction()
    // {
    //     $data = $this->menunggu_pembayaran->where('id_transaction', $this->selectedTransactionId)->first();

    //     $payment = new Tripay();
    //     $response_data = $payment->request_transaction($data);

    //     if ($response_data) {
    //         UserTransaction::where('id_transaction', $this->selectedTransactionId)->update([
    //             'payment_reference' => $response_data->reference
    //         ]);

    //         return redirect()->to('/user/detail_pembayaran/' . $response_data->reference);
    //     }
    // }

    // public function updateSedangDiKirim($id)
    // {
    //     UserTransaction::where('id_transaction', $id)->update([
    //         'status' => 'sampai_tujuan'
    //     ]);
    // }

    // public function reportProduct($id)
    // {
    //     $this->selectedTransactionId = $id;
    //     $this->selectedTransaction = $this->sampai_tujuan->where('id_transaction', $id)->first();
    //     $this->currentReportModal = 1;
    // }

    // public function submitReport()
    // {

    //     $this->validate([
    //         'komentar' => 'required',
    //         'complain_photo' => 'required'
    //     ]);

    //     try {

    //         $report = ProductReport::create([
    //             'komentar' => $this->komentar,
    //             'status'   => 'dalam_review',
    //             'transaction_id_transaction' => $this->selectedTransaction->id_transaction
    //         ]);

    //         foreach ($this->complain_photo as $photo) {
    //             ProductReportPhoto::create([
    //                 'photo' => Storage::disk('public')->put('', $photo),
    //                 'complain_id' => $report->id
    //             ]);
    //         };

    //         $this->selectedTransaction->update([
    //             'status' => 'dalam_masalah'
    //         ]);

    //         $this->dispatchBrowserEvent('submitted-report');
    //     } catch (\Exception $e) {

    //         $this->dispatchBrowserEvent('error-modal');
    //     }
    // }

    // public function ratingProduct($id)
    // {
    //     $this->selectedTransactionId = $id;
    //     $this->selectedTransaction = $this->sampai_tujuan->where('id_transaction', $id)->first();
    //     $this->currentRatingModal = 1;
    // }
    // public function submitRating()
    // {
    //     $this->validate([
    //         'rating' => 'required',
    //     ]);

    //     try {
    //         Rating::create([
    //             'rating' => $this->rating,
    //             'review' => $this->review,
    //             'transaction_id_transaction' => $this->selectedTransactionId
    //         ]);

    //         UserTransaction::where('id_transaction', $this->selectedTransactionId)->update([
    //             'status' => 'selesai'
    //         ]);

    //         $this->dispatchBrowserEvent('submitted-rating');

    //     } catch (\Exception $e) {
    //         $this->dispatchBrowserEvent('error-modal');
    //     }

    // }
    public function updateType($type)
    {
        $this->type = $type;
    }
    public function updateStatus($status)
    {
        $this->status = $status;
    }
}
