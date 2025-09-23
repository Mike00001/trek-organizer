<x-app-layout>
    <!-- Ajoutez cet élément dans le corps de la page pour charger l'API Google Maps -->
    <gmpx-api-loader key="{{ config('services.google_maps.key') }}" solution-channel="GMP_QB_addressselection_v3_cABC"></gmpx-api-loader>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Formulaire pour saisir la ville -->
                <form action="{{ route('weather.get') }}" method="POST" onsubmit="return validateAddress()">
                    @csrf
                    <div class="mb-4">
                        <label for="city" class="block text-sm font-semibold text-gray-700">Saisissez une ville</label>
                        <input 
                            type="text" 
                            id="autocomplete" 
                            name="city" 
                            value="{{ old('city') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                            placeholder="Saisissez une adresse" 
                            required
                        />
                        @error('city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Champ caché pour valider que l'adresse provient des suggestions -->
                    <input type="hidden" id="valid_address" name="valid_address" value="0">

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Voir la météo</button>
                </form>

                <!-- Affichage des favoris -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4 text-indigo-700">Favoris</h3>
                    @if($weatherFavorites->isEmpty())
                        <p class="text-gray-500">Aucun favori enregistré.</p>
                    @else
                        <ul class="space-y-2">
                            @foreach($weatherFavorites as $favorite)
                                <li class="flex justify-between items-center p-2 border-b">
                                    <!-- Lien vers la page de détails du favori -->
                                    <a href="{{ route('weather.details', $favorite->id) }}" class="font-semibold text-gray-700 hover:text-indigo-500">
                                        {{ $favorite->city }}, {{ $favorite->country }}
                                    </a>
                                    <form action="{{ route('weatherFavorites.remove', $favorite->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce favori ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-1 px-6 rounded-md font-semibold transition duration-300">Supprimer</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Script de chargement de l'API Google Maps avec la clé API -->
    <script type="module">
        "use strict";

        import { APILoader } from 'https://unpkg.com/@googlemaps/extended-component-library@0.6';

        // Configuration API avec clé injectée via Blade
        const CONFIGURATION = {
            mapsApiKey: @json(config('services.google_maps.key')), // Injecte la clé API ici
            capabilities: {
                addressAutocompleteControl: true,
            }
        };

        let isPlaceValid = false; // Variable pour suivre la validité de l'adresse

        async function initAutocomplete() {
            try {
                // Importation de la bibliothèque 'places' pour l'autocomplétion
                const { Autocomplete } = await APILoader.importLibrary('places');
                
                // Initialisation de l'autocomplétion avec l'élément d'entrée
                const autocomplete = new Autocomplete(document.getElementById('autocomplete'), {
                    fields: ['address_components', 'geometry', 'name'],
                    types: ['address']
                });

                // Écouteur d'événement lorsque l'utilisateur sélectionne un lieu
                autocomplete.addListener('place_changed', () => {
                    const place = autocomplete.getPlace();
                    if (!place.geometry) {
                        console.log(`No details available for input: '${place.name}'`);
                        return;
                    }
                    console.log("Adresse sélectionnée :", place.name);
                    console.log("Composants de l'adresse :", place.address_components);
                    isPlaceValid = true; // L'adresse provient d'une suggestion de Google
                    // Met à jour le champ caché
                    document.getElementById('valid_address').value = "1";
                });
            } catch (error) {
                console.error("Erreur lors du chargement de l'API Google Maps : ", error);
            }
        }

        // Fonction de validation avant la soumission du formulaire
        function validateAddress() {
            // Vérifie si l'adresse provient d'une suggestion Google
            if (!isPlaceValid) {
                alert("Veuillez sélectionner une adresse parmi les suggestions de Google.");
                return false; // Empêche la soumission si l'adresse n'est pas valide
            }
            return true; // Permet la soumission si l'adresse est valide
        }

        // Appel de la fonction d'initialisation de l'autocomplétion
        initAutocomplete();
    </script>
</x-app-layout>
