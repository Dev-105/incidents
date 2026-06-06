<x-app-layout>
    <div class="card">
        <h2>Mon profil</h2>
        <p class="meta">Bonjour, {{ auth()->user()->name }}. Cette page affiche vos informations et vos signalements.</p>

        <div class="form-group">
            <strong>Name:</strong>
            <p>{{ auth()->user()->name }}</p>
        </div>

        <div class="form-group">
            <strong>Email:</strong>
            <p>{{ auth()->user()->email }}</p>
        </div>
    </div>

    <div class="card">
        <h3>Vos signalements</h3>
        @if(auth()->user()->posts->isEmpty())
            <p>Vous n’avez encore créé aucun signalement.</p>
        @else
            @foreach(auth()->user()->posts as $post)
                <div class="post-preview">
                    <h4><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h4>
                    <div class="meta">{{ $post->category->icon }} {{ $post->category->name }} · {{ $post->created_at->format('d M Y') }}</div>
                </div>
            @endforeach
        @endif
    </div>
</x-app-layout>
