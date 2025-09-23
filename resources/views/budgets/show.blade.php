<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Budget : {{ $budget->nom }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <!-- Participants et ajout de participant sur la même ligne -->
<div class="flex justify-between items-center mb-6">
    <!-- Liste des participants -->
    <div class="flex-1">
        <h3 class="text-sm font-medium text-gray-600 mb-2">Participants</h3>
        <div class="flex flex-wrap space-x-4 text-sm text-gray-700 mb-2">
            @foreach($participants as $participant)
                <span class="bg-gray-200 rounded-full px-3 py-1">{{ $participant->name }}</span>
            @endforeach
        </div>
    </div>
    
    <!-- Bouton Ajouter un participant -->
    <div class="flex-shrink-0">
        <button 
            onclick="document.getElementById('add-participant-form').classList.toggle('hidden')" 
            class="bg-blue-500 text-white text-xs px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
            Ajouter un participant
        </button>
    </div>
</div>

<!-- Formulaire d'ajout de participant, caché par défaut -->
<div id="add-participant-form" class="hidden mb-6">
    <form action="{{ route('budgets.addParticipant', $budget->id) }}" method="POST" class="bg-gray-50 p-4 rounded-lg shadow-sm hover:shadow-md transition duration-200">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="block text-xs font-medium text-gray-500">Sélectionner un utilisateur</label>
            <select name="user_id" id="user_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                @foreach(App\Models\User::whereNotIn('id', $participants->pluck('id'))->get() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600 transition duration-200">Ajouter</button>
    </form>
</div>


            <!-- Formulaire d'ajout de transaction -->
            <h3 class="text-lg font-bold mt-6 mb-4">Ajouter une transaction</h3>
            <form action="{{ route('budgets.storeTransaction', $budget->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="montant" class="block text-sm font-medium text-gray-700">Montant</label>
                    <input type="number" name="montant" id="montant" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" step="0.01" min="0.01">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" name="description" id="description" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type de la transaction</label>
                    <select name="type" id="type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="credit">Crédit</option>
                        <option value="debit">Débit</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Ajouter</button>
            </form>

            <!-- Liste des transactions -->
            <h3 class="text-lg font-bold mt-6 mb-4">Transactions</h3>
            <ul class="list-disc ml-6">
                @foreach($transactions as $transaction)
                    <li>
                        {{ $transaction->description }} - {{ $transaction->montant }}€ ({{ ucfirst($transaction->type) }})
                        par {{ $transaction->utilisateur->name }}
                    </li>
                @endforeach
            </ul>

            <!-- Bouton retour -->
            <div class="flex justify-center mt-6">
                <a href="{{ route('budgets.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
