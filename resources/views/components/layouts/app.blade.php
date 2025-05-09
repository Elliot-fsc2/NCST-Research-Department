<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-poppins antialiased bg-base-200">
    {{-- NAVBAR mobile only --}}
    <x-nav sticky full-width class="bg-blue-700 text-white">

        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            <label class="mr-3">
                <img src="{{asset('images/ncst.png')}}" alt="logo" class="w-10 h-10 object-contain">
            </label>

            {{-- Brand --}}
            <div>NCST Research Department</div>
        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>
            <x-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />
            <x-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />
        </x-slot:actions>
    </x-nav>

    {{-- The main content with `full-width` --}}
    <x-main with-nav full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 ">

            {{-- User --}}
            @if($user = auth()->user())
                <x-list-item :item="$user" class="pt-2">
                    <x-slot:avatar>
                        <div class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center">
                            <span class="text-lg font-semibold text-white">{{ substr($user->first_name, 0, 1) }}</span>
                        </div>
                    </x-slot:avatar>
                    <x-slot:value>
                        <span class="font-medium">{{ $user->fullName() }}</span>
                    </x-slot:value>
                    <x-slot:sub-value>
                        <span>{{ $user->role }}</span>
                    </x-slot:sub-value>
                    <x-slot:actions>
                        <x-dropdown class="btn-circle btn-ghost btn-xs">
                            <x-menu-item title="Logout" icon="o-power" link="/logout" />
                        </x-dropdown>
                    </x-slot:actions>
                </x-list-item>
                <x-menu-separator />
            @endif

            {{-- Activates the menu item when a route matches the `link` property --}}
            <x-menu activate-by-route>
                {{-- <x-menu-item title="Home" icon="o-home" link="###" />
                <x-menu-item title="Messages" icon="o-envelope" link="###" />
                <x-menu-sub title="Settings" icon="o-cog-6-tooth">
                    <x-menu-item title="Wifi" icon="o-wifi" link="####" />
                    <x-menu-item title="Archives" icon="o-archive-box" link="####" />
                </x-menu-sub> --}}

                @if(auth()->user()->isStudent())
                    <x-menu-item title="Dashboard" icon="o-book-open" link="/student/dashboard" />
                    <x-menu-item title="Research Group" icon="o-book-open" link="/student/group" />

                    <x-menu-separator />

                    <x-menu-item title="Library" icon="o-book-open" link="/student/library" />
                    <x-menu-item title="Title Checker" icon="o-book-open" link="/student/checker" />
                @endif

                @if(auth()->user()->isResearchHead())
                    <x-menu-item title="Dashboard" icon="o-book-open" link="/head/dashboard" />
                    <x-menu-item title="Announcement" icon="o-exclamation-triangle" link="/head/announcements" />
                    <x-menu-item title="My Groups" icon="o-user-group" link="/head/groups" />

                    <x-menu-sub title="Thesis Management" icon="o-adjustments-horizontal" >
                        <x-menu-item title="Group Masterlist" icon="o-user-group" link="/head/masterlist"/>
                    </x-menu-sub>

                    <x-menu-sub title="Management" icon="o-adjustments-horizontal" >
                        <x-menu-item title="Personnel Management" icon="o-user-group" link="/head/personnel-management"/>
                        <x-menu-item title="Instructor Management" icon="o-user-group" link="/head/instructor-management"/>
                        <x-menu-item title="Custom Role Management" icon="o-user-group" link="/head/role-management"/>
                        <x-menu-item title="Department and Course Management" icon="o-user-group" link="/head/department-course-management"/>
                    </x-menu-sub>

                    <x-menu-separator />

                    <x-menu-item title="Library" icon="o-book-open" link="/head/library" />
                    <x-menu-item title="Title Checker" icon="o-book-open" link="/head/checker" />
                @endif

                @if(auth()->user()->isProfessor())
                <x-menu-item title="Dashboard" icon="o-book-open" link="/professor/dashboard" />
                <x-menu-item title="My Groups" icon="o-user-group" link="/professor/courses" />
                @endif
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{-- TOAST area --}}
    <x-toast />
</body>

</html>