<div>
    @include('layouts.navigation')
    <section class="relative bg-cover bg-center h-[90vh] flex items-center justify-center px-6 text-center"
        style="background-image: url('{{ asset('images/library.jpg') }}');">
        <div class="backdrop-blur-sm bg-black-600/10 text-white p-6 sm:p-10 rounded-lg w-full max-w-3xl">
            <h1 class="text-2xl sm:text-4xl font-bold">Empowering Research with Innovation</h1>
            <p class="mt-3 sm:mt-4 text-sm sm:text-lg">Access a wide range of resources, consult with professors, and
                contribute to research at NCST.</p>
            <div class="mt-6 flex flex-col items-center sm:flex-row sm:justify-center gap-3">
                <a href="/get-started"
                    class="bg-blue-500 px-4 py-2 sm:px-6 sm:py-3 text-white rounded-lg font-semibold hover:bg-blue-400">Get
                    Started ➜</a>
                <button wire:click="$toggle('showInfo')"
                    class="bg-white px-4 py-2 sm:px-6 sm:py-3 text-black rounded-lg font-semibold hover:bg-gray-200">Learn
                    More</button>
            </div>

            <!-- Livewire: Learn More Section -->
            @if($showInfo)
            <div class="mt-6 bg-white text-black p-4 rounded-lg">
                <p class="text-sm sm:text-base">Our platform simplifies research management, helping students and
                    professors collaborate efficiently.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-12 bg-yellow-400 px-6">
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-4 sm:p-6 shadow-lg rounded-lg flex flex-col items-center text-center">
                <img src="{{ asset('icons/book.png') }}" class="h-12" alt="Book Icon">
                <h3 class="text-lg font-semibold mt-3">Thesis Group Management</h3>
                <p class="mt-2 text-gray-600 text-sm sm:text-base">Easily create, manage, and track thesis groups with
                    automated workflows.</p>
            </div>

            <div class="bg-white p-4 sm:p-6 shadow-lg rounded-lg flex flex-col items-center text-center">
                <img src="{{ asset('icons/personnel.png') }}" class="h-12" alt="Personnel Icon">
                <h3 class="text-lg font-semibold mt-3">Personnel Assignment</h3>
                <p class="mt-2 text-gray-600 text-sm sm:text-base">Assign advisers, statisticians, and language critics
                    effortlessly.</p>
            </div>

            <div class="bg-white p-4 sm:p-6 shadow-lg rounded-lg flex flex-col items-center text-center">
                <img src="{{ asset('icons/ai.png') }}" class="h-12" alt="AI Icon">
                <h3 class="text-lg font-semibold mt-3">AI-Powered Insights</h3>
                <p class="mt-2 text-gray-600 text-sm sm:text-base">Get intelligent suggestions and validate thesis
                    topics with AI.</p>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="relative bg-cover bg-center h-[50vh] flex items-center justify-center px-6 text-center"
        style="background-image: url('{{ asset('images/library.jpg') }}');">
        <div class="bg-black bg-opacity-50 text-white p-6 sm:p-10 rounded-lg w-full max-w-3xl">
            <h2 class="text-2xl sm:text-3xl font-bold">Ready to streamline your research department?</h2>
            <p class="mt-3 sm:mt-4 text-sm sm:text-lg">Join universities that have transformed their research process
                with our platform.</p>
            <div class="mt-6 flex flex-col items-center sm:flex-row sm:justify-center gap-3">
                <a href="/get-started"
                    class="bg-blue-500 px-4 py-2 sm:px-6 sm:py-3 text-white rounded-lg font-semibold hover:bg-blue-400">Get
                    Started ➜</a>
                <button wire:click="$toggle('showInfo')"
                    class="bg-white px-4 py-2 sm:px-6 sm:py-3 text-black rounded-lg font-semibold hover:bg-gray-200">Learn
                    More</button>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-blue-700 text-white text-center py-4 mt-10 text-sm sm:text-base">
        <p>&copy; {{ date('Y') }} NCST Research Department. All Rights Reserved.</p>
    </footer>
</div>