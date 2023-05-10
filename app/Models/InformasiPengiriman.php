<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPengiriman extends Model
{
    protected $table = 'informasi_pengiriman';

    public $timestamps = false;

    protected $fillable = [
        'jasa_pengiriman',
        'biaya_pengiriman',
        'transaction_id_transaction',
    ];
}
