<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: url('/images/login-background.jpg') no-repeat center center fixed;
            background-size: cover;
            overflow: hidden;
        }
    </style>
</head>
<body class="font-poppins text-gray-900 antialiased">
    <div class="min-h-screen flex items-center justify-end pr-24 relative">
        <!-- Large Logo Positioned Just Above the Bike -->
        <div class="absolute top-[20%] left-[2%] z-10">
            <a href="{{ url('/') }}">
                <img src="/images/logo.png" alt="Go Pedal PH Logo" class="w-[900px]">
            </a>
        </div>

        <!-- Login/Register Card with Light Blue Border -->
        <div class="w-full max-w-md p-8 bg-white bg-opacity-95 backdrop-blur-md rounded-xl shadow-lg z-20 border border-blue-600">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
