<header class="w-full sticky top-0 z-50 bg-white shadow-md">
    <div class="container mx-auto px-4">
        <nav class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="/" class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-700 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-lg">LM</span>
                    </div>
                    <span class="text-xl font-bold text-gray-800">Local<span
                            class="bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">Mind</span></span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="/"
                    class="{{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} font-medium px-3 py-2 rounded-lg hover:bg-blue-50 transition">
                    <i class="fas fa-question-circle mr-2"></i>All Questions
                </a>
                <a href="/myquestions"
                    class="{{ request()->routeIs('myquestions') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} font-medium px-3 py-2 rounded-lg hover:bg-blue-50 transition">
                    <i class="fa-regular fa-circle-question mr-2"></i>My Questions
                </a>
                @if ($user->role == 'admin')
                    <a href="/management"
                        class="{{ request()->routeIs('management') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} font-medium px-3 py-2 rounded-lg hover:bg-blue-50 transition">
                        <i class="fas fa-list-check mr-2"></i>Management
                    </a>
                @endif

                <!-- Ask Question Button -->
                <a href="/newpost"
                    class="ml-4 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-indigo-700 transition shadow-md hover:shadow-lg">
                    <i class="fas fa-plus mr-2"></i>Post a question
                </a>

                <a href="/logout"
                    class="ml-4 px-4 py-2 bg-gradient-to-r from-red-500 to-red-700 text-white font-medium rounded-xl hover:from-red-600 hover:to-red-700 transition shadow-md hover:shadow-lg">
                    <i class="fas fa-right-from-bracket mr-2"></i>Logout
                </a>

                <!-- User Menu -->
                <div class="relative ml-4">
                    <a href="{{ route('profile') }}"
                        class="{{ request()->routeIs('profile') ? 'bg-blue-200' : 'hover:bg-gray-100' }} flex items-center space-x-2 px-3 py-2 rounded-xl  transition">
                        <div
                            class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-900 to-blue-500 flex items-center justify-center text-white font-medium">
                            {{ ucfirst(substr($user->name, 0, 1)) }}
                        </div>
                        <span class="text-gray-700 font-medium">{{ $user->name }}</span>
                    </a>
                </div>

            </div>

            <!-- Mobile Menu Button -->
            <button
                class="md:hidden w-10 h-10 flex items-center justify-center text-gray-700 hover:text-blue-600 hover:bg-gray-100 rounded-full transition">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </nav>
    </div>
</header>
