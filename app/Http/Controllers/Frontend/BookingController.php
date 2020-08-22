<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Bus;
use App\Model\Booking;
use App\Model\Seathistory;

class BookingController extends Controller
{
    public function booking ($bus_id)
    {
        $bus = Bus::find($bus_id);
        return view('frontend.booking', ['bus' => $bus]);
    }

    public function seatqueryajax (Request $request) {
        $busid = $request->busid;
        $datejourney = $request->datejourney;
        $journeyroute = $request->journeyroute;
        $history = Seathistory::where('bus_id', $busid)->where('bus_route', $journeyroute)->where('date', $datejourney)->first();
        $bus = Bus::find($busid);
        if (empty($history)) 
        {
            $seatplanhistory = [];
            for ($i = 0; $i < $bus->numberofseat; $i++)
            {
                array_push($seatplanhistory, 0);
            }
            $seatplan = implode(',', $seatplanhistory);
            $data = [
                'bus_id'    => $busid,
                'bus_route' => $journeyroute,
                'date'      => $datejourney,
                'seatplan'  => $seatplan
            ];
            Seathistory::create($data);
        }
        $bookedseat = Seathistory::where('bus_id', $busid)->where('bus_route', $journeyroute)->where('date', $datejourney)->first();
        $bookedseatexplode = explode(',', $bookedseat->seatplan);
        return response()->json(['success' => $bookedseatexplode]);
    }

    public function create (Request $request)
    {
        $request->validate([
            'dateofjourney'     => 'required',
            'busroute'          => 'required',
            'arrivalplace'      => 'required',
            'leavingplace'      => 'required',
            'selectedseat'      => 'required',
            'totalprice'        => 'required',
            'name'              => 'required',
            'phoneno'           => 'required|numeric',
            'account_no'        => 'required|numeric',
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
            'account_no'        => $request->account_no,
            'payment_amount'    => $request->payment_amount,
            'payment_type'      => '',
            'payment_status'    => 0,
            'notification'      => 0,
            'booking_status'    => 0
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
        return redirect()->back()->with('success', 'Your Booking Placed Successfully.');
    }
}
