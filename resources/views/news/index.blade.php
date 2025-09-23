<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Actualités du Trek</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($items as $item)
                <div class="border rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                    @php
                        $image_url = null;
                        // Vérifier les enclosures
                        if ($item->get_enclosure()) {
                            $image_url = $item->get_enclosure()->link;
                        }

                        // Extraire les images du contenu de la description
                        if (!$image_url) {
                            preg_match('/<img.*?src=["\'](.*?)["\']/', $item->get_description(), $matches);
                            $image_url = isset($matches[1]) ? $matches[1] : null;
                        }
                    @endphp

                    @if ($image_url)
                        <img src="{{ $image_url }}" alt="{{ $item->get_title() }}" class="w-full h-48 object-cover" />
                    @else
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            <p class="text-gray-500">Aucune image disponible.</p>
                        </div>
                    @endif

                    <div class="p-4">
                        <a href="{{ $item->get_permalink() }}" target="_blank" class="block text-lg font-semibold text-blue-600 hover:text-blue-800 mb-2">
                            {{ $item->get_title() }}
                        </a>
                        <p class="text-gray-700 mb-2">{{ Str::limit(strip_tags($item->get_description()), 150) }}</p>
                        <small class="text-gray-500">Publié le : {{ $item->get_date('j M Y') }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
