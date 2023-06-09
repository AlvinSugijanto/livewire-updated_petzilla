<?php

namespace App\Http\Livewire\User\Transaction;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\BuktiPembayaran;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class MenungguPembayaran extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    
    public $currentModalStep, $currentUser, $currentDetailTransaksiModal;
    public $selectedTransaction, $selectedTransactionId;
    public $tipe_rekening, $jenis_rekening, $nama_rekening, $nomor_rekening, $bukti_pembayaran;

    protected $listeners = ['cancelTransactionConfirmed' => 'cancelTransaction'];

    
    public function render()
    {
        $this->currentUser = Auth::user();
        $this->currentUser->alamat = $this->currentUser->getAddress($this->currentUser->provinsi, $this->currentUser->kabupaten, $this->currentUser->kecamatan);

        $transactions = (new Transaction())->getMenungguPembayaran();
        return view('livewire.user.transaction.menunggu-pembayaran',['transactions' => $transactions]);
    }
    public function openPembayaranModal($id)
    {
        $this->selectedTransactionId = $id;
        $this->selectedTransaction = Transaction::where('id_transaction', $id)
                                                ->with('user')
                                                ->with('animal')
                                                ->first();

        $this->currentModalStep = 1;
    }
    public function nextStepModal()
    {
        $this->currentModalStep++;
    }
    public function previousStepModal()
    {
        $this->currentModalStep--;
    }
    public function submitPembayaran()
    {
        $data = $this->validate([
            'tipe_rekening' => 'required',
            'jenis_rekening' => 'required',
            'nama_rekening'  => 'required',
            'nomor_rekening' => 'required',
            'bukti_pembayaran' => 'required'
        ]);


        try {
            $data['bukti_pembayaran'] = Storage::disk('public')->put($this->selectedTransactionId, $this->bukti_pembayaran);
            $data['transaction_id_transaction'] = $this->selectedTransactionId;

            BuktiPembayaran::create($data);

            $this->selectedTransaction->update([
                'status' => 'review_pembayaran'
            ]);

            $this->dispatchBrowserEvent('submitted-pembayaran');
        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('error-modal');
        }
    }
    public function openDetailTransaksiModal($id)
    {
        $this->selectedTransaction = Transaction::where('id_transaction', $id)->first();
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
