<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    @vite(['resources/css/app.css', 'resources/js/app.js'], ['version' => '1.0'])


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" rel="icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon" as="image">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
        html,
        body {
            background-color: white;
        }
    </style>

</head>

<body>
    <x-sidebar />
    <header>
        <x-navbar-admin header="Dashboard" class="sm:pl-64" />
        <x-alert.alert-modal />
    </header>
    <main id="main-content" class="h-full bg-white">

        @yield('content')
    </main>

    <script type="text/javascript" src="{{ asset('assets/js/admin.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('assets/js/alert.js') }}"></script>
    <script src="{{ asset('assets/js/map.js') }}"></script>

</body>

</html>
