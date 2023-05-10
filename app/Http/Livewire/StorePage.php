<?php

namespace App\Http\Livewire;

use App\Models\ListAnimal;
use Livewire\Component;

use function PHPSTORM_META\map;

class StorePage extends Component
{
    public $animals;

    public function mount($id_store)
    {
        $this->animals = ListAnimal::where('store_id_store', $id_store)->with('store')->get();
        $this->animals = $this->animals->map(function ($item) {
            $item->alamat = $item->getKecamatan($item->store->kabupaten, $item->store->kecamatan);
            return $item;
        });
    }
    public function render()
    {

        return view('livewire.store-page')->layout('livewire.layouts.base');
    }
}
