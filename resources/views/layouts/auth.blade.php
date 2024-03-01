<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">
    @yield('title')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @yield('import')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html,
        body {
            background-color: rgb(17 24 39);
        }
    </style>
</head>

<body class="antialiased ">
    <div id="app">
        <main>
            <div class="flex flex-col items-center px-10 h-screen ">
                <a href="{{ route('/') }}" tabindex="-1">
                    <img src="{{ asset('assets/image/logo.png') }}" alt="logo" class="w-20 py-6" srcset="">
                </a>
                <div class="justify-content-center w-full md:w-1/2 lg:w-1/3">
                    @yield('content')

                </div>
            </div>
        </main>
    </div>


</body>

@yield('modal')

</html>
