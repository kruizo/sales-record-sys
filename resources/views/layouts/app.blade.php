<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'], ['version' => '1.0'])
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
            @if(session()->has('errors') || session()->has('error') )
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <div id="toast-simple" class="animate-toast flex fixed top-40 left-0 right-0 mx-auto z-20 items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-gray-900 border border-red-600 divide-x rtl:divide-x-reverse divide-red-600 rounded-lg shadow " role="alert">
                                <svg class="flex-shrink-0 text-red-600 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <div class="ps-4 text-sm font-normal text-red-600">{{ $error }}</div>
                            </div>
                        @endforeach
                        @if (session()->has('error'))
                            <div id="toast-simple" class="animate-toast flex fixed top-40 left-0 right-0 mx-auto z-20 items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-gray-900 border border-red-600 divide-x rtl:divide-x-reverse divide-red-600 rounded-lg shadow " role="alert">
                                <svg class="flex-shrink-0 text-red-600 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <div class="ps-4 text-sm font-normal text-red-600">{{ session('error') }}</div>
                            </div>
                        @endif
                    </ul>
                </div>
            @endif

        </header>


        <main>

            @yield('content')
        </main>

    </div>
    <script type="text/javascript" src="{{ asset('assets/js/navbar.js') }}"></script>
    <script src="{{ asset('assets/js/alert.js') }}"></script>
    @if (!auth()->check())
       @include('modals.authentication')
    @endif
   
</body>
</html>