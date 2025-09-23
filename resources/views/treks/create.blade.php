<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-3xl font-semibold mb-6">Créer une nouvelle aventure</h1>
                
                <form action="{{ route('treks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- Image -->
                    <div class="flex flex-col">
                        <label for="image" class="font-medium text-gray-700">Image</label>
                        <input type="file" name="image" id="image" class="mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Nom -->
                    <div class="flex flex-col">
                        <label for="name" class="font-medium text-gray-700">Nom</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Date de début -->
                    <div class="flex flex-col">
                        <label for="start_date" class="font-medium text-gray-700">Date de début</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required class="mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Date de fin -->
                    <div class="flex flex-col">
                        <label for="end_date" class="font-medium text-gray-700">Date de fin</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required class="mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Lieu -->
                    <div class="flex flex-col">
                        <label for="location" class="font-medium text-gray-700">Lieu</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" required class="mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- GPX File -->
                    <div class="flex flex-col">
                        <label for="gpx" class="font-medium text-gray-700">Fichier GPX </label>
                        <select name="gpx" id="gpx" class="mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Choisir un fichier GPX --</option>
                            @foreach($gpxFiles as $gpxFile)
                                <option value="{{ $gpxFile->id }}">{{ $gpxFile->filename }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Boutons -->
                    <div class="flex space-x-4">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">Enregistrer</button>
                        <a href="{{ route('treks.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-300">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
