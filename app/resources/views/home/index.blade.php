@extends('layouts.home')

@section('title','Home')

@section('content')

<div class="hero-middle-bg">
    {{-- hero section start --}}
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="hero-txt-wrap">
                        <h1>Find the Best Deals Anytime, Anywhere</h1>
                        <p>Discover exclusive deals and discounts on the go with Daily</br>
                            Deals & Discounts! Download the app now from the Apple</br>
                            Store and Google Play to start saving money today!
                        </p>
                        <div class="hero_btn">
                            <a href="https://apps.apple.com/app/deals-and-discounts/id6503248591" target="_blank">
                                <img src="{{ asset('public/assets/images/landing/app-store.svg') }}" alt="app" class="img-fluid"></a>
                            <a href="https://play.google.com/store/apps/details?id=com.dandd.app" target="_blank"><img src="{{ asset('public/assets/images/landing/paly-stroe.svg') }}" alt="app" class="img-fluid"></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="text-center hero-img" data-aos="zoom-in" data-aos-duration="1000">
                        <img src="{{ asset('public/assets/images/landing/hero.png') }}" alt="app" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        {{-- background dots --}}
        <div class="bg-dots bg-dots-1"></div>
        <div class="bg-dots bg-dots-2"></div>
        <div class="bg-dots bg-dots-3"></div>
        <div class="bg-dots bg-dots-4"></div>
        {{-- background dots --}}
    </section>
    {{-- hero section end --}}

    <!-- how it workes start -->
    <section class="how-work-sec font-poppins" id="work-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center mb-60">
                        <h2 class="common-title ">How It Works</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="work-box" data-aos="zoom-out-right" data-aos-duration="1000">
                        <div class="work-thumb">
                            <img src="{{ asset('public/assets/images/landing/work-01.svg') }}" alt="work"
                                class="img-fluid">
                        </div>
                        <h5>Search for Deals</h5>
                        <p>Discover an abundance of incredible deals
                            tailored just for you. With our robust search
                            feature, finding the perfect offer is a breeze
                            From electronics to fashion and travel
                            we've got everything you need.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="work-box" data-aos="zoom-out-up" data-aos-duration="1000">
                        <div class="work-thumb">
                            <img src="{{ asset('public/assets/images/landing/work-02.svg') }}" alt="work"
                                class="img-fluid">
                        </div>
                        <h5>Save Favorites</h5>
                        <p>Never let a great deal slip away! Save your
                            top picks with a simple tap and access them
                            anytime, anywhere. Our user-friendly
                            interface ensures your saved deals are neatly organized and ready when you are.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-12 col-lg-4">
                    <div class="work-box" data-aos="zoom-out-left" data-aos-duration="1000">
                        <div class="work-thumb">
                            <img src="{{ asset('public/assets/images/landing/work-03.svg') }}" alt="work"
                                class="img-fluid">
                        </div>
                        <h5>Promote Your Deals</h5>
                        <p>Attention businesses! Showcase your
                            exclusive offers to a vast audience of eager
                            shoppers. With our platform, your deals will
                            gain unparalleled exposure, driving traffic
                            and boosting sales. Join us and watch your
                            promotions soar to new heights!</p>
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="text-center mt-60">
                        <a href="#" class="common-bttn">View Details</a>
                    </div>
                </div> --}}
            </div>
        </div>

        {{-- background dots --}}
        <div class="bg-dots bg-dots-2"></div>
        <div class="bg-dots bg-dots-3"></div>
        <div class="bg-dots bg-dots-4"></div>
        {{-- background dots --}}
    </section>
    {{-- how it end --}}
</div>

<section class="promote-deals youtube-video-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="promote-item text-center comon-title-2">
                    <h2 class="common-title ">The Best Place to Find Daily Deals</h2>
                        <p>Dive into our world of deals and discounts with just a tap. Our app is like having a savvy friend <br> who knows all the best spots for discounts, from cozy cafes to thrilling adventures. Check out <br> our quick video to see how easy it is to save big and enjoy more of what you love every day.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-11 col-lg-10 col-xl-9">
                <div class="video-area" data-aos="zoom-out" data-aos-duration="1000">
                    <iframe src="https://www.youtube.com/embed/gpSn7zli8vg?si=gDDhywbIAT-MdDmY"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    {{-- background dots --}}
    <div class="bg-dots bg-dots-2"></div>
    <div class="bg-dots bg-dots-3"></div>
    <div class="bg-dots bg-dots-4"></div>
    {{-- background dots --}}

