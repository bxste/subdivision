<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\Forms;
use App\Models\waiver_forms;
use App\Models\Incidents;
use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Validator; 
use App\Http\Controllers\CalendarController; 
use App\Http\Controllers\IncidentsController;
use App\Http\Controllers\ShowIncidentsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

require __DIR__.'/adminauth.php';

//waiver
Route::get('/create', function(){
    return view('create');
});

Route::post('/create', function () {
    $validator = Validator::make(request()->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'description' => 'required|string',
        'homeowner_id' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $waiver_forms = new waiver_forms(); // Adjust the model class name
    $waiver_forms->first_name = request('first_name');
    $waiver_forms->last_name = request('last_name');
    $waiver_forms->phone_number = request('phone_number');
    $waiver_forms->description = request('description');
    $waiver_forms->homeowner_id = request('homeowner_id');
    $waiver_forms->save();

    return redirect()->route('dashboard');
});
Route::get('/create', function () {
    return view('create');
})->middleware(['auth', 'verified'])->name('create');

Route::get('/show', [ShowController::class, 'show']);
Route::get('/show', function () {
    $user = Auth::user();
    $data = waiver_forms::where('homeowner_id', $user->id)->orderBy('id', 'desc')->get(); // Define your data here
    
    return view('show', compact('data')); // Pass data to the view
})->middleware(['auth', 'verified'])->name('show');


//admin calender
Route::get('calendar/index', [CalendarController:: class, 'index'])->name('calendar.index');
Route::post('calendar', [CalendarController:: class, 'store'])->name('calendar.store');
Route::patch('calendar/update/{id}', [CalendarController:: class, 'update'])->name('calendar.update');
Route::delete('calendar/destroy/{id}', [CalendarController:: class, 'destroy'])->name('calendar.destroy');

//user calendar
Route::get('/dashboard', [CalendarController:: class, 'user'])->name('dashboard');


//incident
Route::get('/incidents', function(){
    return view('incidents');
});


Route::post('/incidents', function () {

    $incidents = new Incidents();
    $incidents->reporter_first_name = request('reporter_first_name');
    $incidents->reporter_last_name = request('reporter_last_name');
    $incidents->reporter_phone_number = request('reporter_phone_number');
    $incidents->reporter_block_num = request('reporter_block_num');
    $incidents->incident_date = request('incident_date');
    $incidents->incident_time = request('incident_time');
    $incidents->location_details = request('location_details');
    $incidents->incident_details = request('incident_details');
    $incidents->incident_type = request('incident_type');
    $incidents->person_behind_incident = request('person_behind_incident');
    $incidents->person_behind_incident_block_num = request('person_behind_incident_block_num');
    $incidents->save();

    return redirect()->route('dashboard');
});

// Route::get('/showIncidents', function () {
//     $user = Auth::user();
//     $incidents_data = Incidents::where('person_behind_incident_block_num', $user->id)->orderBy('id', 'desc')->get(); // Define your data here
    
//     return view('show.incidents', compact('incidents_data')); // Pass data to the view
// })->middleware(['auth', 'verified'])->name('show.incidents');

Route::get('/incidents', function () {
    return view('incidents');
})->middleware(['auth', 'verified'])->name('incidents');

// Route::get('/showIncidents', function () {
//     return view('showIncidents');
// })->middleware(['auth', 'verified'])->name('showIncidents');

Route::get('/show/incidents', [ShowIncidentsController::class, 'showIncidents'])->name('showincidents')->middleware(['auth', 'verified']);

