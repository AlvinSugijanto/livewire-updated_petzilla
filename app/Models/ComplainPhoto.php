<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplainPhoto extends Model
{
    protected $table = 'complain_photo';

    protected $fillable = [
        'photo',
        'complain_id'
    ];
}
