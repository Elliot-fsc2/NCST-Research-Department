<div>
    <x-card>
        <x-header title="Courses" separator progress-indicator />

        <x-breadcrumbs :items="$breadcrumbs" wire:click="loading" wire:navigate />

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6"> 
            @foreach($courses as $course)
                <a href="{{ route('professor.courses.section', ['course_id' => $course->id]) }}"
                    wire:navigate
                    >
                    <x-card title="{{ $course->name }}" subtitle="{{ $course->sections->count() }} Sections" class="bg-gray-100 shadow-md cursor-pointer">
                        <p class="text-gray-600">click to view your sections</p>
                    </x-card>
                </a>
            @endforeach
        </div>
    </x-card>
</div>