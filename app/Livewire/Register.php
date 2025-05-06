<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate('required|min:3')]
    public $name = "";

    #[Validate('required|email')]
    public $email = "";

    #[Validate('required|confirmed')]
    public $password = "";

    #[Validate('required')]
    public $password_confirmation = "";

    public function register()
    {
        $validated = $this->validate();

        $validated['password'] = Hash::make($validated['password']);
    
        event(new Registered($user = User::create($validated)));
    
        Auth::login($user);
    
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
    public function render()
    {
        return view('livewire.register')
        ->layout('components.layouts.empty');
    }
}
