<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('assets/image/logo.png')}}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets/image/logo.png')}}" type="image/x-icon">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Scripts -->
    <script type="module" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'], ['version' => '1.0'])
    <style>
        body {
            background-color: white;
        }
    </style>
</head>

<body>

    <main>
        <x-sidebar />
        <!-- content -->
        <x-navbar-admin header="Dashboard" class="sm:pl-64" />

        <iframe src="{{ route('/login') }}" frameborder="0" width="100%" height="100%"></iframe>

    </main>
    <script type="text/javascript" src="{{ asset('assets/js/sidebar.js') }}"></script>
</body>

</html>