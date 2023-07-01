<?php

namespace App\Http\Livewire;

use App\Models\ListAnimal;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Wishlist as WishlistModel;

class Wishlist extends Component
{

    public $animals;


    public function render()
    {
        return view('livewire.wishlist')->layout('livewire.layouts.base');
    }
    public function mount()
    {
        $this->animals = ListAnimal::whereHas('wishlist', function($query){
            $query->where('users_id_user', Auth::id());
        })
        ->with('store')
        ->get();
        $this->animals = $this->animals->map(function ($item) {
            $item->alamat = $item->getKecamatan($item->store->kabupaten, $item->store->kecamatan);
            return $item;
        });
    }
}
