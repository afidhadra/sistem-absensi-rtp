<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Absensi RTP' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-200 min-h-screen">
    @yield('content')
    <x-confirm-modal />
    <x-toast />
    @if (session('success'))
        <div x-data x-init="$store.toast.show('{{ session('success') }}', 'success')"></div>
    @endif
    @if (session('error'))
        <div x-data x-init="$store.toast.show('{{ session('error') }}', 'error')"></div>
    @endif
</body>
</html>
