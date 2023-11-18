<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="Invig" content="invig" />

    <title>Invig | Invigilation Scheduling Software</title>

     <!-- Favicon -->
     <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
     <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="{{ asset('public/plugins/themify-icons/themify-icons.css') }}">
    <!-- slick slider -->
    <link rel="stylesheet" href="{{ asset('public/plugins/slick/slick.css') }}">
    <!-- venobox popup -->
    <link rel="stylesheet" href="{{ asset('public/plugins/Venobox/venobox.css') }}">
    <!-- aos -->
    <link rel="stylesheet" href="{{ asset('public/plugins/aos/aos.css') }}">
    <!-- Main Stylesheet -->
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet">

    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
                .then(function(registration) {
                    console.log('Service Worker registered with scope:', registration.scope);
                })
                .catch(function(error) {
                    console.error('Service Worker registration failed:', error);
                });
        }
    </script>
</head>

<body>
    
    <div class="">
        @yield('content')
    </div>
    


      <!-- jQuery -->
    <script src="{{ asset('public/plugins/jQuery/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('public/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <!-- slick slider -->
    <script src="{{ asset('public/plugins/slick/slick.min.js') }}"></script>
    <!-- venobox -->
    <script src="{{ asset('public/plugins/Venobox/venobox.min.js') }}"></script>
    <!-- aos -->
    <script src="{{ asset('public/plugins/aos/aos.js') }}"></script>
    <!-- Main Script -->
    <script src="{{ asset('public/js/script.js') }}"></script>
</body>


</html>
