<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="D&D is a Ecommerce Platform">
    <meta property="og:title" content="D&D">
    <meta property="og:type" content="E-Commerce">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="theme-color" content="#fff">

    <!-- Bootstrap CSS start -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <!-- Bootstrap CSS end -->

    <!-- plugin CSS start -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- plugin CSS end -->

    <!-- custom CSS start -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/responsive.css') }}">
    <!-- custom CSS end -->
    @yield('style')
    <title>@yield('title')</title>
    </head>

    <body>

    <!-- dashboard page wrapper start -->
    <main class="root-main-wrapper">
        <!-- sidebar wrapper start -->
        <aside class="sidebar-wrap">
        <!-- logo -->
        <div class="logo-box">
            <a href="#">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo" class="img-fluid">
            </a>
        </div>
        <!-- logo -->

        <!-- navbar -->
        <div class="side-navbar-wrap">
            <ul>
            <li><a href="#"><img src="{{ asset('assets/images/icons/dashboard.svg') }}" alt="I" class="img-fluid">
                Dashboard</a></li>
            <li><a href="#"><img src="{{ asset('assets/images/icons/marketplace.svg') }}" alt="I" class="img-fluid"> Marketplace</a>
            </li>
            <li><a href="#" class="active"><img src="{{ asset('assets/images/icons/company.svg') }}" alt="I" class="img-fluid">
                Company</a></li>
            <li><a href="#"><img src="{{ asset('assets/images/icons/customer.svg') }}" alt="I" class="img-fluid"> Customer</a></li>
            <li><a href="#"><img src="{{ asset('assets/images/icons/analytics.svg') }}" alt="I" class="img-fluid"> Analytics</a></li>
            <li><a href="#"><img src="{{ asset('assets/images/icons/earnings.svg') }}" alt="I" class="img-fluid"> Earning</a></li>
            <li><a href="#"><img src="{{ asset('assets/images/icons/fee.svg') }}" alt="I" class="img-fluid"> Monthly &amp; Yearly
                Fee</a></li>
            <li><a href="#"><img src="{{ asset('assets/images/icons/advertisment.svg') }}" alt="I" class="img-fluid"> Advertisement</a>
            </li>
            </ul>
        </div>
        <!-- navbar -->
        </aside>
        <!-- sidebar wrapper end -->

        <!-- header part start -->
        <header class="header-area">
        <!-- search box start -->
        <div class="header-search-box">
            <img src="{{ asset('assets/images/icons/search.svg') }}" alt="S" class="img-fluid search">
            <input type="text" class="form-control" placeholder="Search">
            <a href="#" class="filter">
            <img src="{{ asset('assets/images/icons/filter.svg') }}" alt="F" class="img-fluid">
            </a>
        </div>
        <!-- search box end -->

        <!-- header icons start -->
        <div class="header-icons-box">
            <ul>
            <li>
                <a href="#">
                <span></span>
                <img src="{{ asset('assets/images/icons/bell.svg') }}" alt="B" class="img-fluid">
                </a>
            </li>
            <li>
                <a href="#" class="user">
                <img src="{{ asset('assets/images/user.png') }}" alt="U" class="img-fluid">
                <i class="fas fa-angle-down"></i>
                </a>
            </li>
            </ul>
        </div>
        <!-- header icons end -->
        </header>
        <!-- header part end -->
        @yield('content')
    </main>
    <!-- dashboard page wrapper end -->
    @yield('drawer')

    <!-- Bootstrap Bundle with Popper JS start -->
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/custom.js') }}"></script>
    <!-- Bootstrap Bundle with Popper JS end -->
    @yield('script')
</body>

</html>