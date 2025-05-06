<?php

namespace App\Livewire\Forms;

use App\Models\GroupMembers;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Mary\Traits\Toast;

class GroupMemberForm extends Form
{
    use Toast;
    public ?GroupMembers $groupMember;

    #[Validate('required')]
    public $group_id;

    #[Validate('required|unique:group_members,student_id')]
    public $members = [];

    #[Validate('required|unique:group_members,student_id')]
    public $leader;
    public $contact_number;

    public function setGroupMember(GroupMembers $groupMember)
    {
        $this->groupMember = $groupMember;

        $this->student_id = $groupMember->student_id;
        $this->group_id = $groupMember->group_id;
        $this->is_leader = $groupMember->is_leader;
        $this->contact_number = $groupMember->contact_number;
    }

    public function setLeader($studentId)
    {
        // Set all members of the group to not leader
        GroupMembers::where('group_id', $this->groupId)->update(['is_leader' => false]);

        // Set selected student to leader
        GroupMembers::where('group_id', $this->groupId)
            ->where('student_id', $studentId)
            ->update(['is_leader' => true]);
    }

    public function store()
    {
        $this->validateOnly('members');

        foreach ($this->members as $member) {
            GroupMembers::create([
                'group_id' => $this->group_id,
                'student_id' => $member,
                'is_leader' => 0,
                'contact_number' => '',
            ]);
        }

        $this->reset();
    }


    public function update()
    {
        $this->validate();
        $this->groupMember->update([
            'group_id' => $this->group_id,
            'student_id' => $this->leader,
            'is_leader' => 1,
            'contact_number' => '',
        ]);
    }
}
