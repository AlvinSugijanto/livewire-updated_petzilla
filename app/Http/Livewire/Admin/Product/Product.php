<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\ListAnimal;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['type'];
    public $searchTerm ="";
    public $type;
    
    protected $listeners = ['modalConfirmed' => 'updateStatusAnimal'];

    public function mount()
    {
        $this->type = 'aktif';
    }
    public function render()
    {
        if (!empty($this->searchTerm)) {

            $animal = ListAnimal::with('store')
                                ->where('judul_post', 'like', "%" . $this->searchTerm . "%")
                                ->where('status', $this->type)
                                ->paginate(10);

        } else {
            $animal = ListAnimal::where('status', $this->type)->with('store')->paginate(10);
        }
        return view('livewire.admin.product.product', ['animals' => $animal])->layout('livewire.layouts.admin-layout');
    }
    public function updateType($type)
    {
        $this->type = $type;
    }
    public function updateStatusAnimal($id)
    {
        $animal = ListAnimal::find($id);

        
        $animal->status = 'aktif';
        $animal->save();
    }
}
