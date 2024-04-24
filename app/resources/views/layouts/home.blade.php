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
    <link rel="shortcut icon" href="{{ url('public/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('public/assets/css/bootstrap.min.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
    <nav class="navbar navbar-expand-lg landing-header">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('public/assets/images/landing/logo-latest.svg') }}" alt="logo"
                    style="max-width: 10rem">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars-staggered"></i>
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
                        <a class="nav-link" href="{{ url('products') }}">Products</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="scrollToSection('#blog-sec')">Blog</a>
                    </li> --}}
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

                                <a target="_blank" class="mt-5" href="https://www.google.com/maps/place/Amsterdam,+Netherlands/@52.354551,4.7391543,11z/data=!3m1!4b1!4m6!3m5!1s0x47c63fb5949a7755:0x6600fd4cb7c0af8d!8m2!3d52.3675734!4d4.9041389!16zL20vMGszcA?entry=ttu"><img src="{{ asset('public/assets/images/landing/location.svg') }}" alt="a"
                                    class="img-fluid me-2"> Amsterdam, The Netherlands</a>

                    </div>
                </div>
                <div class="col-lg-4 text-center col-md-5">
                    <div class="ftr-menu">
                        <h5>Support</h5>
                        <h6>Quick Support (24/7)</h6>

                        <ul>
                            {{-- <li><a href="#"><img src="{{ asset('public/assets/images/landing/call.svg') }}" alt="a"
                                        class="img-fluid me-2"> +880 1728247398</a></li> --}}
                            <li><a href="mailto:contact@dailydealsdiscounts.com"><img src="{{ asset('public/assets/images/landing/envelope.svg') }}" alt="a"
                                        class="img-fluid me-2">contact@dailydealsdiscounts.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 text-center col-md-12">
                    <div class="d-flex flex-column gap-4 mt-4 mobile-gap">
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
    <button id="scrollToTopBtn" class="back-top-bttn" type="button" data-aos="fade-down" data-aos-duration="1000">
        <i class="fas fa-angle-up"></i>
    </button>
    {{-- back to top --}}

    <!-- Bootstrap Bundle with Popper JS start -->
    <script src="{{ url('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    {{-- <script src="{{ url('public/assets/js/custom.js') }}"></script> --}}
     <!-- Bootstrap Bundle with Popper JS end -->

     {{-- int aos plugin --}}
     <script>
        AOS.init();
      </script>
     {{-- int aos plugin --}}

     {{-- smooth scroll js --}}
    <script> 
            function scrollToSection(sectionId) {
                const section = document.querySelector(sectionId);
                if (section) {
                    section.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
    </script>

    {{-- back to top js --}}
    <script> 
        var scrollToTopBtn = document.getElementById("scrollToTopBtn"); 
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
        scrollToTopBtn.addEventListener("click", function() {
            scrollToTop();
        });

        function scrollToTop() { 
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }

    </script>

</body>

</html>