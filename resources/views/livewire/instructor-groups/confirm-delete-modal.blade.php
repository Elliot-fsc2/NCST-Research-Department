<x-modal wire:model="isConfirmingDelete">
    <div class="p-6">
        <h2 class="text-lg font-semibold text-gray-900">Confirm Delete</h2>
        <p class="mt-2 text-sm text-gray-600">
            Are you sure you want to delete this {{ $deletingType }}? This action cannot be undone.
        </p>

        <div class="mt-6 flex justify-end space-x-3">
            <button wire:click="$set('isConfirmingDelete', false)" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-500">
                Cancel
            </button>
            <button wire:click="confirmDelete" class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600">
                Delete
            </button>
        </div>
    </div>
</x-modal>