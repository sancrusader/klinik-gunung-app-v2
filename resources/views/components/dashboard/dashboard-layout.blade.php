<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <link rel="shortcut icon" href="{{ asset('storage/avatar/klinik_gunung_avatar.jpg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-gray-800">

    <div class="tooltip-arrow" data-popper-arrow></div>

    <x-dashboard-navbar></x-dashboard-navbar>

    {{-- <x-admin-sidebar></x-admin-sidebar> --}}

    @if (auth()->user()->role === 'admin')
        <x-admin-sidebar></x-admin-sidebar>
    @elseif(auth()->user()->role === 'paramedis')
        <x-paramedis-sidebar></x-paramedis-sidebar>
    @elseif(auth()->user()->role === 'pendaki')
        <x-pendaki-sidebar></x-pendaki-sidebar>
    @elseif(auth()->user()->role === 'dokter')
        <x-dokter-sidebar></x-dokter-sidebar>
    @endif

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

        {{ $slot }}

        <x-admin-footer></x-admin-footer>

    </div>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://flowbite-admin-dashboard.vercel.app//app.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
</body>

</html>
