<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Incidents;

class ShowIncidentsController extends Controller
{
    public function showIncidents()
    {
        if(Auth::check()) {
            $user = Auth::user();
            $incidents_data = Incidents::where('person_behind_incident_block_num', $user->id)->orderBy('id', 'desc')->get();
            return view('showIncidents', compact('incidents_data'));
        } else {
            // Redirect to a different route if the user is not authenticated
            return redirect()->route('showIncidents');
        }
    }

}
