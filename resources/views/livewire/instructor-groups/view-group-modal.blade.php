@if($selectedGroup)
    <x-modal wire:model="isViewingGroupModal" title="{{ $selectedGroup->title }}">
        <div class="p-6">
            <div class="space-y-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Group Details</h3>
                    <div class="mt-2 space-y-2">
                        <p class="text-sm text-gray-600">Section: {{ $selectedGroup->section->name }}</p>
                        <p class="text-sm text-gray-600">Course: {{ $selectedGroup->section->course->name }}</p>
                        <p class="text-sm text-gray-600">School Year: {{ $selectedGroup->schoolYear->name }}</p>
                        <p class="text-sm text-gray-600">Phase: {{ $selectedGroup->thesisPhase->name }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900">Group Leader</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Leader: {{ $selectedGroup->leader->student->fullName() }}
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900">Members</h3>
                    <ul class="mt-2 space-y-2">
                        @foreach($selectedGroup->members as $member)
                            <li class="text-sm text-gray-600">{{ $member->student->fullName() }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </x-modal>
    @endif