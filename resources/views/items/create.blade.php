<x-app-layout>
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Ajouter un Nouvel Item</h1>

        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Item -->
            <div class="mb-4">
                <label for="objet" class="block text-sm font-medium text-gray-700">Item</label>
                <input type="text" name="objet" id="objet" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('objet') }}">
            </div>

            <!-- Marque -->
            <div class="mb-4">
                <label for="marque" class="block text-sm font-medium text-gray-700">Marque</label>
                <input type="text" name="marque" id="marque" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required value="{{ old('marque') }}">
            </div>

            <!-- Modèle -->
            <div class="mb-4">
                <label for="modele" class="block text-sm font-medium text-gray-700">Modèle</label>
                <input type="text" name="modele" id="modele" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required value="{{ old('modele') }}">
            </div>

            <!-- Lieu d'Achat -->
            <div class="mb-4">
                <label for="lieu_achat" class="block text-sm font-medium text-gray-700">Lieu d'Achat (URL)</label>
                <input type="url" name="lieu_achat" id="lieu_achat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('lieu_achat') }}">
            </div>

            <!-- Prix d'Achat -->
            <div class="mb-4">
                <label for="prix_achat" class="block text-sm font-medium text-gray-700">Prix d'Achat (€)</label>
                <input type="number" name="prix_achat" id="prix_achat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" step="0.01" value="{{ old('prix_achat') }}">
            </div>

            <!-- Poids -->
            <div class="mb-4">
                <label for="poids" class="block text-sm font-medium text-gray-700">Poids (g)</label>
                <input type="number" name="poids" id="poids" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('poids') }}">
            </div>

            <!-- Volume -->
            <div class="mb-4">
                <label for="volume" class="block text-sm font-medium text-gray-700">Volume (L)</label>
                <input type="number" name="volume" id="volume" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" step="0.01" value="{{ old('volume') }}">
            </div>

            <!-- Type -->
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type d'Item</label>
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" disabled selected>Choisir un type</option>
                    <option value="Dormir">Dormir</option>
                    <option value="Manger">Manger</option>
                    <option value="Vêtements">Vêtements</option>
                    <option value="Hygiène">Hygiène</option>
                    <option value="Equipement">Equipement</option>
                </select>
            </div>

            <!-- Photo -->
            <div class="mb-6">
                <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" id="photo" class="mt-1 block w-full text-gray-900 bg-gray-50 border border-gray-300 rounded-md cursor-pointer focus:outline-none">
            </div>

            <!-- Boutons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('backpack.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-md shadow">Retour</a>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-md shadow">Ajouter</button>
            </div>
        </form>
    </div>
</x-app-layout>
