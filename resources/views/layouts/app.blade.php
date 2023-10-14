<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="Invig" content="invig" />

    <title>Invig | Invigilation Scheduling Software</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="{{ asset('plugins/themify-icons/themify-icons.css') }}">
    <!-- slick slider -->
    <link rel="stylesheet" href="{{ asset('plugins/slick/slick.css') }}">
    <!-- venobox popup -->
    <link rel="stylesheet" href="{{ asset('plugins/Venobox/venobox.css') }}">
    <!-- aos -->
    <link rel="stylesheet" href="{{ asset('plugins/aos/aos.css') }}">
    <!-- Main Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <!-- Add your navigation bar or header here -->
    
    <div class="">
        @yield('content')
    </div>
    


      <!-- jQuery -->
    <script src="{{ asset('plugins/jQuery/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('plugins/bootstrap/bootstrap.min.js') }}"></script>
    <!-- slick slider -->
    <script src="{{ asset('plugins/slick/slick.min.js') }}"></script>
    <!-- venobox -->
    <script src="{{ asset('plugins/Venobox/venobox.min.js') }}"></script>
    <!-- aos -->
    <script src="{{ asset('plugins/aos/aos.js') }}"></script>
    <!-- Main Script -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>


</html>
