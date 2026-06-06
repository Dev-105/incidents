<x-app-layout>
    <div class="card">
        <h2>Incidents à Rabat</h2>
        <p class="meta">Consultez tous les signalements. Les visiteurs peuvent lire, les utilisateurs connectés peuvent créer.</p>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @foreach($posts as $post)
        <div class="card post-preview">
            <h3><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h3>
            <div class="meta">{{ $post->category->icon }} {{ $post->category->name }} · Publié par {{ $post->user->name }} · {{ $post->created_at->format('d M Y') }}</div>
            <p>{{ \Illuminate\Support\Str::limit($post->description, 180) }}</p>
            <a href="{{ route('posts.show', $post) }}">Voir les détails</a>
        </div>
    @endforeach

    <div class="card">
        {{ $posts->links() }}
    </div>
</x-app-layout>
