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
use App\Models\TransactionDetail;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;


class ProductComponent extends Component
{
    public $id_animal, $animal, $animal_photo;

    public $store, $user;

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

            $transaction = Transaction::create([
                'id_transaction' => strtoupper('TRX-' . Str::random(10, 'alnum')),
                'status'    => 'pengajuan_ongkir',
                'grand_total' => $this->animal->harga,
                'users_id_user' => Auth::id(),
                'store_id_store' => $this->animal->store_id_store,
            ]);

            TransactionDetail::create([
                'subtotal' => $this->animal->harga,
                'transaction_id_transaction' => $transaction->id_transaction,
                'list_animal_id_animal' => $this->animal->id_animal,
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
            $checkCart = CartModel::where('users_id_user', $user->id_user)->where('store_id_store', $this->store->id_store)->first();

            if ($checkCart) {
                $checkDetail = CartDetail::where('cart_id', $checkCart->id_cart)->where('list_animal_id_animal', $this->animal->id_animal)->first();
                if (!$checkDetail) {
                    CartDetail::create([
                        'cart_id' => $checkCart->id_cart,
                        'list_animal_id_animal' => $this->animal->id_animal
                    ]);

                    $this->dispatchBrowserEvent('success-wishlist', [
                        'message' => 'Item berhasil ditambahkan ke cart !'
                    ]);

                } else {

                    $this->dispatchBrowserEvent('success-wishlist', [
                        'message' => 'Hewan sudah berada di cart !'
                    ]);
                }
            } else {

                $cart = CartModel::create([
                    'users_id_user' => $user->id_user,
                    'store_id_store' => $this->store->id_store
                ]);
                CartDetail::create([
                    'cart_id' => $cart->id_cart,
                    'list_animal_id_animal' => $this->animal->id_animal
                ]);

                $this->dispatchBrowserEvent('success-wishlist', [
                    'message' => 'Item berhasil ditambahkan ke cart !'
                ]);
                
            }
        } else {
            $this->dispatchBrowserEvent('unauthenticatedUser');
        }
    }


    public function checkIfAuthenticated()
    {
        if (!Auth::check()) {
            $this->dispatchBrowserEvent('unauthenticatedUser');
        }
    }
}
