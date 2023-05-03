<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Inbox extends Component
{
    public $users;
    public $to_id_user;
    public $unreadCounts;

    public function mount()
    {
        $this->users = User::whereHas('messagesFrom', function($query){
            $query->where('to_id_user',Auth::id());
        })->orWhereHas('messagesTo', function($query){
            $query->where('from_id_user',Auth::id());
        })->get();



        // $this->unreadCounts = Chat::selectRaw('count(*) as count, from_id_user')
        //     ->where('to_id_user', Auth::id())
        //     ->groupBy('from_id_user')
        //     ->pluck('count', 'from_id_user');
        
    }

    public function render()
    {
        return view('livewire.inbox', [
            'users' => $this->users,
            'to_id_user' => $this->to_id_user,
            'unreadCounts' => $this->unreadCounts,
        ])->layout('livewire.layouts.base');
    }
}
