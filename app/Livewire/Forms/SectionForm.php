<?php

namespace App\Livewire\Forms;

use App\Models\Section;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SectionForm extends Form
{
    public ?Section $section;

    #[Validate('required|string|max:255|min:3')]
    public $name = '';

    public $course_id;
    public $professor_id;

    public function setSection(Section $section)
    {
        $this->section = $section;
        $this->name = $section->name;
        $this->course_id = $section->course_id;
        $this->professor_id = $section->professor_id;
    }

    public function setCourseId($course_id)
    {
        $this->course_id = $course_id;
    }
    public function store() 
    {
        $this->validate();
        Section::create([
            'name' => $this->name,
            'course_id' => $this->course_id,  // Use the set course_id
            'professor_id' => auth()->id(),
        ]);
        $this->reset('name');  // Only reset name to keep course_id
    }

    public function update()
    {
        $this->validate();
        $this->section->update([
            'name' => $this->name,
            'course_id' => $this->course_id,
            'professor_id' => $this->professor_id,
        ]);

        $this->reset();
    }
    
   
}
