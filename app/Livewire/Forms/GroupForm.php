<?php

namespace App\Livewire\Forms;

use App\Models\Group;
use App\Models\GroupMembers;
use App\Models\SchoolYear;
use App\Models\Section;
use App\Models\ThesisPhase;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GroupForm extends Form
{
    public ?Group $group;

    #[Validate('required|string|min:3|max:255')]
    public string $title = '';
    public $section_id;
    public $school_year_id;
    public $thesis_phase_id;

    public $title_date;

    public $final_date;
    



    public function setGroup(Group $group)
    {
        $this->group = $group;
        $this->title = $group->title;
        $this->section_id = $group->section_id;
        $this->thesis_phase_id = $group->thesis_phase_id;

        // dd($this->members);
    }

    public function store()
    {
        $this->validate();
        
        $thesisPhases = ThesisPhase::where('is_active', true)->first();
        $schoolYear = SchoolYear::where('is_active', true)->first();
        
        Group::create([
            'title' => $this->title,
            'section_id' => $this->section_id,
            'thesis_phase_id' => $thesisPhases->id,
            'school_year_id' => $schoolYear->id,
        ]);
        // dd($this->all());


        $this->reset('title');

    }

    public function update()
    {
        $this->validate();
        $this->group->update([
            'title' => $this->title,
            'section_id' => $this->section_id,
            'thesis_phase_id' => $this->currentThesisPhase,
            'school_year_id' => $this->activeSchoolYear,
        ]);
        $this->reset('title');

    }


    public function setSectionId($sectionId)
    {
        $this->section_id = Section::where('id', $sectionId)
            ->where('professor_id', auth()->id())
            ->firstOrFail()
            ->id;
    }

}
