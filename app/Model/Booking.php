<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'bus_id',
        'dateofjourney',
        'busroute',
        'arrivalplace',
        'leavingplace',
        'selectedseat',
        'totalprice',
        'name',
        'phoneno',
        'email',
        'address',
        'transaction_id',
        'payment_type',
        'payment_status',
        'notification',
        'booking_status',
        'account_no',
        'payment_amount'
    ];

    public function bus ()
    {
        return $this->belongsTo('App\Model\Bus');
    }
}
