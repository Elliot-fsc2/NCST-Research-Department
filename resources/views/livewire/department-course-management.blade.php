<div>
    <x-card title="Department and Course Management" subtitle="Manage the departments and courses here.">

        <x-slot:menu>
            <x-button label="Add Department" icon="o-plus" @click="$wire.addModal = true" />
        </x-slot:menu>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            @forelse ($departments as $department)
                <a href="{{ route('head.dept.course', $department) }}" wire:navigate>
                    <x-card title="{{$department->name}}" subtitle="{{$department->courses->count()}} available program."
                    class="bg-blue-300 hover:bg-gray-200 cursor-pointer" >
                        <x-slot:actions>
                            <x-button icon="o-pencil" @click="$wire.editModal = true" />
                            <x-button icon="o-trash" @click="$wire.deleteModal = true" />
                        </x-slot:actions>
                    </x-card>
                </a>
            @empty
                <p class="text-center">No Departments Found.</p>
            @endforelse
        </div>

    </x-card>

    <x-modal wire:model="addModal" title="New Department" subtitle="Add New department here">
        <x-form wire:submit="">
            <x-input wire:model.live="form.name" label="Name" placeholder="Department Name" inline/>

            <x-slot:actions>
                <x-button label="Save" icon="o-check" tyoe="submit" spinner=""/>
            </x-slot:actions>
        </x-form>
    </x-modal>
</div>