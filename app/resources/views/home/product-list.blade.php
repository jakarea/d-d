@extends('layouts.home')

@section('title','Products')

@section('content')

<section class="product-list py-5 new-product-list-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="promote-item text-center comon-title-2">
                    <h2 class="common-title ">The Best Place to Find Daily Deals</h2>
                        <p>Dive into our world of deals and discounts with just a tap. Our app is like having a savvy friend <br> who knows all the best spots for discounts, from cozy cafes to thrilling adventures. Check out <br> our quick video to see how easy it is to save big and enjoy more of what you love every day.</p>
                </div>
            </div>
        </div>
        <div class="row"> 
            @if (count($products) > 0)
                @foreach ($products as $product)
                    @php
                        $imageUrls = explode(',', $product->images);
                        $firstImageUrl = $imageUrls[0];
                    @endphp
                <div class="col-sm-6 col-lg-4">
                    <div class="discover-box">
                        <img src="{{ asset($firstImageUrl) }}" alt="{{ $product->slug }}" class="img-fluid">

                        <div class="ol">
                            <h5>{{ $product->title }}</h5>

                            <h4><span>€</span> {{ $product->sell_price }} <sub
                                    style="font-weight: 400;text-decoration: line-through;"><s>{{
                                        $product->price}}</s> </sub></h4>
                            <a href="{{ url('products',$product->slug) }}">View Product <i class="fas fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach 
            @else 
            {{-- no data found component --}}
            <x-EmptyDataComponent :dynamicData="'No Product Found!'" />  
            {{-- no data found component --}}
            @endif
        </div>
        {{-- paggination wrap --}}
            <div class="row">
                <div class="col-12 paggination-wrap">
                {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        {{-- paggination wrap --}}
    </div>
</section>
 

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
                        <a href="#" class="me-2"><img src="{{ asset('public/assets/images/landing/app-store.svg') }}"
                                alt="app" class="img-fluid"></a>
                        <a href="#" class="ms-2"><img src="{{ asset('public/assets/images/landing/paly-stroe.svg') }}"
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