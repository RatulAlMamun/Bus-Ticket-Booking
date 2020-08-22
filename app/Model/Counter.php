<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $table = 'counters';
    protected $fillable = [
        'placename',
        'shopname',
        'phoneno',
        'address'
    ];
}
