<?php

namespace App\Livewire\Pharmaceutical;

use Livewire\Component;

class MedicationStock extends Component
{
    public $showModal = false;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.pharmaceutical.medication-stock');
    }
}
