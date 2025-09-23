<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <script src="//unpkg.com/alpinejs" defer></script>

    @stack('scripts')
</head>
<body>
    <div x-data="{ open: false }">
        @include('layouts.navigation')
        <main>
            {{ $slot }} 
        </main>
    </div>

    <!-- Ajouter les scripts JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery avant Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.5.1/gpx.min.js"></script>

    <!-- Initialisation de Select2 -->
    <script>
        $(document).ready(function() {
            $('#items').select2(); // Initialisation de Select2
        });
    </script>
</body>
</html>
