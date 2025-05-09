<?php

namespace App\Livewire;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class DepartmentCourseManagement extends Component
{
    use Toast, WithPagination;

    public DepartmentForm $form;
    public $addModal = false;
    public $search;

    public function addDepartment()
    {
        $this->addModal = true;
    }
    public function departments()
    {
        return Department::query()
            ->with('courses')
            ->get();
    }
    public function render()
    {
        $departments = $this->departments();
        return view('livewire.department-course-management', compact('departments'));
    }
}
