<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invig | Invigilation Scheduling Software</title>
    <meta name="description" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

     @section('styles')
     <link href="css/common.css" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
<link href="css/theme-03.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('temp/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> -->
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('sign/css/fontawesome-all.min.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('sign/font/flaticon.css') }}">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('sign/style.css') }}"> 

     <link rel="stylesheet" href="sign/style.css">     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="">
        @yield('content')
    </div>
    
    <!-- Uncomment the preloader section if needed -->
    <!-- <div id="preloader" class="preloader">
        <div class='inner'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </div> -->

    <script src="{{ asset('sign/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('sign/js/bootstrap.min.js') }}"></script>
    <!-- Imagesloaded js -->
    <script src="{{ asset('sign/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Validator js -->
    <script src="{{ asset('sign/js/validator.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('sign/js/main.js') }}"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/demo.js"></script>
</body>
</html>
