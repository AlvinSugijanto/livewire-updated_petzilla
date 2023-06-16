<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductReportPhoto extends Model
{
    protected $table = 'complain_photo';

    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'photo',
        'complain_id',
    ];

}