</section>


<!-- insperation section start -->
<div class="text-center ins-img d-md-none" data-aos="fade-up" data-aos-duration="1000">
    <img src="{{ asset('public/assets/images/landing/saving.png') }}" alt="app" class="img-fluid">
</div>
<section class="insperation-section pb-0 new-ins-mobile-sec-bg" id="local-deals">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-6 col-lg-5">
                <div class="text-center ins-img d-none d-md-block" data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('public/assets/images/landing/saving.png') }}" alt="app" class="img-fluid">
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-7">
                <div class="ins-txt-wrap left-space mt-0 mt-lg-4">
                    <h3>Easy Savings & Quick Deals</h3>
                    <p>Unlock effortless savings and instant deals with our intuitive app feature,</br> "Quick
                        Redemption." Say goodbye to the hassle of paper vouchers – now</br> you can redeem deals
                        with just a tap, anytime, anywhere.</p>

                    <div class="deals-box">
                        <div class="media" data-aos="zoom-in" data-aos-duration="1000">
                            <img src="{{ asset('public/assets/images/landing/ins-icon-01.svg') }}" alt="a"
                                class="ig-fluid">
                            <div class="media-body">
                                <h5>Local Discoveries</h5>
                                <p>From cozy cafes to hidden gems, our app takes you to the best local spots.
                                    Experience the charm of your own neighborhood and uncover new favorites.</p>
                            </div>
                        </div>
                        <div class="media" data-aos="zoom-in" data-aos-duration="1000">
                            <img src="{{ asset('public/assets/images/landing/ins-icon-02.svg') }}" alt="a"
                                class="ig-fluid">
                            <div class="media-body">
                                <h5>Easy to Use</h5>
                                <p>Say goodbye to paper vouchers – our app lets you use your deals with just a tap.
                                    No printing, no fuss – just easy savings.</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</section>
<!-- insperation section end -->

