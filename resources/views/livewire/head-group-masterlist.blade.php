<div>
    <x-card title="Group MasterList" shadow separator>

       
        <x-slot:menu>
           <x-input placeholder="Search" inline wire:model.live="search" />
        </x-slot:menu>
        
        <x-table :headers="$headers" :rows="$groups" :sort-by="$sortBy" @row-click="$wire.showDetails($event.detail)" show-empty-text with-pagination>>
            @scope('cell_id', $group)
            {{ $loop->index + 1 }}
            @endscope
            @scope('cell_final_defense_date', $group)
            {{ $group->finalDefenseDate() }}
            @endscope
            @scope('cell_status', $group)
            @if($group->is_approved)
                <x-badge value="Active" class="badge-success" />
            @else
                <x-badge value="Pending" class="badge-warning" />
            @endif
            @endscope
        </x-table>
    </x-card>

    <x-modal wire:model="details" title="Group Details">
        <div class="p-4">
            @if($selectedGroup)
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">{{ $selectedGroup['title'] }}</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">School Year</p>
                            <p>{{ $selectedGroup['school_year'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Department</p>
                            <p>{{ $selectedGroup['department'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Course</p>
                            <p>{{ $selectedGroup['course'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Final Defense Date</p>
                            <p>{{ $selectedGroup['final_defense_date'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            @if($selectedGroup['status'] === 'Active')
                                <x-badge value="Active" class="badge-success" />
                            @else
                                <x-badge value="Pending" class="badge-warning" />
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Group Members -->
                <div class="mt-6">
                    <h4 class="font-medium mb-3">Group Members</h4>
                    <div class="space-y-2">
                        @foreach($selectedGroup['members'] as $member)
                            <div class="flex justify-between items-center p-2 bg-gray-50 rounded">
                                <span>{{ $member['student_name'] }}</span>
                                @if($member['is_leader'])
                                    <x-badge value="Leader" class="badge-info" />
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Group Assignments Personnel -->
                <div class="mt-6">
                    <h4 class="font-medium mb-3">Assignment Personnel</h4>
                    <div class="space-y-2">
                        @foreach($selectedGroup['assignments'] as $personnel)
                            <div class="p-2 bg-gray-50 rounded">
                                <div class="flex justify-between items-center">
                                    <span>{{ $personnel['name'] }}</span>
                                    <x-badge value="{{ $personnel['role'] }}" class="badge-info" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </x-modal>

</div>