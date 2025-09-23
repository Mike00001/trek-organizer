<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Créer un nouveau sac à dos</h1>

        <!-- Affichage des messages d'erreur ou de succès -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire de création de papack -->
        <form method="POST" action="{{ route('backpack.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Sélection des items -->
            <div class="mb-6">
                <label for="items" class="block text-lg font-medium text-gray-700">Sélectionnez les items pour votre sac :</label>
                
                <!-- Tableau des items -->
                <table class="min-w-full mt-4 border-collapse">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Image</th>
                            <th class="py-2 px-4 border-b">Marque</th>
                            <th class="py-2 px-4 border-b">Modèle</th>
                            <th class="py-2 px-4 border-b">Poids</th>
                            <th class="py-2 px-4 border-b">Volume</th>
                            <th class="py-2 px-4 border-b">Sélectionner</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td class="py-2 px-4 border-b">
                                    <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('images/default-image.jpg') }}" 
                                     class="h-16 w-16 object-cover rounded-lg cursor-pointer" 
                                     alt="{{ $item->marque }}">
                                </td>
                                <td class="py-2 px-4 border-b">{{ $item->marque }}</td>
                                <td class="py-2 px-4 border-b">{{ $item->modele }}</td>
                                <td class="py-2 px-4 border-b">{{ $item->poids }} kg</td>
                                <td class="py-2 px-4 border-b">{{ $item->volume }} L</td>
                                <td class="py-2 px-4 border-b">
                                    <input type="checkbox" name="items[]" value="{{ $item->id }}" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Nom du sac -->
            <div class="mb-6">
                <label for="name" class="block text-lg font-medium text-gray-700">Nom du sac :</label>
                <input type="text" name="name" id="name" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required />
            </div>

            <!-- Champ Saison -->
            <div class="mb-6">
                <label for="saison" class="block text-lg font-medium text-gray-700">Saison :</label>
                <select name="saison" id="saison" required class="...">
                    <option value="" disabled {{ old('saison') ? '' : 'selected' }}>Choisir une saison</option>
                    <option value="été" {{ old('saison') == 'été' ? 'selected' : '' }}>Été</option>
                    <option value="hiver" {{ old('saison') == 'hiver' ? 'selected' : '' }}>Hiver</option>
                    <option value="mi-saison" {{ old('saison') == 'mi-saison' ? 'selected' : '' }}>Mi-saison</option>
                    <option value="4-saisons" {{ old('saison') == '4-saisons' ? 'selected' : '' }}>4-saisons</option>
                </select>

            </div>

            <!-- Champ Type -->
            <div class="mb-6">
                <label for="type" class="block text-lg font-medium text-gray-700">Type :</label>
                <select name="type" id="type" required class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" disabled selected>Choisir un type</option>
                    <option value="trek_bivouac">Trek & bivouac</option>
                    <option value="trek_gite">Trek & gîte</option>
                    <option value="randonnée">Randonnée</option>
                    <option value="escalade">Escalade</option>
                    <option value="trail">Trail</option>
                </select>
            </div>

            <!-- Image du sac à dos -->
            <div class="mb-6">
                <label for="image" class="block text-lg font-medium text-gray-700">Image du sac à dos :</label>
                <input type="file" name="image" id="image" accept="image/*" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow">
                    Créer
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
