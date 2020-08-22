<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'buses';
    protected $fillable = [
        'name',
        'route',
        'description',
        'numberofseat',
        'leavingtime',
        'service',
        'image'
    ];

    public function busroute ()
    {
        return $this->hasMany('App\Model\Busroute');
    }
}
