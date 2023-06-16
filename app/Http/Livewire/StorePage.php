<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use App\Models\ListAnimal;
use App\Models\StoreModel;
use Livewire\Component;

use function PHPSTORM_META\map;

class StorePage extends Component
{
    public $animals;
    public $store;
    public $produk_terjual;
    
    public function mount($id_store)
    {
        $this->store = StoreModel::where('id_store', $id_store)->with('listAnimal')->first();
        $this->store->kecamatan = $this->store->getKecamatan($this->store->kabupaten, $this->store->kecamatan);
        $this->store->kabupaten = $this->store->getKabupaten($this->store->provinsi, $this->store->kabupaten);

        $this->produk_terjual = Transaction::where('store_id_store', $this->store->id_store)
                                            ->where('status','selesai')
                                            ->count();
        
    }
    public function render()
    {

        return view('livewire.store-page')->layout('livewire.layouts.base');
    }
}
