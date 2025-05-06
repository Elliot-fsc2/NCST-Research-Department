<?php

namespace App\Livewire\Forms;

use App\Models\Role;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RoleForm extends Form
{
    public ?Role $role;

    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $description;

    public function setRole(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->description = $role->description;
    }

    public function save()
    {
        $this->validate();
        Role::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        $this->reset();
    }

    public function update()
    {
        $this->validate();
        $this->role->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        $this->reset();
    }

    public function delete()
    {
        $this->role->delete();
        $this->reset();
    }


}
