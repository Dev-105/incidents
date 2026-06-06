<x-app-layout>
    <div class="card">
        <h2>Modifier le commentaire</h2>
    </div>

    <div class="card">
        <form action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="content">Commentaire</label>
                <textarea id="content" name="content" required>{{ old('content', $comment->content) }}</textarea>
                @error('content')<div class="alert error">{{ $message }}</div>@enderror
            </div>

            <button type="submit">Modifier le commentaire</button>
        </form>
    </div>
</x-app-layout>
