<?php

namespace App\Http\Livewire\Auth;
use Illuminate\Support\Facades\Mail;

use Livewire\Component;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use Carbon\Carbon;


class EmailVerify extends Component
{
    public function mount($token){
        $verifiedUser = VerifyUser::where('token', $token)->first();
        if (isset($verifiedUser)) {
            $user = $verifiedUser->user;
            if ($user->email_verified_at == NULL) {
                $user->email_verified_at = Carbon::now();
                $user->save();
                session()->flash('success', 'Congratulations, Your email has been verified!');
                return redirect()->to('/login');

            } else {
                session()->flash('success', 'Your email already verified');

                return redirect()->to('/login');
            }
        } else {
            return redirect()->to('/login');
        }
    }

    
}
