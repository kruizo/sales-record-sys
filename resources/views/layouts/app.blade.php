<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preload" as="style" href="{{ Vite::asset('resources/css/app.css') }}" onload="this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}"></noscript>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @yield('import')
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">
    <!-- Scripts -->
    <script type="module" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        html {
            background-color: rgb(3 7 18);
        }
    </style>
</head>

<body class="antialiased">
    <div id="app">
        <header>
            <x-navbar />
            <x-alert.alert-toast />
        </header>


        <main>

            @yield('content')
        </main>

    </div>

    <script type="text/javascript" src="{{ asset('assets/js/navbar.js') }}"></script>
    <script src="{{ asset('assets/js/alert.js') }}"></script>
    @guest
        @include('modals.authentication')
    @endguest

</body>

</html>
