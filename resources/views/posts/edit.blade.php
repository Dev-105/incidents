<x-app-layout>
    <div class="card">
        <h2>Modifier un signalement</h2>
        <p class="meta">Mettez à jour les informations. La localisation reste celle du signalement initial.</p>
    </div>

    @if($errors->any())
        <div class="alert error">
            <strong>There are errors in the form.</strong>
            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required>{{ old('description', $post->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Catégorie</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Choose category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->icon }} {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image (optionnel)</label>
                <input type="file" id="image" name="image" accept="image/*">
                @if($post->image)
                    <p class="meta">Current image: <a href="{{ asset($post->image) }}" target="_blank">View</a></p>
                @endif
            </div>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>
