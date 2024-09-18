<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Klinik Gunung' }}</title>
    <link rel="shortcut icon" href="{{ asset('storage/avatar/klinik_gunung_avatar.jpg') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <x-dark-mode />
</head>

<body class="bg-gray-50 dark:bg-gray-800">

    <div class="tooltip-arrow" data-popper-arrow></div>

    <x-dashboard-navbar />

    <x-sidebar />
    <div class="flex flex-col min-h-screen">
        <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
            <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
                {{ $slot }}
            </div>
        </div>
    </div>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://flowbite-admin-dashboard.vercel.app//app.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast-simple');
            if (toast) {
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 3000); // Hilang setelah 3 detik
            }
        });
    </script>
</body>

</html>
