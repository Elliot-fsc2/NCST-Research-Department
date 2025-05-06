<nav class="bg-blue-700 text-white px-6 py-4 flex justify-between items-center">
    <div class="flex items-center">
        <img src="{{ asset('images/ncst.png') }}" alt="NCST Logo" class="h-10 mr-3">
        <span class="text-lg font-semibold">NCST Research Department</span>
    </div>

    <!-- Mobile Sidebar Menu (Alpine.js) -->
    <div x-data="{ open: false }" class="sm:hidden">
        <button @click="open = true" class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <!-- Overlay -->
        <div x-show="open" @click="open = false" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 z-40">
        </div>

        <!-- Sidebar Menu -->
        <div x-show="open" x-transition:enter="transition-transform transform ease-in-out duration-300"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition-transform transform ease-in-out duration-300"
            x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
            class="fixed top-0 left-0 h-full w-64 bg-blue-900 text-white shadow-lg z-50 p-6 flex flex-col space-y-4">

            <!-- Close Button -->
            <button @click="open = false" class="self-end text-white">
                ✕
            </button>

            <a href="/" class="block px-4 py-3 hover:bg-blue-800 rounded">Home</a>

            <a href="/about" class="block px-4 py-3 hover:bg-blue-800 rounded">About</a>
            <a href="/contact" class="block px-4 py-3 hover:bg-blue-800 rounded">Contact</a>
            <a href="/login"
                class="bg-yellow-500 px-4 py-3 text-center text-black font-semibold hover:bg-yellow-400 block rounded">Sign
                in</a>
        </div>
    </div>

    <!-- Desktop Menu -->
    <div class="hidden sm:flex space-x-6">
        <a href="/" class="hover:bg-blue-800 px-4 py-2 rounded">Home</a>
        <a href="/about" class="hover:bg-blue-800 px-4 py-2 rounded">About</a>
        <a href="/contact" class="hover:bg-blue-800 px-4 py-2 rounded">Contact</a>


        <a href="/login" class="bg-yellow-500 px-4 py-2 rounded-md text-black font-semibold hover:bg-yellow-400">Sign
            in</a>
    </div>
</nav>