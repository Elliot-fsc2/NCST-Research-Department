<x-modal wire:model="isAddingSectionModal">
    <x-form wire:submit="saveSection" class="p-6">
        <h2 class="text-lg font-semibold mb-4">{{ $editingSection ? 'Edit Section' : 'Add New Section' }}</h2>

        <div class="space-y-4">
            <div>
                <x-select wire:model="sectionForm.course_id" label="Course" placeholder="Select Course"
                    :options="$courses" />
            </div>
            
            <div>
                <x-input label="Section" wire:model.live="sectionForm.name" placeholder="Input a section" inline />
            </div>
        </div>


        <x-slot:actions>
            <x-button label="{{ $editingSection ? 'Update' : 'Create' }}" class="btn-primary" type="submit"
                spinner="saveSection" />
        </x-slot:actions>
    </x-form>
</x-modal>