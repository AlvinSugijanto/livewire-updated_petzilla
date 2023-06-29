<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\ListAnimal;
use Livewire\Component;
use Livewire\WithPagination;

class VerifikasiProduk extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['modalConfirmed' => 'updateStatusAnimal'];

    public function render()
    {
        $animal = ListAnimal::where('status','dalam_persetujuan')->with('store')->paginate(10);

        return view('livewire.admin.product.verifikasi-produk',['animals' => $animal])->layout('livewire.layouts.admin-layout');
    }
    public function updateStatusAnimal($id)
    {
        $animal = ListAnimal::find($id);
        $animal->status = 'aktif';
        $animal->save();
    }
}
