<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communty Klinik Gunung</title>
    <link rel="shortcut icon" href="{{ asset('storage/avatar/klinik_gunung_avatar.jpg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">
    {{ $slot }}
    @if (!request()->is('community/new-post'))
        <x-community.navigation />
    @endif

</body>

</html>
