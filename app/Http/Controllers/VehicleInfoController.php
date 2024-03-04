<?php

namespace App\Http\Controllers;

use App\Models\Homeowners;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleInfoController extends Controller
{
    public function vehicle()
    {
        if(Auth::check()) {
            $user = Auth::user(); // Retrieve authenticated user
            $vehicles = Vehicles::where('homeowner_id', $user->id)->orderBy('id', 'desc')->get();
            return view('about', compact('vehicles'));
        } else {
            // Redirect to a different route if the user is not authenticated
            return redirect()->route('login'); // Adjust this route to your login route
        }
    }
}


