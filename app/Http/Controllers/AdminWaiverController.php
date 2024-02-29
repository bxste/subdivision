<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\waiver_forms; // Assuming WaiverForm is your model class

class AdminWaiverController extends Controller
{
    public function forms(){
        $forms = waiver_forms::orderBy('id', 'desc')->get(); // Corrected model class name
        return view('admin.forms', compact('forms'));
    }

    public function updateStatus(Request $request, waiver_forms $form){ // Corrected model class name
        $request->validate([
            'status'=> 'required|in:on_process,done', // Removed space after comma
        ]);
        $form->status = $request->status;
        $form->save();
        return redirect()->back()->with('success', 'Form status updated successfully.');
    }
}
