<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\ListAnimal;
use App\Models\StoreModel;
use App\Models\InformasiPengiriman;

class Transaction extends Model
{
    protected $table = 'transaction';

    protected $primaryKey = 'id_transaction';

    public $timestamps = true;

    public $incrementing = false;

    protected $fillable = [
        'id_transaction',
        'qty',
        'status',
        'sub_total',
        'grand_total',
        'created_at',
        'updated_at',
        'users_id_user',
        'store_id_store',
        'list_animal_id_animal',
        'payment_reference'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id_user', 'id_user');
    }
    public function animal()
    {
        return $this->belongsTo(ListAnimal::class, 'list_animal_id_animal', 'id_animal');
    }
    public function store()
    {
        return $this->belongsTo(StoreModel::class, 'store_id_store', 'id_store');
    }
    public function pengiriman()
    {
        return $this->hasOne(InformasiPengiriman::class, 'transaction_id_transaction', 'id_transaction');
    }
    public function pembayaran()
    {
        return $this->hasOne(BuktiPembayaran::class, 'transaction_id_transaction', 'id_transaction');
    }
    public function rating()
    {
        return $this->hasOne(Rating::class, 'transaction_id_transaction', 'id_transaction');
    }
    public function getTransactionData($user)
    {
        $transaction = Transaction::where('users_id_user', $user->id_user)
        ->with('store')
        ->with('animal')
        ->get()
        ->groupBy('status')
        ->map(function ($group) {
            return $group->map(function ($item) {
                $item->store->alamat = $item->store->getAddress($item->store->provinsi, $item->store->kabupaten, $item->store->kecamatan);
                return $item;
            });
        });

        return $transaction;
    }

    public function getTransactionDataStore($store)
    {
        $transaction = Transaction::where('store_id_store', $store->id_store)
        ->with('user')
        ->with('animal')
        ->get()
        ->groupBy('status')
        ->map(function ($group) {
            return $group->map(function ($item) {
                $item->user->alamat = $item->user->getAddress($item->user->provinsi, $item->user->kabupaten, $item->user->kecamatan);
                return $item;
            });
        });

        return $transaction;
    }
}
