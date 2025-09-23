<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">{{ $backpack->name }}</h1>

        <div class="flex flex-col md:flex-row justify-center mb-6">
            <!-- Image du sac -->
            <div class="md:w-1/3 p-4">
                <img src="{{ $backpack->image ? asset('storage/' . $backpack->image) : asset('images/backpack-placeholder.jpg') }}" 
                     alt="Image du sac à dos" 
                     class="w-full h-64 object-cover rounded-lg shadow-md">
            </div>

            <!-- Détails du sac -->
            <div class="md:w-2/3 p-4">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Détails du Sac</h2>
                <ul class="space-y-2 text-lg text-gray-600">
                    <li><strong>Volume total:</strong> {{ $totalCapacity ? $totalCapacity . ' L' : 'Non spécifiée' }}</li>
                    <li><strong>Poids total:</strong> {{ $totalWeight ? $totalWeight . ' g' : 'Non spécifié' }}</li>
                    <li><strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $backpack->type)) }}</li> <!-- Mise en forme du type -->
                    <li><strong>Saison:</strong> {{ ucfirst($backpack->saison) }}</li>
                </ul>
            </div>
        </div>

        <!-- Bouton Modifier -->
        <div class="text-center mb-6">
        <a href="{{ route('backpack.editBackpack', $backpack->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
    Modifier le sac
</a>


        </div>

        <!-- Liste des items dans le sac -->
        <div class="mt-8">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Items du Sac</h3>

            @if($backpack->items->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($backpack->items as $item)
                        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('images/default-image.jpg') }}" 
                                     alt="{{ $item->marque }}" 
                                     class="h-16 w-16 object-cover rounded-lg">
                                <div>
                                    <h4 class="font-semibold text-gray-700">{{ $item->marque }} - {{ $item->modele }}</h4>
                                    <p class="text-gray-600 text-sm">{{ ucfirst($item->type) }}</p>
                                    <p class="text-gray-600 text-sm">{{ $item->prix_achat }} €</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600">Aucun item dans ce sac.</p>
            @endif
        </div>

        <!-- Bouton retour -->
        <div class="mt-6 text-center">
            <a href="{{ route('backpack.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                Retour à la liste des sacs
            </a>
        </div>
    </div>
</x-app-layout>
