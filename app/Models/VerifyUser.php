<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class VerifyUser extends Model
{
    protected $table = 'verify_user';

    protected $fillable = [
        'token',
        'user_id_user'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id_user','id_user');
    }
}
