<x-modal wire:model="isAddingGroupModal" title="{{ $editingGroup ? 'Edit Group' : 'Add New Group' }}">
    <x-form wire:submit="saveGroup">

        <x-input label="Thesis Title" wire:model="groupForm.title" icon="o-book-open" />


        <x-choices-offline label="Group Leader" wire:model="groupForm.leader" :options="$availableStudents"
            placeholder="Leader" single clearable searchable />

        <x-choices-offline label="Group Members" wire:model="groupForm.members" :options="$availableStudents"
            placeholder="Members" clearable searchable/>

        <x-slot:actions>
            <x-button label="Save" class="btn-primary" type="submit" spinner="saveGroup" />
        </x-slot:actions>
    </x-form>
</x-modal>