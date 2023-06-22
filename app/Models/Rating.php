<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Rating extends Model
{
    protected $table = 'rating_and_review';

    public $timestamps = true;

    protected $fillable = [
        'rating',
        'review',
        'transaction_id_transaction',
        'created_at',
        'updated_at'
    ];

    public function store()
    {
        return $this->belongsTo(StoreModel::class,'store_id_store','id_store');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'transaction_id_transaction','id_transaction');
    }

}
