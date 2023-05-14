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
    public $sertifikat_pedigree, $surat_keterangan_sehat;

    public $currentAddModalStep;
    public $currentEditModalStep;

    public function render()
    {
        $animals = ListAnimal::whereHas('store', function ($query) {
            $query->where('user_id_user', Auth::id());
        })->paginate(10);
        // $animals = ListAnimal::paginate(10);
        return view('livewire.store.daftar-produk', [
            'animals' => $animals
        ])->layout('livewire.layouts.tes-layout', ['blueButton' => 'produk']);

        // return view('livewire.store.daftar-produk')->layout('livewire.layouts.tes-layout',['blueButton' => 'produk']);
    }
    public function storeProduk()
    {
        $data = $this->nextStepAddModal();
        $data['status'] = 'Aktif';
        $data['store_id_store'] = StoreModel::whereHas('user', function ($query) {
            $query->where('id_user', Auth::id());
        })->value('id_store');

        $animal = ListAnimal::create($data);

        $data['thumbnail'] = Storage::disk('public')->put($animal->id_animal, $this->thumbnail);
        $data['surat_keterangan_sehat'] = Storage::disk('public')->put($animal->id_animal, $this->surat_keterangan_sehat);

        $animal->thumbnail = $data['thumbnail'];
        $animal->surat_keterangan_sehat = $data['surat_keterangan_sehat'];

        if($this->sertifikat_pedigree){
            $data['sertifikat_pedigree'] = Storage::disk('public')->put($animal->id_animal, $this->sertifikat_pedigree);
            $animal->sertifikat_pedigree = $data['sertifikat_pedigree'];
        }
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
        $this->currentEditModalStep = 1;
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
        if ($this->surat_keterangan_sehat != NULL) {
            Storage::disk('public')->delete($animal->id_animal, $animal->surat_keterangan_sehat);
            $data['surat_keterangan_sehat'] = Storage::disk('public')->put($animal->id_animal, $this->surat_keterangan_sehat);
        }
        if ($this->sertifikat_pedigree != NULL) {
            Storage::disk('public')->delete($animal->id_animal, $animal->sertifikat_pedigree);
            $data['sertifikat_pedigree'] = Storage::disk('public')->put($animal->id_animal, $this->sertifikat_pedigree);
        }
        if (!empty($this->photos)) {

            $model = new AnimalPhoto;
            $model->storePhoto($this->photos, $animal->id_animal);
        }
        $animal->update($data);
        if($animal->save())
        {
            $this->dispatchBrowserEvent('success-notification');
        }
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
    public function openAddModal()
    {
        $this->currentAddModalStep = 1;
        $this->resetForm();
        $this->dispatchBrowserEvent('show-add-modal');
    }
    public function nextStepAddModal()
    {
        if ($this->currentAddModalStep == 1) {
            $this->validate([
                'jenis_hewan' => 'required',
                'judul_post'  => 'required',
                'deskripsi'   => 'required',
                'harga'       => 'required',
                'thumbnail' => 'required'
            ]);
        }else if($this->currentAddModalStep == 2){
            $data = $this->validate([
                'jenis_hewan' => 'required',
                'judul_post'  => 'required',
                'deskripsi'   => 'required',
                'harga'       => 'required',
                'thumbnail' => 'required',
                'surat_keterangan_sehat' => 'required'
            ]);
            return $data;
        }
        $this->currentAddModalStep++;
    }
    public function previousStepAddModal()
    {
        $this->currentAddModalStep--;
    }
    public function nextStepEditModal()
    {
        if ($this->currentEditModalStep == 1) {
            $this->validate([
                'jenis_hewan' => 'required',
                'judul_post'  => 'required',
                'deskripsi'   => 'required',
                'harga'       => 'required',
            ]);
        }
        $this->currentEditModalStep++;
    }
    public function previousStepEditModal()
    {
        $this->currentEditModalStep--;
    }
    public function resetForm()
    {
        $this->jenis_hewan = null;
        $this->judul_post = null;
        $this->deskripsi = null;
        $this->harga = null;
        $this->thumbnail = null;
        $this->sertifikat_pedigree = null;
        $this->surat_keterangan_sehat = null;
    }
}