<!-- discover local section start -->
<section class="discover-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="discover-head-txt mb-60">
                    <h3>Local Finds: Explore Nearby</h3>
                    <p>Discover hidden treasures and exclusive deals just around the corner with "Local Finds."
                        Whether it's a </br>quaint cafe or a charming boutique, there's something special waiting
                        for you in your neighborhood.</br> Enjoy significant savings while supporting local
                        businesses, making every day an adventure with the</br> exciting offers available at "Local
                        Finds." Start exploring today and unlock the best of what your area</br> has to offer!</p>
                </div>
            </div>
        </div>
        <div class="row font-poppins">
            <div class="col-lg-4 custom-tab-bttn mt-4 mt-lg-0" data-aos="zoom-out" data-aos-duration="1000">
                <div class="nav flex-column nav-pills custom-scrollbar" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    @foreach ($categories as $key => $category)

                    <button class="nav-link {{ $key === 0 ? 'active' : '' }}" id="v-pills-{{ $category->id }}-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-{{ $category->id }}" type="button" role="tab"
                        aria-controls="v-pills-{{ $category->id }}" aria-selected="false"
                        onclick="showTab('{{ $category->id }}')">
                        <span><img src="{{ asset($category->icon) }}" alt="{{ $category->name }}"
                                class="img-fluid"></span>
                        {{ $category->name }}
                    </button>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-8 " data-aos="zoom-in" data-aos-duration="1000">
                <div class="tab-content" id="v-pills-tabContent">
                    @foreach ($categories as $key => $category)

                    <div class="tab-pane fade {{ $key === 0 ? 'show active' : '' }}"
                        id="v-pills-{{ $category->id }}" role="tabpanel"
                        aria-labelledby="v-pills-{{ $category->id }}-tab" tabindex="0">
                        <div class="row ms-lg-4">
                            @if (isset($products[$category->id]))
                            @foreach ($products[$category->id]->slice(0,2) as $product)

                            @php
                                $imageUrls = explode(',', $product->images);
                                $firstImageUrl = $imageUrls[0];
                            @endphp


                            <div class="col-sm-6 col-lg-6">
                                <div class="discover-box">
                                    <img src="{{ asset($firstImageUrl) }}" alt="{{ $product->slug }}"
                                        class="img-fluid">

                                    <div class="ol">
                                        <h5>{{ $product->title }}</h5>

                                        <h4><span>€</span> {{ $product->sell_price }} <sub
                                                style="font-weight: 400;text-decoration: line-through;"><s>{{
                                                    $product->price}}</s> </sub></h4>
                                        {{-- <a href="#">View Product <i class="fas fa-angle-right"></i></a> --}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- discover local section end -->

<!-- insperation section start -->
<section class="insperation-section savings-section" id="start-save">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-12 col-sm-6 col-md-6 col-lg-6 order-2 order-lg-1">
                <div class="ins-txt-wrap" data-aos="zoom-in-right" data-aos-duration="1000">

                    <h3>Say Hello to Savings!</h3>
                    <p class="mt-3">Get ready to save big with Daily Deals & Discounts! Say hello</br>
                        to amazing deals, special offers, and lots of ways to keep more</br>
                        money in your pocket. It's super easy and super fun.</br>
                        Join us now and start saying hello to saving money!</p>

                    <div class="deals-box">

                        <div class="media mt-0">
                            <img src="{{ asset('public/assets/images/landing/check.svg') }}" alt="a"
                                class="ig-fluid">
                            <div class="media-body">
                                <h5>Save Money</h5>
                            </div>
                        </div>
                        <div class="media mt-0">
                            <img src="{{ asset('public/assets/images/landing/check.svg') }}" alt="a"
                                class="ig-fluid">
                            <div class="media-body">
                                <h5>Convenience</h5>
                            </div>
                        </div>
                        <div class="media mt-0">
                            <img src="{{ asset('public/assets/images/landing/check.svg') }}" alt="a"
                                class="ig-fluid">
                            <div class="media-body">
                                <h5>Exclusive Offers</h5>
                            </div>
                        </div>
                    </div>

                    <div class="hero_btn mt-60 different-app-logo">
                        <a href="https://apps.apple.com/app/deals-and-discounts/id6503248591" class="me-2"><img
                                src="{{ asset('public/assets/images/landing/app-store-2.svg') }}" alt="app"
                                class="img-fluid"></a>
                        <a href="https://play.google.com/store/apps/details?id=com.dandd.app" class="ms-2"><img
                                src="{{ asset('public/assets/images/landing/paly-stroe-2.svg') }}" alt="app"
                                class="img-fluid"></a>
                    </div>

                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-6 order-1 order-lg-2">
                <div class="text-end inspair-model" data-aos="zoom-in" data-aos-duration="1000">
                    <img src="{{ asset('public/assets/images/landing/savings.png') }}" alt="savings"
                        class="img-fluid">
                </div>
            </div>

        </div>
    </div>
</section>
<!-- insperation section end -->

<!-- promote dreams start -->
<section class="promote-dreams-sec font-poppins" id="for-com">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="ins-txt-wrap text-center dream-head">
                    <h5>For Companies</h5>
                    <h3 class="mb-4">The Best Place to Promote <br>
                        Your Deals</h3>
                    <p>Unlock unparalleled exposure and skyrocket your sales with Daily Deals &
                        Discounts, <br>
                        the premier destination for showcasing your exclusive offers. Our platform provides
                        unmatched visibility <br>
                        and engagement opportunities, ensuring that your deals receive the attention they
                        deserve from a highly receptive audience <br>
                        of eager shoppers. Join us today and experience the power of strategic promotion like
                        never before.</p>
                </div>
            </div>

            <div class="col-12 col-md-11 col-xl-9">
                <div class="video-area deals-video" data-aos="zoom-out" data-aos-duration="1000">

                    <iframe src="https://www.youtube.com/embed/NrmMk1Myrxc?si=PfNxNmLyZ6mz7Cs4"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

     {{-- background dots --}}
     <div class="curved-bg">
        <img src="{{ asset('public/assets/images/landing/curved-bg.svg') }}" alt="curved" class="img-fluid">
     </div>
     <div class="bg-dots bg-dots-3"></div>
     <div class="bg-dots bg-dots-4"></div>
     {{-- background dots --}}

</section>

{{-- why different section start --}}
<section class="different-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="different-txt-box" data-aos="zoom-in" data-aos-duration="1000">
                    <h2 class="font-jakarta">Why We're Different</h2>
                    <p class="font-poppins">We're all about keeping it simple and sweet. For businesses looking to
                        join us, we have a no-nonsense
                        approach: just €45 a month. No extra fees, no surprises—just a straightforward way to share
                        your deals with
                        people who are eager to check them out. This makes us stand out because we value both your
                        experience
                        and your budget. Why complicate things when you can keep it easy and effective with us?</p>
                    <div class="hero_btn mt-60 text-center m-mt-62"  data-aos="zoom-up" data-aos-duration="1000">
                        <a href="https://apps.apple.com/app/deals-and-discounts/id6503248591" class="me-2"><img
                                src="{{ asset('public/assets/images/landing/app-store.svg') }}" alt="app"
                                class="img-fluid"></a>
                        <a href="https://play.google.com/store/apps/details?id=com.dandd.app" class="ms-2"><img
                                src="{{ asset('public/assets/images/landing/paly-stroe.svg') }}" alt="app"
                                class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- background dots --}}
     <div class="bg-dots bg-dots-3"></div>
     <div class="bg-dots bg-dots-4"></div>
     {{-- background dots --}}

