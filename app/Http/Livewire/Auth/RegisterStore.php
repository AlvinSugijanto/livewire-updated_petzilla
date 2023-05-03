<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\StoreModel;
use App\Models\StoreBankAccount;

use App\Libraries\Provinsi;
use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;

class RegisterStore extends Component
{
    public $nama_toko, $description, $alamat_lengkap, $no_hp;
    public $provinsi, $kabupaten, $kecamatan;
    public $tipe_rekening, $jenis_rekening, $nama_rekening, $nomor_rekening;

    public function mount()
    {
        $provObject = new Provinsi();

        $this->daftar_provinsi = $provObject->all();
        $this->daftar_kabupaten = [];
        $this->daftar_kecamatan = [];
        $this->currentStep = 1;
    }
    public function render()
    {

        return view('livewire.auth.register-store')->layout('layouts/layout-register-store');
    }

    public function updatedProvinsi()
    {
        $kabObject = new Kabupaten();

        $this->daftar_kabupaten = $kabObject->getKabupatenFromProvinsi($this->provinsi);
        $this->kabupaten = "";
        $this->daftar_kecamatan = [];
    }
    public function updatedKabupaten()
    {

        $kecObject = new Kecamatan();
        $this->daftar_kecamatan = $kecObject->getKecamatanFromKabupaten($this->kabupaten);
    }

    public function registerStore()
    {
        $this->validate([
            'nama_toko'      => 'required|min:2|max:20',
            'description'    => 'required|string|min:10',
            'no_hp'          => 'required|digits_between:10,14',
            'alamat_lengkap' => 'required|string|min:10',
            'provinsi'       => 'required',
            'kabupaten'      => 'required',
            'kecamatan'      => 'required'
        ]);
        $kabObject = new Kabupaten();
        $kecObject = new Kecamatan();

        $nama_kecamatan = $kecObject->getNama($this->kabupaten, $this->kecamatan);
        $nama_kabupaten = $kabObject->getNama($this->provinsi, $this->kabupaten);

        $temp = explode(" ", $nama_kabupaten);
        $kabupaten_name = implode(" ", array_slice($temp, 1));
        $getLatLng = Http::get('https://geocode.maps.co/search?q=' . $nama_kecamatan . ', ' . $kabupaten_name)->json();

        $store = StoreModel::create([
            'id_store' => Str::random(10),
            'nama_toko' => $this->nama_toko,
            'description' => $this->description,
            'alamat_lengkap' => $this->alamat_lengkap,
            'no_hp'         => $this->no_hp,
            'provinsi'      => $this->provinsi,
            'kabupaten'     => $this->kabupaten,
            'kecamatan'     => $this->kecamatan,
            'user_id_user'  => Auth::id(),
            'latitude'    => $getLatLng[0]['lat'],
            'longitude'     => $getLatLng[0]['lon']
        ]);
        StoreBankAccount::create([
            'tipe_rekening' => $this->tipe_rekening,
            'jenis_rekening' => $this->jenis_rekening,
            'nama_rekening'  => $this->nama_rekening,
            'nomor_rekening' => $this->nomor_rekening,
            'store_id_store' => $store->id_store
        ]);

        $this->dispatchBrowserEvent('show-modal');
    }
    public function nextStep()
    {
        $this->validateForm();
        $this->currentStep++;
    }
    public function previousStep()
    {
        $this->currentStep--;
    }
    public function validateForm()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'nama_toko'      => 'required|min:2|max:20',
                'description'    => 'required|string|min:10',
                'no_hp'          => 'required|digits_between:10,14',
            ]);
        } else if ($this->currentStep == 2) {
            $this->validate([
                'alamat_lengkap' => 'required|string|min:10',
                'provinsi'       => 'required',
                'kabupaten'      => 'required',
                'kecamatan'      => 'required'
            ]);
        } else if ($this->currentStep == 3) {
            $this->validate([
                'tipe_rekening' => 'required',
                'jenis_rekening'       => 'required',
                'nama_rekening'      => 'required',
                'nomor_rekening'      => 'required'
            ]);
        }
    }
}
