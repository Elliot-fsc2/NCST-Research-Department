
<div class="md:w-96 mx-auto mt-20">
    <div class="mb-10">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-20 w-auto" src="{{asset('images/ncst.png')}}" alt="NCST Logo">
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
            <p class="mt-2 text-center text-sm text-gray-600">Please use your school credentials to login</p>
        </div>
    </div>

    <x-form wire:submit="register">
        <x-input placeholder="Name" wire:model.live="name" icon="o-user" />
        <x-input placeholder="E-mail" wire:model="email" icon="o-envelope" />
        <x-input placeholder="Password" wire:model="password" type="password" icon="o-key" />
        <x-input placeholder="Confirm Password" wire:model="password_confirmation" type="password" icon="o-key" />

        <x-slot:actions>
            <x-button label="Already registered?" class="btn-ghost" link="/login" />
            <x-button label="Register" type="submit" icon="o-paper-airplane" class="btn-primary" spinner='register'/>
        </x-slot:actions>
    </x-form>
</div>