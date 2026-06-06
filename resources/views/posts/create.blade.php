<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8 border border-gray-100">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight mb-2">
                        Créer un nouveau signalement
                    </h2>
                    <p class="text-gray-600">
                        Votre navigateur doit autoriser la géolocalisation et vous devez être à Rabat.
                    </p>
                </div>
            </div>
        </div>

        <!-- Errors Alert -->
        @if($errors->any())
            <div class="mb-8 transform transition-all duration-500">
                <div class="bg-red-50 border-l-4 border-red-500 rounded-xl shadow-md p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <strong class="text-sm font-semibold text-red-800">Il y a des erreurs dans le formulaire.</strong>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="h-2 bg-gradient-to-r from-green-400 to-green-600"></div>
            
            <div class="p-6 md:p-8">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="postForm">
                    @csrf

                    <!-- Title Field -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Titre <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            value="{{ old('title') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200"
                            placeholder="Ex: Nid-de-poule dangereux"
                            required
                        >
                    </div>

                    <!-- Description Field -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="6"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 resize-none"
                            placeholder="Décrivez l'incident en détail..."
                            required
                        >{{ old('description') }}</textarea>
                    </div>

                    <!-- Category Field -->
                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Catégorie <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="category_id" 
                            name="category_id" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 bg-white"
                            required
                        >
                            <option value="">Choisir une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->icon }} {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Image Field -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                            Image (optionnel)
                        </label>
                        <div class="relative">
                            <input 
                                type="file" 
                                id="image" 
                                name="image" 
                                accept="image/*"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                            >
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Formats acceptés: JPG, PNG, GIF (max 2MB)</p>
                    </div>

                    <!-- Location Fields (Hidden) -->
                    <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">

                    <!-- Location Verification Button -->
                    <div class="mb-8">
                        <button 
                            type="button" 
                            id="locate-button" 
                            class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-6 py-3 rounded-xl transition-all duration-200"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Vérifier ma position
                        </button>
                        <div id="location-message" class="mt-3 text-sm text-gray-500 flex items-center gap-2">
                            <span>📍</span>
                            <span>Cliquez pour autoriser la géolocalisation et vérifier que vous êtes à Rabat.</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button 
                            type="submit" 
                            id="submit-button"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-3 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105 inline-flex items-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Enregistrer le signalement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Geolocation Script (Fixed for Rabat) -->
    <script>
        const locateButton = document.getElementById('locate-button');
        const message = document.getElementById('location-message');
        const latField = document.getElementById('latitude');
        const lonField = document.getElementById('longitude');
        const submitButton = document.getElementById('submit-button');
        const form = document.getElementById('postForm');

        // CORRECTED Rabat boundaries (based on original working coordinates)
        // Rabat spans approximately: Latitude 33.95° to 34.05°, Longitude -6.90° to -6.80°
        // But we'll use wider boundaries to be safe
        const RABAT_BOUNDS = {
            lat: { min: 33.90, max: 34.10 },     // Covers all Rabat districts
            lon: { min: -6.95, max: -6.75 }       // Covers Rabat center to outskirts
        };

        let isLocationVerified = false;

        function updateMessage(text, isError = false, isSuccess = false, isInfo = false) {
            // Reset classes
            message.classList.remove('bg-green-50', 'bg-red-50', 'bg-blue-50', 'bg-yellow-50', 'p-3', 'rounded-xl', 'border', 'border-green-200', 'border-red-200', 'border-blue-200', 'border-yellow-200');
            
            let icon = '📍';
            let colorClass = 'text-gray-500';
            
            if (isError) {
                icon = '❌';
                colorClass = 'text-red-600';
                message.classList.add('bg-red-50', 'p-3', 'rounded-xl', 'border', 'border-red-200');
                isLocationVerified = false;
            } else if (isSuccess) {
                icon = '✅';
                colorClass = 'text-green-600';
                message.classList.add('bg-green-50', 'p-3', 'rounded-xl', 'border', 'border-green-200');
                isLocationVerified = true;
            } else if (isInfo) {
                icon = 'ℹ️';
                colorClass = 'text-blue-600';
                message.classList.add('bg-blue-50', 'p-3', 'rounded-xl', 'border', 'border-blue-200');
                isLocationVerified = false;
            }
            
            message.innerHTML = `
                <span>${icon}</span>
                <span class="${colorClass}">${text}</span>
            `;
        }

        // Add form validation before submit
        form.addEventListener('submit', function(e) {
            if (!isLocationVerified && (latField.value === '' || lonField.value === '')) {
                e.preventDefault();
                updateMessage('⚠️ Veuillez d\'abord vérifier votre position à Rabat avant d\'envoyer le signalement.', true);
                return false;
            }
            
            if (!isLocationVerified && latField.value !== '' && lonField.value !== '') {
                // Check if coordinates are within Rabat
                const lat = parseFloat(latField.value);
                const lon = parseFloat(lonField.value);
                const isInRabat = lat >= RABAT_BOUNDS.lat.min && 
                                 lat <= RABAT_BOUNDS.lat.max && 
                                 lon >= RABAT_BOUNDS.lon.min && 
                                 lon <= RABAT_BOUNDS.lon.max;
                
                if (!isInRabat) {
                    e.preventDefault();
                    updateMessage('⚠️ Vous devez être à Rabat pour créer un signalement.', true);
                    return false;
                }
            }
        });

        locateButton.addEventListener('click', () => {
            if (!navigator.geolocation) {
                updateMessage('La géolocalisation n\'est pas supportée par votre navigateur.', true);
                return;
            }

            updateMessage('🔄 Demande de localisation en cours...', false, false, true);
            locateButton.disabled = true;
            locateButton.classList.add('opacity-50', 'cursor-not-allowed');

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    
                    console.log('Position détectée:', lat, lon);
                    
                    latField.value = lat;
                    lonField.value = lon;

                    // Check if within Rabat boundaries
                    const isInRabat = lat >= RABAT_BOUNDS.lat.min && 
                                     lat <= RABAT_BOUNDS.lat.max && 
                                     lon >= RABAT_BOUNDS.lon.min && 
                                     lon <= RABAT_BOUNDS.lon.max;

                    console.log('Dans Rabat?', isInRabat);
                    console.log('Limites:', RABAT_BOUNDS);

                    if (isInRabat) {
                        updateMessage(
                            `✓ Localisation vérifiée à Rabat (${lat.toFixed(6)}, ${lon.toFixed(6)}). Vous pouvez envoyer le signalement.`,
                            false,
                            true
                        );
                    } else {
                        updateMessage(
                            `✗ Position en dehors de Rabat (${lat.toFixed(6)}, ${lon.toFixed(6)}). ` +
                            `Le signalement est autorisé uniquement depuis Rabat. ` +
                            `Limites: Latitude ${RABAT_BOUNDS.lat.min}°-${RABAT_BOUNDS.lat.max}°, ` +
                            `Longitude ${RABAT_BOUNDS.lon.min}°-${RABAT_BOUNDS.lon.max}°`,
                            true,
                            false
                        );
                    }
                    locateButton.disabled = false;
                    locateButton.classList.remove('opacity-50', 'cursor-not-allowed');
                },
                (error) => {
                    let errorMsg = 'Impossible de récupérer la localisation. ';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            errorMsg += 'Veuillez autoriser l\'accès à la localisation dans les paramètres de votre navigateur.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMsg += 'Information de localisation non disponible. Vérifiez votre connexion GPS.';
                            break;
                        case error.TIMEOUT:
                            errorMsg += 'La demande a expiré. Réessayez.';
                            break;
                        default:
                            errorMsg += 'Une erreur est survenue.';
                    }
                    updateMessage(errorMsg, true);
                    locateButton.disabled = false;
                    locateButton.classList.remove('opacity-50', 'cursor-not-allowed');
                },
                {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0
                }
            );
        });
        
        // Auto-detect on page load if coordinates already exist (e.g., from form error)
        document.addEventListener('DOMContentLoaded', function() {
            if (latField.value && lonField.value) {
                const lat = parseFloat(latField.value);
                const lon = parseFloat(lonField.value);
                const isInRabat = lat >= RABAT_BOUNDS.lat.min && 
                                 lat <= RABAT_BOUNDS.lat.max && 
                                 lon >= RABAT_BOUNDS.lon.min && 
                                 lon <= RABAT_BOUNDS.lon.max;
                if (isInRabat) {
                    updateMessage(`✓ Localisation vérifiée à Rabat (${lat.toFixed(6)}, ${lon.toFixed(6)})`, false, true);
                }
            }
        });
    </script>
</x-app-layout>