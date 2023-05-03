<?php

namespace App\Http\Livewire\Store;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\StoreModel;
use App\Models\ListAnimal;
use App\Models\AnimalPhoto;

class DaftarProduk extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $jenis_hewan, $judul_post, $deskripsi, $harga, $edit_id;
    public $thumbnail, $photos = [];
    public $display_photo, $display_photos = [];


    public function render()
    {
        $animals = ListAnimal::whereHas('store', function ($query) {
            $query->where('user_id_user', Auth::id());
        })->paginate(10);
        // $animals = ListAnimal::paginate(10);
        return view('livewire.store.daftar-produk',[
            'animals' => $animals
        ])->layout('livewire.layouts.tes-layout',['blueButton' => 'produk']);

        // return view('livewire.store.daftar-produk')->layout('livewire.layouts.tes-layout',['blueButton' => 'produk']);
    }
    public function storeProduk()
    {
        $data = $this->validate([
            'jenis_hewan' => 'required',
            'judul_post'  => 'required',
            'deskripsi'   => 'required',
            'harga'       => 'required',
            'thumbnail' => 'required'
        ]);

        $data['status'] = 1;
        $data['store_id_store'] = StoreModel::whereHas('user', function ($query) {
            $query->where('id_user', Auth::id());
        })->value('id_store');
        $animal = ListAnimal::create($data);
        $data['thumbnail'] = Storage::disk('public')->put($animal->id_animal, $this->thumbnail);

        $animal->thumbnail = $data['thumbnail'];
        $animal->save();


        $model = new AnimalPhoto;
        $model->storePhoto($this->photos, $animal->id_animal);
    }
    public function editProduk($id)
    {
        $animal = ListAnimal::where('id_animal', $id)->first();
        $this->edit_id = $id;
        $this->jenis_hewan = $animal->jenis_hewan;
        $this->judul_post = $animal->judul_post;
        $this->deskripsi = $animal->deskripsi;
        $this->harga = $animal->harga;
        $this->display_photo = $animal->thumbnail;
        $this->display_photos = AnimalPhoto::where('list_animal_id_animal', $id)->get();
        $this->dispatchBrowserEvent('show-edit-modal');
    }
    public function editProdukData()
    {
        // if (Storage::disk('public')->exists('whugtvVbxn/J2fOMhSyCE3lTPeHvLHrJW6KOEsgROoi9q8hD8Re.png')) {
        // }
        $data = $this->validate([
            'jenis_hewan'   => 'required',
            'judul_post'    => 'required',
            'deskripsi'     => 'required',
            'harga'         => 'required',
        ]);

        $animal = ListAnimal::where('id_animal', $this->edit_id)->first();
        if ($this->thumbnail != NULL) {
            Storage::disk('public')->delete($animal->id_animal, $animal->thumbnail);
            $data['thumbnail'] = Storage::disk('public')->put($animal->id_animal, $this->thumbnail);

        }
        if(!empty($this->photos)){

            $model = new AnimalPhoto;
            $model->storePhoto($this->photos, $animal->id_animal);
        }
        $animal->update($data);
        $animal->save();
    }

    
    public function updatedThumbnail()
    {
        $this->display_photo = NULL;
    }

    public function deletePhoto($id)
    {
        if ($id) {
            $animal = AnimalPhoto::where('id_animal_photo', $id)->first();
            Storage::disk('public')->delete($animal->id_animal_photo, $animal->photo);
            $animal->delete();
        }
    }
}
