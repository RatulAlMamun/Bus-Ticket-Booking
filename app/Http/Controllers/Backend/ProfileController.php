<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function indexview ()
    {
		$user_id = Auth::user()->id;
		$user = User::findOrfail($user_id);
        return view('backend.profile.profile', [
        	'user' => $user
        ]);
    }

    public function profileupdate (Request $request)
    {
    	$user_id = Auth::user()->id;
    	$data = [
    		'name' => $request->name,
    		'email' => $request->email
    	];
    	User::where('id', $user_id)->update($data);
    	return redirect()->back()->with('success', 'Your Profile Updated Successfully.');
    }

    public function changepassword (Request $request)
    {
    	$this->validate($request, [
    		'password' => 'required|string|min:8|confirmed'
    	]);
    	$user_id = Auth::user()->id;
    	$data = [
    		'password' => Hash::make($request->password),
    	];
    	User::where('id', $user_id)->update($data);
    	return redirect()->back()->with('success', 'Your Password Changed Successfully.');
    }
}
