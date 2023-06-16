<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\ListAnimal;
use App\Models\AnimalPhoto;
use App\Models\User;
use App\Models\Transaction;
use App\Models\StoreModel;
use App\Models\Wishlist;

use Auth;
use Illuminate\Support\Str;


class ProductComponent extends Component
{
    public $id_animal, $animal, $animal_photo;

    public $store, $user;

    public $current_qty = 1;

    protected $listeners = [
        'dec_qty' => 'decrement_qty',
        'inc_qty' => 'increment_qty'
    ];

    public function mount($id_animal)
    {
        $this->animal = ListAnimal::where('id_animal', $id_animal)->first();
    }
    public function render()
    {
        $this->animal_photo = AnimalPhoto::where('list_animal_id_animal', $this->animal->id_animal)->get();

        $data = $this->animal->store;
        $this->store = $this->animal->getStore($data);

        $this->user = Auth::user();
        $this->user->alamat = $this->user->getAddress($this->user->provinsi, $this->user->kabupaten, $this->user->kecamatan);

        $this->to_id_user =  $this->store->id_store;
        

        return view('livewire.product-component')->layout('livewire.layouts.base');
    }
    public function createTransaction()
    {
        $transaction = Transaction::create([
            'id_transaction' => Str::random(16),
            'sub_total'  => $this->animal->harga * $this->current_qty,
            'status'    => 'pengajuan_ongkir',
            'users_id_user' => Auth::id(),
            'store_id_store' => $this->animal->store_id_store,
            'list_animal_id_animal' => $this->animal->id_animal,
            'qty'           => $this->current_qty
        ]);
        if ($transaction) {
            $this->dispatchBrowserEvent('success-modal');
        }
    }

    public function add_to_wishlist()
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('users_id_user', $user->id_user)->where('list_animal_id_animal', $this->animal->id_animal)->first();

        if ($wishlist == NULL) {
            Wishlist::create([
                'users_id_user' => $user->id_user,
                'list_animal_id_animal' => $this->animal->id_animal
            ]);
            $this->dispatchBrowserEvent('success-wishlist',[
                'status'  => '200',
                'message' => 'Hewan berhasil ditambahkan ke wishlist !'
            ]);

        } else {
            $this->dispatchBrowserEvent('success-wishlist',[
                'status'  => '300',
                'message' => 'Hewan sudah berada di wishlist !'
            ]);
        }
    }
    public function increment_qty()
    {
        if ($this->current_qty < $this->animal->stok) {
            $this->current_qty++;
        }
    }
    public function decrement_qty()
    {
        if ($this->current_qty > 1) {
            $this->current_qty--;
        }
    }
}
