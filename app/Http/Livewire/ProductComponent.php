<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ListAnimal;
use App\Models\AnimalPhoto;
use App\Models\User;
use App\Models\Transaction;
use App\Models\StoreModel;
use Auth;

class ProductComponent extends Component
{
    public $id_animal;
    public $animal;
    public $animal_photo;
    public $store;
    public $user;


    public function mount($id_animal)
    {
        $this->animal = ListAnimal::where('id_animal', $id_animal)->first();
        $this->animal_photo = AnimalPhoto::where('list_animal_id_animal',$id_animal)->get();

        $data = $this->animal->store;
        $this->store = $this->animal->getStore($data);

        $this->user = Auth::user();
        $this->to_id_user =  $this->store->id_store;

    }
    public function render()
    {
        return view('livewire.product-component')->layout('livewire.layouts.base');
    }
    // public function createTransaction()
    // {
    //     $transaction = Transaction::create([
    //         'subtotal'  =
    //     ]);
    // }
}
