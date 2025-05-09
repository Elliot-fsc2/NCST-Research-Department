<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class CourseManagement extends Component
{
    public $department_id;
    public Department $department;


    public $headers = [
        ['key' => 'id', 'label' => 'ID'],
        ['key' => 'name', 'label' => 'Name'],
    ];

    public $search = '';
    public function mount(Department $department)
    {
        $this->department = $department;
        $this->department_id = $department->id;
    }

    public function courses()
    {
        return Course::query()
            ->where('department_id', $this->department_id)
            ->when($this->search, function (Builder $query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->paginate(10);
    }
    public function render()
    {
        $courses = $this->courses();
        return view('livewire.course-management', compact('courses'));
    }
}
