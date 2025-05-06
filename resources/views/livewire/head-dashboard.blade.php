<div class="p-6 space-y-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Research Department Overview</h1>
            <p class="text-gray-600">Welcome back, {{ auth()->user()->fullName() }}</p>
        </div>
        <div class="text-right">
            <div class="text-sm text-gray-600">Academic Year</div>
            <div class="text-lg font-semibold text-blue-600">
                {{ $activeSchoolYear?->name ?? 'Not Set' }}
            </div>
        </div>
    </div>

    <!-- Current Phase Card -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold">Current Research Phase</h2>
                <p class="text-3xl font-bold mt-2">{{ $currentPhase }}</p>
            </div>
            <x-icon name="o-academic-cap" class="w-16 h-16 opacity-50" />
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Students -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Total Students</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $statistics['students'] }}</h3>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <x-icon name="o-users" class="w-6 h-6 text-blue-600" />
                </div>
            </div>
        </div>

        <!-- Total Professors -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Total Professors</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $statistics['professors'] }}</h3>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <x-icon name="o-user-circle" class="w-6 h-6 text-green-600" />
                </div>
            </div>
        </div>

        <!-- Research Groups -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Research Groups</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $statistics['groups'] }}</h3>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <x-icon name="o-user-group" class="w-6 h-6 text-purple-600" />
                </div>
            </div>
        </div>

        <!-- Active Research -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500">Active Research</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">0</h3>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <x-icon name="o-document-text" class="w-6 h-6 text-yellow-600" />
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-card title="Quick Actions">
            <div class="space-y-3">
                <x-button icon="o-plus" label="New School Year" class="btn-primary w-full" />
                <x-button icon="o-academic-cap" label="Manage Phases" class="btn-outline w-full" />
                <x-button icon="o-user-plus" label="Add Professor" class="btn-outline w-full" />
            </div>
        </x-card>

        <x-card title="Recent Activities" class="md:col-span-2">
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <p class="text-sm">New research group formed</p>
                    <span class="text-xs text-gray-500 ml-auto">2 hours ago</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <p class="text-sm">Phase 1 completed for Group A</p>
                    <span class="text-xs text-gray-500 ml-auto">1 day ago</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                    <p class="text-sm">New professor assigned</p>
                    <span class="text-xs text-gray-500 ml-auto">2 days ago</span>
                </div>
            </div>
        </x-card>
    </div>
</div>
