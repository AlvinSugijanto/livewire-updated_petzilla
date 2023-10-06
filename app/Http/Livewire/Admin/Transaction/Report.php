<?php

namespace App\Http\Livewire\Admin\Transaction;

use App\Models\Complain;
use Livewire\Component;
use Livewire\WithPagination;

class Report extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $currentDetailComplainModal;
    public $selectedTransaction;

    public function render()
    {
        $complain = Complain::with('photo')
            ->with('transaction')
            ->with('transaction.detailTransaction')
            ->with('transaction.user')
            ->orderBy('created_at','desc')
            ->paginate(10);

        return view('livewire.admin.transaction.report', ['complains' => $complain])
            ->layout('livewire.layouts.admin-layout');
    }
    public function openDetailModal($id)
    {
        $this->currentDetailComplainModal = 1;
        $this->selectedTransaction = Complain::where('id', $id)
                                            ->with('transaction')
                                            ->with('transaction.detailTransaction')
                                            ->with('transaction.user')
                                            ->with('photo')
                                            ->first();
        
    }
}
