<?php

namespace App\Http\Livewire\Store\Transaction;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Storage;

use App\Models\Transaction;
use App\Models\Rating;
use App\Models\ProductReport;
use App\Models\ProductReportPhoto;
use Livewire\WithFileUploads;

class SampaiTujuan extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $currentReportModal, $currentRatingModal;
    public $currentDetailTransaksiModal, $selectedTransaction;

    public $rating, $review;
    public $komentar, $complain_photo;


    public function render()
    {
        $transactions = (new Transaction())->getSampaiTujuanStore();
        return view('livewire.store.transaction.sampai-tujuan', ['transactions' => $transactions]);
    }
    public function openDetailTransaksiModal($id)
    {
        $this->selectedTransaction = Transaction::where('id_transaction', $id)->first();
        $this->selectedTransaction->alamat = $this->selectedTransaction->user->getAddress($this->selectedTransaction->user->provinsi, $this->selectedTransaction->user->kabupaten, $this->selectedTransaction->user->kecamatan);
        $this->currentDetailTransaksiModal = 1;

    }

}
