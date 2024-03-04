<?php

use App\Http\Controllers\AdminWaiverController;
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
use App\Http\Controllers\ChartController;
use App\Models\Residents;
use App\Http\Controllers\AdminIncidentController;
use App\Http\Controllers\HomeownersController;
use App\Http\Controllers\VehicleInfoController;

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

Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [ChartController::class, 'showCharts'])
        ->name('admin.dashboard');

    Route::get('/admin/residentForms/{residentId}/editResident', [App\Livewire\EditResident::class, 'editResidentInfo'])
        ->name('admin.residentForms.editResident');
});

//<----------------------------------------------NAVBAR ROUTES---------------------------------------------->

Route::get('/admin/incidentReport', [AdminIncidentController::class, 'forms'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.incidentReport');
Route::post('/admin/forms/updateStatus/{form}', [AdminIncidentController::class, 'updateStatus'])->name('admin.forms.updateStatus');

Route::get('/admin/waiverForm', [AdminWaiverController::class, 'forms'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.waiverForm');
Route::post('/admin/waiverForms/updateStatus/{form}', [AdminWaiverController::class, 'updateStatus'])->name('admin.waiverForms.updateStatus');


Route::get('/admin/userManagement', function () {
    return view('admin.userManagement');
})->middleware(['auth:admin', 'verified'])->name('admin.userManagement');

Route::get('/admin/residentForms/createResident', function () {
    return view('admin.residentForms.createResident');
})->middleware(['auth:admin', 'verified'])->name('admin.residentForms.createResident');

Route::get('/admin/archivedPets', function () {
    return view('admin.archivedPets');
})->middleware(['auth:admin', 'verified'])->name('admin.archivedPets');

Route::get('/admin/archivedVehicles', function () {
    return view('admin.archivedVehicles');
})->middleware(['auth:admin', 'verified'])->name('admin.archivedVehicles');

Route::get('/admin/import', function () {
    return view('admin.import');
})->middleware(['auth:admin', 'verified'])->name('admin.import');

Route::get('/admin/showData', [App\Http\Controllers\ResidentController::class, 'index'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.showData');


require __DIR__.'/adminauth.php';


//waiver
Route::get('/create', function(){
    return view('create');
});

Route::post('/create', function () {

    $validator = Validator::make(request()->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required|numeric|max:20',
        'description' => 'required|string',
        'homeowner_id' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    // Retrieve the currently authenticated user
    $user = Auth::user();
    $resident = Residents::where('email', $user->email)->firstOrFail();
    // Check payment status and violation
    if ($resident->payment_status == 'paid' && $resident->violation == 'no') {
        // Create a new waiver_forms instance and assign the user_id
        $waiver_forms = new waiver_forms(); // Adjust the model class name
        $waiver_forms->first_name = request('first_name');
        $waiver_forms->last_name = request('last_name');
        $waiver_forms->phone_number = request('phone_number');
        $waiver_forms->description = request('description');
        $waiver_forms->homeowner_id = request('homeowner_id');
        $waiver_forms->user_id = $user->id; // Assign the user_id
        $waiver_forms->save();

        // Redirect to the 'show' route instead of 'dashboard'
        return redirect()->route('show');
    } else {
        // Redirect back with appropriate status messages
        if ($resident->payment_status == 'unpaid' && $resident->violation == 'yes') {
    		return redirect()->back()->with('status', 'You have both unpaid status and a violation. Please address the issues.');
	} elseif ($resident->violation == 'yes') {
    		return redirect()->back()->with('status', 'You currently have a violation. Please contact the admin for further assistance.');
	} elseif ($resident->payment_status == 'unpaid') {
   		return redirect()->back()->with('status', 'You are currently unpaid. Unable to send waiver');
	} 
    }
});

Route::get('/create', function () {
    return view('create');
})->middleware(['auth', 'verified'])->name('create');

Route::get('/show', [ShowController::class, 'show']);
Route::get('/show', function () {
    // Retrieve the currently authenticated user
    $user = Auth::user();
    
    // Retrieve the submitted data associated with the currently logged-in user
    $data = $user->waiver_forms()->orderBy('id', 'desc')->get();
    
    // Pass the retrieved data to the 'show' view
    return view('show', compact('data'));
})->middleware(['auth', 'verified'])->name('show'); 


//admin calender
Route::get('/admin/calendar', [CalendarController::class, 'index'])->name('admin.calendar');
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
    // Retrieve the currently authenticated user
    $user = Auth::user();

    // Create a new Incidents instance and set the user_id
    $incidents = new Incidents();
    $incidents->user_id = $user->id; // Set the user_id
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


//<----------------------------------------------IMPORT ROUTES---------------------------------------------->

//<----Residents
Route::get('resident/import', [App\Http\Controllers\ResidentController::class, 'index']);

Route::post('resident/import', [App\Http\Controllers\ResidentController::class, 'importExcelData']);

//<----Pets
Route::get('resident/petImport', [App\Http\Controllers\ResidentController::class, 'getPet']);

Route::post('resident/petImport', [App\Http\Controllers\ResidentController::class, 'importPetExcelData']);

//<----Vehicles
Route::get('resident/vehicleImport', [App\Http\Controllers\ResidentController::class, 'getVehicle']);

Route::post('resident/vehicleImport', [App\Http\Controllers\ResidentController::class, 'importVehicleExcelData']);

//<----------------------------------------------ADDITIONAL INFO ROUTES---------------------------------------------->

Route::get('/admin/resident/{residentId}/additionalInfo', [App\Http\Controllers\VehicleController::class, 'index'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.resident.additionalInfo');

//<----VEHICLES

Route::get('/admin/resident/{homeownerId}/createVehicle', [App\Http\Controllers\VehicleController::class, 'createVehicle'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.resident.createVehicle');

Route::post('/admin/resident/storeVehicle', [App\Http\Controllers\VehicleController::class, 'storeVehicle'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.resident.storeVehicle');

Route::get('/admin/resident/{homeownerId}/{vehicleId}/editVehicle', [App\Http\Controllers\VehicleController::class, 'editVehicle'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.resident.editVehicle');

Route::put('/admin/resident/updateVehicle', [App\Http\Controllers\VehicleController::class, 'updateVehicle'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.resident.updateVehicle');

//<----PETS

Route::get('/admin/resident/{homeownerId}/createPet', [App\Http\Controllers\VehicleController::class, 'createPet'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.resident.createPet');

Route::post('/admin/resident/storePet', [App\Http\Controllers\VehicleController::class, 'storePet'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.resident.storePet');

Route::get('/admin/resident/{homeownerId}/{petId}/editPet', [App\Http\Controllers\VehicleController::class, 'editPet'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.resident.editPet');

Route::put('/admin/resident/updatePet', [App\Http\Controllers\VehicleController::class, 'updatePet'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.resident.updatePet'); 

//<----TENANTS

Route::get('/getTenantDetails/{residentId}', [App\Http\Controllers\ResidentController::class, 'getDetails']);

Route::get('/admin/{residentId}/residentForms/createTenant', [App\Http\Controllers\ResidentController::class, 'createTenant'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.residentForms.createTenant');

Route::post('/admin/residentForms/storeTenant', [App\Http\Controllers\ResidentController::class, 'storeTenant'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.residentForms.storeTenant');

//<----RESIDENT ARCHIVE ROUTES

Route::delete('resident/{residentId}/archive', [App\Http\Controllers\ArchiveController::class, 'archiveResident'])
    ->middleware(['auth:admin', 'verified'])
    ->name('archive.resident');

Route::get('/admin/archivedData', [App\Http\Controllers\ArchiveController::class, 'index'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.archivedData');

Route::get('/admin/{archivedResidentId}/unarchiveData', [App\Http\Controllers\ArchiveController::class, 'unarchiveResident'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.unarchiveData');

//<----VEHICLE ARCHIVE ROUTES

Route::delete('vehicle/{vehicleId}/archive', [App\Http\Controllers\ArchiveController::class, 'archiveVehicle'])
    ->middleware(['auth:admin', 'verified'])
    ->name('archive.vehicle');

Route::get('/vehicle/{archivedVehicleId}/unarchiveData', [App\Http\Controllers\ArchiveController::class, 'unarchiveVehicle'])
    ->middleware(['auth:admin', 'verified'])
    ->name('vehicle.unarchiveData');

//<----PET ARCHIVE ROUTES
Route::delete('pet/{petId}/archive', [App\Http\Controllers\ArchiveController::class, 'archivePet'])
    ->middleware(['auth:admin', 'verified'])
    ->name('archive.pet');

Route::get('/pet/{archivedPetId}/unarchiveData', [App\Http\Controllers\ArchiveController::class, 'unarchivePet'])
    ->middleware(['auth:admin', 'verified'])
    ->name('pet.unarchiveData');

Route::get('/about', [HomeownersController::class, 'about'])->name('about');
