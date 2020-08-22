<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $table = 'supervisor';
    protected $fillable = [
        'busname',
        'phoneno'
    ];
}
