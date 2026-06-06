<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo / Brand -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('posts.index') }}" class="text-xl font-semibold text-gray-900 tracking-tight hover:text-green-600 transition-colors">
                    Incidents
                </a>
                
                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex space-x-1">
                    <a href="{{ route('posts.index') }}" class="px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200">
                        Accueil
                    </a>
                </nav>
            </div>
            
            <!-- Right side buttons -->
            <div class="flex items-center space-x-3">
                @auth
                    <!-- Create Button (iOS style) -->
                    <a href="{{ route('posts.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-full shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                        + Créer un signalement
                    </a>
                    
                    <!-- Profile Dropdown (iOS style) -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-full transition-all duration-200">
                            <span class="text-sm font-medium text-gray-700">Profil</span>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50" style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                Mon profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 transition-colors">
                                    Se déconnecter
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 font-medium transition-colors">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-full shadow-md hover:shadow-lg transition-all duration-200">
                        Inscription
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<!-- Add Alpine.js for dropdown functionality -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>