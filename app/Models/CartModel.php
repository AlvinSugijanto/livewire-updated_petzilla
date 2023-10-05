<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CartModel extends Model
{
    use HasFactory;

    protected $table = 'cart';
    public $timestamps = false;

    protected $primaryKey = 'id_cart';
    
    protected $fillable = [
        'total',
        'users_id_user',
        'store_id_store'
    ];

    public function cartDetail()
    {
        return $this->hasMany(CartDetail::class, 'cart_id', 'id_cart');
    }
    public function store()
    {
        return $this->belongsTo(StoreModel::class, 'store_id_store','id_store');
    }

}
