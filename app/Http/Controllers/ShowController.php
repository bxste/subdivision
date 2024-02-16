<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Forms;
use App\Models\User;
use App\Models\waiver_forms;

class ShowController extends Controller
{
    public function show()
    {
        if(Auth::check()) {
            $user = Auth::user();
            $data = waiver_forms::where('homeowner_id', $user->id)->orderBy('id', 'desc')->get();
            dd($data);
            return view('show', compact('data'));
        } else {
            return redirect()->route('show');
        }
    }
}
