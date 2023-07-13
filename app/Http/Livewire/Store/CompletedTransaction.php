<?php

namespace App\Http\Livewire\Store;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class CompletedTransaction extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $selectedTransaction;
    public $currentDetailTransaksiModal;
    public $currentUser;
    
    public function render()
    {
        $store = User::find(Auth::id())->store;
        $completedTransaction = Transaction::where('store_id_store', $store->id_store)
                                                        ->where('status', 'selesai')
                                                        ->with('user')
                                                        ->with('animal')
                                                        ->with('pengiriman')
                                                        ->paginate(8);

        return view('livewire.store.completed-transaction',['completedTransaction' => $completedTransaction]);
    }
    public function openDetailTransaksiModal($id)
    {
        $this->currentDetailTransaksiModal = 1;
        $this->selectedTransaction = Transaction::where('id_transaction',$id)
                                    ->with('animal')
                                    ->with('user')
                                    ->with('pengiriman')
                                    ->with('pembayaran')
                                    ->first();
                                    // dd($this->selectedTransaction);
    }

}
