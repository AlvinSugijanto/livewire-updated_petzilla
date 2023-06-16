<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Rating extends Model
{
    protected $table = 'rating_and_review';

    public $timestamps = true;

    protected $fillable = [
        'rating',
        'review',
        'transaction_id_transaction',
        'created_at',
        'updated_at'
    ];

}
