<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
    @routes
    <!--  Title -->
    <title>@yield('title', $title)</title>
    <!-- Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Hitung biaya bangun rumah" />
    <meta name="author" content="PT Arkatama Multisolusindo" />
    <meta name="keywords" content="Simulasi anggaran membangun rumah" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="google" content="notranslate" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('/') }}images/logos/favicon.ico" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('/') }}libs/owl.carousel/dist/assets/owl.carousel.min.css">
    <link id="themeColors" rel="stylesheet" href="{{ asset('/') }}libs/select2/dist/css/select2.min.css" />
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('/') }}css/style-orange.min.css" />
    <style>
        .sidebar-nav ul .sidebar-item .first-level .sidebar-link .ti {
            font-size: 15px !important;
        }

        @media only screen and (min-width: 768px) {
            .scrolling-wrapper {
                overflow-y: hidden;
                overflow-x: auto;
                white-space: nowrap;
                flex-wrap: nowrap !important;
            }

            .scrolling-wrapper::-webkit-scrollbar {
                display: none;
            }

            .sidebar-item {
                margin-right: 10px;
                min-height: 40px !important;
            }

            ul.first-level {
                position: sticky !important;
                max-width: max-content !important;
            }
        }

    </style>
    <link rel="stylesheet" href="{{ asset('/') }}libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link id="themeColors" rel="stylesheet" href="{{ asset('/') }}css/jquery.json-viewer.css" />
    <link id="themeColors" rel="stylesheet" href="{{ asset('/') }}libs/sweetalert2/dist/sweetalert2.min.css" />
    @stack('styles')
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('/') }}images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="horizontal" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-xl navbar-light container-fluid px-0">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link sidebartoggler ms-n3" id="sidebarCollapse" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-xl-block">
                        <a href="{{ route('dashboard') }}" class="text-nowrap nav-link">
                            <img src="{{ asset('/') }}images/logos/dark-logo.svg" class="dark-logo" width="180"
                                alt="" />
                            <img src="{{ asset('/') }}images/logos/light-logo.svg" class="light-logo" width="180"
                                alt="" />
                        </a>
                    </li>
                </ul>
                <div class="d-block d-xl-none">
                    <a href="{{ route('dashboard') }}" class="text-nowrap nav-link">
                        <img src="{{ asset('/') }}images/logos/dark-logo.svg" class="dark-logo" width="180" alt="" />
                        <img src="{{ asset('/') }}images/logos/light-logo.svg" class="light-logo" width="180" alt="" />
                    </a>
                </div>

                <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="p-2">
                        <i class="ti ti-dots fs-7"></i>
                    </span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                            <li class="nav-item dropdown d-none">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-bell-ringing"></i>
                                    <div class="notification bg-primary rounded-circle"></div>
                                </a>
                                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="d-flex align-items-center justify-content-between py-3 px-7">
                                        <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                                        <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm">5 new</span>
                                    </div>
                                    <div class="message-body" data-simplebar>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="../../dist/images/profile/user-1.jpg" alt="user"
                                                    class="rounded-circle" width="48" height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">Roman Joined the Team!</h6>
                                                <span class="d-block">Congratulate him</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="../../dist/images/profile/user-2.jpg" alt="user"
                                                    class="rounded-circle" width="48" height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">New message</h6>
                                                <span class="d-block">Salma sent you new message</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="../../dist/images/profile/user-3.jpg" alt="user"
                                                    class="rounded-circle" width="48" height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">Bianca sent payment</h6>
                                                <span class="d-block">Check your earnings</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="../../dist/images/profile/user-4.jpg" alt="user"
                                                    class="rounded-circle" width="48" height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">Jolly completed tasks</h6>
                                                <span class="d-block">Assign her new tasks</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="../../dist/images/profile/user-5.jpg" alt="user"
                                                    class="rounded-circle" width="48" height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">John received payment</h6>
                                                <span class="d-block">$230 deducted from account</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="../../dist/images/profile/user-1.jpg" alt="user"
                                                    class="rounded-circle" width="48" height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold">Roman Joined the Team!</h6>
                                                <span class="d-block">Congratulate him</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="py-6 px-7 mb-1">
                                        <button class="btn btn-outline-primary w-100"> See All Notifications </button>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="d-flex align-items-center">
                                        <div class="user-profile-img">
                                            <img src="{{ asset('/') }}images/profile/user-1.jpg" class="rounded-circle"
                                                width="35" height="35" alt="" />
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop1">
                                    <div class="profile-dropdown position-relative" data-simplebar>
                                        <div class="py-3 px-7 pb-0">
                                            <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                        </div>
                                        <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                            <img src="{{ auth()->user()->avatar_url }}" class="rounded-circle"
                                                width="80" height="80" alt="" />
                                            <div class="ms-3">
                                                <h5 class="mb-1 fs-3">{{ auth()->user()->name }}</h5>
                                                <span
                                                    class="mb-1 d-block text-dark">{{ auth()->user()->roles()->first()->name }}</span>
                                                <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                                    <i class="ti ti-mail fs-4"></i> {{ auth()->user()->email }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="message-body">
                                            <a href="./page-user-profile.html"
                                                class="py-8 px-7 mt-8 d-flex align-items-center">
                                                <span
                                                    class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                                    <img src="{{ asset('/') }}images/svgs/icon-account.svg" alt=""
                                                        width="24" height="24">
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                                                    <span class="d-block text-dark">Account Settings</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-grid py-4 px-7 pt-8">
                                            <a href="{{ route('logout') }}" class="btn btn-outline-primary">Log
                                                Out</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Header End -->
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar container-fluid">
                    <ul id="sidebarnav" class="scrolling-wrapper">
                        <!-- ============================= -->
                        <!-- Home -->
                        <!-- ============================= -->
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Dashboard</span>
                        </li>
                        <!-- =================== -->
                        <!-- Dashboard -->
                        <!-- =================== -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-aperture"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('dashboard.booking.bookings.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-book"></i>
                                </span>
                                <span class="hide-menu">Pemesanan Kendaraan</span>
                            </a>
                        </li>
                        <!-- ============================= -->
                        <!-- Apps -->
                        <!-- ============================= -->
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Data Master</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('dashboard.driver.drivers.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-shield"></i>
                                </span>
                                <span class="hide-menu">Manajemen Pengguna</span>
                            </a>
                        </li>
                        <li class="sidebar-item item">
                            <a class="sidebar-link" href="{{route('dashboard.vehicle.vehicles.index')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-zoom-money"></i>
                                </span>
                                <span class="hide-menu">Kendaraan</span>
                            </a>
                        </li>
                        <!-- ============================= -->
                        <!-- UI -->
                        <!-- ============================= -->
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Pengaturan & Lain-lain</span>
                        </li>
                        <!-- =================== -->
                        <!-- UI Elements -->
                        <!-- =================== -->
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                                <span class="d-flex">
                                    <i class="ti ti-layout-grid"></i>
                                </span>
                                <span class="hide-menu">Lainnya</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="./ui-accordian.html" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-database-export"></i>
                                        </div>
                                        <span class="hide-menu">Database Backup</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('dashboard.logs.activity.index') }}" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-activity"></i>
                                        </div>
                                        <span class="hide-menu">Activity Log</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="./ui-badge.html" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-bug"></i>
                                        </div>
                                        <span class="hide-menu">Error Log
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- Sidebar End -->
        <!-- Main wrapper -->
        <div class="body-wrapper">
            <div class="container-fluid">
                @if (isset($head) && isset($breadcrumbs))
                <div class="card bg-light-info shadow-none position-relative overflow-hidden">
                    <div class="card-body px-4 py-3">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h4 class="fw-semibold mb-8">{{ $head }}</h4>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        @foreach ($breadcrumbs as $breadcrumb)
                                        @if ($breadcrumb->active)
                                        <li class="breadcrumb-item" aria-current="page">
                                            {{ $breadcrumb->name }}</li>
                                        @else
                                        <li class="breadcrumb-item"><a class="text-muted "
                                                href="{{ $breadcrumb->link }}">{{ $breadcrumb->name }}</a>
                                        </li>
                                        @endif
                                        @endforeach

                                    </ol>
                                </nav>
                            </div>
                            <div class="col-3">
                                <div class="text-center mb-n5">
                                    <img src="{{ asset('/') }}images/breadcrumb/ChatBc.png" alt=""
                                        class="img-fluid mb-n4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @yield('content')
            </div>
        </div>
        <div class="dark-transparent sidebartoggler"></div>
    </div>

    <!--  Customizer -->
    <button class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
        type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <i class="ti ti-settings fs-7" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Settings"></i>
    </button>
    <div class="offcanvas offcanvas-end customizer" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel" data-simplebar="">
        <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
            <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Settings</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4">
            <div class="theme-option pb-4">
                <h6 class="fw-semibold fs-4 mb-1">Theme Option</h6>
                <div class="d-flex align-items-center gap-3 my-3">
                    <a href="javascript:void(0)" onclick="toggleTheme('../../dist/css/style.min.css')"
                        class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 light-theme text-dark">
                        <i class="ti ti-brightness-up fs-7 text-primary"></i>
                        <span class="text-dark">Light</span>
                    </a>
                    <a href="javascript:void(0)" onclick="toggleTheme('../../dist/css/style-dark.min.css')"
                        class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 dark-theme text-dark">
                        <i class="ti ti-moon fs-7 "></i>
                        <span class="text-dark">Dark</span>
                    </a>
                </div>
            </div>
            <div class="theme-direction pb-4">
                <h6 class="fw-semibold fs-4 mb-1">Theme Direction</h6>
                <div class="d-flex align-items-center gap-3 my-3">
                    <a href="./index.html"
                        class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
                        <i class="ti ti-text-direction-ltr fs-6 text-primary"></i>
                        <span class="text-dark">LTR</span>
                    </a>
                    <a href="../rtl/index.html"
                        class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
                        <i class="ti ti-text-direction-rtl fs-6 text-dark"></i>
                        <span class="text-dark">RTL</span>
                    </a>
                </div>
            </div>
            <div class="theme-colors pb-4">
                <h6 class="fw-semibold fs-4 mb-1">Theme Colors</h6>
                <div class="d-flex align-items-center gap-3 my-3">
                    <ul class="list-unstyled mb-0 d-flex gap-3 flex-wrap change-colors">
                        <li
                            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0)"
                                class="rounded-circle position-relative d-block customizer-bgcolor skin1-bluetheme-primary active-theme "
                                onclick="toggleTheme('../../dist/css/style.min.css')" data-color="blue_theme"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="BLUE_THEME"><i
                                    class="ti ti-check text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                        </li>
                        <li
                            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0)"
                                class="rounded-circle position-relative d-block customizer-bgcolor skin2-aquatheme-primary "
                                onclick="toggleTheme('../../dist/css/style-aqua.min.css')" data-color="aqua_theme"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="AQUA_THEME"><i
                                    class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                        </li>
                        <li
                            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0)"
                                class="rounded-circle position-relative d-block customizer-bgcolor skin3-purpletheme-primary"
                                onclick="toggleTheme('../../dist/css/style-purple.min.css')" data-color="purple_theme"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="PURPLE_THEME"><i
                                    class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                        </li>
                        <li
                            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0)"
                                class="rounded-circle position-relative d-block customizer-bgcolor skin4-greentheme-primary"
                                onclick="toggleTheme('../../dist/css/style-green.min.css')" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="GREEN_THEME"><i
                                    class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                        </li>
                        <li
                            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0)"
                                class="rounded-circle position-relative d-block customizer-bgcolor skin5-cyantheme-primary"
                                onclick="toggleTheme('../../dist/css/style-cyan.min.css')" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="CYAN_THEME"><i
                                    class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                        </li>
                        <li
                            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0)"
                                class="rounded-circle position-relative d-block customizer-bgcolor skin6-orangetheme-primary"
                                onclick="toggleTheme('../../dist/css/style-orange.min.css')" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="ORANGE_THEME"><i
                                    class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="layout-type pb-4">
                <h6 class="fw-semibold fs-4 mb-1">Layout Type</h6>
                <div class="d-flex align-items-center gap-3 my-3">
                    <form action="{{ route('change-layout') }}" method="post">
                        @csrf
                        <button type="submit" name="layout_type" value="layouts.dashboard.vertical" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
                            <i class="ti ti-layout-sidebar fs-6 text-dark"></i>
                            <span class="text-dark">Vertical</span>
                        </button>
                    </form>
                    <form action="{{ route('change-layout') }}" method="post">
                        @csrf
                        <button type="submit" name="layout_type" value="layouts.dashboard.horizontal" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
                            <i class="ti ti-layout-navbar fs-6 text-primary"></i>
                            <span class="text-dark">Horizontal</span>
                        </button>
                    </form>
                </div>
            </div>
            {{-- <div class="layout-type pb-4">
                <h6 class="fw-semibold fs-4 mb-1">Layout Type</h6>
                <div class="d-flex align-items-center gap-3 my-3">
                    <a href="?layout=vertical"
                        class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
                        <i class="ti ti-layout-sidebar fs-6 text-primary"></i>
                        <span class="text-dark">Vertical</span>
                    </a>
                    <a href="?layout=horizontal"
                        class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
                        <i class="ti ti-layout-navbar fs-6 text-dark"></i>
                        <span class="text-dark">Horizontal</span>
                    </a>
                </div>
            </div> --}}
            <div class="container-option pb-4">
                <h6 class="fw-semibold fs-4 mb-1">Container Option</h6>
                <div class="d-flex align-items-center gap-3 my-3">
                    <a href="javascript:void(0)"
                        class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 boxed-width text-dark">
                        <i class="ti ti-layout-distribute-vertical fs-7 text-primary"></i>
                        <span class="text-dark">Boxed</span>
                    </a>
                    <a href="javascript:void(0)"
                        class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 full-width text-dark">
                        <i class="ti ti-layout-distribute-horizontal fs-7"></i>
                        <span class="text-dark">Full</span>
                    </a>
                </div>
            </div>
            <div class="card-with pb-4">
                <h6 class="fw-semibold fs-4 mb-1">Card With</h6>
                <div class="d-flex align-items-center gap-3 my-3">
                    <a href="javascript:void(0)"
                        class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 text-dark cardborder">
                        <i class="ti ti-border-outer fs-7"></i>
                        <span class="text-dark">Border</span>
                    </a>
                    <a href="javascript:void(0)"
                        class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 cardshadow">
                        <i class="ti ti-border-none fs-7"></i>
                        <span class="text-dark">Shadow</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Customizer -->

    <!-- Import Js Files -->
    <script src="{{ asset('/') }}libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('/') }}libs/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ asset('/') }}libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- core files -->
    <script src="{{ asset('/') }}js/app.min.js"></script>
    <script src="{{ asset('/') }}js/app.horizontal.init.js"></script>
    <script src="{{ asset('/') }}js/app-style-switcher.js"></script>
    <script src="{{ asset('/') }}js/sidebarmenu.js"></script>
    <script src="{{ asset('/') }}js/custom.js"></script>
    <!-- current page js files -->
    <script src="{{ asset('/') }}libs/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="{{ asset('/') }}libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="{{ asset('/') }}js/dashboard.js"></script>
    <script src="{{ asset('/') }}js/jquery.json-viewer.js"></script>
    <script src="{{ asset('/') }}js/plugins/toastr-init.js"></script>
    <script src="{{ asset('/') }}js/app.helper.js"></script>
    <script src="{{ asset('/') }}libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('/') }}libs/select2/dist/js/select2.min.js"></script>

    @stack('scripts')
</body>

</html>
