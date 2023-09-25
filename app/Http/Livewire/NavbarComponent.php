<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavbarComponent extends Component
{
    public $search;
    


    public function render()
    {
        return view('livewire.navbar-component');
    }

    public function getTotalTransaction()
    {
        
    }
    public function findAnimal()
    {
        if(!empty($this->search))
        {
            $link = "http://127.0.0.1:8000/home?search={$this->search}"; 
            
            return redirect($link);
        }
    }
}
