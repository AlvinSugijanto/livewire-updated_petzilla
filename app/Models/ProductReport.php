<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductReport extends Model
{
    protected $table = 'complain';

    protected $fillable = [
        'id',
        'komentar',
        'status',
        'transaction_id_transaction',
    ];

}
