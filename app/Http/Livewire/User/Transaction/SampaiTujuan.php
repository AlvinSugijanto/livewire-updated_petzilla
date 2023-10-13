<?php

namespace App\Http\Livewire\User\Transaction;

use Livewire\Component;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Storage;

use App\Models\Transaction;
use App\Models\Rating;
use App\Models\ProductReport;
use App\Models\ProductReportPhoto;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class SampaiTujuan extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $currentReportModal, $currentRatingModal;
    public $selectedTransaction, $selectedTransactionId;

    public $rating, $review;
    public $komentar, $complain_photo;


    public function render()
    {
        $transactions = (new Transaction())->getSampaiTujuan();
        return view('livewire.user.transaction.sampai-tujuan', ['transactions' => $transactions]);
    }
    public function reportProduct($id)
    {
        $this->selectedTransactionId = $id;
        $this->selectedTransaction = Transaction::where('id_transaction', $id)
                                    ->with('user')
                                    ->with('detailTransaction')
                                    ->first();
        $this->currentReportModal = 1;
    }
    public function submitReport()
    {

        $this->validate([
            'komentar' => 'required',
            'complain_photo' => 'required'
        ]);

        try {

            $report = ProductReport::create([
                'komentar' => $this->komentar,
                'status'   => 'dalam_review',
                'transaction_id_transaction' => $this->selectedTransaction->id_transaction
            ]);

            foreach ($this->complain_photo as $photo) {
                ProductReportPhoto::create([
                    'photo' => Storage::disk('public')->put('', $photo),
                    'complain_id' => $report->id
                ]);
            };

            $this->selectedTransaction->update([
                'status' => 'dalam_masalah'
            ]);

            $this->dispatchBrowserEvent('submitted-report');
        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('error-modal');
        }
    }

    public function ratingProduct($id)
    {
        $this->selectedTransactionId = $id;
        $this->selectedTransaction = Transaction::where('id_transaction', $id)
                                                ->with('user')
                                                ->with('detailTransaction')
                                                ->first();
        $this->currentRatingModal = 1;
    }
    public function submitRating()
    {
        $this->validate([
            'rating' => 'required',
        ]);

        try {
            Rating::create([
                'rating' => $this->rating,
                'review' => $this->review,
                'transaction_id_transaction' => $this->selectedTransactionId
            ]);

            Transaction::where('id_transaction', $this->selectedTransactionId)->update([
                'status' => 'selesai',
                'completed_at' => Carbon::now()
            ]);

            $this->dispatchBrowserEvent('submitted-rating');
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error-modal');
        }
    }
}
