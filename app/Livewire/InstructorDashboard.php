<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Announcement;
use App\Models\GroupAssignment;
use App\Models\SchoolYear;
use App\Models\Section;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Instructor Dashboard')]
class InstructorDashboard extends Component
{
    public $totalStudents = 0;
    public $totalGroups = 0;
    public $totalSections = 0;
    public $assignedGroups = 0;
    public $activeSchoolYear;
    public $assignments;

    public $announcements;



    public function mount()
    {
        $this->activeSchoolYear = SchoolYear::where('is_active', true)->first();
        $sections = Section::withCount([
            'groups',
            'groups as students_count' => function ($query) {
                $query->withCount('groupMembers');
            },
        ])
            ->where('professor_id', auth()->id())
            ->get();

        $this->totalStudents = $sections->sum('students_count');
        $this->totalGroups = $sections->sum('groups_count');
        $this->totalSections = $sections->count();
        $this->assignments = auth()->user()->personnel()->with([
            'group.section',
            'group.groupMembers',
            'group.schoolYear'
        ])
        ->get();

        $this->assignedGroups = auth()->user()->personnel()->count();
        $this->announcements = Announcement::latest()
            ->take(5)
            ->get();

        // dd($this->assignments);

    }

    public function render()
    {
        return view('livewire.instructor-dashboard');
    }
}
