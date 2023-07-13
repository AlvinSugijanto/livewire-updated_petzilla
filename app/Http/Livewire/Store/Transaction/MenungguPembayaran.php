<?php

namespace App\Http\Livewire\Store\Transaction;

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

    public function render()
    {
       
        $transactions = (new Transaction())->getMenungguPembayaranStore();
        
        return view('livewire.store.transaction.menunggu-pembayaran',['transactions' => $transactions]);
    }
    public function openDetailTransaksiModal($id)
    {
        $this->selectedTransaction = Transaction::where('id_transaction', $id)->first();
        $this->currentDetailTransaksiModal = 1;
        
    }

}
