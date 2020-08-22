<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Seathistory extends Model
{
    protected $table = 'seat_historys';
    protected $fillable = [
        'bus_id',
        'bus_route',
        'date',
        'seatplan'
    ];
}
