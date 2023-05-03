<?php

namespace App\Http\Livewire;

use App\Models\ListAnimal;
use App\Models\StoreModel;
use App\Models\User;

use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;

use Livewire\Component;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\WithPagination;
use Illuminate\Pagination\Cursor;

class HomepageComponent extends Component
{
    use WithPagination;

    public $animal_type, $animal_name, $description;
    public $nextCursor;
    public $animal_paginator, $new_animals = [];

    protected $listeners = [
        'load-more' => 'loadMore',
    ];


    public function render()
    {

        $user = User::where('id_user', Auth::id())->first();
        $animals = StoreModel::selectRaw("id_store, nama_toko, latitude, longitude, harga, judul_post, list_animal.deskripsi, user_id_user, provinsi, kabupaten, kecamatan, id_animal, list_animal.thumbnail,   
        ( 6371 * acos( cos( radians(?) ) *
          cos( radians( latitude ) )
          * cos( radians( longitude ) - radians(?)
          ) + sin( radians(?) ) *
          sin( radians( latitude ) ) )
        ) AS distance", [$user->latitude, $user->longitude, $user->latitude])
        ->having("distance", "<", 50)
        ->where('user_id_user','!=',Auth::id())
        ->join('list_animal', 'store.id_store', '=', 'list_animal.store_id_store')
        ->paginate(10);

        $kecamatan_object = new Kecamatan();

        for($i=0; $i< count($animals); $i++)
        {
            $animals[$i]->kecamatan = $kecamatan_object->getNama($animals[$i]->kabupaten,$animals[$i]->kecamatan);
        }
        return view('livewire.homepage-component', ['animals' => $animals])->layout('livewire.layouts.base');
    }
    public function loadMore()
    {
        // $this->page = $this->page + 1;

        // $newData = DB::table('my_table')->paginate(10)->items();


        // $user = User::where('id_user', Auth::id())->first();
        // $animals = StoreModel::selectRaw("id_store, nama_toko, latitude, longitude, harga, judul_post, list_animal.deskripsi, user_id_user, provinsi, kabupaten, kecamatan, id_animal, list_animal.thumbnail,   
        // ( 6371 * acos( cos( radians(?) ) *
        //   cos( radians( latitude ) )
        //   * cos( radians( longitude ) - radians(?)
        //   ) + sin( radians(?) ) *
        //   sin( radians( latitude ) ) )
        // ) AS distance", [$user->latitude, $user->longitude, $user->latitude])
        // ->having("distance", "<", 50)
        // ->where('user_id_user','!=',Auth::id())
        // ->join('list_animal', 'store.id_store', '=', 'list_animal.store_id_store')
        // ->paginate(10)
        // ->items();
        // $kecamatan_object = new Kecamatan();

        // for($i=0; $i< count($animals); $i++)
        // {
        //     $animals[$i]->kecamatan = $kecamatan_object->getNama($animals[$i]->kabupaten,$animals[$i]->kecamatan);
        // }

        // array_push($this->new_animals, ...$animals);
        // dd($this->new_animals);
    }
}
