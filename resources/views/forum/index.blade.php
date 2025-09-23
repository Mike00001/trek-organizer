<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-xl sm:rounded-lg p-8 space-y-12">
                <!-- Formulaire pour créer un nouveau fil de discussion -->
                <div class="mb-6 bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold text-center mb-4 text-blue-600">Créer un Nouveau Fil de Discussion</h2>
                    <form id="discussionForm" action="{{ route('forum.discussion.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="title" class="block text-lg font-medium">Titre de la discussion</label>
                            <input type="text" id="title" name="title" class="mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300" required>
                        </div>

                        <!-- Champ contenu avec Quill -->
                        <div>
                            <label for="content" class="block text-lg font-medium">Contenu de la discussion</label>
                            <div id="editor" class="mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300"></div>
                            <textarea id="content" name="content" class="hidden"></textarea> <!-- Champ caché pour envoyer le contenu -->
                        </div>

                        <div>
                            <label for="category_id" class="block text-lg font-medium">Choisir une catégorie</label>
                            <select id="category_id" name="category_id" class="mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300" required>
                                <option value="">Sélectionnez une catégorie</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition duration-300 font-semibold">Créer la discussion</button>
                        </div>
                    </form>
                </div>

                <!-- Liste des discussions sous forme de tableau -->
                <div>
                    <h1 class="text-3xl font-semibold mb-6 text-center text-blue-600">Discussions du Forum</h1>
                    @if($discussions->count())
                        <div class="overflow-x-auto bg-white shadow-xl rounded-lg">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr class="bg-blue-600 text-white">
                                        <th class="px-4 py-2 text-left">Titre</th>
                                        <th class="px-4 py-2 text-left">Date</th>
                                        <th class="px-4 py-2 text-left">Catégorie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($discussions as $discussion)
                                        <tr class="border-t hover:bg-gray-100">
                                            <!-- Titre cliquable pour ouvrir la discussion -->
                                            <td class="px-4 py-2">
                                                <a href="{{ route('forum.discussion', $discussion->id) }}" class="text-blue-500 hover:text-blue-700">
                                                    {{ $discussion->title }}
                                                </a>
                                            </td>
                                            <td class="px-4 py-2">{{ $discussion->created_at->format('d M Y') }}</td>
                                            <td class="px-4 py-2">{{ $discussion->category->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-gray-500">Aucune discussion disponible pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <!-- Chargement de Quill JS -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

        <!-- Initialisation de Quill -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Initialisation de Quill
                var quill = new Quill('#editor', {
                    theme: 'snow',
                    placeholder: 'Rédigez votre message ici...',
                    modules: {
                        toolbar: [
                            [{ 'header': '1'}, { 'header': '2'}, { 'font': [] }],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            ['bold', 'italic', 'underline'],
                            [{ 'align': [] }],
                            ['link']
                        ]
                    }
                });

                // Lors de la soumission du formulaire, récupérer le contenu de Quill et le placer dans le champ textarea caché
                var form = document.getElementById('discussionForm');
                if (form) {
                    form.addEventListener('submit', function(event) {
                        // Récupère le contenu de l'éditeur Quill
                        var content = document.querySelector('textarea[name="content"]');
                        content.value = quill.root.innerHTML;
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
