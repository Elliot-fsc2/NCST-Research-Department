<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Group;
use App\Models\SchoolYear;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Research Head Dashboard')]
class HeadDashboard extends Component
{
    public $activeSchoolYear;
    public $currentPhase;
    public $statistics;

    public function mount()
    {
        $this->activeSchoolYear = SchoolYear::where('is_active', true)->first();
        $this->currentPhase = $this->activeSchoolYear?->activeThesisPhase->name ?? 'Not Set';
        
        $this->statistics = [
            'students' => User::where('role', 'student')->count(),
            'professors' => User::where('role', 'professor')->count(),
            'groups' => Group::count(),
        ];
    }

    public function render()
    {
        return view('livewire.head-dashboard');
    }
}
