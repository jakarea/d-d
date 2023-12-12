@extends('layouts.auth')

@section('title','Pricing plans')

@section('style')
<link rel="stylesheet" href="{{ url('public/assets/css/pricing.css') }}">
@endsection
@section('content')
<!-- pricing page wrapper start -->
<section class="main-page-wrapper pricing-plan-sec ">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="pricing-heading mt-0">
          <h6>Pricing</h6>
          <h2>Pricing plans</h2>
          <p>Simple, transparent pricing that grows with you. Try any plan free for 30 days.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="pricing-tab-head">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                type="button" role="tab" aria-controls="pills-home" aria-selected="true">Monthly billing</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Annual billing</button>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
        tabindex="0">
        <div class="row justify-content-center">
          @foreach ($packages as $package) 
          <!-- plan single monthly start -->
          <div class="col-xl-4 col-sm-10 col-md-6 mb-3">
            <div class="pricing-box">
              <div>
                <div class="pricing-icon">
                  @if ($package->name == 'Basic plan')
                    <img src="{{ asset('/public/assets/images/icons/basic-plan.svg') }}" alt="Basic" class="img-fluid">
                  @elseif($package->name == 'Business plan')
                  <img src="{{ asset('/public/assets/images/icons/business-plan.svg') }}" alt="Business" class="img-fluid">
                  @elseif($package->name == 'Enterprise plan')
                  <img src="{{ asset('/public/assets/images/icons/enterprise-plan.svg') }}" alt="Enterprise" class="img-fluid">
                  @endif
                  
                </div>
                <div class="txt">
                  <h5>{{ $package->name }}</h5>
                  <h3> €{{ $package->price }}/mth </h3>
                  <h6>Billed Monthly</h6>
 
                  <ul>
                    @foreach (json_decode($package->features) as $feature) 
                    <li>
                      <img src="{{ asset('/public/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                      <span>{{ $feature }}</span>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="bttn">
                <a href="{{ route('pricing.package.edit') }}" class="will-subscribe">Edit Plan</a>
              </div>
            </div>
          </div>
          <!-- plan single monthly end --> 
          @endforeach 

        </div>
      </div>

      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <div class="row justify-content-center">
          @foreach ($packages as $package) 
          <!-- plan single monthly start -->
          @if ($package->yearly_price > 0)
          <div class="col-xl-4 col-sm-10 col-md-6 mb-3">
            <div class="pricing-box">
              <div>
                <div class="pricing-icon">
                  @if ($package->name == 'Basic plan')
                    <img src="{{ asset('/public/assets/images/icons/basic-plan.svg') }}" alt="Basic" class="img-fluid">
                  @elseif($package->name == 'Business plan')
                  <img src="{{ asset('/public/assets/images/icons/business-plan.svg') }}" alt="Business" class="img-fluid">
                  @elseif($package->name == 'Enterprise plan')
                  <img src="{{ asset('/public/assets/images/icons/enterprise-plan.svg') }}" alt="Enterprise" class="img-fluid">
                  @endif
                  
                </div>
                <div class="txt">
                  <h5>{{ $package->name }}</h5>
                  <h3> €{{ $package->yearly_price }}/year </h3>
                  <h6>Billed Yearly</h6>
 
                  <ul>
                    @foreach (json_decode($package->features) as $feature) 
                    <li>
                      <img src="{{ asset('/public/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                      <span>{{ $feature }}</span>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="bttn">
                <a href="{{ route('pricing.package.edit') }}" class="will-subscribe">Edit Plan</a>
              </div>
            </div>
          </div>  
          @endif
          <!-- plan single monthly end --> 
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<!-- pricing page wrapper end -->
@endsection
