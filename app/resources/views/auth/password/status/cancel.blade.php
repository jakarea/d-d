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
    <link rel="stylesheet" href="{{ url('assets/css/payments.css') }}"> 
    <link rel="stylesheet" href="{{ url('assets/css/responsive.css') }}">
    @yield('style')
    <!-- custom CSS end -->

    <title>DnD || Authintication </title>
</head>

<body>

<div class="wrap-outer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="top-logo">
                    <a href="#">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" class="img-fluid">
                    </a>
                </div>
                {{-- @if(session('error'))  --}}
                <div class="payments-message-box cancel-box">
                    <img src="{{ asset('assets/images/icons/cancel.svg') }}" alt="success" class="img-fluid">

                    <h4>Failed to change your password!</h4>
                    <p>Please check your information then try again.</p>

                    <a href="#">FAILED</a>
                </div>
                {{-- @endif  --}}
            </div>
        </div>
    </div>
</div> 
</body>

</html>