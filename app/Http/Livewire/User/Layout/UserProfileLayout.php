<?php

namespace App\Http\Livewire\User\Layout;

use Livewire\Component;

class UserProfileLayout extends Component
{
    public $type;

    public function mount($type)
    {
        $this->type = $type;
    }
    public function render()
    {
        return view('livewire.user.layout.user-profile-layout');
    }
}
