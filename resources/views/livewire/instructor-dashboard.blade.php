<div class="p-6 space-y-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Instructor Dashboard</h1>
            <p class="text-gray-600">Welcome back, {{ auth()->user()->fullName() }}</p>
        </div>
        <div class="text-right">
            <div class="text-sm text-gray-600">Academic Year</div>
            <div class="text-lg font-semibold text-blue-600">
                {{ $activeSchoolYear?->name ?? 'Not Set' }}
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-stat title="Total Students" value="{{$totalStudents}}" description="Overall" icon="o-academic-cap" tooltip="Total Students" color="text-info" class="text-primary" />

        <x-stat title="Total Groups" value="{{$totalGroups}}" description="Overall" icon="o-user-group" tooltip="Total Groups" color="text-success" class="text-primary" />
                
        <x-stat title="Total Sections" value="{{$totalSections}}" description="Overall" icon="o-academic-cap" tooltip="Total Sections" color="text-warning"  />
        <x-stat title="Total Groups Assigned" value="{{$assignedGroups}}" description="Overall" icon="o-clipboard-document-check" tooltip="Total Groups Assigned" color="text-orange-600"  />
    </div>

    <!-- Assigned Groups -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <x-card title="Latest Announcements">
                <div class="space-y-4">
                    @forelse($announcements as $announcement)
                        <div class="border-b border-gray-100 last:border-0 pb-4 last:pb-0">
                            <h4 class="font-medium">{{ $announcement->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($announcement->content, 100) }}</p>
                            <div class="flex items-center gap-2 mt-2 text-sm text-gray-500">
                                <x-icon name="o-clock" class="w-4 h-4" />
                                {{ $announcement->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">
                            <x-icon name="o-information-circle" class="w-8 h-8 mx-auto mb-2" />
                            <p>No announcements yet.</p>
                        </div>
                    @endforelse


                </div>
            </x-card>
        </div>

        <!-- Latest Announcements -->
        <div>
            <x-card title="Assigned Groups">
                <div class="space-y-4">
                    @forelse($assignments as $group)
                        <div
                            class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div>
                                <h4 class="font-medium">{{ $group->group->title }}</h4>
                                <p class="text-sm text-gray-600">{{ $group->group->section->name }} -
                                    {{ $group->group->schoolYear->name }}</p>
                                <p class="text-sm text-gray-600">Thesis Advicer:
                                    {{ $group->group->section->professor->fullName() }}</p>
                            </div>
                            <x-button icon="o-arrow-right" class="btn-ghost btn-sm"
                                wire:click="viewGroup({{ $group->group->id }})" />
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">
                            <x-icon name="o-information-circle" class="w-8 h-8 mx-auto mb-2" />
                            <p>No assigned groups yet.</p>
                        </div>
                    @endforelse
                </div>
            </x-card>
        </div>
    </div>
</div>