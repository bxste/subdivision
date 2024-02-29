<?php

namespace App\Http\Controllers;

use App\Imports\PetImport;
use App\Imports\VehicleImport;
use App\Models\Residents;
use App\Models\Pets;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use App\Imports\ResidentImport;
use Maatwebsite\Excel\Facades\Excel;

class ResidentController extends Controller
{
    public function index()
    {   
        $residents = Residents::all();
        return view('admin.showData', compact('residents'));
    }

    public function importExcelData(Request $request)
    {
        $request->validate([
            'import_file' =>[
                'required',
                'file'
            ]
        ]);

        Excel::import(new ResidentImport, $request->file('import_file'));

        return redirect()->back();
    }

//<----Pets
    public function getPet()
    {   
        $pets = Pets::all();
        return view('admin.showData', compact('pets'));
    }

    public function importPetExcelData(Request $request)
    {
        $request->validate([
            'import_file' =>[
                'required',
                'file'
            ]
        ]);

        Excel::import(new PetImport, $request->file('import_file'));

        return redirect()->back();
    }
    
//<----Vehicles
    public function getVehicle()
    {   
        $pets = Vehicles::all();
        return view('admin.showData', compact('pets'));
    }

    public function importVehicleExcelData(Request $request)
    {
        $request->validate([
            'import_file' =>[
                'required',
                'file'
            ]
        ]);

        Excel::import(new VehicleImport, $request->file('import_file'));

        return redirect()->back();
    }

    public function createTenant($residentId)
    {
        $homeownerId = $residentId;
        return view('admin.residentForms.createTenant', compact('homeownerId'));

    }

    public function storeTenant(Request $request)
    {
        $homeownerId = $request->input('homeownerId');
        $resident = Residents::find($homeownerId);
        
        // Check if the resident is found
        if ($resident) {
            $block = $resident->block;
            $lot = $resident->lot;
            $street = $resident->street;
            $payment_status = $resident->payment_status;

            $data = $request->validate([
                'first_name' => 'required',
                'middle_initial' => 'required',
                'last_name' => 'required',
                'relationship_to_homeowner' => 'required',
                'religion' => 'required',
                'email' => 'required',
                'phone_number' => 'required',
                'household_size' => 'required',
                'occupation' => 'required',
                'acknowledgement_on_community_rules' => 'required',
                'disability' => 'required',
                'gender' => 'required',
                'violation' => 'required',
            ]);

            $data['homeowner_id'] = $homeownerId;
            $data['block'] = $block;
            $data['lot'] = $lot;
            $data['street'] = $street;
            $data['status'] = 'tenant';
            $data['payment_status'] = $payment_status;
            Residents::create($data);

            return redirect()->route('admin.showData');
        } else {
            // Handle the case when the resident is not found
            return redirect()->back()->with('error', 'Resident not found.');
        }
    }
}
