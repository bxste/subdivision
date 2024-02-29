<?php

namespace App\Livewire;

use App\Models\ResidentsArchive;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ArchivedResident extends Component
{
    use WithPagination;

    public $search;
    public $pagination = 10;

    #[Computed(persist: true, seconds: 7200)]
    public function render()
    {
        if (!$this->search) {
            $archivedResidents = ResidentsArchive::simplePaginate($this->pagination);
        } else {
            $archivedResidents = ResidentsArchive::where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('middle_initial', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('block', 'like', '%' . $this->search . '%')
                ->orWhere('lot', 'like', '%' . $this->search . '%')
                ->orWhere('street', 'like', '%' . $this->search . '%')
                ->orWhere('gender', 'like', '%' . $this->search . '%')
                ->orWhere('religion', 'like', '%' . $this->search . '%')
                ->simplePaginate($this->pagination);
        }

        return view('livewire.archived-resident', ['archivedData' => $archivedResidents]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

}