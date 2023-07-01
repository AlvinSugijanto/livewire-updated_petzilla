<?php

namespace App\Http\Livewire\Store;

use App\Models\Chat;
use App\Models\User;
use App\Models\StoreModel;

use App\Events\MessageSent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Message extends Component
{
    public $to_id;
    public $message;
    public $messages = [];
    public $who_is_this;
    public $enemy_name, $your_name;

    // protected $listeners = ['dispatchMessageSent'];

    public function getListeners()
    {

        $store = StoreModel::where('user_id_user', Auth::id())->first();

        return [
            "echo-private:chat.{$store->id_store},MessageSent" => 'broadcastedMessageReceived',
            "refresh-me" => '$refresh'
        ];
    }

    public function broadcastedMessageReceived($event)
    {
        array_push($this->messages, ([
            'users_id_user' => $event['users_id_user'],
            'store_id_store' => $event['store_id_store'],
            'message' => $event['message'],
            'sender_type' => $event['sender_type'],
            'created_at' => $event['created_at']
        ]));
    }
    public function mount($to_id)
    {
        $this->to_id = $to_id;

        $user = User::find($to_id);

        $store = StoreModel::where('user_id_user', Auth::id())->first();
        $this->enemy_name = $user->name;
        $this->your_name = $store->nama_toko;
        $this->who_is_this = 'store';
        $this->messages = Chat::where(function ($query) use ($user, $store) {
            $query->where('users_id_user', $user->id_user)
                ->where('store_id_store', $store->id_store);
        })
            ->orderBy('created_at', 'asc')
            ->get()
            ->toArray();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('scroll-bottom');


        return view('livewire.message')->layout('livewire.layouts.base');
    }

    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|min:1',
        ]);

        $store = StoreModel::where('user_id_user', Auth::id())->first();

        try {
            $message = Chat::create([
                'users_id_user' => $this->to_id,
                'store_id_store' => $store->id_store,
                'message' => $this->message,
                'sender_type' => $this->who_is_this,
            ]);

            array_push($this->messages, $message);

            broadcast(new MessageSent($this->to_id, $store->id_store, $this->message, $this->who_is_this));

            $this->message = '';
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error-modal');
        }
    }
}
