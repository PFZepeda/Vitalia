<?php

namespace App\Livewire\Patient;

use Livewire\Component;

class RecetasPaciente extends Component
{
    public $showModal = false;
    public $selectedRecipe = null;

    public function openModal($recipeId)
    {
        $this->selectedRecipe = $recipeId;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedRecipe = null;
    }

    public function render()
    {
        return view('livewire.patient.recetas-paciente');
    }
}
