<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicles;
use App\Models\Residents;
use App\Models\Pets;

class VehicleController extends Controller
{
    protected $residentId;

    public function index($residentId)
{   
    $this->residentId = $residentId;

    // Retrieve the resident with the specified ID
    $resident = Residents::findOrFail($residentId);

    // Retrieve only the vehicles associated with the resident
    $vehicles = Vehicles::where('homeowner_id', $residentId)->get();

    // Retrieve only the pets associated with the resident
    $pets = Pets::where('homeowner_id', $residentId)->get();


    return view('admin.resident.additionalInfo', compact('vehicles', 'resident', 'pets'));
}

    // Create/store Vehicle information------------------------------------------------------------------------------->

    public function createVehicle($homeownerId)
    {
        $homeownerId = $homeownerId;
        return view('admin.resident.createVehicle', compact('homeownerId'));
    }

    public function storeVehicle(Request $request)
    {
        

            $data = $request->validate([
                'type' => 'required',
                'model' => 'required',
                'make' => 'required',
                'color' => 'required',
                'plate_number' => 'required',
                'sticker_number' => 'required',
            ]);
    
            // Set the homeowner_id
            $data['homeowner_id'] = $request->input('homeownerId');
            Vehicles::create($data);
    
            return redirect()->route('admin.resident.additionalInfo', ['residentId' => $data['homeowner_id']]);
  

    }

    // Edit/update Vehicle information------------------------------------------------------------------------------->

    public function editVehicle($homeownerId, $vehicleId){
        $homeownerId = $homeownerId;
        $vehicleId = $vehicleId;

        $vehicle = Vehicles::findOrFail($vehicleId);

        return view('admin.resident.editVehicle', compact('homeownerId','vehicleId', 'vehicle'));
    }

    public function updateVehicle(Request $request){

        $vehicle = Vehicles::findOrFail($request->input('vehicleId'));
        $homeownerId = $request->input('homeownerId');
        $data = $request->validate([
            'type' => 'required',
            'model' => 'required',
            'make' => 'required',
            'color' => 'required',
            'plate_number' => 'required',
            'sticker_number' => 'required',
        ]);

        $vehicle->update($data);
        return redirect()->route('admin.resident.additionalInfo', ['residentId' => $homeownerId]);

    }

    

    // Create/store pet information------------------------------------------------------------------------------->

    public function createPet($homeownerId)
    {
        $homeownerId = $homeownerId;
        return view('admin.resident.createPet', compact('homeownerId'));
    }

    public function storePet(Request $request)
    {
        

            $data = $request->validate([
                'type_of_pets' => 'required',
                'breed' => 'required',
                'vaccinated' => 'required',
                'age' => 'required',
                'color' => 'required',
            ]);
    
            // Set the homeowner_id
            $data['homeowner_id'] = $request->input('homeownerId');
            pets::create($data);
    
            return redirect()->route('admin.resident.additionalInfo', ['residentId' => $data['homeowner_id']]);
  

    }

    // Edit/update pet information------------------------------------------------------------------------------->

    public function editPet($homeownerId, $petId){
        $homeownerId = $homeownerId;
        $petId = $petId;

        $pet = pets::findOrFail($petId);

        return view('admin.resident.editPet', compact('homeownerId','petId', 'pet'));
    }

    public function updatePet(Request $request){

        $pet = pets::findOrFail($request->input('petId'));
        $homeownerId = $request->input('homeownerId');
        $data = $request->validate([
            'type_of_pets' => 'required',
            'breed' => 'required',
            'vaccinated' => 'required',
            'age' => 'required',
            'color' => 'required',
        ]);

        $pet->update($data);
        return redirect()->route('admin.resident.additionalInfo', ['residentId' => $homeownerId]);

    }
}