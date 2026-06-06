<x-app-layout>
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight mb-2">
                        Incidents à Rabat
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Consultez tous les signalements. Les visiteurs peuvent lire, les utilisateurs connectés peuvent créer.
                    </p>
                </div>
                <!-- iOS-style icon decoration -->
                <div class="hidden md:block w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert (iOS style) -->
    @if(session('success'))
        <div class="mb-6 transform transition-all duration-500 animate-slide-down" id="alert">
            <div class="bg-green-50 border-l-4 border-green-500 rounded-xl shadow-md p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto">
                        <button onclick="document.getElementById('alert').remove()" class="text-green-600 hover:text-green-800">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Posts Grid/Cards -->
    <div class="space-y-6 mb-8">
        @forelse($posts as $post)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden">
                <!-- iOS-style card content -->
                <div class="p-6 md:p-8">
                    <!-- Title with link -->
                    <h3 class="text-xl md:text-2xl font-semibold mb-3">
                        <a href="{{ route('posts.show', $post) }}" class="text-gray-900 hover:text-green-600 transition-colors duration-200">
                            {{ $post->title }}
                        </a>
                    </h3>
                    
                    <!-- Meta information (Category & Author & Date) -->
                    <div class="flex flex-wrap items-center gap-2 mb-4 text-sm">
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 rounded-full text-gray-700">
                            <span class="text-base">{{ $post->category->icon ?? '📌' }}</span>
                            <span class="font-medium">{{ $post->category->name ?? 'Non catégorisé' }}</span>
                        </span>
                        <span class="text-gray-400">•</span>
                        <span class="inline-flex items-center gap-1 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ $post->user->name }}
                        </span>
                        <span class="text-gray-400">•</span>
                        <span class="inline-flex items-center gap-1 text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $post->created_at->format('d M Y') }}
                        </span>
                    </div>
                    
                    <!-- Description preview -->
                    <p class="text-gray-700 leading-relaxed mb-5 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit($post->description, 180) }}
                    </p>
                    
                    <!-- Read more link (iOS style button) -->
                    <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center gap-2 text-green-600 font-medium hover:text-green-700 transition-colors group">
                        <span>Voir les détails</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Optional: Decorative green line at bottom -->
                <div class="h-1 bg-gradient-to-r from-green-400 to-green-600"></div>
            </div>
        @empty
            <!-- Empty state (iOS style) -->
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-100">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucun incident signalé</h3>
                <p class="text-gray-500">Soyez le premier à créer un signalement</p>
                @auth
                    <a href="{{ route('posts.create') }}" class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white font-medium px-6 py-2 rounded-full shadow-md transition-all">
                        Créer un signalement
                    </a>
                @endauth
            </div>
        @endforelse
    </div>

    <!-- Pagination (iOS style) -->
    @if($posts->hasPages())
        <div class="mt-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex justify-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    @endif
</x-app-layout>

<!-- Custom CSS for line-clamp and animations -->
<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-slide-down {
        animation: slideDown 0.3s ease-out;
    }
</style>