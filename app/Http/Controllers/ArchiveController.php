<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\models\Residents;
use App\models\Pets;
use App\models\Vehicles;
use App\models\VehiclesArchive;
use App\models\PetsArchive;
use App\models\ResidentsArchive;

class ArchiveController extends Controller
{
    public function index(){
        $archivedData = ResidentsArchive::all();
        return view('admin.archivedData', compact('archivedData'));

    }

    public function archiveResident(Request $request, $residentId)
    {
        $resident = Residents::with('pets', 'vehicles')->find($residentId);

        if ($resident) {
            // Check if the resident is a homeowner
            if ($resident->status === 'owned') {
                // Archive related tenants
                $tenants = Residents::where('homeowner_id', $resident->id)->where('status', 'tenant')->get();
                foreach ($tenants as $tenant) {
                    // Archive the tenant by creating a new record in the archive table
                    ResidentsArchive::create($tenant->toArray());

                    $tenant->pets()->each(function ($pet) use ($tenant) {
                        PetsArchive::create(array_merge($pet->toArray(), ['email' => $tenant->email]));
                    });

                    // Archive tenant-related vehicles
                    $tenant->vehicles()->each(function ($vehicle) use ($tenant) {
                        VehiclesArchive::create(array_merge($vehicle->toArray(), ['email' => $tenant->email]));
                    });
                    
                }
            }

            // Archive the resident by creating a new record in the archive table
            ResidentsArchive::create($resident->toArray());

            // Archive related pets
            $resident->pets()->each(function ($pet) use ($resident){
                // Archive the pet by creating a new record in the archive table
                PetsArchive::create(array_merge($pet->toArray(), ['email' => $resident->email]));
                // Delete the pet from the main table
            });

            // Archive related vehicles
            $resident->vehicles()->each(function ($vehicle) use ($resident) {
                // Archive the vehicle by creating a new record in the archive table
                VehiclesArchive::create(array_merge($vehicle->toArray(), ['email' => $resident->email]));
                // Delete the vehicle from the main table
            });

            // Delete the resident from the main table
            $resident->delete();

            return redirect()->back()->with('status', 'Resident and related items archived successfully');
        } else {
            return redirect()->back()->with('status', 'Resident not found');
        }
    }

    public function unarchiveResident(Request $request, $archivedResidentId)
    {
        $archivedResident = ResidentsArchive::with('pets', 'vehicles')->find($archivedResidentId);


        if ($archivedResident) {
            if ($archivedResident->status === 'owned') {
                // Unarchive as a homeowner
                $homeowner = Residents::create($archivedResident->toArray());

                $archivedTenants = ResidentsArchive::with(['pets', 'vehicles'])->where('status', 'tenant')
                    ->where('block', $archivedResident->block)
                    ->where('lot', $archivedResident->lot)
                    ->where('street', $archivedResident->street)
                    ->get();
                
                foreach ($archivedTenants as $archivedTenant) {
                    $unarchivedTenant = Residents::create($archivedTenant->toArray());

                    // Update the homeowner_id separately
                    $unarchivedTenant->update(['homeowner_id' => $homeowner->id]);

                    // Unarchive related pets for the tenant
                    $archivedPets = PetsArchive::where('email', $archivedTenant->email)->get();
                    foreach ($archivedPets as $archivedPet) {
                        Pets::create(array_merge($archivedPet->toArray(), ['homeowner_id' => $unarchivedTenant->id]));
                        PetsArchive::find($archivedPet->id)->delete();
                    }

                    // Unarchive related vehicles for the tenant
                    $archivedVehicles = VehiclesArchive::where('email', $archivedTenant->email)->get();
                    foreach ($archivedVehicles as $archivedVehicle) {
                        Vehicles::create(array_merge($archivedVehicle->toArray(), ['homeowner_id' => $unarchivedTenant->id]));
                        VehiclesArchive::find($archivedVehicle->id)->delete();
                    }
                    // Delete the archived tenant
                    $archivedTenant->delete();
                }

                // Unarchive related pets for the resident
                $archivedPets = PetsArchive::where('email', $archivedResident->email)->get();
                foreach ($archivedPets as $archivedPet) {
                    Pets::create(array_merge($archivedPet->toArray(), ['homeowner_id' => $homeowner->id]));
                    PetsArchive::find($archivedPet->id)->delete();
                }

                // Unarchive related vehicles for the resident
                $archivedVehicles = VehiclesArchive::where('email', $archivedResident->email)->get();
                foreach ($archivedVehicles as $archivedVehicle) {
                    Vehicles::create(array_merge($archivedVehicle->toArray(), ['homeowner_id' => $homeowner->id]));
                    VehiclesArchive::find($archivedVehicle->id)->delete();
                }
                // Delete the archived resident
                $archivedResident->delete();

            } elseif ($archivedResident->status === 'tenant') {
                // Unarchive as a tenant
                $homeowner = Residents::with(['pets', 'vehicles'])->where([
                    'block' => $archivedResident->block,
                    'lot' => $archivedResident->lot,
                    'street' => $archivedResident->street,
                    'status' => 'owned', 
                ])->first();

                if ($homeowner) {
                    $unarchivedTenant = Residents::create($archivedResident->toArray(), ['homeowner_id' => $homeowner->id]);
                    
                    // Unarchive related pets for the resident
                    $archivedPets = PetsArchive::where('email', $archivedResident->email)->get();
                    foreach ($archivedPets as $archivedPet) {
                        Pets::create(array_merge($archivedPet->toArray(), ['homeowner_id' => $homeowner->id]));
                        PetsArchive::find($archivedPet->id)->delete();
                    }

                    // Unarchive related vehicles for the resident
                    $archivedVehicles = VehiclesArchive::where('email', $archivedResident->email)->get();
                    foreach ($archivedVehicles as $archivedVehicle) {
                        Vehicles::create(array_merge($archivedVehicle->toArray(), ['homeowner_id' => $homeowner->id]));
                        VehiclesArchive::find($archivedVehicle->id)->delete();
                    }

                    $archivedResident->delete();
                } else {
                    // Log an error if the corresponding homeowner is not found
                    Log::error('Corresponding homeowner not found for archived tenant: ' . $archivedResident->email);
                }
            }

            return redirect()->back()->with('status', 'Resident and related items unarchived successfully');
        } else {
            return redirect()->back()->with('status', 'Archived resident not found');
        }
    }

