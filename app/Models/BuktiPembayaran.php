<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    protected $table = 'bukti_pembayaran';

    public $timestamps = false;

    protected $fillable = [
        'metode_pembayaran',
        'nama_rekening',
        'nomor_rekening',
        'foto_bukti',
        'transaction_id_transaction'
    ];
}
