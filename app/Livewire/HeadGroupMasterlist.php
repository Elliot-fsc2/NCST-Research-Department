<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Group;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class HeadGroupMasterlist extends Component
{
    use WithPagination;

    public $details = false;
    public $search;
    public $selectedGroup = [];


    public array $sortBy = ['column' => 'title', 'direction' => 'asc'];
    public $headers = [
        ['key' => 'id', 'label' => '#', 'sortable' => false],
        ['key' => 'title', 'label' => 'Title'],
        ['key' => 'schoolYear.name', 'label' => 'School Year', 'sortable' => false],
        ['key' => 'section.course.department.name', 'label' => 'Department', 'sortable' => false],
        ['key' => 'section.course.name', 'label' => 'Course', 'sortable' => false],
        ['key' => 'final_defense_date', 'label' => 'Final Defense Date'],
        ['key' => 'status', 'label' => 'Status', 'sortable' => false],
    ];
    public function showDetails($group)
    {
        $selectedGroup = Group::with([
            'schoolYear',
            'section.course.department',
            'groupMembers.student',
            'groupAssignments',
            'leader.student'
        ])->find($group['id']);

        $this->selectedGroup = [
            'title' => $selectedGroup->title,
            'school_year' => $selectedGroup->schoolYear->name,
            'department' => $selectedGroup->section->course->department->name,
            'course' => $selectedGroup->section->course->name,
            'final_defense_date' => $selectedGroup->finalDefenseDate(),
            'status' => $selectedGroup->is_approved ? 'Active' : 'Pending',
            'members' => $selectedGroup->groupMembers->map(function ($member) {
                return [
                    'student_name' => $member->student->fullName(),
                    'is_leader' => $member->is_leader
                ];
            }),
            'assignments' => $selectedGroup->groupAssignments->map(function ($assignment) {
                return [
                    'name' => $assignment->personnel->fullName(),
                    'role' => $assignment->role->name,
                ];
            })
        ];

        $this->details = true;
    }
    public function groups(): LengthAwarePaginator
    {
        return Group::query()
            ->with([
                'schoolYear',
                'thesisPhase',
                'section.course.department',
                'groupMembers',
                'leader',
            ])
            ->when($this->search, fn(Builder $q) => $q->where('title', 'like', "%$this->search%"))
            ->orderBy(...array_values($this->sortBy))
            ->paginate(10);
    }
    public function mount()
    {

    }

    public function render()
    {
        $groups = $this->groups();
        return view('livewire.head-group-masterlist', [
            'groups' => $groups,
        ]);
    }
}
