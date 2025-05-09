<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DepartmentForm extends Form
{
    public ?Department $department;

    #[Validate('required|min:3|max:255|unique')]
    public string $name = '';

    public function setForm(Department $department)
    {
        $this->department = $department;
        $this->name = $department->name;
    }
    public function save()
    {
        $this->validate();

        Department::create([
            'name' => $this->name,
        ]);
        $this->reset();
    }

    public function update()
    {
        $this->validate();
        $this->department->update([
            'name' => $this->name,
        ]);
        $this->reset();
    }

    public function delete()
    {
        $this->department->delete();
        $this->reset();
    }
}
