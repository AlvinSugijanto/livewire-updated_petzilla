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

    public function render()
    {
        $currentStore = StoreModel::where('user_id_user', Auth::id())->first();

        $rating = Rating::with('transaction.store', 'transaction.user','transaction.animal')
            ->whereHas('transaction', function ($query) use ($currentStore) {
                $query->where('store_id_store', $currentStore->id_store);
            })
            ->paginate(10);

        // dd($rating[0]->transaction);

        return view('livewire.store.daftar-review', ['rating' => $rating])->layout('livewire.layouts.tes-layout', ['blueButton' => 'review']);
    }
}
