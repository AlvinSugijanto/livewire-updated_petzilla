<?php

namespace App\Http\Livewire\Store;

use App\Models\ListAnimal;
use App\Models\AnimalPhoto;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EditProduk extends Component
{
    use WithFileUploads;

    public $animalId;

    public $jenis_hewan, $judul_post, $harga, $stok, $warna, $umur, $satuan_umur, $deskripsi;
    public $thumbnail, $photos = [];
    public $display_photo, $display_photos = [];
    public $sertifikat_pedigree, $surat_keterangan_sehat;


    public function mount($animalId)
    {
        $animal = ListAnimal::find($animalId);  
        // dd($animal);

        $this->jenis_hewan = $animal->jenis_hewan;
        $this->judul_post = $animal->judul_post;
        $this->harga = $animal->harga;
        $this->stok = $animal->stok;
        $this->warna = $animal->warna;
        $this->umur = $animal->umur;
        $this->satuan_umur = $animal->satuan_umur;
        $this->deskripsi = $animal->deskripsi;
        $this->display_photo = $animal->thumbnail;
        $this->display_photos = AnimalPhoto::where('list_animal_id_animal', $animalId)->get();
        // dd($animal->thumbnail);
        // $image = Storage::disk('public')->get($animal->thumbnail);
        // $name = basename($image);
        // dd($name);
        // $this->surat_keterangan_sehat = $animal->surat_keterangan_sehat;
        // $this->sertifikat_pedigree = $animal->sertifikat_pedigree;
    }
    public function render()
    {

        return view('livewire.store.edit-produk')->layout('livewire.layouts.tes-layout', ['blueButton' => 'produk']);
    }
    public function editProdukData()
    {

        $data = $this->validate([
            'jenis_hewan'   => 'required',
            'judul_post'    => 'required',
            'deskripsi'     => 'required',
            'harga'         => 'required',
            'stok'          => 'required',
        ]);
        $array_data = [
            'warna' => $this->warna,
            'umur'  => $this->umur,
            'satuan_umur' => $this->satuan_umur
        ];
        $data = array_merge($data,$array_data);
        $animal = ListAnimal::where('id_animal', $this->animalId)->first();
        // dd($this->surat_keterangan_sehat);
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
    public function deletePhoto($id)
    {
        if ($id) {
            $animal = AnimalPhoto::where('id_animal_photo', $id)->first();
            Storage::disk('public')->delete($animal->id_animal_photo, $animal->photo);
            $animal->delete();
        }
    }
    public function updatedThumbnail()
    {
        $this->display_photo = NULL;
    }
}