    //----------------->VEHICLE ARCHIVE
    public function archiveVehicle($vehicleId)
    {
        // Find the vehicle to be archived
        $vehicle = Vehicles::find($vehicleId);

        // Check if the vehicle exists
        if ($vehicle) {
            // Get the associated homeowner
            $homeownerId = $vehicle->homeowner_id;

            $homeowner = Residents::find($homeownerId);
            // Check if the homeowner exists
            if ($homeowner) {
                // Use the homeowner's email for the archived vehicle
                $archivedData = array_merge($vehicle->toArray(), ['email' => $homeowner->email]);

                // Create a new entry in VehiclesArchive
                VehiclesArchive::create($archivedData);

                // Delete the vehicle from VehicleArhive
                $vehicle->delete();

                // Optionally, you can add a flash message or other logic here
                return redirect()->back()->with('status', 'Vehicle archived successfully');
            } else {
                // Homeowner not found, handle accordingly
                return redirect()->back()->with('status', 'Resident not found');        }
        } else {
            // Vehicle not found, handle accordingly
            return redirect()->back()->with('status', 'Vehicle not found');    
        }
    }

    public function unarchiveVehicle($archivedVehicleId)
    {
        // Find the archived vehicle
        $archivedVehicle = VehiclesArchive::find($archivedVehicleId);

        // Check if the archived vehicle exists
        if ($archivedVehicle) {
            // Find the associated homeowner using the email
            $homeowner = Residents::where('email', $archivedVehicle->email)->first();

            // Check if the homeowner exists
            if ($homeowner) {
                // Create a new vehicle in the Vehicles table
                $newVehicleData = array_merge($archivedVehicle->toArray(), ['homeowner_id' => $homeowner->id]);

                // Create a new vehicle in the Vehicles table using the merged data
                Vehicles::create($newVehicleData);

                // Delete the archived vehicle
                $archivedVehicle->delete();

                // Use the with method for the status message
                return redirect()->back()->with('status', 'Vehicle unarchived successfully');
            } else {
                // Homeowner not found, handle accordingly
                return redirect()->back()->with('status', 'Homeowner not found for the vehicle');
            }
        } else {
            // Archived vehicle not found, handle accordingly
            return redirect()->back()->with('status', 'Archived vehicle not found');
        }
    }

    //----------------->PET ARCHIVE
    public function archivePet($petId)
    {
        // Find the pet to be archived
        $pet = Pets::find($petId);
        // Check if the pet exists
        if ($pet) {
            // Get the associated homeowner
            $homeownerId = $pet->homeowner_id;

            $homeowner = Residents::find($homeownerId);
 
            // Check if the homeowner exists
            if ($homeowner) {
                // Use the homeowner's email for the archived pet
                $archivedData = array_merge($pet->toArray(), ['email' => $homeowner->email]);

                // Create a new entry in PetsArchive
                PetsArchive::create($archivedData);

                // Delete the pet from PetArchive
                $pet->delete();

                // Optionally, you can add a flash message or other logic here
                return redirect()->back()->with('status', 'Vehicle archived successfully');
            } else {
                // Homeowner not found, handle accordingly
                return redirect()->back()->with('status', 'Resident not found');        }
        } else {
            // Vehicle not found, handle accordingly
            return redirect()->back()->with('status', 'Vehicle not found');    
        }
    }

    public function unarchivePet($archivedPetId)
    {
        // Find the archived pet
        $archivedpet = PetsArchive::find($archivedPetId);
        
        // Check if the archived pet exists
        if ($archivedpet) {
            // Find the associated homeowner using the email
            $homeowner = Residents::where('email', $archivedpet->email)->first();

            // Check if the homeowner exists
            if ($homeowner) {
                // Create a new pet in the Vehicles table
                $newPetData = array_merge($archivedpet->toArray(), ['homeowner_id' => $homeowner->id]);

                // Create a new pet in the Pets table using the merged data
                Pets::create($newPetData);

                // Delete the archived vehicle
                $archivedpet->delete();

                // Use the with method for the status message
                return redirect()->back()->with('status', 'Pet unarchived successfully');
            } else {
                // Homeowner not found, handle accordingly
                return redirect()->back()->with('status', 'Homeowner not found for the pet');
            }
        } else {
            // Archived vehicle not found, handle accordingly
            return redirect()->back()->with('status', 'Archived pet not found');
        }
    }

}
