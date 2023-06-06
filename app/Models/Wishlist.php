<?php

namespace App\Models;

use App\Models\User;
use App\Models\ListAnimal;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'users_id_user',
        'list_animal_id_animal',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id_user', 'id_user');
    }
    public function animal()
    {
        return $this->belongsTo(ListAnimal::class, 'list_animal_id_animal', 'id_animal');
    }
}
