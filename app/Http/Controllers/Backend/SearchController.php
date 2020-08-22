<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Bus;
use App\Model\Seathistory;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexview ()
    {
        $buses = Bus::all();
        return view('backend.search.search', [
            'buses'     => $buses,
        ]);
    }

    public function routequeryajax (Request $request)
    {
        $busid = $request->busid;
        $bus = Bus::find($busid);
        $busroutes = $bus->busroute;
        $road = [];
        foreach($busroutes as $route)
        {
            $road[] = $route->route;
        }
        return response()->json(['success' => $road]);
    }


    public function seatqueryajax (Request $request)
    {
        $date = $request->date;
        $busid = $request->busid;
        $road = $request->road;
        $history = Seathistory::where('date', $date)->where('bus_id', $busid)->where('bus_route', $road)->first();
        $bus = Bus::find($busid);
        if (empty($history)) 
        {
            $return = "No Search Result Found!!!";
        } else {
            $return = explode(',', $history->seatplan);
        }
        return response()->json(['success' => $return, 'numberofseat' => $bus->numberofseat]);
    }
}