</section>
{{-- why different section end --}}

<!-- faq section start -->
<section class="faq-section" id="faq-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                <div class="text-center mb-4 lg:mb-0"  data-aos="zoom-in-right" data-aos-duration="1000">
                    <img src="{{ asset('public/assets/images/landing/faq.png') }}" alt="savings" class="img-fluid">
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                <div class="ins-txt-wrap">

                    <h3>Frequently Asked <br>
                        Questions</h3>

                    <div class="faq-ask-wrap mt-2"  data-aos="zoom-in-left" data-aos-duration="1000">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                        1. How do I get started with Daily Deals & Discounts?
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Hey there! Getting started is super easy. Just download our app from
                                            the App Store or Google Play, create an account, and you're ready to
                                            start exploring amazing deals near you! It's as simple as that.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                        aria-expanded="false" aria-controls="flush-collapseTwo">
                                        2. Can local businesses also benefit from using Daily Deals & Discounts?
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Absolutely! We love supporting local businesses. Simply sign up for
                                            our business account within the app, and you can start creating and
                                            promoting your exclusive deals to our community of users. It's a
                                            fantastic way to increase your visibility and attract more
                                            customers!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                        aria-expanded="false" aria-controls="flush-collapseThree">
                                        3. Does Daily Deals & Discount offer real value for money on everyday activities?
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Oh, definitely! Whether it's a discount at your favorite restaurant
                                            or a special offer at a local spa, we're all about delivering value
                                            and helping you save money on the things you love.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFour">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseFour"
                                        aria-expanded="false" aria-controls="flush-collapseFour">
                                        4. How often are new deals added to the app?
                                    </button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>We're always on the lookout for exciting new deals to share with you!
                                            You can expect fresh offers added regularly, so there's always
                                            something new and exciting to discover. Keep checking back to see
                                            what's new – you won't want to miss out!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFive">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseFive"
                                        aria-expanded="false" aria-controls="flush-collapseFive">
                                        5. Are there additional fees for placing deals?
                                    </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>Nope! It's straightforward for businesses partnering with us. There
                                            are no extra fees on the deals they offer. Instead, companies pay a
                                            flat monthly subscription fee of €45. We keep it transparent and
                                            fair, with no hidden costs or surprises.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hero_btn mt-60" data-aos="zoom-out-up" data-aos-duration="1000">
                        <a href="https://apps.apple.com/app/deals-and-discounts/id6503248591" class="me-2"><img
                                src="{{ asset('public/assets/images/landing/app-store-2.svg') }}" alt="app"
                                class="img-fluid"></a>
                        <a href="https://play.google.com/store/apps/details?id=com.dandd.app" class="ms-2"><img
                                src="{{ asset('public/assets/images/landing/paly-stroe-2.svg') }}" alt="app"
                                class="img-fluid"></a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- background dots --}}
    <div class="bg-dots bg-dots-3"></div>
    <div class="bg-dots bg-dots-4"></div>
    {{-- background dots --}}
