<div>
    <x-card>
        <x-header title="Groups Overview" separator progress-indicator />
        <x-breadcrumbs :items="$breadcrumbs" />

        <div class="flex justify-between items-center mb-6 mt-4">
            <h2 class="text-xl font-semibold text-gray-800">{{ $section->name }} Groups</h2>
            @if ($schoolYear || $thesisPhases)                
                <x-button label="Add Group" icon="o-plus" class="btn-primary" @click="$wire.addGroupModal = true" />
            @endif
        </div>

        <!-- Groups Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($groups as $group)
                <x-card title="{{ $group->title }}" subtitle="{{ $group->groupMembers->count() }} Members" 
                    class="bg-gray-100 shadow-md transition-all duration-200 cursor-pointer">

                    @if($group->leader)
                        <p class="text-gray-600 mb-2">Leader: {{ $group->leader->student->fullName() }}</p>
                    @endif

                    <div class="flex justify-between items-center text-sm text-gray-600">
                        <span>{{ $group->thesisPhase ? $group->thesisPhase->name : 'No Phase' }}</span>
                    </div>

                    <x-slot:menu>
                        <x-button icon="o-eye" wire:click="viewGroup({{$group->id}})" class="btn-info btn-circle" />
                    </x-slot:menu>
                </x-card>
            @endforeach
        </div>
    </x-card>

    {{-- add Group modal --}}
    <x-modal wire:model="addGroupModal" title="Add Group">
        <div class="p-4">
            <x-form wire:submit="addGroup">
                <x-input label="Group Title" wire:model.live="form.title" />
                <x-slot:actions>
                    <x-button label="Add Group" class="btn-primary" type="submit" wire:confirm="asdas"
                        spinner="addGroup" />
                </x-slot:actions>
            </x-form>
        </div>
    </x-modal>
 
    {{-- Group Details Modal --}}
    <x-modal wire:model="viewModal" title="Group Details">
            <h3 class="text-lg font-semibold mb-4">{{ $selectedGroup['title'] }}</h3>
            <div class="space-y-4">
                <!-- Members List -->
                <div>
                    <h4 class="font-medium mb-2">Group Members:</h4>
                    <div class="space-y-2">
                        @foreach($groupMembers as $member)
                                <div>
                                    <x-list-item :item="$member" value="student_name">
                                        @if($member['is_leader'])
                                            <x-slot:actions>
                                                <x-badge value="Leader" class="badge-success" />
                                            </x-slot:actions>
                                        @endif
                                    </x-list-item>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <x-slot:actions>
                <x-button label="Edit Group" class="btn-primary" />
                <x-button label="Edit Members" wire:click="addMembers({{$selectedGroup['id']}})" class="btn-primary" />
            </x-slot:actions>
    </x-modal>

    <x-modal title="Edit Members" wire:model="addMembersModal" subtitle="Setup your Group Members for {{$selectedGroup['title']}}">
        <x-form wire:submit="addMember">
            <div class="space-y-4">

                <!-- Add New Members -->
                <x-choices-offline 
                    label="Add Members" 
                    wire:model.live="memberForm.members" 
                    :options="$students" 
                    searchable
                    multiple
                />
            </div>

            <x-slot:actions>
                <x-button label="Update Members" type="submit" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-modal>
</div>