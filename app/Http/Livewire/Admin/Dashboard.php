<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\User;

class Dashboard extends Component
{
    public $transaction_completed;
    public $transaction_value;
    public $earnings;
    public $new_users;

    public function mount()
    {
        $now = Carbon::now();

        $this->transaction_completed = Transaction::whereYear('completed_at', $now->year)
            ->whereMonth('completed_at', $now->month)
            ->count();

        $this->transaction_value = Transaction::whereYear('completed_at', $now->year)
            ->whereMonth('completed_at', $now->month)
            ->sum('grand_total');

        $this->new_users = User::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();
    }
    public function render()
    {
        return view('livewire.admin.dashboard')->layout('livewire.layouts.admin-layout');
    }
}
