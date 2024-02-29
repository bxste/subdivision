<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

<<<<<<< HEAD
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
=======
class UserController extends Controller
{
    //
>>>>>>> 015dad485dc23a6f03833fe0fadc3cd3a5c6febf
}
