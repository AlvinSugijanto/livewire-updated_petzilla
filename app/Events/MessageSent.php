<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Chat;
class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $users_id_user, $store_id_store, $message, $sender_type;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($users_id_user, $store_id_store, $message, $sender_type)
    {
        $this->users_id_user = $users_id_user;
        $this->store_id_store = $store_id_store;
        $this->message = $message;
        $this->sender_type = $sender_type;

        

    }

    public function broadcastWith()
    {
        return [
            'users_id_user' => $this->users_id_user,
            'store_id_store'      => $this->store_id_store,
            'message'   => $this->message,
            'sender_type'   => $this->sender_type,
            'created_at'   => \Carbon\Carbon::now()
        ];
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if($this->sender_type == 'user'){
            $id = $this->store_id_store;
        }else{
            $id = $this->users_id_user;
        }
        return new PrivateChannel('chat.'.$id);
    }
}
