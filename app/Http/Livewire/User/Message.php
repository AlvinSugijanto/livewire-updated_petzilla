<?php

namespace App\Http\Livewire\User;

use App\Models\Chat;
use App\Models\User;
use App\Models\StoreModel;
use Carbon\Carbon;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Message extends Component
{
    public $to_id;
    public $message;
    public $messages = [];
    public $who_is_this;
    public $enemy_name, $your_name;
    public $user;

    // protected $listeners = ['dispatchMessageSent'];

    public function getListeners()
    {
        $id = Auth::id();

        return [
            "echo-private:chat.{$id},MessageSent" => 'broadcastedMessageReceived',
            "refresh-me" => '$refresh'
        ];
    }

    public function broadcastedMessageReceived($event)
    {
        array_push($this->messages, $event);
    }
    public function mount($to_id)
    {
        $this->to_id = $to_id;

        $this->user = Auth::user();

        $store = StoreModel::where('id_store', $to_id)->first();
        $this->enemy_name = $store->nama_toko;
        $this->your_name = $this->user->name;
        $this->who_is_this = 'user';

        $this->messages = Chat::where(function ($query) {
            $query->where('users_id_user', $this->user->id_user)
                ->where('store_id_store', $this->to_id);
        })
            ->orderBy('created_at', 'asc')
            ->get()
            ->toArray();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('scroll-bottom');


        return view('livewire.user.message')->layout('livewire.layouts.base');
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|min:1',
        ]);

        try {
            $message = Chat::create([
                'users_id_user' => $this->user->id_user,
                'store_id_store' => $this->to_id,
                'message' => $this->message,
                'sender_type' => $this->who_is_this,
            ]);
            array_push($this->messages, $message);

            broadcast(new MessageSent($this->user->id_user, $this->to_id, $this->message, $this->who_is_this));

            $this->message = '';
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error-modal');
        }
    }
}
