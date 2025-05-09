<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Welcome')]
class Welcome extends Component
{
    public bool $showInfo = false;

    public function render()
    {
        return view('livewire.welcome');
    }
}