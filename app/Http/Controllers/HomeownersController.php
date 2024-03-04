<?php


namespace App\Http\Controllers;

use App\Models\Homeowners;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeownersController extends Controller
{
    public function about()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $homeowners = Homeowners::where('email', $user->email)->orderBy('id', 'desc')->get();
            
            // Initialize an array to store vehicles for each homeowner
            $vehicles = [];

            // Iterate over each homeowner to retrieve associated vehicles
            foreach ($homeowners as $homeowner) {
                // Assuming there's a relationship defined between Homeowners and Vehicles models
                $vehiclesForHomeowner = $homeowner->vehicles()->get();
                $vehicles[$homeowner->id] = $vehiclesForHomeowner; // Use homeowner ID as key for vehicles array
            }
            return view('about', compact('homeowners', 'vehicles'));
        } else {
            // Redirect to a different route if the user is not authenticated
            return redirect()->route('login');
        }
    }
}

