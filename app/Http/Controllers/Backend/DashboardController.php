<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Bus;
use App\Model\Supervisor;
use App\Model\Counter;
use App\Model\Booking;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexview () 
    {
        $bus = count(Bus::all());
        $supervisor = count(Supervisor::all());
        $counter = count(Counter::all());
        $newbooking = count(Booking::where('booking_status', 0)->get());
        $bookings = Booking::orderBy('id', 'DESC')->limit(9)->get();
        foreach ($bookings as $booking) {
            $selectedseat = explode(',', $booking->selectedseat);
            $bookedseat = [];
            $totalseat = $booking->bus->numberofseat;
            $lastSeatName = chr(floor(($totalseat-3)/4) + 64);
            foreach ($selectedseat as $i) {
                if($i >= 1 && $i <= 3) 
                {
                    $return = "Ex".$i;
                }
                else if($i >= 4 && $i <= $totalseat - 5)
                {
                    $return = chr(floor($i/4) + 64).($i%4 + 1);
                }
                else
                {
                    $return = $lastSeatName.($i%5 + 1);
                }
                array_push($bookedseat, $return);
            }
            $booking->selectedseat = $bookedseat;
        }
        return view('backend.dashboard.dashboard', [
            'bus'           => $bus,
            'supervisor'    => $supervisor,
            'counter'       => $counter,
            'bookings'      => $bookings,
            'newbooking'    => $newbooking
        ]);
    }
}
