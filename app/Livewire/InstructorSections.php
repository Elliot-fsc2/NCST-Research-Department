<?php

namespace App\Livewire;

use App\Livewire\Forms\SectionForm;
use App\Models\Course;
use App\Models\Section;
use Livewire\Component;
use Mary\Traits\Toast;

class InstructorSections extends Component
{
    use Toast;
    public $course;
    public $sections = [];

    public SectionForm $form;
    
    public $isAddingSectionModal = false;
    public $isEditingSectionModal = false;
    public $breadcrumbs = [
        ['label' => 'Courses', 'link' => "/professor/courses"],
        ['label' => 'Sections', 'link' => "#"],
    ];

    public function mount($course_id)
    {
        $this->course = Course::findOrFail($course_id);
        
        if ($this->course->department_id !== auth()->user()->department_id) {
            abort(403, 'You do not have access to this course.');
        }
        $this->form->course_id = $this->course->id;  // Set the course_id directly
        $this->loadSections();
        $this->updateBreadcrumbs();
    }

    
    public function editSection(Section $section)
    {
        $this->form->setSection($section);
        $this->isEditingSectionModal = true;
    }
    public function addSection()
    {
        $this->form->store();
        $this->loadSections();
        $this->isAddingSectionModal = false;
    }
    public function updateSection()
    {
        $this->form->update();
        $this->loadSections();
        $this->isEditingSectionModal = false;
    }
    
    private function loadSections()
    {
        $this->sections = Section::where('course_id', $this->course->id)
            ->where('professor_id', auth()->id())
            ->withCount('groups')
            ->get();
    }

    private function updateBreadcrumbs()
    {
        $this->breadcrumbs[1]['label'] = $this->course->name;
    }

    public function render()
    {
        return view('livewire.instructor-sections');
    }
}
