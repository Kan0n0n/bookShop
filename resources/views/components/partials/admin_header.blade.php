<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LOTU Admin Page</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Dashboard/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ URL::asset('Dashboard/images/logo-icon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ URL::to('/admin') }}"><img
                        src="{{ URL::asset('Dashboard/images/logo-removebg-preview.png') }}" class="mr-2"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{ URL::to('/admin') }}"><img
                        src="{{ URL::asset('Dashboard/images/logo-icon.png') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="{{ asset(Auth::user()->avatar_path) }}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ URL::to('/user/edit/' . Auth::user()->id) }}">
                                <i class="ti-settings text-primary"></i>
                                Edit Profile
                            </a>
                            <a class="dropdown-item" href="{{ URL::to('/user/password/edit/') }}">
                                <i class="ti-settings text-primary"></i>
                                Change Password
                            </a>
                            <a class="dropdown-item" href="{{ URL::to('/') }}">
                                <i class="ti-power-off text-primary"></i>
                                Return to Home
                            </a>
                            <a class="dropdown-item" href="{{ URL::to('/logout') }}">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>

            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('/admin') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <i class="icon-head menu-icon"></i>
                            <span class="menu-title">User Manager</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/admin/user') }}">User</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Books Manager</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/admin/book') }}">Books</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/admin/author') }}">Authors</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/admin/publisher') }}">Publisher</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/admin/category') }}">Categories</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#cart" aria-expanded="false"
                            aria-controls="cart">
                            <i class="ti-shopping-cart menu-icon"></i>
                            <span class="menu-title">Cart Manager</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="cart">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/admin/cart') }}">Cart</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#borrow" aria-expanded="false"
                            aria-controls="borrow">
                            <i class="ti-book menu-icon"></i>
                            <span class="menu-title">Borrow Manager</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="borrow">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/admin/borrow') }}">Borrow
                                        Book</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
