<?php

namespace App\Livewire;

use App\Models\VehiclesArchive;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ArchivedVehicles extends Component
{
    use WithPagination;

    public $search;
    public $pagination = 10;

    #[Computed(persist: true, seconds: 7200)]
    public function render()
    {
        if (!$this->search) {
            $archivedVehicles = VehiclesArchive::simplePaginate($this->pagination);
        } else {
            $archivedVehicles = VehiclesArchive::where('email', 'like', '%' . $this->search . '%')
                ->simplePaginate($this->pagination);
        }

        return view('livewire.archived-vehicles', ['archivedData' => $archivedVehicles]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

}