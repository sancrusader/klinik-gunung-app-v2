<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>{{ $title ?? 'Klinik Gunung' }}</title>
    <link rel="shortcut icon" href="{{ asset('storage/avatar/klinik_gunung_avatar.jpg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-inter tracking-tight text-gray-900 antialiased">

    <x-navbar />

    {{ $slot }}

    <x-footer />
    </div>
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const dropdownMenu = document.getElementById('dropdown-menu');

        menuToggle.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    </script>


</body>

</html>
