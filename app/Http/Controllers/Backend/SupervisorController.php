<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Bus;
use App\Model\Supervisor;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexview ()
    {
        $buses = Bus::all();
        $supervisors = Supervisor::all();
        return view('backend.supervisor.supervisor', [
            'buses'         => $buses,
            'supervisors'   => $supervisors
        ]);
    }

    public function create (Request $request)
    {
        $request->validate([
            'busname' => 'required',
            'phoneno' => 'required|numeric'
        ]);
        $data = [
            'busname' => $request->busname,
            'phoneno' => $request->phoneno
        ];
        Supervisor::create($data);
        return redirect()->back()->with('success', 'Supervisor Added Successfully.');
    }

    public function edit (Request $request)
    {
        $id = $request->id;
        $data = [
            'busname' => $request->busname,
            'phoneno' => $request->phoneno
        ];
        Supervisor::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Supervisor Updated Successfully');
    }

    public function destroy ($id)
    {
        $supervisor = Supervisor::find($id);
        Supervisor::where('id', $supervisor->id)->delete();
        return redirect()->back()->with('success', 'Supervisor Deleted Successfully.');
    }
}
