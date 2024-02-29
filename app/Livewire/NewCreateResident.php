<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Residents;

class NewCreateResident extends Component
{
    
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
    public $status = 'owned';
    public $acknowledgement_on_community_rules;
    public $disability;
    public $gender;
    public $payment_status;
    public $violation;

    public function render()
    {
        return view('livewire.new-create-resident');
    }

    public function createResident()
    {
        // Validate input data
        $this->validate([
            'block' => 'required',
            'lot' => 'required',
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
        
        // Create new resident
        Residents::create([
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

        

        // Reset input fields
        $this->reset();
        
        session()->flash('message', 'Resident created successfully.');


    }
}
