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

    <!-- custom CSS start -->
    <link rel="stylesheet" href="{{ url('assets/css/payments.css') }}"> 
    <!-- custom CSS end -->

    <title>DnD || Payments</title>
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
                    <div class="payments-message-box cancel-box">
                        <img src="{{ asset('assets/images/icons/cancel.svg') }}" alt="success" class="img-fluid">
    
                        <h4>Unable to continue the process</h4>
                        <p>Please check your information then try again</p>
    
                        <a href="#">Try Again</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 

</body>

</html>