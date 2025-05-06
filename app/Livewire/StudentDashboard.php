<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Student Dashboard')]
class StudentDashboard extends Component
{
    public $thesisProgress = [
        ['chapter' => 'Chapter 1: Introduction', 'status' => 'Completed', 'progress' => 100],
        ['chapter' => 'Chapter 2: Review of Related Literature', 'status' => 'In Progress', 'progress' => 65],
        ['chapter' => 'Chapter 3: Methodology', 'status' => 'Pending', 'progress' => 0],
    ];

    public $recentActivities = [
        ['activity' => 'Adviser feedback received on Chapter 2', 'time' => '2 days ago', 'type' => 'info'],
        ['activity' => 'Chapter 1 approved by panel', 'time' => '5 days ago', 'type' => 'success'],
        ['activity' => 'Defense schedule confirmed', 'time' => '1 week ago', 'type' => 'warning'],
    ];

    public function render()
    {
        return view('livewire.student-dashboard');
    }
}
