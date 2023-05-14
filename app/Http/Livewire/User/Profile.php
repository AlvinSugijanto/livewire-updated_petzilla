<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;

use App\Libraries\Provinsi;
use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;

class Profile extends Component
{
    public $name, $email, $address, $phone_number, $alamat_lengkap;
    public $edit_personal = false, $edit_address;
    public $provinsi, $kabupaten, $kecamatan;


    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;

        $this->daftar_kabupaten = [];
        $this->daftar_kecamatan = [];
        $this->getAddress();
    }
    public function render()
    {
        return view('livewire.user.profile')->layout('livewire.layouts.base');
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

        $user = User::where('id_user', Auth::user()->id_user)->first();
        $this->provinsi = $user->provinsi;
        $this->updatedProvinsi();
        $this->kabupaten = $user->kabupaten;
        $this->updatedKabupaten();
        $this->kecamatan = $user->kecamatan;

        $this->alamat_lengkap = $user->alamat_lengkap;
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
    public function update()
    {

        $data = $this->validate([
            'name'      => 'required',
            'email'    => 'required',
            'alamat_lengkap'          => 'required',
            'phone_number' => 'required',
            'alamat_lengkap' => 'required',
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

        $data['latitude'] = $getLatLng[0]['lat'];
        $data['longitude'] = $getLatLng[0]['lon'];


        User::where('id_user', Auth::id())->update($data);
    }
    public function updatePersonal()
    {
        $data = $this->validate([
            'name'          => 'required',
            'email'         => 'required',
            'phone_number'  => 'required',
        ]);
        $user = User::where('id_user', Auth::id())->update($data);

        if ($user) {
            $this->cancelEditPersonal();
            $this->dispatchBrowserEvent('success-notification');
        }
    }
    public function updateAddress()
    {
        $data = $this->validate([
            'alamat_lengkap' => 'required',
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

        $data['latitude'] = $getLatLng[0]['lat'];
        $data['longitude'] = $getLatLng[0]['lon'];

        $user = User::where('id_user', Auth::id())->update($data);

        if ($user) {
            $this->cancelEditAddress();
            $this->dispatchBrowserEvent('success-notification');
        }
    }
}
