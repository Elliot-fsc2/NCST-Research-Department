<div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Research Groups</h1>
    </div>

    <!-- Departments Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($departments as $department)
            <x-card>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-blue-700">{{ $department->name }}</h3>
                        <x-badge :value="$department->groups->count() . ' Groups'" />
                    </div>

                    <!-- Groups in Department -->
                    <div class="space-y-3">
                        @foreach($department->groups as $group)
                            <div class="border rounded-lg p-3 hover:bg-gray-50 cursor-pointer"
                                wire:click="viewGroup({{ $group->id }})">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium">{{ $group->name }}</h4>
                                        <p class="text-sm text-gray-600">
                                            Adviser: {{ $group->adviser->fullName() }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $group->members->count() }} Members
                                        </p>
                                    </div>
                                    <x-badge :value="$group->status" class="badge-primary" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </x-card>
        @endforeach
    </div>

    <!-- Group Details Modal -->
    <x-modal wire:model="showGroupDetails" size="lg">
        @if($selectedGroup)
            <x-card title="{{ $selectedGroup->name }}">
                <div class="space-y-6">
                    <!-- Basic Info -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Department</h4>
                            <p>{{ $selectedGroup->department->name }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Course</h4>
                            <p>{{ $selectedGroup->course->name }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Status</h4>
                            <x-badge :value="$selectedGroup->status" />
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Created</h4>
                            <p>{{ $selectedGroup->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Adviser -->
                    <div>
                        <h4 class="font-medium mb-2">Research Adviser</h4>
                        <x-list-item :item="$selectedGroup->adviser">
                            <x-slot:avatar>
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-700 font-medium">
                                        {{ substr($selectedGroup->adviser->first_name, 0, 1) }}
                                    </span>
                                </div>
                            </x-slot:avatar>
                            <x-slot:value>
                                {{ $selectedGroup->adviser->fullName() }}
                            </x-slot:value>
                            <x-slot:sub-value>
                                Adviser
                            </x-slot:sub-value>
                        </x-list-item>
                    </div>

                    <!-- Members -->
                    <div>
                        <h4 class="font-medium mb-2">Group Members</h4>
                        <div class="space-y-2">
                            @foreach($selectedGroup->members as $member)
                                <x-list-item :item="$member">
                                    <x-slot:avatar>
                                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                                            <span class="text-gray-700 font-medium">
                                                {{ substr($member->first_name, 0, 1) }}
                                            </span>
                                        </div>
                                    </x-slot:avatar>
                                    <x-slot:value>
                                        {{ $member->fullName() }}
                                    </x-slot:value>
                                    <x-slot:sub-value>
                                        {{ $member->student_number }}
                                    </x-slot:sub-value>
                                </x-list-item>
                            @endforeach
                        </div>
                    </div>
                </div>

                <x-slot:footer>
                    <div class="flex justify-end">
                        <x-button label="Close" wire:click="$set('showGroupDetails', false)" />
                    </div>
                </x-slot:footer>
            </x-card>
        @endif
    </x-modal>
</div>
