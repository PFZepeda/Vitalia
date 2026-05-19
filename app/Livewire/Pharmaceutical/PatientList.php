<?php

namespace App\Livewire\Pharmaceutical;

use App\Models\User;
use App\Support\RoleNames;
use Livewire\Component;
use Livewire\WithPagination;

class PatientList extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $patients = User::role(RoleNames::PATIENT)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.pharmaceutical.patient-list', [
            'patients' => $patients
        ]);
    }
}
