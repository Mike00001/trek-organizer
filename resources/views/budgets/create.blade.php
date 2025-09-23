<x-app-layout>
    <div class="container">
        <h1>Créer un Budget</h1>

        <form action="{{ route('budgets.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom">Nom du Budget</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</x-app-layout>
