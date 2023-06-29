<?php

namespace App\Http\Livewire\Admin;

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
            ->with('transaction.animal')
            ->with('transaction.user')
            ->paginate(10);

        // dd($complain);
        return view('livewire.admin.report', ['complains' => $complain])->layout('livewire.layouts.admin-layout');
    }
    public function openDetailModal($id)
    {
        $this->currentDetailComplainModal = 1;
        $this->selectedTransaction = Complain::where('id', $id)
                                            ->with('transaction')
                                            ->with('transaction.animal')
                                            ->with('transaction.user')
                                            ->with('photo')
                                            ->first();
        
        // dd($this->selectedTransaction);
    }
}
