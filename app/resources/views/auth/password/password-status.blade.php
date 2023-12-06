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

    <title>DnD || Authintication </title>
</head>

<body>
<!-- login page wrapper start -->
<main class="auth-page-wrapper">
    <div class="container-fluid">
        <div class="row justify-content-center"> 
            <div class="col-12 col-xl-6">
                <!-- auth text start -->
                <div class="auth-txt-box">
                    <!-- auth login form start -->
                    <div class="auth-form-wrap">

                        <div class="title"> 
                            @if(session('success'))
                            <h1 style="font-size: 1.25rem"><strong class="text-success">Password Reset:</strong> Your password has been successfully reset. Please return to the mobile app and log in to continue.</h1> 
                            @elseif(session('error'))
                            <h1 style="font-size: 1.25rem">
                                <strong class="text-danger">Password Reset:</strong> Failed to reset your password. Please try again!
                            </h1>
                            @else 
                                <h1>Go back to DnD Mobile App!</h1>
                            @endif

                        </div> 
                         
                    </div>
                    <!-- auth login form end -->

                    <!-- ftr -->
                    <div class="ftr-txt">
                        <p>&copy; 2023 <a href="#">Humanline</a> . Alrights reserved.</p>

                        <ul>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>

                    </div>
                    <!-- ftr -->
                </div>
                <!-- auth text end -->
            </div>
        </div>
    </div>
</main>
<!-- login page wrapper end -->
 <!-- Bootstrap Bundle with Popper JS start -->
 <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>  

</body>

</html>