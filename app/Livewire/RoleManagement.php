<?php

namespace App\Livewire;

use App\Livewire\Forms\RoleForm;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class RoleManagement extends Component
{
    use Toast;

    public RoleForm $form;  
    public $search;
    public $deleteModal = false;
    public $addModal = false;
    public $updateModal = false;
    public $headers = [
        ['key' => 'id', 'label' => 'ID'],
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'description', 'label' => 'Description'],
    ];

    public function roles(): LengthAwarePaginator
    {
        return Role::query()
            ->when($this->search, function (Builder $query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->paginate(10);
    }

    public function createModal()
    {
        $this->addModal = true;
        $this->form->reset();
    }

    public function save()
    {
        $this->form->save();
        $this->addModal = false;
        $this->form->reset();
        $this->success('Role created successfully');
    }
    public function edit(Role $role)
    {
        $this->form->setRole($role);
        $this->updateModal = true;
    }
    public function update()
    {
        $this->form->update();
        $this->updateModal = false;
        $this->form->reset();
        $this->success('Role updated successfully');
    }

    public function delete(Role $role)
    {
        $this->deleteModal = true;
        $this->form->setRole($role);
    }

    public function destroy()
    {
        $this->form->delete();
        $this->deleteModal = false;
        $this->success('Role deleted successfully');
    }

    public function render()
    {
        $roles = $this->roles();
        return view('livewire.role-management', compact('roles'));
    }
}
