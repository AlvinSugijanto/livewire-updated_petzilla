<?php

namespace App\Http\Livewire\Store;

use App\Models\ListAnimal;
use App\Models\StoreModel;
use App\Models\AnimalPhoto;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class TambahProduk extends Component
{
    use WithFileUploads;

    public $jenis_hewan, $judul_post, $harga, $stok, $warna, $umur, $satuan_umur, $deskripsi;
    public $thumbnail, $photos = [];
    public $sertifikat_pedigree, $surat_keterangan_sehat;

    public function mount()
    {
        $this->harga = 0;
        $this->stok = 1;
    }
    public function render()
    {
        return view('livewire.store.tambah-produk')->layout('livewire.layouts.tes-layout', ['blueButton' => 'produk']);;
    }

    public function storeProduct()
    {

        $data = $this->validate([
            'jenis_hewan'   => 'required',
            'judul_post'    => 'required',
            'harga' => 'required|numeric|min:1',
            'stok' => 'required|integer|min:1',
            'deskripsi'     => 'required',
            'umur'          => 'nullable|numeric|min:1',
            'thumbnail'     => 'required',
            'surat_keterangan_sehat' => 'required'
        ]);

        $animal = ListAnimal::create([

            'id_animal' => Str::random(10),
            'jenis_hewan' => $this->jenis_hewan,
            'judul_post'  => $this->judul_post,
            'deskripsi'   => $this->deskripsi,
            'harga'       => $this->harga,
            'stok'        => $this->stok,
            'warna'       => $this->warna,
            'umur'        => $this->umur ? $this->umur : null,
            'satuan_umur' => $this->umur ? $this->satuan_umur : null,
            'status'      => 'menunggu_persetujuan',
            'store_id_store' => StoreModel::whereHas('user', function ($query) {
                                    $query->where('id_user', Auth::id());
                                })->value('id_store')
        ]);
        $animal->thumbnail = Storage::disk('public')->put($animal->id_animal, $this->thumbnail);
        $animal->surat_keterangan_sehat = Storage::disk('public')->put($animal->id_animal, $this->surat_keterangan_sehat);
        
        if($this->sertifikat_pedigree){
            $animal->sertifikat_pedigree = Storage::disk('public')->put($animal->id_animal, $this->sertifikat_pedigree);
        }

        $model = new AnimalPhoto;
        $model->storePhoto($this->photos, $animal->id_animal);

        if($animal->save())
        {
            $this->dispatchBrowserEvent('success-notification');
        }
    }
}
