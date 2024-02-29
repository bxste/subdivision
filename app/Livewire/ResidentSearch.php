<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Residents;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class ResidentSearch extends Component
{
    use WithPagination;
    public $search;
    public $pagination = 10;
    public $payment_status;

    #[Computed(persist:true,seconds:7200)]
    public function render()
    {
        if (!$this->search) {
            $residents = Residents::simplePaginate($this->pagination);
        } else {
            $residents = Residents::where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('middle_initial', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('block', 'like', '%' . $this->search . '%')
                ->orWhere('lot', 'like', '%' . $this->search . '%')
                ->orWhere('street', 'like', '%' . $this->search . '%')
                ->orWhere('gender', 'like', '%' . $this->search . '%')
                ->orWhere('religion', 'like', '%' . $this->search . '%')
                ->simplePaginate($this->pagination);
        }

        return view('livewire.resident-search', ['residents' => $residents]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function changePaymentStatus($residentId, $currentStatus)
    {
        // Assuming you have a 'residents' table with a 'payment_status' column
        $resident = Residents::find($residentId);

        if ($resident) {
            $newStatus = $currentStatus === 'paid' ? 'unpaid' : 'paid';
            $resident->update(['payment_status' => $newStatus]);

            session()->flash('message', 'Payment status updated successfully');
        } else {
            session()->flash('error', 'Resident not found');
        }
    }

}
