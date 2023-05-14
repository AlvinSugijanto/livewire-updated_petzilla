<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Transaction;
use App\Services\Tripay;


class DetailPembayaran extends Component
{
    public $referenceId, $invoice, $transaction;

    public function mount($referenceId)
    {
        $payment = new Tripay();

        $this->invoice = collect($payment->detail_transaction($referenceId));
        
        $this->transaction = Transaction::where('payment_reference', $this->invoice['reference'])
                            ->with('user')
                            ->with('animal')
                            ->with('pengiriman')
                            ->first();
        // dd($this->invoice);
    }


    public function render()
    {
        
        return view('livewire.user.detail-pembayaran')->layout('livewire.layouts.base');
    }

}
