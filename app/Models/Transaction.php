<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\ListAnimal;
use App\Models\StoreModel;
use App\Models\InformasiPengiriman;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    protected $table = 'transaction';

    protected $primaryKey = 'id_transaction';

    public $timestamps = true;

    public $incrementing = false;

    protected $fillable = [
        'id_transaction',
        'sub_total',
        'grand_total',
        'created_at',
        'updated_at',
        'users_id_user',
        'store_id_store',
        'payment_reference'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id_user', 'id_user');
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
    public function complain()
    {
        return $this->hasOne(Complain::class, 'transaction_id_transaction', 'id_transaction');
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
    public function getPengajuanOngkir()
    {
        return Transaction::where('users_id_user', Auth::id())
                                    ->where('status','pengajuan_ongkir')
                                    ->with('user')
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

    }
    public function getMenungguPembayaran()
    {
        return Transaction::where('users_id_user', Auth::id())
                                    ->where('status','menunggu_pembayaran')
                                    ->with('user')
                                    ->with('animal')
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

    }
    public function getReviewPembayaran()
    {
        return Transaction::where('users_id_user', Auth::id())
                                    ->where('status','review_pembayaran')
                                    ->with('user')
                                    ->with('animal')
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

    }
    public function getSedangDiProses()
    {
        return Transaction::where('users_id_user', Auth::id())
                                    ->where('status','sedang_diproses')
                                    ->with('user')
                                    ->with('animal')
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

    }
    public function getSedangDiKirim()
    {
        return Transaction::where('users_id_user', Auth::id())
                                    ->where('status','sedang_dikirim')
                                    ->with('user')
                                    ->with('animal')
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

    }
    public function getSampaiTujuan()
    {
        return Transaction::where('users_id_user', Auth::id())
                                    ->where('status','sampai_tujuan')
                                    ->with('user')
                                    ->with('animal')
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

    }

    // Store
    public function getPengajuanOngkirStore()
    {
        return Transaction::where('store_id_store', Auth::user()->store->id_store)
                                    ->where('status','pengajuan_ongkir')
                                    ->with('user')
                                    ->with('animal')
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

    }
    public function getMenungguPembayaranStore()
    {
        return Transaction::where('store_id_store', Auth::user()->store->id_store)
                                    ->where('status','menunggu_pembayaran')
                                    ->with('user')
                                    ->with('animal')
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

    }
    public function getSedangDiProsesStore()
    {
        return Transaction::where('store_id_store', Auth::user()->store->id_store)
                                    ->where('status','sedang_diproses')
                                    ->with('user')
                                    ->with('animal')
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

    }
    public function getSedangDiKirimStore()
    {
        return Transaction::where('store_id_store', Auth::user()->store->id_store)
                                    ->where('status','sedang_dikirim')
                                    ->with('user')
                                    ->with('animal')
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

    }
    public function getSampaiTujuanStore()
    {
        return Transaction::where('store_id_store', Auth::user()->store->id_store)
                                    ->where('status','sampai_tujuan')
                                    ->with('user')
                                    ->with('animal')
                                    ->orderBy('created_at','desc')
                                    ->paginate(5);

    }
}
