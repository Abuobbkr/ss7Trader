<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="dark" data-toggled="close">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/brand-logos/favicon.ico') }}" type="image/x-icon">

    <!-- Preload Critical CSS -->
    <link rel="preload" href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('css/styles.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">

    <link rel="preload" href="{{ asset('css/custom.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styles.min.css') }}" rel="stylesheet">
    </noscript>

    <!-- Main CSS -->
    <link href="{{ asset('css/styles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet">

    <!-- Plugin CSS -->
    <link href="{{ asset('libs/node-waves/waves.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/@simonwep/pickr/themes/nano.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

</head>

<body>
    @include('partials.switcher')
    <div class="page">
        @include('partials.header')
        @include('partials.sidebar')
        @yield('content')
        @include('partials.footer')
    </div>

    <!-- Scroll Top & Overlay -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>

    <!-- JS Libraries (Defer where possible) -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script src="{{ asset('libs/@popperjs/core/umd/popper.min.js') }}" defer></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}" defer></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}" defer></script>
    <script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}" defer></script>
    <script src="{{ asset('libs/jsvectormap/js/jsvectormap.min.js') }}" defer></script>
    <script src="{{ asset('libs/jsvectormap/maps/world-merc.js') }}" defer></script>
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}" defer></script>
    <script src="{{ asset('libs/chart.js/chart.min.js') }}" defer></script>
    <script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}" defer></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/defaultmenu.min.js') }}" defer></script>
    <script src="{{ asset('js/sticky.js') }}" defer></script>
    <script src="{{ asset('js/simplebar.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/crm-dashboard.js') }}" defer></script>
    <script src="{{ asset('js/custom-switcher.min.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>



    @stack('scripts') <!-- For page-specific JS -->
</body>

</html>