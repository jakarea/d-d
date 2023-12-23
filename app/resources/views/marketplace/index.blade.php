@extends('layouts.auth')

@section('title','All Product Page')

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
    <!-- page title -->
    <div class="page-title">
        <h1>All Product</h1>

        <!-- filter -->
        <form action="" method="GET" id="myForm">
            <div class="page-filter">
                <div class="dropdown">
                    <button class="btn" type="button" id="dropdownBttn" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $selectedCat->slug ?? 'Categories' }}
                        <i class="fas fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item filterItem" href="#" data-value="">All Product</a></li>
                        @foreach ($categories as $category)
                        <li>
                            <a class="dropdown-item filterItem" href="#" data-value="{{$category->id}}">
                                {{$category->name}}

                                @if ($selectedCat && $selectedCat->slug == $category->slug)
                                <i class="fas fa-check"></i>
                                @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <input type="hidden" name="category" id="inputField">
        </form>
        <!-- filter -->
    </div>
    <!-- page title -->

    <!-- product list start -->
    <div class="row">
        @if (count($products) > 0)
        @foreach ($products as $product)
        <!-- product item start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    @php
                    $price = $product->price;
                    $sellPrice = $product->sell_price;
                    $percentageDiscount = $price != 0 ? ((($price - $sellPrice) / $price) * 100) : 0;

                    if (!$sellPrice || !$price) {
                    $percentageDiscount = 0;
                    }
                    @endphp

                    <span>{{ number_format($percentageDiscount, 0) }}%</span>

                    @php
                    $imageUrls = [];
                    if (isset($product) && !empty($product->images)) {
                    $imageUrls = explode(',', $product->images);
                    }
                    @endphp

                    @if(count($imageUrls) > 0)
                    <img src="{{ $imageUrls[0] }}" alt="Product Thumbnail" class="img-fluid">
                    @else
                    <img src="{{ asset('public/uploads/products/product-thumbnail-01.png')}}" alt="Product Thumbnail"
                        class="img-fluid">
                    @endif

                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>
                        <a href="{{ route('product.show', $product->slug) }}">{{ Str::limit($product->title, $limit =
                            40, $end = '..') }}</a>
                    </h5>
                    <p>{{ Str::limit($product->company->name, $limit = 50, $end = '..') }}</p>

                    @php
                    $reviewCount = count($product->reviews);
                    $averageRating = $reviewCount > 0 ? number_format($product->reviews->avg('rating'), 1) : 0;
                    $revText = $reviewCount === 0 ? 'No Reviews' : ($reviewCount === 1 ? '1 Review' : $reviewCount . '
                    Reviews');
                    @endphp

                    <ul class="star-rating">
                        @for ($i = 1; $i <= 5; $i++) @if ($i <=$averageRating) <li><i class="fas fa-star"></i></li>
                            @else
                            <li><i class="far fa-star"></i></li>
                            @endif
                            @endfor
                            <li><span class="avg-star">{{ $averageRating }}</span></li>
                            <li><span class="total-rev">({{ $revText }})</span></li>
                    </ul>

                    @if ($product->sell_price && $product->price)
                    <h4>€{{ $product->sell_price }} <span>€{{ $product->price }}</span></h4>
                    @elseif(!$product->sell_price && $product->price)
                    <h4>€{{ $product->price }}</h4>
                    @elseif($product->sell_price && !$product->price)
                    <h4>€{{ $product->sell_price }}</h4>
                    @else
                    <h4>€{{ $product->price }}</h4>
                    @endif

                    <div class="take-deal-bttn">
                        <button class="btn bttn" type="button">Take Deal</button>
                    </div>
                </div>
                <!-- txt -->
            </div>
        </div>
        <!-- product item end -->
        @endforeach
        @else
        {{-- no data found component --}}
        {{-- <x-EmptyDataComponent :dynamicData="'No Products Found!'" /> --}}
        <p>No Products Found!</p>
        {{-- no data found component --}}
        @endif
    </div>
    <!-- product list end -->

    {{-- paggination wrap --}}
    <div class="row">
        <div class="col-12 paggination-wrap">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
    {{-- paggination wrap --}}
</section>
<!-- main page wrapper end -->
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let inputField = document.getElementById("inputField");
        let dropdownItems = document.querySelectorAll(".filterItem");
        let form = document.getElementById("myForm");

        dropdownItems.forEach(item => {
            item.addEventListener("click", function(e) {
                e.preventDefault();
                inputField.value = this.getAttribute("data-value");
                form.submit();
            });
        });
    });
</script>
@endsection