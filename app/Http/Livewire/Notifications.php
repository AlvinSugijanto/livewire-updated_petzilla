<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    public function getListeners()
    {
        $id = Auth::id();
        
        return [
            "echo-private:successTransaction.{$id},PaymentSuccess" => 'broadcastedMessageReceived',
        ];
    }
    public function broadcastedMessageReceived($event)
    {
        $this->dispatchBrowserEvent('payment-success');
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
