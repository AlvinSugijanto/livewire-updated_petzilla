<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\StoreModel;

use Auth;

class InboxStore extends Component
{
    protected $queryString = ['toUser'];

    public $users;
    public $isActive;

    public $toUser;

        

    public function render()
    {
        $store = StoreModel::where('user_id_user', Auth::id())->first();
        
        $this->users = User::whereHas('messages', function($query) use ($store){
            $query->where('store_id_store',$store->id_store);
        })->get();
        
        $this->users = $this->users->map(function ($item, $key) {
            $item->kabupaten = $item->getKabupaten($item->provinsi, $item->kabupaten);
            return $item;
        });
        return view('livewire.inbox-store')->layout('livewire.layouts.tes-layout',['blueButton' => 'none']);
    }

    public function setCurrentMessage($id)
    {
        $this->toUser = $id;
        $this->isActive = $id;

    }
}
