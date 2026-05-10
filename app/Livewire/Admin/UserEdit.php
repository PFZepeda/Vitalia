<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Support\RoleNames;
use Livewire\Component;

class UserEdit extends Component
{
    public User $user;
    public $role;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->role = $user->getRoleNames()->first() ?? RoleNames::PATIENT;
    }

    public function save()
    {
        $this->user->syncRoles([$this->role]);
        session()->flash('status', 'Cuenta actualizada correctamente');
        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        $roles = [
            RoleNames::PATIENT => RoleNames::PATIENT,
            RoleNames::CAREGIVER => RoleNames::CAREGIVER,
            RoleNames::DOCTOR => 'Médico',
            RoleNames::PHARMACIST => 'Farmacéutico',
            RoleNames::ADMIN => 'Administrador',
        ];

        return view('livewire.admin.user-edit', [
            'roles' => $roles,
        ])->layout('layouts.app', [
            'title' => 'Editar usuario',
            'bodyClass' => 'min-h-screen bg-[#f2f4f6] text-slate-900 antialiased',
        ]);
    }
}
