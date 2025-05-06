<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class InstructorCourses extends Component
{
    public $courses = [];
    
    public $breadcrumbs = [
        ['label' => 'Courses', 'link' => "/professor/courses"],
    ];

    public function mount()
    {
        $this->loadCourses();
    }

    public function loadCourses()
    {
        $instructorDepartment = auth()->user()->department_id;
        $this->courses = Course::where('department_id', $instructorDepartment)
            ->withCount('sections')
            ->get();
    }

    public function loading()
    {
        // Handle loading state if needed
    }

    public function render()
    {
        return view('livewire.instructor-courses');
    }
}
