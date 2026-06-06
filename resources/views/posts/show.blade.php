<x-app-layout>
    <!-- Main Post Card -->
    <div class="max-w-4xl mx-auto mb-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <!-- Post Header with gradient top border -->
            <div class="h-2 bg-gradient-to-r from-green-400 to-green-600"></div>
            
            <div class="p-6 md:p-8">
                <!-- Title -->
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight mb-4">
                    {{ $post->title }}
                </h1>
                
                <!-- Meta Information -->
                <div class="flex flex-wrap items-center gap-2 mb-4 pb-4 border-b border-gray-100">
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 rounded-full text-gray-700 text-sm">
                        <span class="text-base">{{ $post->category->icon ?? '📌' }}</span>
                        <span class="font-medium">{{ $post->category->name ?? 'Non catégorisé' }}</span>
                    </span>
                    <span class="text-gray-400 text-sm">•</span>
                    <span class="inline-flex items-center gap-1 text-gray-600 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ $post->user->name }}
                    </span>
                    <span class="text-gray-400 text-sm">•</span>
                    <span class="inline-flex items-center gap-1 text-gray-600 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $post->created_at->format('d M Y H:i') }}
                    </span>
                </div>
                
                <!-- Location Info (iOS-style map badge) -->
                <div class="mb-6 bg-blue-50 rounded-xl p-4 border border-blue-100">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 mb-1">Localisation</p>
                            <p class="text-sm text-gray-600">
                                Latitude: {{ $post->latitude }}<br>
                                Longitude: {{ $post->longitude }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Image -->
                @if($post->image)
                    <div class="mb-6 rounded-xl overflow-hidden shadow-md">
                        <img src="{{ asset($post->image) }}" alt="Post image" class="w-full h-auto object-cover">
                    </div>
                @endif
                
                <!-- Description -->
                <div class="prose max-w-none">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $post->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons for Author -->
    @auth
        @if(auth()->id() === $post->user_id)
            <div class="max-w-4xl mx-auto mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-medium px-6 py-3 rounded-xl shadow-md transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Modifier le signalement
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-3 rounded-xl shadow-md transition-all duration-200" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce signalement ?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Supprimer le signalement
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endauth

    <!-- Comments Section -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="p-6 md:p-8">
                <!-- Comments Header -->
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Commentaires</h3>
                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-sm">
                        {{ $post->comments->count() }}
                    </span>
                </div>

                <!-- Comments List -->
                @forelse($post->comments as $comment)
                    <div class="mb-6 last:mb-0 pb-6 last:pb-0 border-b last:border-b-0 border-gray-100">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-semibold text-gray-600">
                                        {{ substr($comment->user->name, 0, 2) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-900 text-sm">{{ $comment->user->name }}</span>
                                    <span class="text-xs text-gray-500 ml-2">{{ $comment->created_at->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                            
                            @if(auth()->check() && auth()->id() === $comment->user_id)
                                <div class="flex gap-2">
                                    <a href="{{ route('comments.edit', $comment) }}" class="text-green-600 hover:text-green-700 text-sm transition-colors">
                                        Modifier
                                    </a>
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600 text-sm transition-colors" onclick="return confirm('Supprimer ce commentaire ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <div class="ml-10">
                            <p class="text-gray-700 leading-relaxed">{{ $comment->content }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500">Aucun commentaire pour le moment</p>
                        <p class="text-sm text-gray-400 mt-1">Soyez le premier à commenter</p>
                    </div>
                @endforelse

                <!-- Add Comment Form -->
                @auth
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Ajouter un commentaire</h4>
                        <form action="{{ route('comments.store', $post) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <textarea 
                                    id="content" 
                                    name="content" 
                                    rows="4"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 resize-none"
                                    placeholder="Partagez votre pensée..."
                                    required
                                >{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-medium px-6 py-3 rounded-xl shadow-md transition-all duration-200 inline-flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Envoyer le commentaire
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                        <p class="text-gray-600">
                            <a href="{{ route('login') }}" class="text-green-600 hover:text-green-700 font-medium">Connectez-vous</a> 
                            pour ajouter un commentaire
                        </p>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>