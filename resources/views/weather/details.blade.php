<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(isset($weatherData['current_weather']))
                    <h2 class="text-4xl font-semibold mb-6 text-center text-indigo-700">
                        Météo actuelle pour {{ $favorite->city }}
                    </h2>
                    
                    <!-- Section météo actuelle -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-6 mb-8 rounded-lg shadow-md">
                        <div class="text-xl mb-4">Température actuelle : 
                            <span class="font-semibold text-2xl">{{ $weatherData['current_weather']['temperature'] }}°C</span>
                        </div>
                        <div class="text-lg mb-2"><strong>Vent :</strong> {{ $weatherData['current_weather']['windspeed'] }} km/h</div>
                        <div class="text-lg"><strong>Direction du vent :</strong> {{ $weatherData['current_weather']['winddirection'] }}°</div>
                    </div>

                    <!-- Section prévisions quotidiennes -->
                    @if(isset($weatherData['daily']))
                        <h3 class="text-3xl font-semibold mb-6 text-center text-indigo-600">Prévisions quotidiennes</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($weatherData['daily']['time'] as $key => $date)
                                <div class="bg-white border rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 duration-300 ease-in-out">
                                    <!-- Formatage de la date avec Carbon -->
                                    <h4 class="font-semibold text-xl text-center text-indigo-600 mb-4">
                                        {{ \Carbon\Carbon::parse($date)->format('d F Y') }}
                                    </h4>
                                    <p class="text-lg mb-2">Température maximale : <span class="font-semibold text-red-600">{{ $weatherData['daily']['temperature_2m_max'][$key] }}°C</span></p>
                                    <p class="text-lg mb-2">Température minimale : <span class="font-semibold text-blue-600">{{ $weatherData['daily']['temperature_2m_min'][$key] }}°C</span></p>
                                    <p class="text-lg mb-2">Précipitations totales : <span class="font-semibold text-green-600">{{ $weatherData['daily']['precipitation_sum'][$key] }} mm</span></p>
                                    
                                    <!-- Formatage des heures de lever et coucher du soleil -->
                                    <p class="text-lg mb-2">Lever du soleil : 
                                        <span class="font-semibold">{{ \Carbon\Carbon::parse($weatherData['daily']['sunrise'][$key])->format('H:i') }}</span>
                                    </p>
                                    <p class="text-lg">Coucher du soleil : 
                                        <span class="font-semibold">{{ \Carbon\Carbon::parse($weatherData['daily']['sunset'][$key])->format('H:i') }}</span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-red-500 text-center mt-6">Désolé, les prévisions quotidiennes n'ont pas été trouvées.</p>
                    @endif
                @else
                    <p class="text-red-500 text-center">Désolé, une erreur est survenue ou les données météo n'ont pas été trouvées.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
