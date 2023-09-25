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

    protected $queryString = [
        'hewan',
        'umur',
        'radius',
        'age',
        'search'
    ];

    public $animal_type, $animal_name, $description;
    public $alamat, $user;
    public $perPage = 12;
    public $hewan, $umur, $radius, $age, $search;


    public function mount()
    {
        $this->radius = 50;
        
        
    }
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
            ->having("distance", "<", $this->radius)
            ->where('user_id_user', '!=', Auth::id())
            ->join('list_animal', 'store.id_store', '=', 'list_animal.store_id_store')
            ->when($this->hewan, function ($query) {
                $query->where('list_animal.jenis_hewan', $this->hewan);
            })
            ->when($this->age, function ($query) {
                $query->where('umur', $this->age);
            })
            ->when($this->search, function ($query){
                $query->where('list_animal.judul_post', 'like', "%".$this->search."%");
            })
            ->paginate($this->perPage);




        foreach ($animals as $animal) {
            $animal->kecamatan = $animal->getKecamatan($animal->kabupaten, $animal->kecamatan);
        }

        return view('livewire.homepage-component', ['animals' => $animals])
            ->layout('livewire.layouts.base');
    }
    public function loadMore()
    {
        $this->perPage += 12;
    }
    
    public function setRadiusFilter($radius)
    {
        $this->radius = $radius;
    }
    public function setAnimalFilter($animal)
    {
        $this->hewan = $animal;
    }
    public function unsetAnimalFilter()
    {
        $this->hewan = null;
    }
    public function setAgeFilter($age)
    {
        $this->age = $age;
    }
    public function unsetAgeFilter()
    {
        $this->age = null;
    }
    public function unsetSearchFilter()
    {
        $this->search = null;
    }
}
