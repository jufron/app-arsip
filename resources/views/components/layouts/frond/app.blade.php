<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'arsip' }}</title>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    {{-- ? CSS file build --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-B_jRX8Sy.css') }}">

    {{-- ? JavaScript file build --}}
    <script src="{{ asset('build/assets/app-DaBYqt0m.js') }}" defer></script>

    {{-- ? Style tambahan khusus halaman --}}
    {{ $myStyle ?? '' }}
</head>
<body>
    {{ $slot }}

    {{ $myScript ?? null }}
</body>
</html>
