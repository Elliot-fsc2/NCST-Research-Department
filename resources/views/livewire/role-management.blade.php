<x-card title="Role Management" subtitle="Manage all the roles here" shadow separator>

    <x-slot:menu>
        <x-input label="Search" placeholder="Search role" inline clearable wire:model.live="search" />
        <x-button icon="o-plus" label="Add Role" wire:click="createModal" class="btn-sm btn-success" responsive />
    </x-slot:menu>

    <x-table :headers="$headers" :rows="$roles" show-empty-text with-pagination>
        @scope('actions', $role)
        <div class="flex gap-3">
            <x-button icon="o-pencil" @click="$wire.edit({{$role}})" spinner class="btn-sm btn-info" />
            <x-button icon="o-trash" @click="$wire.delete({{$role}})" spinner class="btn-sm btn-error" />
        </div>
        @endscope
    </x-table>

    <x-modal wire:model="addModal" title="New role" subtitle="Add new role here">
        <x-form wire:submit="save">
            <x-input label="Name" wire:model.live="form.name" />
            <x-textarea label="Description" wire:model.live="form.description" />

            <x-slot:actions>
                <x-button class="btn-success" type="submit" label="Save" spinner="save" />
            </x-slot:actions>
        </x-form>
    </x-modal>


    <x-modal wire:model="updateModal" title="Update role" subtitle="Update {{$form->name}} role details">
        <x-form wire:submit="update">
            <x-input label="Name" wire:model.live="form.name" />
            <x-textarea label="Description" wire:model.live="form.description" />

            <x-slot:actions>
                <x-button icon="o-check" class="btn-success" type="submit" label="update" spinner="update" />
            </x-slot:actions>
        </x-form>
    </x-modal>

    <x-modal wire:model="deleteModal" title="Delete role">
        <div>
            <p class="mt-2">Are you sure you want to delete <b>{{$form->name}}</b> role?</p>
        </div>
        <x-slot:actions>
            <x-button icon="o-trash" class="btn-error" label="Delete" spinner="destroy"
                wire:click="destroy" />
        </x-slot:actions>
    </x-modal>
</x-card>