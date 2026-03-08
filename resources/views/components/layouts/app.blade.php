<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BMN - Kementerian Kelautan dan Perikanan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <style>
        [x-cloak] {
            display: none !important;
        }
        .swal2-container {
            z-index: 100000 !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @filamentStyles
    @vite('resources/css/app.css')
</head>
<body class="antialiased text-slate-900 bg-slate-50 font-sans">
    {{ $slot }}

    @filamentScripts
    @vite('resources/js/app.js')
</body>
</html>
