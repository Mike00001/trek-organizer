<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-lg p-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Mes Treks</h1>

                <!-- Bouton discret pour créer une nouvelle aventure -->
                <div class="flex justify-end mb-6">
                    <a href="{{ route('treks.create') }}" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition duration-300 shadow-lg">
                        <!-- Icone + -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Créer
                    </a>
                </div>

                <!-- Si aucun trek n'existe -->
                @if($treks->isEmpty())
                    <p class="mt-8 text-xl text-gray-700 text-center">Aucun trek n'a été créé pour le moment. Soyez le premier à partir à l'aventure !</p>
                @else
                    <!-- Liste des treks existants -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($treks as $trek)
                            <a href="{{ route('treks.show', $trek->id) }}" class="relative block p-8 text-center bg-white rounded-xl shadow-lg hover:shadow-2xl transform transition duration-300 hover:scale-105 overflow-hidden">
                                <!-- Image de fond du trek -->
                                <div class="absolute inset-0 bg-cover bg-center opacity-60 hover:opacity-80 transition-opacity duration-300" style="background-image: url('{{ asset('storage/' . $trek->image) }}');"></div>
                                <div class="relative z-10">
                                    <h3 class="font-bold text-3xl text-white drop-shadow-lg">{{ $trek->name }}</h3>
                                    <p class="text-xl mt-2 text-gray-200 drop-shadow-lg">{{ $trek->location }}</p>
                                    <p class="text-md mt-3 text-gray-300 drop-shadow-lg">{{ $trek->start_date }} - {{ $trek->end_date }}</p>
                                </div>
                                <!-- Overlay for better contrast -->
                                <div class="absolute inset-0 bg-black bg-opacity-40 rounded-xl"></div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
