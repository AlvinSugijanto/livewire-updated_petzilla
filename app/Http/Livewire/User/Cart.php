<?php

namespace App\Http\Livewire\User;

use App\Models\CartDetail;
use Livewire\Component;
use App\Models\CartModel;
use App\Models\ListAnimal;
use Illuminate\Support\Facades\Auth;

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
        $carts = CartModel::where('users_id_users', Auth::id())->with('store')->with('cartDetail')->get();
        
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

    public function openTransactionModal()
    {
        
    }
}
