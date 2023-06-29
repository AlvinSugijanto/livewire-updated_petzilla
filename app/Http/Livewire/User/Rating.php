<?php

namespace App\Http\Livewire\User;

use App\Models\StoreModel;
use App\Models\Rating as UserRating;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Rating extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $id_store;
    public $store;

    public function mount($id_store)
    {
        $this->store = StoreModel::where('id_store', $id_store)->first();

    }
    public function render()
    {
        $store = $this->store;

        $rating = UserRating::whereHas('transaction', function($query) use ($store){
            $query->where('store_id_store',$store->id_store);
        })
        ->with('transaction')
        ->with('transaction.user')
        ->with('transaction.animal')
        ->paginate(10);
        
        return view('livewire.user.rating', ['rating' => $rating]);
    }
    
}
