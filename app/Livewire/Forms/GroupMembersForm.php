<?php

namespace App\Livewire\Forms;

use App\Models\GroupMembers;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GroupMembersForm extends Form
{
    public ?GroupMembers $groupMembers;

    #[Validate('required|unique:group_id')]
    public $leader;

    #[Validate('required|unique:group_id')]
    public $members;
}
