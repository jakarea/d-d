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
          <h2>Our Plans</h2>
          <p>Choose your plan and start promoting your deals! Start your 7 days free trial today.</p>
        </div>
      </div>
    </div>
    {{-- <div class="row">
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
    </div> --}}

    <div class="mt-5">
      <div class="row justify-content-center">
        @if (count($packages) > 0)
        @foreach ($packages as $package)
        <!-- plan single monthly start -->
        <div class="col-xl-4 col-sm-10 col-md-6 mb-3">
          <div class="pricing-box">
            <div>
              <div class="pricing-icon">
                @if ($package->package_type == 'Monthly')
                <img src="{{ asset('/public/assets/images/icons/basic-plan.svg') }}" alt="Monthly" class="img-fluid">
                @else 
                <img src="{{ asset('/public/assets/images/icons/enterprise-plan.svg') }}" alt="Yearly"  class="img-fluid">
                @endif
              </div>
              <div class="txt">
                <h5>{{ $package->name }}</h5>
                <h3> €{{ $package->price }}/{{ substr($package->package_type, 0, -2) }} </h3>
                <h6>Billed {{ $package->package_type }}

                  {{ $package->package_type == 'Yearly' ? ',Safe €90!' : '' }}

                </h6>

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
              {{-- <a href="{{ route('pricing.package.edit') }}" class="will-subscribe">Edit Plan</a> --}}
            </div>
          </div>
        </div>
        <!-- plan single monthly end -->
        @endforeach
        @else
        <div class="col-12">
          {{-- no data found component --}}
          <x-EmptyDataComponent :dynamicData="'Packages Loading... '" />
          {{-- no data found component --}}
        </div>
        @endif
      </div>
    </div>
  </div>
</section>
<!-- pricing page wrapper end -->
@endsection