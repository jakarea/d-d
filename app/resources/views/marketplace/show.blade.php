@extends('layouts.auth')

@section('title',$product->title)

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper company-page-wrapper">
  <!-- company detils box start -->
  <div class="company-details-box">
    <!-- top part -->
    <div class="company-information">
      <div class="media align-items-start">
        @if ($product->images)
        <img src="{{ $product->images }}" alt="Product Tumbnail" class="img-fluid main-thumb">
        @else
        <img src="{{ asset('public/uploads/products/product-thumbnail-01.png')}}" alt="Product Tumbnail"
          class="img-fluid main-thumb">
        @endif

        <div class="media-body">
          <div class="d-flex">
            <h5>{{ $product->title }}</h5>
            <a href="#">
              <img src="{{asset('public/assets/images/icons/pen.svg')}}" alt="I" class="img-fluid">
            </a>
          </div>
          <h6>{{ $company->name }}</h6>

          <ul>
            @if ($company)
            @if ($company->email)
            <li>
              <img src="{{ asset('public/assets/images/icons/envelope.svg') }}" alt="I" class="img-fluid">
              <span>{{ $company->email }}</span>
            </li>
            @endif
            @if ($company->phone)
            <li>
              <img src="{{asset('public/assets/images/icons/call.svg')}}" alt="I" class="img-fluid">
              <span>{{ $company->phone }}</span>
            </li>
            @endif
            @if ($company->location)
            <li>
              <img src="{{asset('public/assets/images/icons/gps.svg')}}" alt="I" class="img-fluid">
              <span>{{ $company->location }}</span>
            </li>
            @endif
            @endif
          </ul>

          <p>{{$product->description}}</p>

        </div>
      </div>
    </div>
    <!-- top part -->

    <div class="row mt-20">
      <div class="col-lg-6">
        <!-- reviews box -->
        <div class="company-reviews">
          <h3>Reviews</h3>

          @php
              $allReviewCount = count($product->reviews);
              $allTotalStars = $allReviewCount > 0 ? $product->reviews->sum('rating') : 0;
              $allAverageRating = $allReviewCount > 0 ? number_format($allTotalStars / $allReviewCount, 1) : 0;
              $allRevText = $allReviewCount === 0 ? 'No Reviews' : ($allReviewCount === 1 ? '1 Review' : $allReviewCount . ' Reviews');
          @endphp

          <div class="review-statics-box">
              <div>
                  <h4>{{ $allAverageRating }}<span class="h5">/5</span></h4>
                  <p>{{ $allTotalStars }} Rating . {{ $allRevText }}</p>

                  <ul>
                      @for ($i = 1; $i <= 5; $i++)
                          @if ($i <= $allAverageRating)
                              <li><i class="fas fa-star"></i></li>
                          @else
                              <li><i class="far fa-star"></i></li>
                          @endif
                      @endfor
                  </ul>
            </div>
            <div class="rev-item-list">
              @php
                  $ratings = [];
                  foreach ($product->reviews as $review) {
                      $ratings[] = $review->rating;
                  }
                  $ratingCounts = array_count_values($ratings);
                  $totalReviews = count($ratings);
              @endphp
          
              @for ($i = 5; $i >= 1; $i--)
                  <div class="item">
                      <p>{{ $i }} star</p>
                      @if (isset($ratingCounts[$i]))
                          <div class="progress" role="progressbar" aria-label="Basic example"
                              aria-valuenow="{{ $ratingCounts[$i] / $totalReviews * 100 }}"
                              aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar" style="width: {{ $ratingCounts[$i] / $totalReviews * 100 }}%"></div>
                          </div>
                      @else
                          <div class="progress" role="progressbar" aria-label="Basic example"
                              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar" style="width: 0%"></div>
                          </div>
                      @endif
                  </div>
              @endfor
          </div>
          
          </div>

          <!-- review list start -->
          <div class="review-list">
            @foreach ($product->reviews->slice(0,5) as $review)
            <!-- review single item start -->
            <div class="review-single-item">
              <div class="header">
                <div class="media">
                  <img src="{{ $review->user->personalInfo->avatar }}" alt="U" class="img-fluid">
                  <div class="media-body">
                    <h5>{{$review->user->personalInfo->name}}</h5>
                    <span>{{$review->created_at->diffForHumans()}}</span>
                  </div>
                </div>

                <ul class="star-rating">
                  @for ($i = 1; $i <= 5; $i++)
                  @if ($i <=$review->rating)
                  <li><i class="fas fa-star"></i></li>
                    @else
                    <li><i class="far fa-star"></i></li>
                    @endif
                    @endfor
                </ul>

              </div>
              <p>{{$review->review}}</p>
            </div>
            <!-- review single item end -->
            @endforeach
          </div>
          <!-- review list end -->
        </div>
        <!-- reviews box -->
      </div>
      <div class="col-lg-6">
        <div class="advertismewnt-deal-box">
          <h3>Product Varients</h3>

          <div class="row">
            @if (!empty($productVarients) && $productVarients != NULL)
            @foreach ($productVarients->slice(0,4) as $v_product)
            <!-- product item start -->
            <div class="col-12 col-xl-6 mb-3 mb-3">
              <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                  @php
                  $price = $v_product->price;
                  $sellPrice = $v_product->sell_price;
                  $percentageDiscount = $price != 0 ? ((($price - $sellPrice) / $price) * 100) : 0;

                  if (!$sellPrice || !$price) {
                    $percentageDiscount = 0;
                  }
                  @endphp

                  <span>{{ number_format($percentageDiscount, 0) }}%</span>

                  @if ($v_product->images)
                  <img src="{{ $v_product->images }}" alt="Product Tumbnail" class="img-fluid">
                  @else
                  <img src="{{ asset('public/uploads/products/product-thumbnail-01.png')}}" alt="Product Tumbnail" class="img-fluid">
                  @endif

                  <a href="#"><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                  <h5>
                    {{ $v_product->title }}
                  </h5>
                  <p>{{ Str::limit($v_product->description, $limit = 180, $end = '..') }}</p>

                  @if ($v_product->sell_price && $v_product->price)
                  <h4>€{{ $v_product->sell_price }} <span>€{{ $v_product->price }}</span></h4>
                  @elseif(!$v_product->sell_price && $v_product->price)
                  <h4>€{{ $v_product->price }}</h4>
                  @elseif($v_product->sell_price && !$v_product->price)
                  <h4>€{{ $v_product->sell_price }}</h4>
                  @else
                  <h4>€{{ $v_product->price }}</h4>
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
            <x-emptyDataComponent :dynamicData="'No Variants Found for this Product!'" />
            {{-- no data found component --}}
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- company detils box end -->
</section>
<!-- main page wrapper end -->
@endsection