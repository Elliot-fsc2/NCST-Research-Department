<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Services\RedirectService;
 
new
#[Layout('components.layouts.empty')]       //  <-- Here is the `empty` layout
#[Title('Login')]
class extends Component {
 
    // Remove the email validation rule
    #[Rule('required')]
    public string $email = '';
 
    #[Rule('required')]
    public string $password = '';
 
    public function mount()
    {
        // It is logged in
        if (auth()->user()) {
            return redirect('/');
        }
    }
 
    public function login()
    {
        $key = 'login_attempts_'.request()->ip();
        
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            
            throw ValidationException::withMessages([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }
        
        // Custom validation
        $this->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
 
        $loginType = filter_var($this->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'student_number';
        $credentials = [
            $loginType => $this->email,
            'password' => $this->password
        ];
 
        if (auth()->attempt($credentials)) {
            RateLimiter::clear($key);
            session()->regenerate();
            
            $redirectService = new RedirectService();
            return redirect($redirectService->afterLogin());
        }
 
        RateLimiter::hit($key, 60);
        
        $this->addError('email', 'The provided credentials do not match our records.');
        $this->reset('password');
    }
} ?>

<div class="md:w-96 mx-auto mt-15">
    

    <x-card shadow separator class="bg-gray-200">
        <div class="my-10">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-20 w-auto" src="{{asset('images/ncst.png')}}" alt="NCST Logo">
                <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
                <p class="mt-2 text-center text-sm text-gray-600">Please use your school credentials to login</p>
            </div>
            {{-- <x-app-brand /> --}}
        </div>
     
        <x-form wire:submit="login">
            <x-input placeholder="E-mail or Student Number" wire:model="email" icon="o-user" />
            <x-input placeholder="Password" wire:model="password" type="password" icon="o-key" />
     
            <x-slot:actions>
                <x-button label="Create an account" class="btn-ghost" link="/register" />
                <x-button label="Login" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="login" />
            </x-slot:actions>
        </x-form>
    </x-card>   
</div>
