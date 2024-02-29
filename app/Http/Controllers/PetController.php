<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pets;
use App\Models\Residents;

class PetController extends Controller
{
    protected $residentId;

    public function index($residentId)
    {   
        

        $this->residentId = $residentId;
        $resident = Residents::findOrFail($residentId);
        $pets = pets::all();
        
        $this->createPet($residentId);

        return view('admin.resident.additionalInfo', compact('pets','resident'));
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
                'type' => 'required',
                'model' => 'required',
                'make' => 'required',
                'color' => 'required',
                'plate_number' => 'required',
                'sticker_number' => 'required',
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
            'type' => 'required',
            'model' => 'required',
            'make' => 'required',
            'color' => 'required',
            'plate_number' => 'required',
            'sticker_number' => 'required',
        ]);

        $pet->update($data);
        return redirect()->route('admin.resident.additionalInfo', ['residentId' => $homeownerId]);

    }
}
