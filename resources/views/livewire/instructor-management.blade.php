<div>
    <x-card title="Instructor Management" subtitle="Activate/Deactivate Instructors" shadow separator>
        <x-slot:menu>
            <x-input placeholder="Search" inline wire:model.live="search" />
        </x-slot:menu>
        <x-table :headers="$headers" :rows="$users" :sort-by="$sortBy" with-pagination show-empty-text>
            @scope('cell_id', $user)
            {{ $loop->index + 1  }}
            @endscope
            @scope('cell_handledSections', $user)
            {{ $user->handledSections()->count() }}
            @endscope
            @scope('cell_is_active', $user)
            @if($user->is_active)
                <x-badge value="Active" class="badge-success" />
            @else
                <x-badge value="Inactive" class="badge-error" />
            @endif
            @endscope
            @scope('actions', $user)
            @if($user->is_active)
                <x-button wire:click="toggleStatus({{$user}})" label="Deactivate" class="btn-error btn-sm btn-outline" />
            @else
                <x-button wire:click="toggleStatus({{$user}})" label="Activate" class="btn-primary btn-sm btn-outline" />
            @endif
            @endscope
        </x-table>
    </x-card>
</div>