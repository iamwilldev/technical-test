<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    <!--  Title -->
    <title>
        @yield('title', config('app.name'))
    </title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="google" content="notranslate" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('/') }}images/logos/favicon.ico" />
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('/') }}css/style.min.css" />

    @stack('css')
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('/') }}images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('/') }}images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <a href="./index.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                            <img src="{{ asset('/') }}images/logos/dark-logo.svg" width="180" alt="">
                        </a>
                        <div class="d-none d-xl-flex align-items-center justify-content-center"
                            style="height: calc(100vh - 80px);">
                            <img src="{{ asset('/') }}images/backgrounds/login-security.svg" alt=""
                                class="img-fluid" width="500">
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--  Import Js Files -->
    <script src="{{ asset('/') }}libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('/') }}libs/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ asset('/') }}libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--  core files -->
    <script src="{{ asset('/') }}js/app.min.js"></script>
    <script src="{{ asset('/') }}js/app.init.js"></script>
    <script src="{{ asset('/') }}js/app-style-switcher.js"></script>
    <script src="{{ asset('/') }}js/sidebarmenu.js"></script>

    <script src="{{ asset('/') }}js/plugins/toastr-init.js"></script>

    <script src="{{ asset('/') }}js/custom.js"></script>
    <script src="{{ asset('/') }}js/app.helper.js"></script>

    @stack('js')
</body>

</html>
