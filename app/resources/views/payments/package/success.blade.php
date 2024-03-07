<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="{{ url('public/assets/css/bootstrap.min.css') }}">
    <!-- Bootstrap CSS end --> 

    <!-- custom CSS start -->
    <link rel="stylesheet" href="{{ url('public/assets/css/payments.css') }}"> 
    <!-- custom CSS end -->

    <title>DnD || Payment Success</title>
</head>

<body>
      
    <div class="wrap-outer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="top-logo">
                        <a href="#" style="display: block; max-width: 70%; margin: 0 auto;">
                            <img src="{{ asset('public/assets/images/logo.png') }}" alt="logo" class="img-fluid">
                        </a>
                    </div>
                    <div class="payments-message-box">
                        <img src="{{ asset('public/assets/images/icons/success.svg') }}" alt="success" class="img-fluid">

                        <h4>We have received your payment</h4>
                        <p>Thank you for the Subscription!</p>

                        <a href="#">Go BACK TO APP</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

</body>

</html>