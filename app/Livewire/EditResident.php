<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Residents;

class EditResident extends Component
{
    public $residentId;
    public $block;
    public $lot;
    public $street;
    public $first_name;
    public $middle_initial;
    public $last_name;
    public $religion;
    public $email;
    public $phone_number;
    public $household_size;
    public $occupation;
    public $status;
    public $acknowledgement_on_community_rules;
    public $disability;
    public $gender;
    public $payment_status;
    public $violation;
    
    public function editResidentInfo($residentId)
    {
        $resident = Residents::find($residentId);
        $this->residentId = $residentId;
        // Pass both residentId and resident to the view
        return view('admin.residentForms.editResident', ['residentId' => $this->residentId, 'resident' => $resident]);
    }

    public function mount($residentId)
    {
        // Load resident data for editing
        $resident = Residents::find($residentId);
        if ($resident) {
            $this->residentId = $resident->id;
            $this->block = $resident->block;
            $this->lot = $resident->lot;
            $this->street = $resident->street;
            $this->first_name = $resident->first_name;
            $this->middle_initial = $resident->middle_initial;
            $this->last_name = $resident->last_name;
            $this->religion = $resident->religion;
            $this->email = $resident->email;
            $this->phone_number = $resident->phone_number;
            $this->household_size = $resident->household_size;
            $this->occupation = $resident->occupation;
            $this->status = $resident->status;
            $this->acknowledgement_on_community_rules = $resident->acknowledgement_on_community_rules;
            $this->disability = $resident->disability;
            $this->gender = $resident->gender;
            $this->payment_status = $resident->payment_status;
            $this->violation = $resident->violation;
        }
    }

    public function render()
    {
        return view('livewire.edit-resident');
    }

    public function updateResident()
    {
        // Validate input data
        $this->validate([
            'block' => 'required',
            'lot' => 'nullable',
            'street' => 'required',
            'first_name' => 'required',
            'middle_initial' => 'required',
            'last_name' => 'required',
            'religion' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'occupation' => 'required',
            'status' => 'required',
            'acknowledgement_on_community_rules' => 'required',
            'disability' => 'required',
            'gender' => 'required',
            'payment_status' => 'required',
            'violation' => 'required',
        ]);

        // Update resident
        $resident = Residents::find($this->residentId);
        if ($resident) {
            $resident->update([
                'block' => $this->block,
                'lot' => $this->lot,
                'street' => $this->street,
                'first_name' => $this->first_name,
                'middle_initial' => $this->middle_initial,
                'last_name' => $this->last_name,
                'religion' => $this->religion,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'household_size' => $this->household_size,
                'occupation' => $this->occupation,
                'status' => $this->status,
                'acknowledgement_on_community_rules' => $this->acknowledgement_on_community_rules,
                'disability' => $this->disability,
                'gender' => $this->gender,
                'payment_status' => $this->payment_status,
                'violation' => $this->violation,
            ]);

            // Flash a success message
            session()->flash('status', 'Updated Successfully!');

            // Redirect back to the previous page
            return redirect()->to(url()->previous());
        }
    }

}

