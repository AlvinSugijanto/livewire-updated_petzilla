<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\StoreModel;
use App\Models\StoreBankAccount;

use App\Libraries\Provinsi;
use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;

use App\Services\Geocode;

class RegisterStore extends Component
{
    public $nama_toko, $description, $alamat_lengkap, $no_hp;

    public $provinsi, $kabupaten, $kecamatan;

    public $tipe_rekening, $jenis_rekening, $nama_rekening, $nomor_rekening;

    public $isLocationDetected, $koordinat;
    public $geo_data;

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
        $data_store = $this->validate([
            'nama_toko'      => 'required|min:2|max:20',
            'description'    => 'required|string|min:10',
            'no_hp'          => 'required|digits_between:10,14',
            'alamat_lengkap' => 'required|string|min:10',
            'provinsi'       => 'required',
            'kabupaten'      => 'required',
            'kecamatan'      => 'required',
        ]);

        $data_bank = $this->validate([
            'tipe_rekening' => 'required',
            'jenis_rekening'       => 'required',
            'nama_rekening'      => 'required',
            'nomor_rekening'      => 'required'
        ]);
        try {
            
            $data_store['id_store'] = Str::random(10);
            $data_store['latitude'] = $this->geo_data['lat'];
            $data_store['longitude'] = $this->geo_data['lon'];
            $data_store['user_id_user'] = Auth::id();

            $store = StoreModel::create($data_store);

            
            $data_bank['store_id_store'] = $store->id_store;
            StoreBankAccount::create($data_bank);

            $this->dispatchBrowserEvent('show-modal');

        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('error-modal');
        }
    }
    public function nextStep()
    {
        $this->validateForm();
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

            $this->currentStep++;
        } else if ($this->currentStep == 2) {

            $data = $this->validate([
                'alamat_lengkap' => 'required|string|min:10',
                'provinsi'       => 'required',
                'kabupaten'      => 'required',
                'kecamatan'      => 'required',
            ]);

            if ($this->koordinat == null) {

                $geo_object = new Geocode;
                $this->geo_data = $geo_object->handle($data);

                if (empty($this->geo_data)) {
                    $this->isLocationDetected = 'false';
                } else {
                    $this->currentStep++;
                    $this->nextStep();
                }
            } else {
                $geo_object = new Geocode;
                $this->geo_data = $geo_object->geocode_from_coordinate($this->koordinat);
                $this->currentStep++;
                $this->nextStep();
            }
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
