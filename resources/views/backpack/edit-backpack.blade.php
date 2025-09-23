<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Modifier le sac à dos : {{ $backpack->name }}</h1>

        <form method="POST" action="{{ route('backpack.updateBackpack', $backpack->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nom du sac -->
            <div class="mb-6">
                <label for="name" class="block text-lg font-medium text-gray-700">Nom du sac :</label>
                <input type="text" name="name" id="name" value="{{ old('name', $backpack->name) }}" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required />
            </div>

            <!-- Champ Saison -->
            <div class="mb-6">
                <label for="saison" class="block text-lg font-medium text-gray-700">Saison :</label>
                <select name="saison" id="saison" required class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="été" {{ old('saison', $backpack->saison) == 'été' ? 'selected' : '' }}>Été</option>
                    <option value="hiver" {{ old('saison', $backpack->saison) == 'hiver' ? 'selected' : '' }}>Hiver</option>
                    <option value="mi-saison" {{ old('saison', $backpack->saison) == 'mi-saison' ? 'selected' : '' }}>Mi-saison</option>
                    <option value="4 saisons" {{ old('saison', $backpack->saison) == '4 saisons' ? 'selected' : '' }}>4 saisons</option>
                </select>
            </div>

            <!-- Champ Type -->
            <div class="mb-6">
                <label for="type" class="block text-lg font-medium text-gray-700">Type :</label>
                <select name="type" id="type" required class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="trek_bivouac" {{ old('type', $backpack->type) == 'trek_bivouac' ? 'selected' : '' }}>Trek & bivouac</option>
                    <option value="trek_gite" {{ old('type', $backpack->type) == 'trek_gite' ? 'selected' : '' }}>Trek & gîte</option>
                    <option value="randonnée" {{ old('type', $backpack->type) == 'randonnée' ? 'selected' : '' }}>Randonnée</option>
                    <option value="escalade" {{ old('type', $backpack->type) == 'escalade' ? 'selected' : '' }}>Escalade</option>
                    <option value="trail" {{ old('type', $backpack->type) == 'trail' ? 'selected' : '' }}>Trail</option>
                </select>
            </div>

            <!-- Image du sac à dos -->
            <div class="mb-6">
                <label for="image" class="block text-lg font-medium text-gray-700">Image du sac à dos :</label>
                <input type="file" name="image" id="image" accept="image/*" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                @if($backpack->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $backpack->image) }}" alt="Image actuelle" class="h-20 object-cover">
                </div>
                @endif
            </div>

            <!-- Sélection des items -->
            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-700">Sélectionnez les items pour votre sac :</label>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                    @foreach($items as $item)
                        <div class="flex items-center">
                            <input type="checkbox" name="items[]" value="{{ $item->id }}" {{ $backpack->items->contains($item->id) ? 'checked' : '' }} class="mr-2">
                            <span>{{ $item->marque }} - {{ $item->modele }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Boutons -->
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md shadow">
                    Mettre à jour
                </button>
                <a href="{{ route('backpack.index') }}" class="ml-4 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-md shadow">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
