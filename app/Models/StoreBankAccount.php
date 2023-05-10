<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class StoreBankAccount extends Model
{
    protected $table = 'store_bank_information';

    public $timestamps = false;
    
    protected $fillable = [
        'tipe_rekening',
        'jenis_rekening',
        'nama_rekening',
        'nomor_rekening',
        'store_id_store'
    ];

}
