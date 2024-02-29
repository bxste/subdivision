<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Residents;
use App\Models\Vehicles;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class VehicleImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        
        foreach ($rows as $row) {
            // Validate the pet data
            $validator = Validator::make($row->toArray(), [
                'type' => 'required|string',
                'model' => 'required|string',
                'make' => 'required|string',
                'plate_number' => 'required|string',
                'color' => 'required|string',
                'sticker_number' => 'required|string',
            ]);

            if ($validator->fails()) {
                // If validation fails, handle the error
                return redirect()->back()->withErrors($validator)->withInput()->with('form', 'pet');
            }

            $vehicleData = [
                'type' => $row['type'],
                'model' => $row['model'],
                'make' => $row['make'],
                'plate_number' => $row['plate_number'],
                'color' => $row['color'],
                'sticker_number' => $row['sticker_number'],
            ];

            // Check if there is an existing resident with the provided email
            $resident = Residents::where('email', $row['email'])->first();

            if ($resident) {
                // Associate the pet with the resident by setting homeowner_id
                $vehicleData['homeowner_id'] = $resident->id;

                // Create or update the pet
                Vehicles::updateOrCreate(['type' => $vehicleData['type']], $vehicleData);
            } else {
                
            }
        }
        Session::flash('status', 'Imported Successfully');
    }
}
