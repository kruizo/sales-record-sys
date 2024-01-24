<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @yield('import')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div id="app">
        <main>
            <div class="flex flex-col items-center px-10">
                <a href="{{ route('/') }}" tabindex="-1">
                    <img src="{{ asset('assets/image/logo.png')}}" alt="logo" class="w-20 py-6" srcset="">
                </a>
                <div class="justify-content-center bg-gray-800 w-full md:w-1/2 lg:w-1/3">
                    @yield('content')

                </div>
            </div>
        </main>
    </div>


</body>

@yield('modal')

</html>