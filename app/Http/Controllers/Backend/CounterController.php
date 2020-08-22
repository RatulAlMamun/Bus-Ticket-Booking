<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Counter;

class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexview ()
    {
        $counters = Counter::all();
        return view('backend.counter.counter', ['counters' => $counters]);
    }

    // Adding A Counter to the Database
    public function create (Request $request)
    {
        $request->validate([
            'placename' => 'required',
            'shopname'  => 'required',
            'phoneno'   => 'required|numeric',
            'address'   => 'required'
        ]);
        $data = [
            'placename' => $request->placename,
            'shopname'  => $request->shopname,
            'phoneno'   => $request->phoneno,
            'address'   => $request->address
        ];
        Counter::create($data);
        return redirect()->back()->with('success', 'Counter Added Successfully.');
    }

    // Edit Function for Counter
    public function edit (Request $request)
    {
        $id = $request->id;
        $data = [
            'placename' => $request->placename,
            'shopname'  => $request->shopname,
            'phoneno'   => $request->phoneno,
            'address'   => $request->address
        ];
        Counter::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Counter Updated Successfully');
    }

    // Delete Function for Counter
    public function destroy ($id)
    {
        $counter = Counter::find($id);
        Counter::where('id', $counter->id)->delete();
        return redirect()->back()->with('success', 'Counter Deleted Successfully.');
    }
}
