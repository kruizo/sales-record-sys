<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    @vite(['resources/css/app.css', 'resources/js/app.js'], ['version' => '1.0'])


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('assets/image/logo.png')}}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Scripts -->

    <style>
        body {
            background-color: white;

        }
    </style>
</head>

<body>
    <x-sidebar />
    <x-navbar-admin header="Dashboard" class="sm:pl-64" />
    <main id="main-content">
        @yield('content')
    </main>

    <script type="text/javascript" src="{{ asset('assets/js/sidebar.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            loadContent("delivery");

            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();

                    const section = this.dataset.section;
                    loadContent(section);
                });
            });
        });

        // Fetch and load content dynamically
        function loadContent(section) {
            // Use AJAX or another method to fetch content based on the section
            // Example using fetch:
            fetch(`${section}`)
                .then(response => response.text())
                .then(html => {
                    // Replace the content of main-content with the loaded HTML
                    document.getElementById('main-content').innerHTML = html;
                })
                .catch(error => console.error('Error loading content:', error));
        }
    </script>
</body>

</html>