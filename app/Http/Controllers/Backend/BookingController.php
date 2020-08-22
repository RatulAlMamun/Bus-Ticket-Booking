<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Bus;
use App\Model\Booking;
use App\Model\Seathistory;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function bookingview ()
    {
        $bookings = Booking::orderBy('id', 'DESC')->get();
        foreach ($bookings as $booking) 
        {
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
        return view('backend.booking.view', [
            'bookings' => $bookings
        ]);
    }

    public function singlebookingview ($id)
    {
        $booking = Booking::find($id);
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
        return view('backend.booking.singleview', [
            'booking' => $booking
        ]);
    }

    public function addbookingview ()
    {
        $buses = Bus::where('service', 1)->get();
        return view('backend.booking.addbooking', [
            'buses' => $buses
        ]);
    }

    public function create (Request $request)
    {
        $request->validate([
            'dateofjourney'     => 'required',
            'bus_id'            => 'required',
            'busroute'          => 'required',
            'arrivalplace'      => 'required',
            'leavingplace'      => 'required',
            'selectedseat'      => 'required',
            'totalprice'        => 'required',
            'name'              => 'required',
            'phoneno'           => 'required|numeric',
            'payment_amount'    => 'required|numeric'
        ]);
        $data = [
            'bus_id'            => $request->bus_id,
            'dateofjourney'     => $request->dateofjourney,
            'busroute'          => $request->busroute,
            'arrivalplace'      => $request->arrivalplace,
            'leavingplace'      => $request->leavingplace,
            'selectedseat'      => $request->selectedseat,
            'totalprice'        => $request->totalprice,
            'name'              => $request->name,
            'phoneno'           => $request->phoneno,
            'email'             => !empty($request->email)?$request->email:'',
            'address'           => !empty($request->address)?$request->address:'',
            'transaction_id'    => '',
            'payment_type'      => '',
            'payment_status'    => 0,
            'notification'      => 0,
            'booking_status'    => 0,
            'account_no'        => '',
            'payment_amount'    => $request->payment_amount
        ];
        // Seat History Updator
        $history = Seathistory::where('bus_id', $request->bus_id)->where('bus_route', $request->busroute)->where('date', $request->dateofjourney)->first();
        $selectedseat = $request->selectedseat;
        $selectedseatexplode = explode(',', $selectedseat);
        $seatplanhistory = $history->seatplan;
        $seatplanhistoryexplode = explode(',', $seatplanhistory);
        for ($i = 0; $i < count($selectedseatexplode); $i++)
        {
            $seatplanhistoryexplode[$selectedseatexplode[$i]] = 1;
        }
        $seatplanhistoryimplode = implode(',', $seatplanhistoryexplode);
        $history_update_data = [
            'seatplan' => $seatplanhistoryimplode
        ];
        Seathistory::where('id', $history->id)->update($history_update_data);
        Booking::create($data);
        return redirect()->back()->with('success', 'Your Booking Placed Successfully. Please Wait for Confirmation.');
    }

    public function destroy ($id)
    {
        Booking::where('id', $id)->delete();
        return redirect('/admin/booking/view')->with('success', 'Your Booking Removed Successfully.');
    }

    public function approved ($id)
    {
        $booking = Booking::find($id);
        $busid = $booking->bus_id;
        $busroute = $booking->busroute;
        $date = $booking->dateofjourney;
        $selectedseat = $booking->selectedseat;
        $selectedseatexplode = explode(',', $selectedseat);
        $history = Seathistory::where('bus_id', $busid)->where('bus_route', $busroute)->where('date', $date)->first();
        $seatplanhistory = $history->seatplan;
        $seatplanhistoryexplode = explode(',', $seatplanhistory);
        for ($i = 0; $i < count($selectedseatexplode); $i++)
        {
            $seatplanhistoryexplode[$selectedseatexplode[$i]] = 2;
        }
        $seatplanhistoryimplode = implode(',', $seatplanhistoryexplode);
        $history_update_data = [
            'seatplan' => $seatplanhistoryimplode
        ];
        $data = [
            'booking_status' => 1
        ];
        Seathistory::where('id', $history->id)->update($history_update_data);
        Booking::where('id', $id)->update($data);
        return redirect('/admin/booking/view')->with('success', 'The Booking has been Approved.');
    }

    public function return ($id) 
    {
        $data = [
            'booking_status' => 2
        ];
        Booking::where('id', $id)->update($data);
        return redirect('/admin/booking/view')->with('success', 'The Booking has been Returned.');
    }
}

