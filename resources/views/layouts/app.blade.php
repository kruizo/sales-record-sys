<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @yield('import')
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">

    <link rel="icon" href="{{asset('assets/image/logo.png')}}" type="image/x-icon">
    <!-- Scripts -->
    <script type="module" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'], ['version' => '1.0'])

</head>

<body class="antialiased">
    <div id="app">
        <header>
            <x-navbar />
        </header>
        <main>

            @yield('content')
        </main>
    </div>
    <div id="modal-container"></div>
    <script type="text/javascript" src="{{ asset('assets/js/navbar.js') }}"></script>

</body>

@yield('modal')

</html>