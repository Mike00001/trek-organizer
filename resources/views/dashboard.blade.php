<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Section des boutons principaux -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

                    <!-- Backpack Button -->
                    <a href="{{ route('backpack.index') }}" class="relative block p-6 text-center bg-green-700 hover:bg-green-800 text-white rounded-lg shadow-xl transform transition duration-300 hover:scale-105 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center opacity-50 hover:opacity-75 transition-opacity duration-300" style="background-image: url('/images/storage.jpeg');"></div>
                        <div class="relative z-10">
                            <h3 class="font-bold text-xl">Backpack</h3>
                            <p class="text-lg mt-2">Organise tes items et tes sacs</p>
                        </div>
                    </a>

                    <!-- Map Button -->
                    <a href="{{ route('map.show') }}" class="relative block p-6 text-center bg-lime-700 hover:bg-lime-800 text-white rounded-lg shadow-xl transform transition duration-300 hover:scale-105 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center opacity-50 hover:opacity-75 transition-opacity duration-300" style="background-image: url('/images/map.webp');"></div>
                        <div class="relative z-10">
                            <h3 class="font-bold text-xl">Map</h3>
                            <p class="text-lg mt-2">Analyse tes trajets</p>
                        </div>
                    </a>

                    <!-- Weather Station Button -->
                    <a href="{{ route('weather.form') }}" class="relative block p-6 text-center bg-yellow-700 hover:bg-yellow-800 text-white rounded-lg shadow-xl transform transition duration-300 hover:scale-105 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center opacity-50 hover:opacity-75 transition-opacity duration-300" style="background-image: url('/images/weather.webp');"></div>
                        <div class="relative z-10">
                            <h3 class="font-bold text-xl">Weather Station</h3>
                            <p class="text-lg mt-2">Surveille la météo</p>
                        </div>
                    </a>
                    <!-- Budget -->
                    <a href="{{ route('budgets.index') }}" class="relative block p-6 text-center bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg shadow-xl transform transition duration-300 hover:scale-105 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center opacity-50 hover:opacity-75 transition-opacity duration-300" style="background-image: url('/images/result.jpeg');"></div>
                        <div class="relative z-10">
                            <h3 class="font-bold text-xl">Budgets</h3>
                            <p class="text-lg mt-2">Gère tes tunes</p>
                        </div>
                    </a>

                    <!-- Adventures (trek) -->
                    <a href="{{ route('treks.index') }}" class="relative block p-6 text-center bg-teal-700 hover:bg-teal-800 text-white rounded-lg shadow-xl transform transition duration-300 hover:scale-105 overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center opacity-50 hover:opacity-75 transition-opacity duration-300" style="background-image: url('/images/adventure.jpeg');"></div>
                        <div class="relative z-10">
                            <h3 class="font-bold text-xl">Adventures</h3>
                            <p class="text-lg mt-2">Organise tes treks</p>
                        </div>
                    </a>

                </div>

                <!-- Weather favorites -->
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                            <!-- Section des favoris météo -->
                            <h2 class="text-3xl font-semibold mb-4 text-center">Vos lieux favoris</h2>

                            @if($favorites->count())
                                <div class="flex flex-wrap gap-6 justify-start">
                                    @foreach ($favorites as $favorite)
                                        <div class="favorite-tile bg-white border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 w-64">
                                            <!-- Lien vers la page de détail -->
                                            <h3 class="text-xl font-semibold text-center text-blue-800 mb-2">
                                                <a href="{{ route('weather.details', $favorite->id) }}" class="hover:text-blue-600">
                                                    {{ $favorite->city }}
                                                </a>
                                            </h3>

                                            <!-- Vérification de la présence des données météo -->
                                            @if(isset($weatherData[$favorite->id]) && $weatherData[$favorite->id])
                                                <div class="mt-2 text-center">
                                                    <!-- Température max/min -->
                                                    <p><strong>Temp. max:</strong> {{ $weatherData[$favorite->id]['daily']['temperature_2m_max'][0] }}°C</p>
                                                    <p><strong>Temp. min:</strong> {{ $weatherData[$favorite->id]['daily']['temperature_2m_min'][0] }}°C</p>
                                                </div>
                                            @else
                                                <p class="text-gray-500 mt-2 text-center">Données météo indisponibles.</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500">Aucun favori trouvé.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Section des actualités -->
                <div class="container mx-auto p-6 mt-12">
                    <h1 class="text-3xl font-bold mb-6 text-center">Dernières Actualités</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($items as $item)
                            <div class="border rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                                @php
                                    $image_url = null;
                                    if ($item->get_enclosure()) {
                                        $image_url = $item->get_enclosure()->link;
                                    }
                                    if (!$image_url) {
                                        preg_match('/<img.*?src=["\'](.*?)["\']/', $item->get_description(), $matches);
                                        $image_url = $matches[1] ?? null;
                                    }
                                @endphp

                                @if ($image_url)
                                    <img src="{{ $image_url }}" alt="{{ $item->get_title() }}" class="w-full h-48 object-cover" />
                                @else
                                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                                        <p class="text-gray-500">Aucune image disponible.</p>
                                    </div>
                                @endif

                                <div class="p-4">
                                    <a href="{{ $item->get_permalink() }}" target="_blank" class="block text-lg font-semibold text-blue-600 hover:text-blue-800 mb-2">
                                        {{ $item->get_title() }}
                                    </a>
                                    <p class="text-gray-700 mb-2">{{ Str::limit(strip_tags($item->get_description()), 150) }}</p>
                                    <small class="text-gray-500">Publié le : {{ $item->get_date('j M Y') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Bouton "Voir plus" -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('news.index') }}" class="inline-block bg-blue-500 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">
                            Voir plus
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
