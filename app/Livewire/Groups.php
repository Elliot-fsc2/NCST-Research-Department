<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Group;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Research Groups')]
class Groups extends Component
{
    public $selectedGroup = null;
    public $showGroupDetails = false;

    public function viewGroup($groupId)
    {
        $this->selectedGroup = Group::with(['members', 'adviser', 'department', 'course'])->find($groupId);
        $this->showGroupDetails = true;
    }

    public function render()
    {
        $departments = Department::with(['groups' => function($query) {
            $query->with(['members', 'adviser']);
        }])->get();

        return view('livewire.groups', [
            'departments' => $departments
        ]);
    }
}
