<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-3xl font-semibold mb-6">{{ $discussion->title }}</h1>
                <p class="text-gray-500 text-sm mb-4">Posté par {{ $discussion->user->name }} le {{ $discussion->created_at->format('d M Y') }}</p>
                
                <!-- Contenu de la discussion -->
                <div class="mb-6">
                    <p class="text-lg text-gray-700">{!! $discussion->content !!}</p>
                </div>

                <!-- Réponses -->
                <div class="space-y-6">
                    @foreach ($discussion->posts as $post)
                        <div class="border-b pb-4">
                            <p class="font-semibold text-gray-800">{{ $post->user->name }} a répondu le {{ $post->created_at->format('d M Y') }} :</p>
                            <p class="mt-2 text-gray-700">{!! $post->content !!}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Formulaire pour ajouter une réponse -->
                @auth
                    <div class="mt-8 bg-gray-100 p-6 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-semibold mb-4">Répondre à cette discussion</h2>
                        <form action="{{ route('forum.discussion.post', $discussion->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <textarea name="content" id="content" rows="5" class="w-full border border-gray-300 rounded-lg p-3 mt-1" required></textarea>
                            </div>
                            
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                                Répondre
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
