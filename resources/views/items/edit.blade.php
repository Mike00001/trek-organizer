<x-app-layout>
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Modifier l'Item</h1>

        <!-- Affichage des erreurs de validation -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Champ Objet -->
            <div class="mb-4">
                <label for="objet" class="block text-sm font-medium text-gray-700">Item</label>
                <input type="text" name="objet" id="objet" value="{{ old('objet', $item->objet) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
            </div>

            <!-- Champ Marque -->
            <div class="mb-4">
                <label for="marque" class="block text-sm font-medium text-gray-700">Marque</label>
                <input type="text" name="marque" id="marque" value="{{ old('marque', $item->marque) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
            </div>

            <!-- Champ Modèle -->
            <div class="mb-4">
                <label for="modele" class="block text-sm font-medium text-gray-700">Modèle</label>
                <input type="text" name="modele" id="modele" value="{{ old('modele', $item->modele) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
            </div>

            <!-- Champ Type -->
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="" disabled>Choisir un type</option>
                    <option value="Dormir" {{ old('type', $item->type) == 'Dormir' ? 'selected' : '' }}>Dormir</option>
                    <option value="Manger" {{ old('type', $item->type) == 'Manger' ? 'selected' : '' }}>Manger</option>
                    <option value="Vêtements" {{ old('type', $item->type) == 'Vêtements' ? 'selected' : '' }}>Vêtements</option>
                    <option value="Hygiène" {{ old('type', $item->type) == 'Hygiène' ? 'selected' : '' }}>Hygiène</option>
                    <option value="Equipement" {{ old('type', $item->type) == 'Equipement' ? 'selected' : '' }}>Equipement</option>
                </select>
            </div>

            <!-- Champ Lieu d'achat -->
            <div class="mb-4">
                <label for="lieu_achat" class="block text-sm font-medium text-gray-700">Lieu d'achat</label>
                <input type="url" name="lieu_achat" id="lieu_achat" value="{{ old('lieu_achat', $item->lieu_achat) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <!-- Champ Prix d'achat -->
            <div class="mb-4">
                <label for="prix_achat" class="block text-sm font-medium text-gray-700">Prix d'achat</label>
                <input type="number" step="0.01" name="prix_achat" id="prix_achat" value="{{ old('prix_achat', $item->prix_achat) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <!-- Champ Poids -->
            <div class="mb-4">
                <label for="poids" class="block text-sm font-medium text-gray-700">Poids (g)</label>
                <input type="number" name="poids" id="poids" value="{{ old('poids', $item->poids) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <!-- Champ Volume -->
            <div class="mb-4">
                <label for="volume" class="block text-sm font-medium text-gray-700">Volume (L)</label>
                <input type="number" step="0.1" name="volume" id="volume" value="{{ old('volume', $item->volume) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>

            <!-- Champ Photo -->
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" id="photo" class="mt-1 block w-full text-gray-500">
                @if ($item->photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $item->photo) }}" alt="Photo de l'item" class="h-20">
                    </div>
                @endif
            </div>

            <!-- Boutons -->
            <div class="flex space-x-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 transition duration-150 ease-in-out">
                    Enregistrer
                </button>

                <button type="button" 
                        onclick="confirmReturn(event)"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 active:bg-gray-600 transition duration-150 ease-in-out">
                    Retour
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
    let isDirty = false;

    // On détecte tout changement dans le formulaire
    document.querySelectorAll('input, select, textarea').forEach(element => {
        element.addEventListener('input', () => {
            isDirty = true;
        });
    });

    function confirmReturn(event) {
        // Bloquer la redirection si le formulaire a été modifié
        if (isDirty) {
            const userConfirmed = confirm('Vous avez des modifications non enregistrées. Êtes-vous sûr de vouloir quitter sans enregistrer ?');
            if (!userConfirmed) {
                // Si l'utilisateur ne confirme pas, on empêche la redirection
                event.preventDefault();
            } else {
                // Si l'utilisateur confirme, on continue avec la redirection
                window.location.href = '{{ route('backpack.index') }}';
            }
        } else {
            // Si aucun changement, on peut quitter
            window.location.href = '{{ route('backpack.index') }}';
        }
    }
</script>
