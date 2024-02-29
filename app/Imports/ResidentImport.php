<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Residents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ResidentImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        // Define the mapping of Excel columns to database columns
        $validatorMapping = [
            'email' => 'required|email',
            'block' => 'required|int',
            'lot' => 'required|int',
            'street' => 'required|string',
            'first_name' => 'required|string',
            'middle_initial' => 'nullable|string|max:2',
            'last_name' => 'required|string',
            'religion' => 'nullable|string',
            'phone_number' => 'required',
            'household_size' => 'required|integer|min:2',
            'occupation' => 'nullable|string',
            'status' => 'required|in:tenant,owned',
            'acknowledgement_on_community_rules' => 'required|in:yes,no',
            'disability' => 'nullable|string',
            'gender' => 'required|in:Male,Female',
            'payment_status' => 'required|in:paid,unpaid',
            'violation' => 'required|in:yes,no',
            'relationship_to_homeowner' => 'nullable|string',
        ];
        $columnMapping = [
            'email' => 'email',
            'block' => 'block',
            'lot' => 'lot',
            'street' => 'street',
            'first_name' => 'first_name',
            'middle_initial' => 'middle_initial',
            'last_name' => 'last_name',
            'religion' => 'religion',
            'phone_number' => 'phone_number',
            'household_size' => 'household_size',
            'occupation' => 'occupation',
            'status' => 'status',
            'acknowledgement_on_community_rules' => 'acknowledgement_on_community_rules',
            'disability' => 'disability',
            'gender' => 'gender',
            'payment_status' => 'payment_status',
            'violation' => 'violation',
            'relationship_to_homeowner' => 'relationship_to_homeowner'
        ];

        foreach ($rows as $row) {

            // Validate the row data
            $validator = Validator::make($row->toArray(), $validatorMapping);

            if ($validator->fails()) {
                // If validation fails, redirect back with error messages
                return redirect()->back()->withErrors($validator)->withInput()->with('form', 'resident');
            }
            
            // Map Excel columns to database columns dynamically
            $mappedRow = [];
            foreach ($columnMapping as $excelColumn => $dbColumn) {
                $mappedRow[$dbColumn] = $row[$excelColumn] ?? null;
            }
            
            // Check if the resident exists based on email
            $existingResident = Residents::where('email', $mappedRow['email'])->first();
            if ($existingResident) {
                // Update the existing resident
                $updateResult = $existingResident->update($mappedRow);

                if ($updateResult) {
                    $homeowner = $existingResident;
                } else {
                    dd('Failed to update existing resident:', $mappedRow);
                }
            } else {
                // Create a new resident
                $createResult = Residents::create($mappedRow);
                if ($createResult) {
                    $homeowner = $createResult;
                    
                } else {
                    dd('Failed to create new resident:', $mappedRow);
                }
            }

            // Check if the resident is a tenant
            if ($mappedRow['status'] === 'tenant') {
                // Find the corresponding homeowner using block, lot, and street
                $homeownerOfTenant = Residents::where([
                    'block' => $mappedRow['block'],
                    'lot' => $mappedRow['lot'],
                    'street' => $mappedRow['street'],
                    'status' => 'owned', // Assuming status 'owned' for homeowners
                ])->first();

                // Associate the tenant with the homeowner
                if ($homeownerOfTenant) {
                    $homeowner->update(['homeowner_id' => $homeownerOfTenant->id]);
                }
            }
        }
        Session::flash('status', 'Imported Successfully');
    }
    
}

