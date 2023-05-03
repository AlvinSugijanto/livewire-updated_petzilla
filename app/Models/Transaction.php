<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';

    public $timestamps = true;

    
    protected $fillable = [
        'id_transaction',
        'ongkir',
        'status',
        'subtotal',
        'grand_total',
        'created_at',
        'updated_at',
        'users_id_user',
        'store_id_store',
        'list_animal_id_animal',
    ];
}
