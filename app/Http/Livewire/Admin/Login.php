<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{
    public $email, $password;

    public function render()
    {
        return view('livewire.admin.login')->layout('layouts.admin');
    }
    public function login()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $admin = Admin::where('email',$this->email)->first();
        if($admin == NULL)
        {
           return session()->flash('error', 'Incorrect credentials !');
        }
        // $password = decrypt($admin->password);
        if (Hash::check($this->password, $admin->password)) {

            return redirect()->to('/admin/dashboard');

        }
        return session()->flash('error', 'Incorrect credentials !');

    }
}
