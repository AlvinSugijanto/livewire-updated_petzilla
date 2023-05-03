<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Mail;

use Livewire\Component;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use App\Libraries\Provinsi;
use App\Libraries\Kabupaten;
use App\Libraries\Kecamatan;


class RegisterUser extends Component
{
    public $name, $email, $password, $alamat_lengkap, $phone_number;
    public $provinsi, $kabupaten, $kecamatan;
    public $jenis_rekening;
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
        $data = $this->validateForm();
        $model = new User;
        $data = $model->geocode($data);

        $user = User::create($data);

        VerifyUser::create([
            'token' => Str::random(60),
            'user_id_user' => $user->id_user,
        ]);

        Mail::to($user->email)->send(new VerifyEmail($user));

        $this->dispatchBrowserEvent('show-modal');
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
        if ($this->currentStep == 1){
            $this->validate([
                'name'           => 'required|min:2|max:20',
                'email'          => 'required|email|unique:users|max:255',
                'password'       => 'required|string|min:8|max:20',
                'phone_number'   => 'required|digits_between:10,14',
            ]);
        }else if($this->currentStep ==2){
            $data = $this->validate([
                'alamat_lengkap' => 'required|string|min:20',
                'provinsi'       => 'required',
                'kabupaten'      => 'required',
                'kecamatan'      => 'required',
                'name'           => 'required|min:2|max:20',
                'email'          => 'required|email|unique:users|max:255',
                'password'       => 'required|string|min:8|max:20',
                'phone_number'   => 'required|digits_between:10,14',
            ]);
            return $data;
        }
    }

}
