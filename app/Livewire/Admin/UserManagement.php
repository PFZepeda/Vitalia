<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Support\RoleNames;
use Livewire\Component;

class UserManagement extends Component
{
    public $search = '';

    public $userToDelete = null;
    public $showDeleteModal = false;

    public function confirmDelete($id)
    {
        $this->userToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->userToDelete = null;
        $this->showDeleteModal = false;
    }

    public function deleteUser()
    {
        if ($this->userToDelete) {
            User::find($this->userToDelete)?->delete();
            $this->userToDelete = null;
            $this->showDeleteModal = false;
            session()->flash('status', 'Cuenta eliminada correctamente');
        }
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('email', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.admin.user-management', [
            'users' => $users
        ])->layout('layouts.app', [
            'title' => 'Gestión de usuarios',
            'bodyClass' => 'min-h-screen bg-[#f2f4f6] text-slate-900 antialiased',
        ]);
    }
}
