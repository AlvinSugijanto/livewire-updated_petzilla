<?php

namespace App\Http\Livewire;

use App\Libraries\GetAllCityName;
use App\Models\StoreModel;
use App\Services\Geocode;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use stdClass;
use Illuminate\Support\Facades\Http;

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
    public $isAuthenticatedUser, $isSetCoordinate;
    public $allCityData;
    public $searchCity, $searchResult = [];
    public $clickedCity;
    public $address;


    protected $listeners = ['locationFounded'];

    public function mount()
    {
        $this->radius = 50;
        $this->allCityData =  (new GetAllCityName)->getName();
    }
    public function render()
    {

        if (Auth::check()) {
            $animals = $this->authenticatedUser();
        } else {
            $animals = $this->checkSession();
        }

        return view('livewire.homepage-component', ['animals' => $animals])
            ->layout('livewire.layouts.base');
    }

    public function authenticatedUser()
    {
        $this->user = Auth::user();
        $this->address = $this->user->getAddress($this->user->provinsi, $this->user->kabupaten, $this->user->kecamatan);
        return $this->getAllAnimals($this->user);
        
    }
    public function getAllAnimals($geodata)
    {
        $animals = StoreModel::selectRaw("store.*, list_animal.* , 
            ( 6371 * acos( cos( radians(?) ) *
              cos( radians( latitude ) )
              * cos( radians( longitude ) - radians(?)
              ) + sin( radians(?) ) *
              sin( radians( latitude ) ) )
            ) AS distance", [$geodata->latitude, $geodata->longitude, $geodata->latitude])
            ->having("distance", "<", $this->radius)
            ->where('user_id_user', '!=', Auth::id())
            ->join('list_animal', 'store.id_store', '=', 'list_animal.store_id_store')
            ->when($this->hewan, function ($query) {
                $query->where('list_animal.jenis_hewan', $this->hewan);
            })
            ->when($this->age, function ($query) {
                $query->where('umur', $this->age);
            })
            ->when($this->search, function ($query) {
                $query->where('list_animal.judul_post', 'like', "%" . $this->search . "%");
            })
            ->paginate($this->perPage);

        foreach ($animals as $animal) {
            $animal->kecamatan = $animal->getKecamatan($animal->kabupaten, $animal->kecamatan);
        }
        $this->isSetCoordinate = true;
        return $animals;
    }

    public function checkSession()
    {
        if (session()->has('latitude') && session()->has('longitude')) {
            $data = new stdClass();
            $data->latitude = session()->get('latitude');
            $data->longitude = session()->get('longitude');
            
            $reverse_geocode = Http::get('https://geocode.maps.co/reverse?lat='.$data->latitude.'&lon='.$data->longitude)->json();
            // dd($reverse_geocode);
            $this->address = $reverse_geocode['address']['village'] . ', '. $reverse_geocode['address']['city'];
            return $this->getAllAnimals($data);
        }
    }
    public function handleClickedCity($string = null)
    {

        $geoData = (new Geocode)->geocode_from_string($string);

        session()->put('latitude', $geoData['lat']);
        session()->put('longitude', $geoData['lon']);

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('able-to-scroll');

    }

    public function locationFounded($coordinate)
    {
        $data = new stdClass();
        $data->latitude = $coordinate['latitude'];
        $data->longitude = $coordinate['longitude'];

        session()->put('latitude', $data->latitude);
        session()->put('longitude', $data->longitude);

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('able-to-scroll');

    }

    public function updatedSearchCity()
    {
        if ($this->searchCity) {
            $input = preg_quote($this->searchCity, '~');
            $this->searchResult = preg_grep('/' . $input . '/i', $this->allCityData);
        } else {
            $this->searchResult = [];
        }
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
