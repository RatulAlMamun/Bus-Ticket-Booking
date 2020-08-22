<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Bus;
use App\Model\Busroute;

class BusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexview ()
    {
        $buses = Bus::all();
        return view('backend.bus.bus', ['buses' => $buses]);
    }

    public function create (Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'numberofseat'  => 'required|numeric',
            'description'   => 'required',
            'seat_price'    => 'required|numeric',
            'service'       => 'required',
            'image'         => 'required|image'
        ]);
        $image_name = rand().'.'.$request->image->extension();
        $request->image->move('uploads/', $image_name);
        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'numberofseat'  => $request->numberofseat,
            'seat_price'    => $request->seat_price,
            'service'       => $request->service,
            'image'         => $image_name
        ];
        Bus::create($data);
        return redirect()->back()->with('success', 'Bus Added Successfully');
    }

    public function edit (Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description'  => 'required',
            'numberofseat'  => 'required|numeric',
            'description'  => 'required',
            'service'   => 'required',
        ]);
        $image = $request->image;
        $busid = $request->id;
        $oldimg = $request->oldimg;
        if(isset($image))
        {
            $new_name = rand().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/', $new_name);
            unlink('uploads/'.$oldimg);
        } else {
            $new_name = $oldimg;
        }
        $data = [
            'name'          => $request->name,
            'description'   => $request->description,
            'numberofseat'  => $request->numberofseat,
            'service'       => $request->service,
            'image'         => $new_name
        ];
        $routedata = [];
        $busroute = Busroute::where('bus_id', $busid)->get();
        foreach ($busroute as $route)
        {
            $r = 'route'.$route->id;
            $l = 'leavingtime'.$route->id;
            $routedata['route'] = $request->$r;
            $routedata['leavingtime'] = $request->$l;
            Busroute::where('id', $route->id)->update($routedata);
            $routedata = [];
        }
        Bus::where('id', $busid)->update($data);
        return redirect()->back()->with('success', 'Bus Updated Successfully');
    }

    public function routedestroy ($id)
    {
        Busroute::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Bus Road Deleted Successfully.');
    }

    public function destroy ($id)
    {
        $bus = Bus::find($id);
        unlink('uploads/'.$bus->image);
        Busroute::where('bus_id', $bus->id)->delete();
        Bus::where('id', $bus->id)->delete();
        return redirect()->back()->with('success', 'Bus Deleted Successfully.');
    }

    public function routecreate (Request $request)
    {
        $request->validate([
            'busname'  => 'required',
            'route'  => 'required',
            'leavingtime'  => 'required'
        ]);
        $data = [
            'bus_id'       => $request->busname,
            'route'         => $request->route,
            'leavingtime'   => $request->leavingtime
        ];
        Busroute::create($data);
        return redirect()->back()->with('success', 'Bus Route Added Successfully');
    }
}