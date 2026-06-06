<x-app-layout>
    <div class="card">
        <h2>Créer un nouveau signalement</h2>
        <p class="meta">Votre navigateur doit autoriser la géolocalisation et vous devez être à Rabat.</p>
    </div>

    @if($errors->any())
        <div class="alert error">
            <strong>Il y a des erreurs dans le formulaire.</strong>
            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Catégorie</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Choisir une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->icon }} {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image (optionnel)</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <div class="form-group">
                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">
                <button type="button" id="locate-button" class="secondary">Vérifier ma position</button>
                <p id="location-message" class="meta" style="margin-top: 10px;">Cliquez pour autoriser la géolocalisation et vérifier que vous êtes à Rabat.</p>
            </div>

            <button type="submit">Enregistrer le signalement</button>
        </form>
    </div>

    <script>
        const locateButton = document.getElementById('locate-button');
        const message = document.getElementById('location-message');
        const latField = document.getElementById('latitude');
        const lonField = document.getElementById('longitude');

        locateButton.addEventListener('click', () => {
            if (!navigator.geolocation) {
                message.textContent = 'Geolocation is not supported by your browser.';
                return;
            }

            message.textContent = 'Demande de localisation...';
            navigator.geolocation.getCurrentPosition((position) => {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                latField.value = lat;
                lonField.value = lon;

                if (lat >= 34.0 && lat <= 34.15 && lon >= -6.95 && lon <= -6.65) {
                    message.textContent = 'Localisation vérifiée à Rabat. Vous pouvez envoyer le signalement.';
                } else {
                    message.textContent = 'Vous n’êtes pas à Rabat. Le signalement est autorisé uniquement depuis Rabat.';
                }
            }, (error) => {
                message.textContent = 'Impossible de récupérer la localisation. Veuillez autoriser l’accès à la localisation.';
            });
        });
    </script>
</x-app-layout>
