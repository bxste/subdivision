<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homeowners; // Corrected model name

class ChecklistController extends Controller
{
    public function showChecklist()
    {
        // Fetch the homeowner data, assuming you have some logic to determine the homeowner
        // If you have specific logic to fetch the homeowner, replace this with your logic
        $homeowner = Homeowners::all(); // Fetch the first homeowner for demonstration
        
        // Assuming 'payment_status' is a column in the 'homeowners' table
        $paymentStatus = $homeowner->payment_status === 'paid';

        // Assuming 'violation' is a column in the 'homeowners' table
        $noViolations = $homeowner->violation === null || $homeowner->violation === '';

        // Pass the homeowner data to the view
        return view('dashboard', compact('homeowner', 'paymentStatus', 'noViolations'));
    }
}
