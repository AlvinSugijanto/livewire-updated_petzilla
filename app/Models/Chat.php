<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Chat extends Model
{
    protected $table = 'chat';

    protected $fillable = [
        'message',
        'users_id_user',
        'store_id_store',
        'sender_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id_user', 'id_user');
    }
}
