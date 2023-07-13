<?php

namespace App\Http\Livewire\Store;

use App\Models\Rating;
use App\Models\StoreModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarReview extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $avg_rating;
    public $currentStore;

    public function mount()
    {
        $this->currentStore = StoreModel::where('user_id_user', Auth::id())->first();

        $this->avg_rating = Rating::with('transaction.store', 'transaction.user','transaction.animal')
        ->whereHas('transaction', function ($query) {
            $query->where('store_id_store', $this->currentStore->id_store);
        })
        ->avg('rating');
    }
    public function render()
    {
        $rating = Rating::with('transaction.store', 'transaction.user','transaction.animal')
            ->whereHas('transaction', function ($query) {
                $query->where('store_id_store', $this->currentStore->id_store);
            })
            ->orderBy('created_at','desc')
            ->paginate(10);

        return view('livewire.store.daftar-review', [
            'rating' => $rating
            ])->layout('livewire.layouts.tes-layout',['blueButton' => 'review']);
    }
}
