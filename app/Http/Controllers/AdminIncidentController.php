<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidents;

class AdminIncidentController extends Controller
{
    public function forms(){
        $forms = Incidents::orderBy('id', 'desc')->get(); // Corrected model class name
        return view('admin.incident', compact('forms'));
    }

    public function updateStatus(Request $request, Incidents $form){ // Corrected model class name
        $request->validate([
            'status'=> 'required|in:on_process,done', // Removed space after comma
        ]);
        $form->status = $request->status;
        $form->save();
        return redirect()->back()->with('success', 'Form status updated successfully.');
    }
}
