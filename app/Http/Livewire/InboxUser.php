<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\User;
use App\Models\StoreModel;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InboxUser extends Component
{
    public $stores;
    public $isActive;

    protected $queryString = ['toStore'];
    
    public $toStore;
    
    public function render()
    {
        $this->stores = StoreModel::whereHas('messages', function($query){
            $query->where('users_id_user',Auth::id());
        })->get();

        $this->stores = $this->stores->map(function ($item, $key) {
            $item->kabupaten = $item->getKabupaten($item->provinsi, $item->kabupaten);
            return $item;
        });
        $this->isActive = $this->toStore;

        return view('livewire.inbox-user')->layout('livewire.layouts.base');
    }
    public function setCurrentMessage($id)
    {
        $this->toStore = $id;
        $this->isActive = $id;

    }



}
