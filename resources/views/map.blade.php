<x-app-layout>
    <div class="container mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold text-center text-green-800 mb-8">Gestion des Fichiers GPX</h1>

        <!-- Carte avec position sticky et plus d'espace au-dessus -->
        <div id="map" class="mx-auto mb-8 rounded-xl shadow-md overflow-hidden bg-gray-300" style="height: 400px; max-width: 80%; position: sticky; top: 100px; z-index: 10;"></div>

        <!-- Contenu sous la carte avec plus d'espace -->
        <div class="pt-16"> <!-- Padding pour éviter que la navbar ne cache le contenu -->

            <!-- Téléchargement GPX -->
            <form id="gpx-upload-form" method="POST" action="{{ route('gpx.upload') }}" enctype="multipart/form-data" class="bg-white p-8 rounded-xl shadow-md mb-8">
                @csrf
                <div class="flex items-center justify-between space-x-4">
                    <input type="file" name="gpxFile" accept=".gpx" class="block w-full p-4 border-2 border-gray-400 rounded-lg focus:ring-4 focus:ring-green-200 focus:outline-none transition duration-200" />
                    <button type="submit" class="hidden"></button>
                    <div class="flex items-center space-x-4">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-3 px-6 rounded-md font-semibold transition duration-300 transform hover:scale-105">
                            Télécharger GPX
                        </button>
                    </div>
                </div>
            </form>

            <!-- Tableau des fichiers GPX personnels avec défilement -->
            <div class="bg-white p-8 rounded-xl shadow-md mb-8">
                <h2 class="text-3xl font-semibold text-green-800 mb-6">Mes fichiers GPX</h2>
                <div class="overflow-y-scroll max-h-96"> <!-- Limite la hauteur et permet de scroller -->
                    <table class="min-w-full bg-white rounded-xl shadow-md border border-gray-300">
                        <thead class="bg-green-100">
                            <tr>
                                <th class="py-4 px-6 text-left text-gray-700 font-medium">Nom du fichier</th>
                                <th class="py-4 px-6 text-left text-gray-700 font-medium">Date d'upload</th>
                                <th class="py-4 px-6 text-left text-gray-700 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($userGpxFiles as $gpxFile)
                            <tr class="hover:bg-gray-100 transition duration-300">
                                <td class="py-3 px-6 border-b text-blue-600 hover:underline cursor-pointer" onclick="loadGpxTrace('{{ $gpxFile->id }}', '{{ $gpxFile->filename }}')">{{ $gpxFile->filename }}</td>
                                <td class="py-3 px-6 border-b">{{ $gpxFile->created_at->format('Y-m-d H:i') }}</td>
                                <td class="py-3 px-6 border-b">
                                    <form method="POST" action="{{ route('gpx.delete', $gpxFile->id) }}" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier GPX ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-1 px-4 rounded-md font-semibold transition duration-300">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-3 px-6 text-center text-gray-500">Aucun fichier GPX téléchargé.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Affichage des fichiers GPX communs -->
            <div class="bg-white p-8 rounded-xl shadow-md mb-8">
                <h2 class="text-3xl font-semibold text-green-800 mb-6">Fichiers GPX communs</h2>
                <div class="overflow-y-scroll max-h-96"> <!-- Limite la hauteur et permet de scroller -->
                    <table class="min-w-full bg-white rounded-xl shadow-md border border-gray-300">
                        <thead class="bg-green-100">
                            <tr>
                                <th class="py-4 px-6 text-left text-gray-700 font-medium">Nom du fichier</th>
                                <th class="py-4 px-6 text-left text-gray-700 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($commonGpxFiles as $gpxFile)
                            <tr class="hover:bg-gray-100 transition duration-300">
                                <td class="py-3 px-6 border-b text-blue-600 hover:underline cursor-pointer" onclick="loadGpxTraceCommon('{{ basename($gpxFile) }}')">{{ basename($gpxFile) }}</td>
                                <td class="py-3 px-6 border-b">
                                    <a href="{{ asset('storage/gpx/common/' . basename($gpxFile)) }}" class="bg-green-600 hover:bg-green-700 text-white py-1 px-4 rounded-md font-semibold transition duration-300">
                                        Télécharger
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="py-3 px-6 text-center text-gray-500">Aucun fichier GPX commun.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Suppression de tous les GPX 
            <form method="POST" action="{{ route('gpx.clear') }}" class="mt-6 text-center" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer tous les fichiers GPX ?');">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-3 px-6 rounded-md font-semibold transition duration-300">
                    Supprimer tous les fichiers
                </button>
            </form> -->
        </div>
    </div>

    @push('scripts')
    <script>
        var map;
        var currentLayer = null;
        var traceVisible = false;

        document.addEventListener("DOMContentLoaded", function() {
            var mapContainer = document.getElementById('map');
            if (mapContainer) {
                map = L.map('map').setView([50.8465573, 4.351697], 5);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);

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

        // Fonction pour charger la trace GPX depuis un fichier personnel
        function loadGpxTrace(gpxFileId, filename) {
            if (currentLayer) {
                map.removeLayer(currentLayer);
            }

            fetch('{{ route('gpx.download', '') }}/' + gpxFileId)
                .then(response => response.text())
                .then(gpxData => {
                    currentLayer = new L.GPX(gpxData, {
                        async: true,
                        marker_options: {
                            startIconUrl: null,
                            endIconUrl: null,
                            shadowUrl: null
                        }
                    }).on('loaded', function (e) {
                        map.fitBounds(e.target.getBounds());
                    }).addTo(map);

                    traceVisible = true;
                    document.getElementById('toggle-icon').src = "{{ asset('images/oeilF.png') }}";
                });
        }

        // Fonction pour charger la trace GPX depuis un fichier commun
        function loadGpxTraceCommon(filename) {
            if (currentLayer) {
                map.removeLayer(currentLayer);
            }

            fetch('{{ asset('storage/gpx/common/') }}/' + filename)
                .then(response => response.text())
                .then(gpxData => {
                    currentLayer = new L.GPX(gpxData, {
                        async: true,
                        marker_options: {
                            startIconUrl: null,
                            endIconUrl: null,
                            shadowUrl: null
                        }
                    }).on('loaded', function (e) {
                        map.fitBounds(e.target.getBounds());
                    }).addTo(map);

                    traceVisible = true;
                    document.getElementById('toggle-icon').src = "{{ asset('images/oeilF.png') }}";
                });
        }
    </script>
    @endpush
</x-app-layout>
