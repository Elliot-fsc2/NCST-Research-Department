<div>
    <x-card title="Personnel Management" subtitle="Manage all external personnels" shadow separator>
        <x-slot:menu>
            <div class="flex flex-col gap-2 md:flex-row">
                <x-input icon="o-magnifying-glass" placeholder="Search personnel..." inline wire:model.live="search"
                    clearable />
                <x-button label="Add Personnel" icon="o-plus" @click="$wire.add"
                    class="btn-primary w-full md:w-auto" />
            </div>

        </x-slot:menu>

        <x-table :headers="$headers" :rows="$personnels" :sort-by="$sortBy" with-pagination show-empty-text>
            @scope('cell_id', $user)
            {{$loop->index + 1}}
            @endscope
            @scope('actions', $user)
            <div class="flex gap-1">
                <x-button icon="o-pencil" wire:click="edit({{$user}})" class="btn-circle btn-soft btn-success" />
                <x-button icon="o-trash" wire:click="delModal({{$user}})" class="btn-circle btn-soft btn-error" />
            </div>
            @endscope
        </x-table>
    </x-card>

    <x-modal wire:model="addPersonnel" title="Add New Personnel" box-class="h-120">
        <x-form wire:submit="save">
            <x-input label="First Name" wire:model.live="personnelForm.first_name" first-error-only />
            <x-input label="Middle Name" wire:model.live="personnelForm.middle_name" />
            <x-input label="Last Name" wire:model.live="personnelForm.last_name" first-error-only />
            <x-input label="Email" wire:model.live="personnelForm.email" first-error-only />
            <x-input label="Phone" wire:model.live="personnelForm.contact_number" />
            <x-input label="Affiliation" wire:model.live="personnelForm.affiliation" />
            <x-slot:actions>
                <x-button label="Save" icon="o-check" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
            </x-card>
    </x-modal>

    <x-modal wire:model="updatePersonnel" title="Update Personnel" box-class=" h-130">
        <x-card>
            <x-form wire:submit="update">
                <x-input label="First Name" wire:model.live="personnelForm.first_name" />
                <x-input label="Middle Name" wire:model.live="personnelForm.middle_name" />
                <x-input label="Last Name" wire:model.live="personnelForm.last_name" />
                <x-input label="Email" wire:model.live="personnelForm.email" />
                <x-input label="Phone" wire:model.live="personnelForm.contact_number" />
                <x-input label="Affiliation" wire:model.live="personnelForm.affiliation" />
                <x-slot:actions>
                    <x-button label="update" icon="o-check" class="btn-primary" type="submit" spinner="update" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </x-modal>

    <x-modal title="Delete Personnel" wire:model="deletePersonnel">
        <x-card>
            <div>Are you sure you want to delete personnel <strong>{{$personnel}}</strong>?</div>
        </x-card>
        <x-slot:actions>
            <x-button label="Delete" icon="o-trash" wire:click="delete" class="btn-error" type="submit"
                spinner="delete" />
        </x-slot:actions>
    </x-modal>
</div>