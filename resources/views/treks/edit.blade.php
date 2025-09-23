<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-3xl font-semibold mb-6">Modifier le trek : {{ $trek->name }}</h1>

                <form action="{{ route('treks.update', $trek->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Indique que c'est une mise à jour -->

                    <div class="mb-4">
                        <label for="name" class="block text-lg font-semibold">Nom du trek</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $trek->name) }}" class="w-full mt-2 px-4 py-2 border rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="start_date" class="block text-lg font-semibold">Date de début</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $trek->start_date) }}" class="w-full mt-2 px-4 py-2 border rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="end_date" class="block text-lg font-semibold">Date de fin</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $trek->end_date) }}" class="w-full mt-2 px-4 py-2 border rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-lg font-semibold">Lieu</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $trek->location) }}" class="w-full mt-2 px-4 py-2 border rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-lg font-semibold">Description</label>
                        <textarea name="description" id="description" class="w-full mt-2 px-4 py-2 border rounded-md">{{ old('description', $trek->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-lg font-semibold">Image</label>
                        <input type="file" name="image" id="image" class="w-full mt-2 px-4 py-2 border rounded-md">
                    </div>

                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 transition duration-300">Mettre à jour</button>
                </form>

                <a href="{{ route('treks.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Retour à la liste des treks</a>
            </div>
        </div>
    </div>
</x-app-layout>
