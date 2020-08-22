<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Counter;
use App\Model\Bus;
use App\Model\Supervisor;

class IndexController extends Controller
{
    public function index()
    {
        $counters = Counter::all();
        $buses = Bus::where('service', 1)->get();
        $supervisors = Supervisor::all();
        return view('frontend.index', [
            'counters'      => $counters,
            'buses'         => $buses,
            'supervisors'   => $supervisors
        ]);
    }
}
