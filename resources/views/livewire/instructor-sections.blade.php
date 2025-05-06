<div>
    <x-card>
        <x-header title="Sections Overview" separator progress-indicator />

        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="flex justify-between items-center mb-6 mt-4">
            <h2 class="text-xl font-semibold text-gray-800">{{ $course->name }} Sections</h2>
            <x-button label="Add Section" icon="o-plus" class="btn-primary"
                @click="$wire.isAddingSectionModal = true" />
        </div>

        <!-- Sections Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($sections as $section)

                <x-card class="bg-gray-100 shadow-md transition-all duration-200 cursor-pointer">

                    <a href="{{ route('professor.courses.section.groups', [$course->id, $section->id]) }}" wire:navigate>
                        <x-header :title="$section->name" subtitle="Click to view groups" separator>
                            <x-slot:middle class="!justify-end">
                            </x-slot:middle>
                            
                        </x-header>
                    </a>
                    <x-slot:actions>
                        <x-button icon="o-pencil" class="btn-circle btn-sm btn-info" wire:click="editSection({{$section}})" />
                        <x-button icon="o-trash" class="btn-circle btn-sm btn-error" wire:click="deleteSection({{ $section->id }})" />
                    </x-slot:actions>

                    {{-- <x-header title="{{ $section->name }}" subtitle="Click to view groups" separator />
                    <p class="text-sm text-gray-600">{{ $section->groups_count }} Groups</p> --}}
                    
                </x-card>

            @endforeach
        </div>
    </x-card>

    {{-- <a href="{{ route('professor.courses.section.groups', [$course->id, $section->id]) }}" wire:navigate> --}}

        {{-- //modal for adding section --}}
        <x-modal wire:model="isAddingSectionModal">
            <x-form wire:submit="addSection" class="p-6">
                <h2 class="text-lg font-semibold mb-4">Add New Section</h2>

                <div class="space-y-4">
                    <div>
                        <x-input label="Section" wire:model.blur="form.name" placeholder="Input a section" inline />
                    </div>
                </div>


                <x-slot:actions>
                    <x-button label="Create" class="btn-primary" type="submit" spinner="addSection" />
                </x-slot:actions>
            </x-form>
        </x-modal>


        {{-- //modal for editing section --}}
        <x-modal wire:model="isEditingSectionModal">
            <x-form wire:submit="updateSection" class="p-6">
                <h2 class="text-lg font-semibold mb-4">Edit Section</h2>

                <div class="space-y-4">
                    <div>
                        <x-input label="Section" wire:model.blur="form.name" placeholder="Input a section" inline />
                    </div>
                </div>


                <x-slot:actions>
                    <x-button label="Update" class="btn-primary" type="submit" spinner="updateSection" />
                </x-slot:actions>
            </x-form>
        </x-modal>
</div>