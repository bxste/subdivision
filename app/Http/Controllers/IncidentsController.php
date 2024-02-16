<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidents;

class IncidentsController extends Controller
{
    public function incidents(Request $request)
    {
        // Retrieve the incident ID from the request
        $id = $request->input('id');

        // Retrieve the incident based on the ID
        $incidents = Incidents::findOrFail($id);

        // Pass the incident data to the 'incident' view
        return view('incidents', compact('incidents'));
    }
}
