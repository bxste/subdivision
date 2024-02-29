<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Residents;
use App\Models\Pets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class PetImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Validate the pet data
            $validator = Validator::make($row->toArray(), [
                'type_of_pets' => 'required|string',
                'breed' => 'required|string',
                'vaccinated' => 'required|in:yes,no',
                'age' => 'required|int',
                'color' => 'required|string',
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                // If validation fails, handle the error
                return redirect()->back()->withErrors($validator)->withInput()->with('form', 'pet');
            }

            // The rest of your code for handling pets
            $petData = [
                'type_of_pets' => $row['type_of_pets'],
                'breed' => $row['breed'],
                'vaccinated' => $row['vaccinated'],
                'age' => $row['age'],
                'color' => $row['color'],
                'email' => $row['email'], // Assuming email is required
            ];

            // Check if there is an existing resident with the provided email
            $resident = Residents::where('email', $row['email'])->first();

            if ($resident) {
                // Associate the pet with the resident by setting homeowner_id
                $petData['homeowner_id'] = $resident->id;

                // Create or update the pet
                Pets::updateOrCreate(['type_of_pets' => $petData['type_of_pets']], $petData);
            } else {
                // Handle the case where the resident does not exist
            }
        }
        Session::flash('status', 'Imported Successfully');
    }
}