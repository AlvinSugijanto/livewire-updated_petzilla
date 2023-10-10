<?php

namespace App\Http\Livewire\User;

use App\Models\CartDetail;
use App\Models\Transaction;
use Livewire\Component;
use App\Models\CartModel;
use App\Models\ListAnimal;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Cart extends Component
{
    public $checkBoxChild = [];

    public $totalHarga = 0;
    public $currentQty = 1;
    public $user;
    public $cartz;


    protected $listeners = ['checkParent', 'unCheckParent'];

    public function mount()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        $carts = CartModel::where('users_id_user', Auth::id())->with('store')->with('cartDetail')->get();
        
        return view('livewire.user.cart', ['carts' => $carts])->layout('livewire.layouts.base');
    }
    public function checkParent($id_cart)
    {
        $cartDetail = CartDetail::where('cart_id', $id_cart)->get();
        foreach ($cartDetail as $detail) {
            array_push($this->checkBoxChild, $detail->id_cart_detail);
        }
        $this->updatedCheckBoxChild();
    }
    public function unCheckParent($id_cart)
    {
        $cartDetail = CartDetail::where('cart_id', $id_cart)->get();

        foreach ($cartDetail as $cart) {
            $key = array_search($cart->id_cart_detail, $this->checkBoxChild);

            if ($key !== false) {
                unset($this->checkBoxChild[$key]);
            }
        }
        $this->checkBoxChild = array_values($this->checkBoxChild);

        $this->updatedCheckBoxChild();

    }
    public function updatedCheckBoxChild()
    {
        $this->totalHarga = 0;

        foreach ($this->checkBoxChild as $cart) {
            $cart_detail = CartDetail::where('id_cart_detail', $cart)->first();

            $animal = ListAnimal::where('id_animal', $cart_detail->list_animal_id_animal)->first();
            $this->totalHarga += $animal->harga * $cart_detail->qty;

        }
        if(isset($cart_detail))
        {
            $this->cartz = CartModel::where('id_cart', $cart_detail->cart_id)->with('cartDetail')->first();
            $this->cartz->total = $this->totalHarga;
        }
        
    }

    public function createTransaction()
    {
        // Create Parent Transaction
        $transaction = Transaction::create([
            'id_transaction' => strtoupper('TRX-' . Str::random(10, 'alnum')),
            'status'    => 'pengajuan_ongkir',
            // 'grand_total' => $this->animal->harga * $this->current_qty,
            'users_id_user' => Auth::id(),
            'store_id_store' => $this->cartz->store->id_store,
        ]);

        // Create Transaction Detail
        $grand_total = 0;
        foreach($this->cartz->cartDetail as $detail)
        {
            $subtotal = $detail->qty * $detail->animal->harga;
            $grand_total += $subtotal;
            TransactionDetail::create([
                'subtotal' => $subtotal,
                'qty' => $detail->qty,
                'transaction_id_transaction' => $transaction->id_transaction,
                'list_animal_id_animal' => $detail->list_animal_id_animal
            ]);
        }

        // Update Transaction Total
        $transaction->update([
            'grand_total' => $grand_total
        ]);
        $transaction->save();
        // Delete Cart & Detail Cart
        CartDetail::where('cart_id', $this->cartz->id_cart)->delete();
        $this->cartz->delete();

        $this->dispatchBrowserEvent('success-transaction');
    }
    public function incrementQty($id_cart_detail)
    {
        $cart_detail = CartDetail::where('id_cart_detail', $id_cart_detail)->first();
        $cart_detail->qty += 1;
        $cart_detail->save();
        $this->updatedCheckBoxChild();
    }
    public function decrementQty($id_cart_detail)
    {
        $cart_detail = CartDetail::where('id_cart_detail', $id_cart_detail)->first();
        $cart_detail->qty -= 1;
        $cart_detail->save();
        $this->updatedCheckBoxChild();
    }


}
