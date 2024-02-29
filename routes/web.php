<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [ChartController::class, 'showCharts'])
        ->name('admin.dashboard');

    Route::get('/admin/residentForms/{residentId}/editResident', [App\Livewire\EditResident::class, 'editResidentInfo'])
        ->name('admin.residentForms.editResident');
});

// NAVBAR ROUTES

Route::middleware(['auth:admin', 'verified'])->prefix('admin')->group(function () {
    Route::get('/incidentReport', function () {
        return view('admin.incidentReport');
    })->name('admin.incidentReport');

    Route::get('/userManagement', function () {
        return view('admin.userManagement');
    })->name('admin.userManagement');

    Route::get('/residentForms/createResident', function () {
        return view('admin.residentForms.createResident');
    })->name('admin.residentForms.createResident');

    Route::get('/archivedPets', function () {
        return view('admin.archivedPets');
    })->name('admin.archivedPets');

    Route::get('/archivedVehicles', function () {
        return view('admin.archivedVehicles');
    })->name('admin.archivedVehicles');

    Route::get('/showData', [ResidentController::class, 'index'])
        ->name('admin.showData');
});

require __DIR__.'/adminauth.php';

// Waiver
Route::get('/create', function () {
    return view('create');
})->middleware(['auth', 'verified'])->name('create');

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

    $waiver_forms = new waiver_forms();
    $waiver_forms->first_name = request('first_name');
    $waiver_forms->last_name = request('last_name');
    $waiver_forms->phone_number = request('phone_number');
    $waiver_forms->description = request('description');
    $waiver_forms->homeowner_id = request('homeowner_id');
    $waiver_forms->save();

    return redirect()->route('dashboard');
});

Route::get('/show', function () {
    $user = Auth::user();
    $data = waiver_forms::where('homeowner_id', $user->id)->orderBy('id', 'desc')->get();
    return view('show', compact('data'));
})->middleware(['auth', 'verified'])->name('show');

// Admin Calendar
Route::middleware(['auth:admin', 'verified'])->prefix('admin')->group(function () {
    Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');
    Route::patch('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
    Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
});

// User Calendar
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [CalendarController::class, 'user'])->name('dashboard');
});

// Incidents
Route::get('/incidents', function () {
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
})->middleware(['auth', 'verified']);

Route::get('/incidents', function () {
    return view('incidents');
})->middleware(['auth', 'verified'])->name('incidents');

Route::get('/show/incidents', [ShowIncidentsController::class, 'showIncidents'])->name('showincidents')->middleware(['auth', 'verified']);

// Import Routes

Route::middleware(['auth:admin', 'verified'])->prefix('resident')->group(function () {
    Route::get('import', [ResidentController::class, 'index']);
    Route::post('import', [ResidentController::class, 'importExcelData']);

    Route::get('petImport', [ResidentController::class, 'getPet']);
    Route::post('petImport', [ResidentController::class, 'importPetExcelData']);

    Route::get('vehicleImport', [ResidentController::class, 'getVehicle']);
    Route::post('vehicleImport', [ResidentController::class, 'importVehicleExcelData']);
});

// Additional Info Routes

Route::middleware(['auth:admin', 'verified'])->prefix('admin/resident')->group(function () {
    Route::get('{residentId}/additionalInfo', [VehicleController::class, 'index'])
        ->name('admin.resident.additionalInfo');

    Route::get('{homeownerId}/createVehicle', [VehicleController::class, 'createVehicle'])
        ->name('admin.resident.createVehicle');

    Route::post('storeVehicle', [VehicleController::class, 'storeVehicle'])
        ->name('admin.resident.storeVehicle');

    Route::get('{homeownerId}/{vehicleId}/editVehicle', [VehicleController::class, 'editVehicle'])
        ->name('admin.resident.editVehicle');

    Route::put('updateVehicle', [VehicleController::class, 'updateVehicle'])
        ->name('admin.resident.updateVehicle');

    Route::get('{homeownerId}/createPet', [VehicleController::class, 'createPet'])
        ->name('admin.resident.createPet');

    Route::post('storePet', [VehicleController::class, 'storePet'])
        ->name('admin.resident.storePet');

    Route::get('{homeownerId}/{petId}/editPet', [VehicleController::class, 'editPet'])
        ->name('admin.resident.editPet');

    Route::put('updatePet', [VehicleController::class, 'updatePet'])
        ->name('admin.resident.updatePet');

    Route::get('{residentId}/residentForms/createTenant', [ResidentController::class, 'createTenant'])
        ->name('admin.residentForms.createTenant');

    Route::post('storeTenant', [ResidentController::class, 'storeTenant'])
        ->name('admin.residentForms.storeTenant');
});

// Archive Routes

Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::delete('resident/{residentId}/archive', [ArchiveController::class, 'archiveResident'])
        ->name('archive.resident');

    Route::get('/admin/archivedData', [ArchiveController::class, 'index'])
        ->name('admin.archivedData');

    Route::get('vehicle/{archivedVehicleId}/unarchiveData', [ArchiveController::class, 'unarchiveVehicle'])
        ->name('vehicle.unarchiveData');

    Route::delete('pet/{petId}/archive', [ArchiveController::class, 'archivePet'])
        ->name('archive.pet');

    Route::get('/pet/{archivedPetId}/unarchiveData', [ArchiveController::class, 'unarchivePet'])
        ->name('pet.unarchiveData');
});
