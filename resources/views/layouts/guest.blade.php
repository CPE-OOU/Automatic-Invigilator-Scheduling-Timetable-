<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <title>Invig | Dashboard</title>

    <!-- Preload and Lazy Load Stylesheets -->
    <link rel="preload" href="{{ asset('temp/assets/css/soft-ui-dashboard.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'" />
    <noscript><link rel="stylesheet" href="{{ asset('temp/assets/css/soft-ui-dashboard.css') }}" /></noscript>

    @section('styles')
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/portraitlogo.png') }}">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.png') }}">
    <link href="{{ asset('temp/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('temp/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('temp/assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/nucleo-icons@1.0.1/css/nucleo-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('temp/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('temp/assets/css/soft-ui-dashboard.css') }}" rel="stylesheet" />
    @show

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
<body class="g-sidenav-show bg-gray-100">
@auth
@yield('auth')
@endauth
@guest
@yield('guest')
@endguest


@if(session()->has('success'))
<div x-data="{ show: true}"
     x-init="setTimeout(() => show = false, 4000)"
     x-show="show"
     class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
    <p class="m-0">{{ session('success') }}</p>
</div>
@endif

<script src="{{ asset('/js/toastr.min.js') }}"></script>
<script>
    @if(Session::has('success'))
        toastr.success("{{Session::get('success')}}")
    @endif
    @if(Session::has('info'))
        toastr.info("{{Session::get('info')}}")
    @endif
</script>

<!-- Lazy Load JavaScript Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js" defer></script>

<!-- Core JS Files -->
<script src="{{ asset('temp/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('temp/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('temp/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('temp/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('temp/assets/js/plugins/fullcalendar.min.js') }}"></script>
<script src="{{ asset('temp/assets/js/plugins/chartjs.min.js') }}"></script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script src="{{ asset('temp/assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.4/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
</body>
</html>
