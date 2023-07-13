<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\ListAnimal;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DetailProduk extends Component
{
    public $jenis_hewan, $judul_post, $harga, $stok, $warna, $umur, $satuan_umur, $deskripsi;
    public $thumbnail, $photos = [];
    public $display_photo, $display_photos = [];
    public $sertifikat_pedigree, $surat_keterangan_sehat;

    public function mount($id_animal)
    {
        $animal = ListAnimal::where('id_animal', $id_animal)
            ->with('store')
            ->with('animal_photo')
            ->first();

        if(empty($animal))
        {
            return redirect()->to('/admin/error/not-found');
        }

        $this->jenis_hewan = $animal->jenis_hewan;
        $this->judul_post = $animal->judul_post;
        $this->harga = $animal->harga;
        $this->stok = $animal->stok;
        $this->warna = $animal->warna;
        $this->umur = $animal->umur;
        $this->satuan_umur = $animal->satuan_umur;
        $this->deskripsi = $animal->deskripsi;
        $this->display_photo = $animal->thumbnail;
        $this->display_photos = $animal->animal_photo;
        $this->surat_keterangan_sehat = $animal->surat_keterangan_sehat;
        if ($animal->sertifikat_pedigree) {
            $this->sertifikat_pedigree = $animal->sertifikat_pedigree;
        }
    }

    public function render()
    {
        return view('livewire.admin.product.detail-produk')->layout('livewire.layouts.admin-layout');
    }


}
