<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-0 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Announcements</h1>
        <x-button label="Create Announcement" icon="o-plus" class="btn-primary w-full sm:w-auto" wire:click="$set('isModalOpen', true)" />
    </div>

    <!-- Announcements List -->
    <div class="space-y-4">
        @foreach($announcements as $announcement)
            <x-card>
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $announcement->title }}</h3>
                        <p class="text-gray-600 mt-2">{{ $announcement->content }}</p>
                        <div class="flex items-center gap-2 mt-3 text-sm text-gray-500">
                            <x-icon name="o-clock" class="w-4 h-4" />
                            {{ $announcement->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <x-button icon="o-pencil" class="btn-ghost btn-sm" 
                            wire:click="editAnnouncement({{ $announcement->id }})" />
                        <x-button icon="o-trash" class="btn-ghost btn-sm text-red-500" 
                            wire:confirm="Are you sure you want to delete this announcement?"
                            wire:click="deleteAnnouncement({{ $announcement->id }})" />
                    </div>
                </div>
            </x-card>
        @endforeach

        <div class="mt-4">
            {{ $announcements->links() }}
        </div>
    </div>

    <!-- Create/Edit Modal -->
    <x-modal wire:model="isModalOpen">
        <x-card title="{{ $editingId ? 'Edit Announcement' : 'Create Announcement' }}">
            <div class="space-y-2">
                <x-input label="Title" wire:model="title" placeholder="Enter announcement title" />
                
                <x-textarea label="Content" wire:model="content" placeholder="Enter announcement content" rows="6" />
            </div>

            <x-slot:actions>
                <div class="flex flex-col sm:flex-row justify-end gap-1">
                    <x-button label="Save" class="btn-primary w-full sm:w-auto" 
                        wire:click="{{ $editingId ? 'updateAnnouncement' : 'createAnnouncement' }}" />
                </div>
            </x-slot:actions>
        </x-card>
    </x-modal>
</div>
