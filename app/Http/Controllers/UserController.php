<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\waiver_forms;

class UserController extends Controller
{
    public function show($id)
    {
        $userData = waiver_forms::find($id);

        // if(!$users){
        //     abort(404);
        // }

        // $userAdditionalData = $userData->additionalData();

        return view('show', compact('userData'));
    }
}
