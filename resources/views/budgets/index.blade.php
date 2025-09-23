<x-app-layout>
    <div class="container mx-auto p-8">
        <!-- Titre de la page -->
        <h1 class="text-4xl font-semibold text-gray-900 mb-6">Liste des Budgets</h1>

        <!-- Bouton pour créer un nouveau budget -->
        <div class="mb-8 text-right">
            <a href="{{ route('budgets.create') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 transform hover:scale-105 shadow-lg">
        <!-- Icône "+" -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nouveau Budget
            </a>

        </div>

        <!-- Liste des budgets -->
        <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($budgets as $budget)
                <li class="bg-white shadow-lg rounded-lg p-6 hover:bg-gray-50 transition-all duration-300">
                    <a href="{{ route('budgets.show', $budget->id) }}" class="block text-2xl font-semibold text-indigo-600 hover:text-indigo-800">
                        {{ $budget->nom }}
                    </a>
                    <p class="text-gray-500 mt-2">Géré par : {{ $budget->createur->name }}</p>
                    <div class="mt-4">
                        <span class="inline-block text-sm text-gray-600">Participants : {{ $budget->participants->count() }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
