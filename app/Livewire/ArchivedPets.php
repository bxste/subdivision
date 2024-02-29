<?php

namespace App\Livewire;

use App\Models\PetsArchive;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ArchivedPets extends Component
{
    use WithPagination;

    public $search;
    public $pagination = 10;

    #[Computed(persist: true, seconds: 7200)]
    public function render()
    {
        if (!$this->search) {
            $archivedPets = PetsArchive::simplePaginate($this->pagination);
        } else {
            $archivedPets = PetsArchive::where('email', 'like', '%' . $this->search . '%')
                ->simplePaginate($this->pagination);
        }

        return view('livewire.archived-pets', ['archivedData' => $archivedPets]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

}