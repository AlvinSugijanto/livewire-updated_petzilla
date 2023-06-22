<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Mail;

use Livewire\Component;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\VerifyUser;

use App\Mail\VerifyEmail;

use App\Libraries\Provinsi;
use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;

use App\Services\Geocode;


class RegisterUser extends Component
{
    public $name, $email, $password, $alamat_lengkap, $phone_number;
    public $provinsi, $kabupaten, $kecamatan;
    public $jenis_rekening;

    public $isLocationDetected, $lat, $lng, $koordinat;
    public $geo_data;


    public function mount()
    {
        $provObject = new Provinsi();
        $province = $provObject->all();

        $this->daftar_provinsi = $province;
        $this->daftar_kabupaten = [];
        $this->daftar_kecamatan = [];

        $this->currentStep = 1;
    }
    public function render()
    {
        return view('livewire.auth.register-user')->layout('layouts/layout-register-user');
    }
    public function register()
    {

        $data = $this->validate([
            'name'           => 'required|min:2|max:20',
            'email'          => 'required|email|unique:users|max:255',
            'password'       => 'required|string|min:8|max:20',
            'phone_number'   => 'required|digits_between:10,14',
            'alamat_lengkap' => 'required|string|min:10',
            'provinsi'       => 'required',
            'kabupaten'      => 'required',
            'kecamatan'      => 'required',
        ]);

        $data['id_user'] = Str::random(10);
        $data['password'] = bcrypt($data['password']);
        $data['latitude'] = $this->geo_data['lat'];
        $data['longitude'] = $this->geo_data['lon'];


        try {
            $user = User::create($data);

            VerifyUser::create([
                'token' => Str::random(60),
                'user_id_user' => $user->id_user,
            ]);

            Mail::to($user->email)->send(new VerifyEmail($user));

            $this->dispatchBrowserEvent('show-modal');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

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
    public function submit_button()
    {
        $this->validateForm();
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
                'name'           => 'required|min:2|max:20',
                'email'          => 'required|email|unique:users|max:255',
                'password'       => 'required|string|min:8|max:20',
                'phone_number'   => 'required|digits_between:10,14',
            ]);
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
                    $this->register();
                }
            } else {
                $geo_object = new Geocode;
                $this->geo_data = $geo_object->geocode_from_coordinate($this->koordinat);
                $this->register();
            }
        }
    }

    public function openTipsModal()
    {
        $this->dispatchBrowserEvent('open-tips-modal');
    }
}
