<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Image en en-tête avec le titre en overlay -->
                <div class="relative mb-8">
                    <img src="{{ asset('storage/' . $trek->image) }}" alt="{{ $trek->name }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <h1 class="text-5xl font-bold text-white">{{ $trek->name }}</h1>
                    </div>
                </div>

                <!-- Conteneur principal en flex pour les détails et la carte côte à côte -->
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Détails du trek -->
                    <div class="flex-1 bg-gray-100 p-6 rounded-lg shadow-inner">
                        <p class="text-2xl font-semibold text-gray-800 mb-4">{{ $trek->location }}</p>
                        <p class="text-lg text-gray-600 mb-4"><strong>Dates :</strong> {{ $trek->start_date }} - {{ $trek->end_date }}</p>
                        <p class="text-lg text-gray-700">{{ $trek->description ?? 'Aucune description pour ce trek.' }}</p>
                    </div>

                    @if($trek->gpxFile) <!-- Vérification si un fichier GPX existe -->
                    <!-- Affichage de la carte avec trace GPX, avec un format carré -->
                    <div class="w-full lg:w-96 h-96 bg-gray-300 rounded-xl shadow-md overflow-hidden" id="map"></div>
                    @else
                    <p class="text-red-500">Aucun fichier GPX disponible pour ce trek.</p>
                    @endif
                </div>

                 <!-- Bouton pour retourner à la page des treks -->
                 <div class="flex justify-end mb-4">
                    <a href="{{ route('treks.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        Retour aux treks
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        var map;
        var currentLayer = null;
        var traceVisible = true;

        document.addEventListener("DOMContentLoaded", function() {
            var mapContainer = document.getElementById('map');
            if (mapContainer) {
                map = L.map('map').setView([50.8465573, 4.351697], 5);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);

                // Vérifier si $trek->gpxFile existe
                @if($trek->gpxFile)
                    // Charger la trace GPX du trek
                    fetch('{{ route('gpx.download', $trek->gpxFile->id) }}')
                        .then(response => response.text())
                        .then(gpxData => {
                            currentLayer = new L.GPX(gpxData, {
                                async: true,
                                marker_options: {
                                    startIconUrl: null,
                                    endIconUrl: null,
                                    shadowUrl: null
                                }
                            }).on('loaded', function(e) {
                                map.fitBounds(e.target.getBounds());
                            }).addTo(map);
                        });
                @endif

                // Ajout du bouton de bascule des traces GPX
                var toggleButton = L.control({ position: 'bottomleft' });
                toggleButton.onAdd = function (map) {
                    var div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
                    div.innerHTML = `
                        <button id="toggle-map" class="bg-transparent hover:bg-gray-700 text-white font-medium p-3 rounded-lg transition duration-300">
                            <img id="toggle-icon" src="{{ asset('images/oeilF.png') }}" alt="Toggle GPX" class="w-6 h-6" />
                        </button>`;
                    return div;
                };
                toggleButton.addTo(map);

                document.getElementById('toggle-map').addEventListener('click', function () {
                    if (traceVisible) {
                        if (currentLayer) {
                            map.removeLayer(currentLayer);
                        }
                        document.getElementById('toggle-icon').src = "{{ asset('images/oeilO.png') }}";
                    } else {
                        if (currentLayer) {
                            map.addLayer(currentLayer);
                        }
                        document.getElementById('toggle-icon').src = "{{ asset('images/oeilF.png') }}";
                    }
                    traceVisible = !traceVisible;
                });

                // Ajout du bouton plein écran
                var fullScreenButton = L.control({ position: 'bottomleft' });
                fullScreenButton.onAdd = function (map) {
                    var div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
                    div.innerHTML = `
                        <button id="fullscreen-map" class="bg-transparent hover:bg-gray-700 text-white font-medium p-3 rounded-lg transition duration-300">
                            <img src="{{ asset('images/fullscreen.png') }}" alt="Fullscreen" class="w-6 h-6" />
                        </button>`;
                    return div;
                };
                fullScreenButton.addTo(map);

                document.getElementById('fullscreen-map').addEventListener('click', function () {
                    if (!document.fullscreenElement) {
                        mapContainer.requestFullscreen().catch(err => {
                            console.log(`Error attempting to enable full-screen mode: ${err.message}`);
                        });
                    } else {
                        document.exitFullscreen();
                    }
                });
            } else {
                console.error('Map container not found!');
            }
        });
    </script>
    @endpush
</x-app-layout>
