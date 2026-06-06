<x-app-layout>
    <div class="card">
        <h2>{{ $post->title }}</h2>
        <div class="meta">{{ $post->category->icon }} {{ $post->category->name }} · Publié par {{ $post->user->name }} · {{ $post->created_at->format('d M Y H:i') }}</div>
        <p class="meta">Lieu : {{ $post->latitude }}, {{ $post->longitude }}</p>
        @if($post->image)
            <img src="{{ asset($post->image) }}" alt="Post image" style="width:100%; margin-top:16px; border-radius: 10px;" />
        @endif
        <p style="margin-top:18px; white-space: pre-line;">{{ $post->description }}</p>
    </div>

    @auth
        @if(auth()->id() === $post->user_id)
            <div class="card">
                <a href="{{ route('posts.edit', $post) }}" class="button">Modifier le signalement</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="secondary small">Supprimer le signalement</button>
                </form>
            </div>
        @endif
    @endauth

    <div class="card">
        <h3>Commentaires</h3>

        @foreach($post->comments as $comment)
            <div class="comment">
                <div class="comment-header">
                    <div>{{ $comment->user->name }} · {{ $comment->created_at->format('d M Y H:i') }}</div>
                    @if(auth()->check() && auth()->id() === $comment->user_id)
                        <div class="comment-actions">
                            <a href="{{ route('comments.edit', $comment) }}" class="small">Modifier</a>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="secondary small">Supprimer</button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="comment-body">{{ $comment->content }}</div>
            </div>
        @endforeach

        @auth
            <form action="{{ route('comments.store', $post) }}" method="POST" style="margin-top: 16px;">
                @csrf
                <div class="form-group">
                    <label for="content">Ajouter un commentaire</label>
                    <textarea id="content" name="content" required>{{ old('content') }}</textarea>
                    @error('content')<div class="alert error">{{ $message }}</div>@enderror
                </div>
                <button type="submit">Envoyer le commentaire</button>
            </form>
        @else
            <p>Veuillez <a href="{{ route('login') }}">vous connecter</a> pour ajouter un commentaire.</p>
        @endauth
    </div>
</x-app-layout>
