<?php

namespace App\Http\Livewire\User;

use App\Models\Transaction;
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
        $completedTransaction = Transaction::where('users_id_user', Auth::id())
            ->where('status', 'selesai')
            ->with('store')
            ->with('detailTransaction')
            ->with('pengiriman')
            ->paginate(5);

        $this->currentUser = Auth::user();
        
        return view('livewire.user.completed-transaction', ['completedTransaction' => $completedTransaction]);
    }
    public function openDetailTransaksiModal($id)
    {
        $this->currentDetailTransaksiModal = 1;
        $this->selectedTransaction = Transaction::where('id_transaction',$id)
                                    ->with('store')
                                    ->with('detailTransaction')
                                    ->with('pengiriman')
                                    ->with('pembayaran')
                                    ->first();
    }
}
