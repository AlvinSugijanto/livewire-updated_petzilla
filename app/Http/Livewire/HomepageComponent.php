<?php

namespace App\Http\Livewire;

use App\Models\ListAnimal;
use App\Models\StoreModel;
use App\Models\User;

use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;


class HomepageComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['search'];

    public $animal_type, $animal_name, $description;
    public $alamat, $user;
    public $perPage = 12;
    public $search;


    public function render()
    {

        $this->user = Auth::user();
        $this->user->alamat = $this->user->getAddress($this->user->provinsi, $this->user->kabupaten, $this->user->kecamatan);

        $animals = StoreModel::selectRaw("store.*, list_animal.* , 
            ( 6371 * acos( cos( radians(?) ) *
              cos( radians( latitude ) )
              * cos( radians( longitude ) - radians(?)
              ) + sin( radians(?) ) *
              sin( radians( latitude ) ) )
            ) AS distance", [$this->user->latitude, $this->user->longitude, $this->user->latitude])
            ->having("distance", "<", 50)
            ->where('user_id_user', '!=', Auth::id())
            ->join('list_animal', 'store.id_store', '=', 'list_animal.store_id_store')
            ->paginate($this->perPage);

        foreach($animals as $animal)
        {
            $animal->kecamatan = $animal->getKecamatan($animal->kabupaten, $animal->kecamatan);
        }

        return view('livewire.homepage-component', ['animals' => $animals])
                ->layout('livewire.layouts.base');
    }
    public function loadMore()
    {
        $this->perPage += 12;

    }
}
