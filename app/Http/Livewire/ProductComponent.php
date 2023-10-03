<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\ListAnimal;
use App\Models\AnimalPhoto;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\CartModel;
use App\Models\User;
use App\Models\Transaction;
use App\Models\StoreModel;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $this->animal = ListAnimal::where('id_animal', $id_animal)
            ->with('animal_photo')
            ->first();

        if (!$this->animal) {
            return redirect()->to('/user/error/not-found');
        }
    }
    public function render()
    {


        $this->store = $this->animal->getStore($this->animal->store);

        if (Auth::check()) {
            $this->user = Auth::user();
            $this->user->alamat = $this->user->getAddress($this->user->provinsi, $this->user->kabupaten, $this->user->kecamatan);
        }

        return view('livewire.product-component')->layout('livewire.layouts.base');
    }
    public function createTransaction()
    {
        try {

            Transaction::create([
                'id_transaction' => strtoupper('TRX-' . Str::random(10, 'alnum')),
                'sub_total'  => $this->animal->harga * $this->current_qty,
                'status'    => 'pengajuan_ongkir',
                'users_id_user' => Auth::id(),
                'store_id_store' => $this->animal->store_id_store,
                'list_animal_id_animal' => $this->animal->id_animal,
                'qty'           => $this->current_qty
            ]);

            ListAnimal::where('id_animal', $this->animal->id_animal)
                ->update([
                    'stok'       => DB::raw('stok - ' . $this->current_qty)
                ]);

            $this->dispatchBrowserEvent('success-modal');
        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('error-modal');
        }
    }

    public function add_to_wishlist()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $wishlist = Wishlist::where('users_id_user', $user->id_user)->where('list_animal_id_animal', $this->animal->id_animal)->first();

            if ($wishlist == NULL) {
                Wishlist::create([
                    'users_id_user' => $user->id_user,
                    'list_animal_id_animal' => $this->animal->id_animal
                ]);
                $this->dispatchBrowserEvent('success-wishlist', [
                    'message' => 'Hewan berhasil ditambahkan ke wishlist !'
                ]);
            } else {
                $this->dispatchBrowserEvent('success-wishlist', [
                    'message' => 'Hewan sudah berada di wishlist !'
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('unauthenticatedUser');
        }
    }
    public function add_to_cart()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $checkCart = CartModel::where('users_id_users', $user->id_user)->where('store_id_store', $this->store->id_store)->first();

            if ($checkCart) {
                CartDetail::create([
                    'cart_id' => $checkCart->id_cart,
                    'qty'     => $this->current_qty,
                    'list_animal_id_animal' => $this->animal->id_animal
                ]);
            } else {
                $cart = CartModel::create([
                    'users_id_users' => $user->id_user,
                    'store_id_store' => $this->store->id_store
                ]);
                CartDetail::create([
                    'cart_id' => $cart->id_cart,
                    'qty'     => $this->current_qty,
                    'list_animal_id_animal' => $this->animal->id_animal
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('unauthenticatedUser');
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

    public function checkIfAuthenticated()
    {
        if (!Auth::check()) {
            $this->dispatchBrowserEvent('unauthenticatedUser');
        }
    }
}
