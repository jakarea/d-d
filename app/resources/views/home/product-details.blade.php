@extends('layouts.home')

@section('title','Product Details')

@section('content')

{{-- product details --}}
<section class="book-details-sec py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="book-preview-wrap">
                    <a href="{{ url('products') }}">
                        <i class="fas fa-angle-left"></i>
                    </a>
                    @php
                        $imageArray = $product->images ? explode(',', $product->images) : [];
                        $firstImageUrl = count($imageArray) > 0 ? $imageArray[0] : 'public/uploads/products/product-thumbnail-01.png';
                    @endphp
                    <div class="book-preview-img-box">
                        @if($firstImageUrl)
                        <img src="{{ asset($firstImageUrl) }}" alt="Product Thumbnail" class="img-fluid main-thumb">
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="book-details-txt-wrap">
                    <div class="book-details-head">
                        <span>Reviews: {{ $allReviewCount = $product->reviews->where('replies_to',NULL)->count() }}</span>
                        <h2>{{ $product->title }} </h2>
                        <p>{{ optional($product->company)->name }}</p>
                    </div>

                    <div class="book-details-filtr">
                        <span>{{ optional($product->company)->location }}</span>
                    </div>
                    <div class="book-details-bttn">
                        @if ($product->sell_price)
                            <h4>€ {{ $product->sell_price }} <span>€ {{ $product->price }}</span></h4>
                        @else
                            <h4>€ {{ $product->price }}</h4>
                        @endif

                        {{-- <a href="#">****{{ substr($product->cupon, -4) }}</a>  --}}
                        <a href="javascript:void(0)" title="CUPON">{{ $product->cupon }}</a>
                    </div>
                    <p>Deal ends at: <strong>{{ \Carbon\Carbon::parse($product->deal_expired_at)->diffForHumans() }}</strong></p>
                    <div class="book-details-bttm">
                        <h6>Description :</h6>

                        <p>{{$product->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- product details --}}

{{-- why different section start --}}
<section class="different-sec my-5">
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
                    <div class="hero_btn mt-60 text-center m-mt-62" data-aos="zoom-up" data-aos-duration="1000">
                        <a href="https://apps.apple.com/app/deals-and-discounts/id6503248591" class="me-2"><img src="{{ asset('public/assets/images/landing/app-store.svg') }}"
                                alt="app" class="img-fluid"></a>
                        <a href="https://play.google.com/store/apps/details?id=com.dandd.app" class="ms-2"><img src="{{ asset('public/assets/images/landing/paly-stroe.svg') }}"
                                alt="app" class="img-fluid">
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
@endsection
