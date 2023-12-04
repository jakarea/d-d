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

    {{-- bootstrap css --}}
    <link rel="stylesheet" href="{{ url('public/assets/css/bootstrap.min.css') }}">

    <!-- plugin CSS start -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- plugin CSS end -->

    <!-- custom CSS start -->
    <link rel="stylesheet" href="{{ url('public/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/responsive.css') }}">

    @yield('style')

    <title>DnD | @yield('title')</title>
</head>

<body>

    {{-- dashboard page wrapper start --}}
    <main class="root-main-wrapper">
        {{-- sidebar start --}}
        @include('partials.sidebar')
        {{-- sidebar end --}}

        {{-- header start --}}
        @include('partials.header')
        {{-- header end --}}

        {{-- main secction start --}}
        @yield('content')
        {{-- main secction end --}}
    </main>
    {{-- dashboard page wrapper end --}}
    @yield('drawer')

    <!-- Bootstrap Bundle with Popper JS start -->
    <script src="{{ url('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/assets/js/custom.js') }}"></script>
    <!-- Bootstrap Bundle with Popper JS end -->
    @yield('script')

</body>
</html>
