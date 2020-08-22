<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Busroute extends Model
{
    protected $table = 'busroutes';
    protected $fillable = [
        'bus_id',
        'route',
        'leavingtime'
    ];
}
