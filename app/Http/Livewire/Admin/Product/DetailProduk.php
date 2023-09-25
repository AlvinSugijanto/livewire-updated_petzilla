<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\ListAnimal;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DetailProduk extends Component
{
    public $jenis_hewan, $judul_post, $harga, $stok, $warna, $umur, $satuan_umur, $deskripsi, $animal;
    public $thumbnail, $photos = [];
    public $display_photo, $display_photos = [];
    public $sertifikat_pedigree, $surat_keterangan_sehat;

    protected $listeners = ['modalConfirmed' => 'confirmStatusAnimal', 'modalRejected' => 'rejectStatusAnimal'];

    public function mount($id_animal)
    {
        $this->animal = ListAnimal::where('id_animal', $id_animal)
            ->with('store')
            ->with('animal_photo')
            ->first();
        
        if(empty($this->animal))
        {
            return redirect()->to('/admin/error/not-found');
        }

        $this->jenis_hewan = $this->animal->jenis_hewan;
        $this->judul_post = $this->animal->judul_post;
        $this->harga = $this->animal->harga;
        $this->stok = $this->animal->stok;
        $this->warna = $this->animal->warna;
        $this->umur = $this->animal->umur;
        $this->satuan_umur = $this->animal->satuan_umur;
        $this->deskripsi = $this->animal->deskripsi;
        $this->display_photo = $this->animal->thumbnail;
        $this->display_photos = $this->animal->animal_photo;
        $this->surat_keterangan_sehat = $this->animal->surat_keterangan_sehat;
        if ($this->animal->sertifikat_pedigree) {
            $this->sertifikat_pedigree = $this->animal->sertifikat_pedigree;
        }
    }

    public function render()
    {
        return view('livewire.admin.product.detail-produk')->layout('livewire.layouts.admin-layout');
    }

    public function confirmStatusAnimal($id)
    {
        $animal = ListAnimal::find($id);

        
        $animal->status = 'aktif';
        $animal->save();
    }

    public function rejectStatusAnimal($id)
    {
        $animal = ListAnimal::find($id);

        
        $animal->status = 'ditolak';
        $animal->save();
    }

    public function goBack()
    {
        if($this->animal->status == 'aktif')
        {
            return redirect()->to('/admin/product?type=aktif');

        }else{
            return redirect()->to('/admin/product?type=dalam_persetujuan');

        }

    }

}
