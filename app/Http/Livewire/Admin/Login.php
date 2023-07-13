<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password;

    public function render()
    {
        return view('livewire.admin.login')->layout('layouts.admin');
    }
    public function login()
    {
        $data = $this->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt($data)) {

            return redirect()->to('/admin/dashboard');

        }
        return session()->flash('error', 'Incorrect credentials !');

    }
}