</section>
<!-- faq section end -->

<!-- nut shell start -->
<section class="nutshell-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ins-txt-wrap text-center mb-36">
                    <h3 class="font-poppins">All Your Deals, One App</h3>
                    <p class="mt-2">Explore exclusive deals and discounts available in your local area with Daily
                        <br>
                        Deals & Discounts. We bring savings and smiles, one offer at a time.
                    </p>
                </div>

            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-4 col-sm-6 order-2 order-md-2 order-lg-1">
                <div class="nutshleel-txt text-end mt-60" data-aos="zoom-in-right" data-aos-duration="1000">
                    <h5>Tailored Just for You</h5>
                    <p>Deals you'll love, tailored to your likes. Smart suggestions mean more joy, less search.</p>
                </div>
                <div class="nutshleel-txt mt-60 text-end" data-aos="zoom-in-right" data-aos-duration="1000">
                    <h5>Effortless Navigation</h5>
                    <p>Swipe, tap, save. Our app's so user-friendly, you'll find deals in no time.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 order-1 order-sm-1">
                <div class="text-center nut-imgg"  data-aos="fade-up" data-aos-duration="1000">
                    <img src="{{ asset('public/assets/images/landing/nutshell-1.png') }}" alt="nutshell"
                        class="img-fluid">
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 order-3 order-sm-2" data-aos="zoom-in-left" data-aos-duration="1000">
                <div class="nutshleel-txt mt-60">
                    <h5>Unbeatable Savings</h5>
                    <p>Exclusive discounts across dining, shopping, and fun. Always the best prices, effortlessly.
                    </p>
                </div>
                <div class="nutshleel-txt mt-60" data-aos="zoom-in-left" data-aos-duration="1000">
                    <h5>Always Something New</h5>
                    <p>Fresh deals daily. From your morning coffee to your weekend getaway, discover something new
                        every day.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- nut shell end -->

<!-- clients feedback start -->
<section class="clients-feedback" id="review-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ins-txt-wrap text-center mb-60">
                    <h3>Our Clients Feedback</h3>
                    <p class="mt-2">The food at your doorstep. Why starve when you have us. You hunger <br>
                        partner. Straight out of the oven to your doorstep.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="review-box font-poppins" data-aos="zoom-in-right" data-aos-duration="1000">
                    <img src="{{ asset('public/assets/images/landing/quote.svg') }}" alt="a" class="img-fluid">
                    <p>Absolutely loving this app! It's become my go-to for snagging incredible deals effortlessly. From discounts on must-have items to personalized recommendations, it's like having a savvy shopping companion right in my pocket. Plus, the support team is super responsive. Highly recommend giving it a try! </p>

                    <div class="d-flex">
                        <a href="#">
                            <img src="{{ asset('public/assets/images/landing/avatar-01.png') }}" alt="avatar"
                                class="img-fluid">
                        </a>
                        <ul>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                        </ul>
                    </div>


                    <h5 class="font-jakarta">Sofie van den Berg / <span>CEO</span></h5>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="review-box font-poppins" data-aos="zoom-out-up" data-aos-duration="1000">
                    <img src="{{ asset('public/assets/images/landing/quote.svg') }}" alt="a" class="img-fluid">
                    <p>This app is a game-changer! Finding deals has never been easier. Whether it's discounts on everyday essentials or hidden gems, it's like having a treasure map at your fingertips. The user-friendly interface and quick customer support make shopping a pleasure. Can't recommend it enough!</p>

                    <div class="d-flex">
                        <a href="#">
                            <img src="{{ asset('public/assets/images/landing/avatar-02.png') }}" alt="avatar"
                                class="img-fluid">
                        </a>
                        <ul>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                        </ul>
                    </div>


                    <h5 class="font-jakarta">Daan de Vries / <span>Financial Consultant</span></h5>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="review-box font-poppins" data-aos="zoom-in-left" data-aos-duration="1000">
                    <img src="{{ asset('public/assets/images/landing/quote.svg') }}" alt="a" class="img-fluid">
                    <p>Impressed doesn't even begin to cover it! This app has revolutionized how I shop. From flash sales to personalized offers, it's like having a VIP pass to the best deals in town. Plus, the seamless navigation and prompt assistance make the whole experience a breeze. A must-download for any smart shopper!</p>

                    <div class="d-flex">
                        <a href="#">
                            <img src="{{ asset('public/assets/images/landing/avatar-03.png') }}" alt="avatar"
                                class="img-fluid">
                        </a>
                        <ul>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star inactive"></i></li>
                        </ul>
                    </div>


                    <h5 class="font-jakarta">Eva Jansen / <span>Marketing Analyst</span></h5>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- clients feedback end -->

