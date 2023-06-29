<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{    
    protected $table = 'complain';

    protected $fillable = [
        'id',
        'komentar',
        'status',
        'created_at',
        'updated_at',
        'transaction_id_transaction'
    ];

    public function photo()
    {
        return $this->hasMany(ComplainPhoto::class, 'complain_id', 'id');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id_transaction','id_transaction');
    }
}
