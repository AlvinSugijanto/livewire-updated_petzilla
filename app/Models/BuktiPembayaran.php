<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    protected $table = 'bukti_pembayaran';

    public $timestamps = false;

    protected $fillable = [
        'tipe_rekening',
        'jenis_rekening',
        'nama_rekening',
        'nomor_rekening',
        'bukti_pembayaran',
        'transaction_id_transaction'
    ];
}