{{-- blog section start --}}
<section class="blog-section" id="blog-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ins-txt-wrap text-center mb-60">
                    <h3>Smart Shopping Insights</h3>
                    <p class="mt-2">Explore tips and quick guides to unlock the best deals, enhance your savings, and navigate <br> our app with ease. Perfect for savvy shoppers!</p>
                </div>
            </div>
        </div>
        <div class="row" data-aos="zoom-out-up" data-aos-duration="1000">
            {{-- blog item --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="blog-post-box">
                    <div class="thumabnail">
                        <img src="{{ asset('public/assets/images/landing/shop-01.jpg') }}" alt="thumbnail"
                            class="img-fluid">
                    </div>
                    <div class="text">
                        <h5 class="font-jakarta">Maximize Year-Round Savings</h5>
                        <p class="font-poppins">Discover timing tricks for snagging the best deals and stretching your budget further.</p>

                        <ul class="font-poppins">
                            <li>
                                <a href="#"><img src="{{ asset('public/assets/images/landing/calendar-icon.svg') }}"
                                        alt="a" class="img-fluid me-2"> March 12, 2024</a>
                            </li>
                            <li>
                                <a href="#">∙ 5 min read</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- blog item --}}
            {{-- blog item --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="blog-post-box">
                    <div class="thumabnail">
                        <img src="{{ asset('public/assets/images/landing/shop-02.jpg') }}" alt="thumbnail"
                            class="img-fluid">
                    </div>
                    <div class="text">
                        <h5 class="font-jakarta">Crack the Discount <br> Code</h5>
                        <p class="font-poppins">Unlock, utilize, and maximize your savings potential with a plethora of online coupons.</p>

                        <ul class="font-poppins">
                            <li>
                                <a href="#"><img src="{{ asset('public/assets/images/landing/calendar-icon.svg') }}"
                                        alt="a" class="img-fluid me-2"> July 22, 2023</a>
                            </li>
                            <li>
                                <a href="#">∙ 4 min read</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- blog item --}}
            {{-- blog item --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="blog-post-box">
                    <div class="thumabnail">
                        <img src="{{ asset('public/assets/images/landing/shop-03.jpg') }}" alt="thumbnail"
                            class="img-fluid">
                    </div>
                    <div class="text">
                        <h5 class="font-jakarta">Seize Limited-Time <br> Bargains</h5>
                        <p class="font-poppins">Implement quick and effective actions to capitalize on limited-time offers for substantial savings.</p>

                        <ul class="font-poppins">
                            <li>
                                <a href="#"><img src="{{ asset('public/assets/images/landing/calendar-icon.svg') }}"
                                        alt="a" class="img-fluid me-2"> April 06, 2023</a>
                            </li>
                            <li>
                                <a href="#">∙ 8 min read</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- blog item --}}
            {{-- blog item --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="blog-post-box">
                    <div class="thumabnail">
                        <img src="{{ asset('public/assets/images/landing/shop-04.jpg') }}" alt="thumbnail"
                            class="img-fluid">
                    </div>
                    <div class="text">
                        <h5 class="font-jakarta">Simplify Your Buying Experience</h5>
                        <p class="font-poppins">Effortlessly browse, select, and purchase items with ease through our intuitive mobile application.</p>

                        <ul class="font-poppins">
                            <li>
                                <a href="#"><img src="{{ asset('public/assets/images/landing/calendar-icon.svg') }}"
                                        alt="a" class="img-fluid me-2"> April 12, 2022</a>
                            </li>
                            <li>
                                <a href="#">∙ 3 min read</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- blog item --}}
        </div>
    </div>
</section>
{{-- blog section start --}}
@endsection
