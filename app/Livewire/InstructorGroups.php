<?php

namespace App\Livewire;

use App\Livewire\Forms\GroupForm;
use App\Livewire\Forms\GroupMemberForm;
use App\Models\Course;
use App\Models\SchoolYear;
use App\Models\Section;
use App\Models\Group;
use App\Models\ThesisPhase;
use App\Models\User;
use Livewire\Component;
use Mary\Traits\Toast;

class InstructorGroups extends Component
{
    use Toast;
    public GroupForm $form;
    public $course;
    public $section;
    public $groups = [];
    public $section_id;
    public $students;

    public $thesisPhases;
    public $schoolYear;

    public $addGroupModal = false;
    public $addMembersModal = false;
    public $viewModal = false;


    public GroupMemberForm $memberForm;
    public $selectedGroup = [
        'id' => null,
        'title' => null,
        'is_approved' => null,
        'section_id' => null,
        'title_defense_date' => null,
        'title_defense_time' => null,
    ];
    public $groupMembers = [];

    public $breadcrumbs = [
        ['label' => 'Courses', 'link' => "/professor/courses"],
        ['label' => 'Sections', 'link' => "#"],
        ['label' => 'Groups', 'link' => "#"]
    ];

    public function loadOptions()
    {
        $this->students = User::where('role', 'student')
            ->where('department_id', operator: auth()->user()->department_id)
            ->whereDoesntHave('groups') // assuming this is the relationship to check group join
            ->get()
            ->map(function ($student) {
                return [
                    'id' => $student->id,
                    'name' => $student->fullName()
                ];
            })
            ->toArray();
    }

    public function mount($course_id, $section_id)
    {
        $this->course = Course::findOrFail($course_id);
        if ($this->course->department_id !== auth()->user()->department_id) {
            redirect()->route('professor.courses')->with('error', 'You do not have permission to access this course.');
        }

        $this->loadOptions();
        $this->thesisPhases = ThesisPhase::where('is_active', true)->first();
        $this->schoolYear = SchoolYear::where('is_active', true)->first();

        // Load section before using it
        $this->section = Section::findOrFail($section_id);
        $this->form->section_id = $this->section->id;

        $this->loadGroups();
        $this->updateBreadcrumbs();
    }

    public function viewGroup($groupId)
    {
        // dd($groupId);
        try {
            $group = Group::with(['groupMembers.student', 'leader.student'])->findOrFail($groupId);
            $this->selectedGroup = [
                'id' => $group->id,
                'title' => $group->title,
                'is_approved' => $group->is_approved,
                'section_id' => $group->section_id,
                'title_defense_date' => $group->title_defense_date,
                'title_defense_time' => $group->title_defense_time,
            ];

            $this->groupMembers = $group->groupMembers->map(function ($member) {
                return [
                    'group_id' => $member->group_id,
                    'student_id' => $member->student_id,
                    'is_leader' => $member->is_leader,
                    'email' => $member->email,
                    'contact_number' => $member->contact_number,
                    'student_name' => $member->student->fullName()
                ];
            })->toArray();

            $this->viewModal = true;

        } catch (\Exception $e) {
            $this->error('Error loading group details');
        }
    }

    private function loadGroups()
    {
        $this->groups = Group::where('section_id', $this->section->id)
            ->with(['leader.student', 'groupMembers', 'thesisPhase'])
            ->get();
    }

    private function updateBreadcrumbs()
    {
        $this->breadcrumbs[1]['label'] = $this->course->name;
        $this->breadcrumbs[1]['link'] = route('professor.courses.section', ['course_id' => $this->course->id]);
        $this->breadcrumbs[2]['label'] = $this->section->name;
    }

    public function addGroup()
    {
        $this->form->store();
        $this->loadGroups();
        $this->addGroupModal = false;
        $this->success('Group added successfully');
    }

    public function editGroup($groupId)
    {
        // Edit group logic
    }

    public function deleteGroup($groupId)
    {
        // Delete group logic
    }

    public function addMembers($groupId)
    {
        $this->selectedGroup = Group::findOrFail($groupId);
        $this->memberForm->group_id = $groupId;
        $this->addMembersModal = true;
        $this->viewModal = false;
    }

    public function addMember()
    {
        $this->memberForm->store();
        $this->loadGroups();
        $this->addMembersModal = false;
        $this->success('Members added successfully');
    }


    public function render()
    {
        return view('livewire.instructor-groups');
    }
}
