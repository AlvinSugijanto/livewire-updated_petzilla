<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_detail';
    public $timestamps = false;
    protected $primaryKey = 'id_transaction_detail';
    
    protected $fillable = [
        'subtotal',
        'qty',
        'transaction_id_transaction',
        'list_animal_id_animal'
    ];

    public function animal(){
        return $this->belongsTo(ListAnimal::class, 'list_animal_id_animal', 'id_animal');
    }
}
