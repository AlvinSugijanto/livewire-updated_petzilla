<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';

    protected $fillable = [
        'message',
        'users_id_user',
        'store_id_store',
        'sender_type',
    ];
}
