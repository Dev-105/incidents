<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <!-- Profile Header Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 mb-8">
            <div class="h-24 bg-gradient-to-r from-green-400 to-green-600"></div>
            
            <div class="relative px-6 pb-6 md:p-8">
                <!-- Avatar -->
                <div class="absolute -top-12 left-6 md:left-8">
                    <div class="w-24 h-24 bg-white rounded-2xl shadow-lg flex items-center justify-center border-4 border-white">
                        <div class="w-full h-full bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center">
                            <span class="text-3xl font-bold text-green-700">
                                {{ substr(auth()->user()->name, 0, 2) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- User Info -->
                <div class="mt-16 md:mt-14">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                                {{ auth()->user()->name }}
                            </h1>
                            <p class="text-gray-500 mt-1">
                                Membre depuis {{ auth()->user()->created_at->format('F Y') }}
                            </p>
                        </div>
                        
                        <!-- Edit Profile Button -->
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-4 py-2 rounded-xl transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Modifier le profil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Information Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 mb-8">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Informations personnelles
                </h2>
            </div>
            
            <div class="p-6 md:p-8 space-y-6">
                <!-- Name Field -->
                <div class="flex flex-col md:flex-row md:items-center gap-3 pb-4 border-b border-gray-100">
                    <div class="md:w-32">
                        <label class="text-sm font-semibold text-gray-700">Nom complet</label>
                    </div>
                    <div class="flex-1">
                        <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="text-gray-900 font-medium">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Email Field -->
                <div class="flex flex-col md:flex-row md:items-center gap-3 pb-4 border-b border-gray-100">
                    <div class="md:w-32">
                        <label class="text-sm font-semibold text-gray-700">Adresse email</label>
                    </div>
                    <div class="flex-1">
                        <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-900">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member Since Field -->
                <div class="flex flex-col md:flex-row md:items-center gap-3">
                    <div class="md:w-32">
                        <label class="text-sm font-semibold text-gray-700">Membre depuis</label>
                    </div>
                    <div class="flex-1">
                        <div class="bg-gray-50 rounded-xl px-4 py-3 border border-gray-200">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-900">{{ auth()->user()->created_at->format('d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User's Posts Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                <div class="flex items-center justify-between flex-wrap gap-3">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        Vos signalements
                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">
                            {{ auth()->user()->posts->count() }}
                        </span>
                    </h2>
                    
                    <a href="{{ route('posts.create') }}" class="inline-flex items-center gap-1 bg-green-500 hover:bg-green-600 text-white text-sm font-medium px-3 py-1.5 rounded-full transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Nouveau signalement
                    </a>
                </div>
            </div>
            
            <div class="p-6 md:p-8">
                @if(auth()->user()->posts->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucun signalement</h3>
                        <p class="text-gray-500 mb-4">Vous n'avez encore créé aucun signalement.</p>
                        <a href="{{ route('posts.create') }}" class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-medium px-6 py-2 rounded-full shadow-md transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Créer mon premier signalement
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach(auth()->user()->posts as $post)
                            <div class="group bg-gray-50 hover:bg-white rounded-xl p-4 border border-gray-200 hover:border-green-200 hover:shadow-md transition-all duration-200">
                                <div class="flex items-start justify-between flex-wrap gap-3">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                            <a href="{{ route('posts.show', $post) }}" class="hover:text-green-600 transition-colors">
                                                {{ $post->title }}
                                            </a>
                                        </h4>
                                        <div class="flex flex-wrap items-center gap-3 text-sm">
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-white rounded-full text-gray-600 border border-gray-200">
                                                <span>{{ $post->category->icon ?? '📌' }}</span>
                                                <span>{{ $post->category->name ?? 'Non catégorisé' }}</span>
                                            </span>
                                            <span class="text-gray-400">•</span>
                                            <span class="inline-flex items-center gap-1 text-gray-500">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $post->created_at->format('d M Y') }}
                                            </span>
                                            <span class="inline-flex items-center gap-1 text-gray-500">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                {{ $post->comments->count() }} commentaire(s)
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Action buttons -->
                                    <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <a href="{{ route('posts.edit', $post) }}" class="p-2 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors" title="Modifier">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 hover:bg-red-100 rounded-lg transition-colors" onclick="return confirm('Supprimer ce signalement ?')" title="Supprimer">
                                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>