<div class="p-4" wire:poll.30s>
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <x-card class="bg-gradient-to-br from-blue-500 to-blue-600 text-white">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-600">
                    <x-icon name="o-document-text" class="w-8 h-8" />
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">My Thesis</h3>
                    <p class="text-sm opacity-90">Current Status: In Progress</p>
                </div>
            </div>
        </x-card>

        <x-card class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-600">
                    <x-icon name="o-users" class="w-8 h-8" />
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">My Group</h3>
                    <p class="text-sm opacity-90">4 Members</p>
                </div>
            </div>
        </x-card>

        <x-card class="bg-gradient-to-br from-green-500 to-green-600 text-white">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-600">
                    <x-icon name="o-calendar" class="w-8 h-8" />
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Next Defense</h3>
                    <p class="text-sm opacity-90">In 15 Days</p>
                </div>
            </div>
        </x-card>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <x-card title="Thesis Progress">
                <div class="space-y-4">
                    @foreach($thesisProgress as $progress)
                    <div class="flex justify-between items-center">
                        <span class="font-medium">{{ $progress['chapter'] }}</span>
                        <span @class([
                            'text-green-600' => $progress['status'] === 'Completed',
                            'text-blue-600' => $progress['status'] === 'In Progress',
                            'text-gray-600' => $progress['status'] === 'Pending',
                        ])>{{ $progress['status'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div @class([
                            'h-2.5 rounded-full',
                            'bg-green-600' => $progress['status'] === 'Completed',
                            'bg-blue-600' => $progress['status'] === 'In Progress',
                            'bg-gray-600' => $progress['status'] === 'Pending',
                        ]) style="width: {{ $progress['progress'] }}%"></div>
                    </div>
                    @endforeach
                </div>
            </x-card>

            <x-card title="Recent Activities" wire:poll.5s>
                <div class="space-y-4">
                    @foreach($recentActivities as $activity)
                    <div class="flex items-center gap-4">
                        <div @class([
                            'w-2 h-2 rounded-full',
                            'bg-blue-500' => $activity['type'] === 'info',
                            'bg-green-500' => $activity['type'] === 'success',
                            'bg-yellow-500' => $activity['type'] === 'warning',
                        ])></div>
                        <p class="text-sm">{{ $activity['activity'] }}</p>
                        <span class="text-xs text-gray-500 ml-auto">{{ $activity['time'] }}</span>
                    </div>
                    @endforeach
                </div>
            </x-card>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <x-card title="Research Team">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <x-avatar />
                        <div>
                            <p class="font-medium">Dr. Smith</p>
                            <p class="text-sm text-gray-600">Adviser</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <x-avatar />
                        <div>
                            <p class="font-medium">Prof. Johnson</p>
                            <p class="text-sm text-gray-600">Statistician</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <x-avatar />
                        <div>
                            <p class="font-medium">Dr. Williams</p>
                            <p class="text-sm text-gray-600">Technical Adviser</p>
                        </div>
                    </div>
                </div>
            </x-card>

            <x-card title="Upcoming Deadlines">
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium">Chapter 2 Revision</p>
                            <p class="text-sm text-gray-600">Due in 3 days</p>
                        </div>
                        <x-badge label="Urgent" class="badge-error" />
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium">Defense Presentation</p>
                            <p class="text-sm text-gray-600">Due in 2 weeks</p>
                        </div>
                        <x-badge label="Upcoming" class="badge-warning" />
                    </div>
                </div>
            </x-card>
        </div>
    </div>
</div>
