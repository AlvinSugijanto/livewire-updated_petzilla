<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\ListAnimal;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $animal = ListAnimal::with('store')->paginate(10);
        return view('livewire.admin.product.product',['animals' => $animal])->layout('livewire.layouts.admin-layout');
    }
}