<?php

namespace App\Http\Livewire\Store;

use Livewire\Component;

use App\Models\StoreModel;
use App\Models\StoreBankAccount;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\Libraries\Provinsi;
use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;

class StoreIndex extends Component
{
    public $is_there_store;
    public $nama_toko, $description, $no_hp, $alamat_lengkap;
    public $edit_personal = false, $edit_address = false;
    public $provinsi, $kabupaten, $kecamatan;
    public $tipe_rekening, $jenis_rekening, $nama_rekening, $nomor_rekening;


    public function mount()
    {
        $store = StoreModel::where('user_id_user', Auth::user()->id_user)->first();
        if($store != NULL){

            $model = new StoreModel;

            // Personal Information
            $this->is_there_store = 'true';
            $this->nama_toko = $store->nama_toko;
            $this->description = $store->description;
            $this->no_hp = $store->no_hp;

            // Address
            $this->daftar_kabupaten = [];
            $this->daftar_kecamatan = [];
            $this->getAddress();

            // Payment Information
            $this->payment = StoreBankAccount::where('store_id_store', $store->id_store)->get();
            

        }else{

            $this->is_there_store = 'false';
        }
    }
    public function render()
    {
        return view('livewire.store.store-index')->layout('livewire.layouts.tes-layout',['blueButton' => 'profil']);
    }
    public function openEditPersonal()
    {
        $this->edit_personal = true;
    }
    public function cancelEditPersonal()
    {
        $this->edit_personal = false;
    }
    public function openEditAddress()
    {
        $this->edit_address = true;
    }
    public function cancelEditAddress()
    {
        $this->edit_address = false;
    }
    public function getAddress()
    { 
        $provObject = new Provinsi();
        $this->daftar_provinsi = $provObject->all();
        
        $store = StoreModel::where('user_id_user', Auth::user()->id_user)->first();
        $this->provinsi = $store->provinsi;
        $this->updatedProvinsi();
        $this->kabupaten = $store->kabupaten;
        $this->updatedKabupaten();
        $this->kecamatan = $store->kecamatan;

        $this->alamat_lengkap = $store->alamat_lengkap;

    }
    public function updatedProvinsi()
    {
        $kabObject = new Kabupaten();

        $this->daftar_kabupaten = $kabObject->getKabupatenFromProvinsi($this->provinsi);
        $this->daftar_kecamatan = [];

    }
    public function updatedKabupaten()
    {
        $kecObject = new Kecamatan();

        $this->daftar_kecamatan = $kecObject->getKecamatanFromKabupaten($this->kabupaten);
    }

 

    public function updatePersonal()
    {
        $data = $this->validate([
            'nama_toko'      => 'required',
            'description'    => 'required',
            'no_hp'          => 'required',
        ]);
        StoreModel::where('user_id_user', Auth::id())->update($data);
    }
    public function updateAddress()
    {
        $data = $this->validate([
            'alamat_lengkap' => 'required',
            'provinsi'       => 'required',
            'kabupaten'      => 'required',
            'kecamatan'      => 'required'
        ]);
        $model = new StoreModel;
        $data = $model->geocode($data);
        StoreModel::where('user_id_user', Auth::id())->update($data);

    }

    public function submitTambahRekening()
    {
        $data = $this->validate([
            'tipe_rekening' => 'required',
            'jenis_rekening'       => 'required',
            'nama_rekening'      => 'required',
            'nomor_rekening'      => 'required'
        ]);

        $data['store_id_store'] = StoreModel::where('user_id_user', Auth::user()->id_user)->value('id_store');
        if(StoreBankAccount::create($data))
        {
            $this->dispatchBrowserEvent('successTambahRekening');
        }
    }
}
