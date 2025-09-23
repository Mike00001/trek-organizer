<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-4xl font-bold mb-6 text-gray-800">{{ $item->marque }} - {{ $item->modele }}</h1>
            <div class="flex mb-6">
                <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('images/default-image.jpg') }}" class="h-64 w-64 object-cover rounded-lg shadow-md" alt="{{ $item->marque }}">
            </div>
            <div class="flex mb-6">
                <div class="ml-8"> <!-- Marge à gauche de l'image -->
                    <p class="text-lg mb-4"><strong>Lieu d'Achat:</strong> <span class="text-gray-600">{{ $item->lieu_achat }}</span></p>
                    <p class="text-lg mb-4"><strong>Prix:</strong> <span class="text-gray-600">{{ $item->prix_achat }} €</span></p>
                    <p class="text-lg mb-4"><strong>Volume:</strong> <span class="text-gray-600">{{ $item->volume }} L</span></p>
                    <p class="text-lg mb-4"><strong>Poids:</strong> <span class="text-gray-600">{{ $item->poids }} g</span></p>
                    <p class="text-lg mb-4"><strong>Type:</strong> <span class="text-gray-600">{{ $item->type }}</span></p>
                </div>
            </div>
            <a href="{{ route('backpack.index') }}" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">Retour à la liste des items</a>
            <a href="{{ route('items.edit', $item->id) }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-200">Modifier l'item</a>
            
            </div>
        </div>
    </div>
</x-app-layout>
