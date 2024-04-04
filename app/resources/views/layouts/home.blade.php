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
    {{--
    <link rel="shortcut icon" href="{{ url('public/assets/images/favicon.png') }}" type="image/x-icon"> --}}
    <link rel="shortcut icon" href="{{ url('public/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('public/assets/css/bootstrap.min.css') }}">

    <!-- plugin CSS start -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- plugin CSS end -->

    <!-- custom CSS start -->
    <link rel="stylesheet" href="{{ url('public/assets/css/landing.css') }}">

    @yield('style')

    <title>@yield('title') | dailydealsdiscounts.com </title>
</head>

<body>

    <!-- header start -->
    <nav class="navbar navbar-expand-md landing-header">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('public/assets/images/landing/logo-latest.svg') }}" alt="logo"
                    style="max-width: 10rem">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="scrollToSection('#work-sec')">How it
                            Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="scrollToSection('#local-deals')">Local
                            Deals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="scrollToSection('#start-save')">Start
                            Saving</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="scrollToSection('#for-com')">For
                            Companies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="scrollToSection('#faq-sec')">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)"
                            onclick="scrollToSection('#review-sec')">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="scrollToSection('#blog-sec')">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- header end -->

    {{-- main content load here --}}
    @yield('content')
     {{-- main content load here --}}

    <!-- get the app -->
    <section class="get-the-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-7">
                    <div class="ins-txt-wrap text-start ftr-text">
                        <h3 class="text-white">Get the App Now!</h3>
                        <p class="mt-3">Don't miss out on amazing deals. <br>
                            Download the app today and start saving!</p>

                        <p class="mt-5"><img src="{{ asset('public/assets/images/landing/location.svg') }}" alt="a"
                                class="img-fluid me-2"> Bogure, Bangladesh</p>

                    </div>
                </div>
                <div class="col-lg-4 text-center col-md-5">
                    <div class="ftr-menu">
                        <h5>Support</h5>
                        <h6>Quick Support (24/7)</h6>

                        <ul>
                            <li><a href="#"><img src="{{ asset('public/assets/images/landing/call.svg') }}" alt="a"
                                        class="img-fluid me-2"> +880 1728247398</a></li>
                            <li><a href="#"><img src="{{ asset('public/assets/images/landing/envelope.svg') }}" alt="a"
                                        class="img-fluid me-2">info@example.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 text-center col-md-5">
                    <div class="d-flex flex-column gap-4 mt-4">
                        <a href="#"><img src="{{ asset('public/assets/images/landing/app-store.svg') }}" alt="app"
                                class="img-fluid"></a>
                        <a href="#"><img src="{{ asset('public/assets/images/landing/paly-stroe.svg') }}" alt="app"
                                class="img-fluid"></a>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="{{ url('terms-condition') }}">Terms of Service</a></li>
                            <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- get the app -->

    {{-- back to top --}}
    <button id="scrollToTopBtn" class="back-top-bttn" type="button">
        <i class="fas fa-angle-up"></i>
    </button>
    {{-- back to top --}}

    <!-- Bootstrap Bundle with Popper JS start -->
    <script src="{{ url('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/assets/js/custom.js') }}"></script>

    <script>
        // Function to handle smooth scrolling to sections
            function scrollToSection(sectionId) {
                const section = document.querySelector(sectionId);
                if (section) {
                    section.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
    </script>
    <!-- Bootstrap Bundle with Popper JS end -->

    {{-- back to top js --}}
    <script>
        // Get the button
var scrollToTopBtn = document.getElementById("scrollToTopBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
scrollToTopBtn.addEventListener("click", function() {
    scrollToTop();
});

function scrollToTop() {
    // Scroll to the top of the document
    window.scrollTo({
        top: 0,
        behavior: "smooth" // Smooth scrolling behavior
    });
}

    </script>

</body>

</html>