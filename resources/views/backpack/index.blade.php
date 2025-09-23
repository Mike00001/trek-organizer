<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Liste des Items</h1>

        <!-- Formulaire de recherche -->
        <div class="flex justify-between mb-6">
            <form method="GET" action="{{ route('backpack.index') }}" class="flex items-center space-x-2">
                <input type="text" name="search" placeholder="Rechercher un item..." value="{{ request()->search }}" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                
                <!-- Bouton croix pour nettoyer la recherche -->
                @if(request()->search)
                    <button type="button" onclick="window.location='{{ route('backpack.index') }}'" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                @endif
                
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    Rechercher
                </button>
            </form>

            <div class="flex items-center space-x-2">
                <button type="button" class="filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-type="Dormir">Dormir</button>
                <button type="button" class="filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-type="Manger">Manger</button>
                <button type="button" class="filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-type="Hygiène">Hygiène</button>
                <button type="button" class="filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-type="Vêtement">Vêtement</button>
                <button type="button" class="filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-type="Equipement">Équipement</button>

                <!-- Bouton de réinitialisation des filtres d'items avec une icône croix -->
                <button id="reset-item-filters" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                

                <button type="button" onclick="window.location='{{ route('items.create') }}'" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </button>
            </div>
        </div>

        @if($itemCount > 0)
        <div class="overflow-x-auto max-h-80 overflow-y-auto">
            <table id="items-table" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-4 px-6 text-left">Image</th>
                        <th class="py-4 px-6 text-left">Marque</th>
                        <th class="py-4 px-6 text-left">Modèle</th>
                        <th class="py-4 px-6 text-left">Lieu d'Achat</th>
                        <th class="py-4 px-6 text-left">Prix</th>
                        <th class="py-4 px-6 text-left">Volume (L)</th> 
                        <th class="py-4 px-6 text-left">Poids (g)</th> 
                        <th class="py-4 px-6 text-left">Type</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="item-row border-b hover:bg-gray-50" data-type="{{ $item->type }}" data-id="{{ $item->id }}">
                            <td class="py-4 px-6 flex items-center justify-center">
                                <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('images/default-image.jpg') }}" 
                                     class="h-16 w-16 object-cover rounded-lg cursor-pointer" 
                                     alt="{{ $item->marque }}">
                            </td>
                            <td class="py-4 px-6">{{ $item->marque }}</td>
                            <td class="py-4 px-6">{{ $item->modele }}</td>
                            <td class="py-4 px-6">{{ $item->lieu_achat }}</td>
                            <td class="py-4 px-6">{{ $item->prix_achat }} €</td>
                            <td class="py-4 px-6">{{ $item->volume }} L</td> 
                            <td class="py-4 px-6">{{ $item->poids }} g</td>
                            <td class="py-4 px-6">{{ $item->type }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p class="text-center text-gray-600">Aucun item trouvé.</p>
        @endif
    </div>
</div>



    <!-- Section pour les backpacks -->
    <div class="container mx-auto px-4 py-6 mt-8">
        <h2 class="text-2xl font-semibold mb-4 text-center">Liste des Backpacks</h2>

    <!-- Filtres pour les saisons et les types des backpacks -->
    <div class="flex justify-center space-x-2 mb-4">
        <button type="button" class="backpack-filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-filter="saison" data-value="été">Été</button>
        <button type="button" class="backpack-filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-filter="saison" data-value="hiver">Hiver</button>
        <button type="button" class="backpack-filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-filter="saison" data-value="mi-saison">Mi-saison</button>
        <button type="button" class="backpack-filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-filter="saison" data-value="4-saisons">4 Saisons</button>
    </div>
    <div class="flex justify-center space-x-2 mb-4">
        <button type="button" class="backpack-filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-filter="type" data-value="trek_bivouac">Trek Bivouac</button>
        <button type="button" class="backpack-filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-filter="type" data-value="trek_gite">Trek Gîte</button>
        <button type="button" class="backpack-filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-filter="type" data-value="randonnée">Randonnée</button>
        <button type="button" class="backpack-filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-filter="type" data-value="escalade">Escalade</button>
        <button type="button" class="backpack-filter-btn bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md" data-filter="type" data-value="trail">Trail</button>
        
        <!-- Bouton de réinitialisation des filtres avec une icône croix -->
        <button id="reset-filters" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Bouton Nouveau Sac à Dos avec une icône + -->
        <button type="button" onclick="window.location='{{ route('backpack.create') }}'" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        </button>
    </div>


        @if($backpacks->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($backpacks as $backpack)
                <div class="relative bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 backpack-row"
                    data-id="{{ $backpack->id }}" data-type="{{ $backpack->type }}" data-saison="{{ $backpack->saison }}">
                    <!-- Image de fond -->
                    <div class="absolute inset-0 bg-cover bg-center opacity-50"
                        style="background-image: url('{{ $backpack->image ? asset('storage/' . $backpack->image) : asset('images/backpack-placeholder.webp') }}');"></div>

                    <!-- Contenu -->
                    <div class="relative p-6 z-10 clicBackpack">
                        <h3 class="text-xl font-bold text-gray-800">{{ $backpack->name }}</h3>
                        <p class="mt-2 text-gray-600">
                            Volume total: {{ $backpack->totalCapacity ? $backpack->totalCapacity . ' l' : 'Non spécifié' }}<br>
                            Poids total: {{ $backpack->totalWeight ? $backpack->totalWeight . ' g' : 'Non spécifié' }}<br>
                            Type: {{ $backpack->type }}<br>
                            Saison: {{ $backpack->saison }}<br>
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
        @else
            <p class="text-center text-gray-600">Aucun backpack trouvé.</p>
        @endif
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner tous les éléments nécessaires
        const filterButtons = document.querySelectorAll('.filter-btn');
        const backpackFilterButtons = document.querySelectorAll('.backpack-filter-btn');
        const resetButton = document.getElementById('reset-filters');
        const newBackpackButton = document.getElementById('new-backpack');
        const resetItemFiltersButton = document.getElementById('reset-item-filters');
        const itemRows = document.querySelectorAll('.item-row');

        // Objets pour stocker les filtres actifs
        let activeTypeFilter = null;
        let activeSaisonFilter = null;
        let activeItemFilter = null;

        // Initialisation des filtres d'items
        filterButtons.forEach(button => {
            button.addEventListener('click', () => toggleItemFilter(button));
        });

        // Initialisation des filtres de backpacks
        backpackFilterButtons.forEach(button => {
            button.addEventListener('click', () => toggleBackpackFilter(button));
        });

        // Gestion du bouton de réinitialisation des filtres
        if (resetButton) {
            resetButton.addEventListener('click', resetBackpackFilters);
        }

        // Gestion du bouton de réinitialisation des filtres d'items
        if (resetItemFiltersButton) {
            resetItemFiltersButton.addEventListener('click', resetItemFilters);
        }

        // Gestion du bouton "Nouveau Sac à Dos"
        if (newBackpackButton) {
            newBackpackButton.addEventListener('click', () => alert('Nouveau sac à dos ajouté !'));
        }

        // Gestion des clics sur les images des items pour ouvrir la page de détail
        itemRows.forEach(row => {
            const image = row.querySelector('img');
            if (image) {
                image.addEventListener('click', () => {
                    const itemId = row.dataset.id; // Récupère l'ID de l'item
                    window.location.href = `/items/${itemId}`; // Redirige vers la page de détail
                });
            }
        });

       // Gestion des clics sur les images des backpacks pour ouvrir la page de détail
        const backpackRows = document.querySelectorAll('.backpack-row');

        backpackRows.forEach(row => {
            const image = row.querySelector('.clicBackpack');
            if (image) {
                image.addEventListener('click', () => {
                    const backpackId = row.dataset.id; // Récupère l'ID du backpack
                    window.location.href = `/backpacks/${backpackId}`; // Redirige vers la page de détail
                });
            }
        });




        // Fonction pour gérer le filtre d'items
        function toggleItemFilter(button) {
            const isActive = button.classList.contains('active');
            filterButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-blue-500');
                btn.classList.add('bg-gray-500');
            });

            if (!isActive) {
                button.classList.add('active', 'bg-blue-500');
                button.classList.remove('bg-gray-500');
                activeItemFilter = button.dataset.type;
                updateItemDisplay();
            } else {
                activeItemFilter = null;
                updateItemDisplay();
            }
        }

        // Fonction pour gérer le filtre de backpacks
        function toggleBackpackFilter(button) {
            const isActive = button.classList.contains('active');
            const filterCategory = button.dataset.filter;
            const filterValue = button.dataset.value;

            if (!isActive) {
                backpackFilterButtons.forEach(btn => {
                    if (btn.dataset.filter === filterCategory && btn !== button) {
                        btn.classList.remove('active', 'bg-blue-500');
                        btn.classList.add('bg-gray-500');
                    }
                });

                button.classList.add('active', 'bg-blue-500');
                button.classList.remove('bg-gray-500');
                if (filterCategory === 'type') activeTypeFilter = filterValue;
                if (filterCategory === 'saison') activeSaisonFilter = filterValue;
            } else {
                if (filterCategory === 'type') activeTypeFilter = null;
                if (filterCategory === 'saison') activeSaisonFilter = null;
                button.classList.remove('active', 'bg-blue-500');
                button.classList.add('bg-gray-500');
            }
            updateBackpackDisplay();
        }

        // Met à jour l'affichage des items en fonction du filtre actif
        function updateItemDisplay() {
            itemRows.forEach(row => {
                row.style.display = (!activeItemFilter || row.dataset.type === activeItemFilter) ? '' : 'none';
            });
        }

        // Met à jour l'affichage des backpacks en fonction des filtres actifs
        function updateBackpackDisplay() {
            const backpackRows = document.querySelectorAll('.backpack-row');
            backpackRows.forEach(row => {
                const backpackType = row.dataset.type;
                const backpackSaison = row.dataset.saison;

                const showBackpack = (!activeTypeFilter || backpackType === activeTypeFilter) &&
                                    (!activeSaisonFilter || backpackSaison === activeSaisonFilter);

                row.style.display = showBackpack ? '' : 'none';
            });
        }

        // Réinitialise les filtres des backpacks
        function resetBackpackFilters() {
            activeTypeFilter = null;
            activeSaisonFilter = null;
            backpackFilterButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-blue-500');
                btn.classList.add('bg-gray-500');
            });
            updateBackpackDisplay();
        }

        // Réinitialise les filtres des items
        function resetItemFilters() {
            activeItemFilter = null;
            filterButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-blue-500');
                btn.classList.add('bg-gray-500');
            });
            updateItemDisplay();
        }

    });
</script>











