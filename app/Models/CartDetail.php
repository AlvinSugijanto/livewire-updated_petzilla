<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CartDetail extends Model
{
    use HasFactory;

    protected $table = 'cart_detail';
    public $timestamps = false;
    protected $primaryKey = 'id_cart_detail';
    
    protected $fillable = [
        'cart_id',
        'qty',
        'list_animal_id_animal'
    ];

    public function animal(){
        return $this->belongsTo(ListAnimal::class, 'list_animal_id_animal', 'id_animal');
    }
}
