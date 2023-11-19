@extends('layouts.auth')
@section('style')
<link rel="stylesheet" href="{{ url('assets/css/pricing.css') }}">
@endsection
@section('content')
      <!-- pricing page wrapper start -->
    <section class="pricing-plan-sec pt-5">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="pricing-heading">
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
              <!-- plan single monthly start -->
              <div class="col-xl-4 col-sm-10 col-md-6 mb-3">
                <div class="pricing-box">
                 
                  <div>
                    <div class="pricing-icon">
                      <img src="{{ asset('/assets/images/icons/basic-plan.svg') }}" alt="B" class="img-fluid">
                    </div>
                    <div class="txt">
                      <h5>Basic plan</h5>
                      <h3> $10/mth </h3>
                      <h6>Billed monthly</h6>

                      <ul>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Access to all basic features</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Basic reporting and analytics</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Up to 10 individual users</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>20GB individual data each user</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Basic chat and email support</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="bttn">
                    <a href="#" class="will-subscribe">Edit Plan</a>
                  </div>
                </div>
              </div>
              <!-- plan single monthly end -->
              <!-- plan single monthly start -->
              <div class="col-xl-4 col-sm-10 col-md-6 mb-3">
                <div class="pricing-box">
                  <span class="current-plan">
                    Feature
                  </span>
                  <div>
                    <div class="pricing-icon">
                      <img src="{{ asset('/assets/images/icons/business-plan.svg') }}" alt="B" class="img-fluid">
                    </div>
                    <div class="txt">
                      <h5>Business plan</h5>
                      <h3> $20/mth </h3>
                      <h6>Billed monthly</h6>

                      <ul>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>200+ integrations</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Advanced reporting and analytics</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Up to 20 individual users</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>40GB individual data each user</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Priority chat and email support</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="bttn">
                    <a href="#" class="will-subscribe">Edit Plan</a>
                  </div>
                </div>
              </div>
              <!-- plan single monthly end -->
              <!-- plan single monthly start -->
              <div class="col-xl-4 col-sm-10 col-md-6 mb-3">
                <div class="pricing-box">
              
                  <div>
                    <div class="pricing-icon">
                      <img src="{{ asset('/assets/images/icons/enterprise-plan.svg') }}" alt="B" class="img-fluid">
                    </div>
                    <div class="txt">
                      <h5>Enterprise plan</h5>
                      <h3> $40/mth </h3>
                      <h6>Billed monthly</h6>

                      <ul>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Advanced custom fields</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Audit log and data history</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Unlimited individual users</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Unlimited individual data</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Personalised+priotity service</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="bttn">
                    <a href="#" class="will-subscribe">Edit Plan</a>
                  </div>
                </div>
              </div>
              <!-- plan single monthly end -->
            </div>
          </div>

          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
            tabindex="0">
            <div class="row justify-content-center">
              <div class="col-xl-4 col-sm-10 col-md-6 mb-3">
                <div class="pricing-box">
                  <span class="current-plan">
                    Feature
                  </span>
                  <div>
                    <div class="pricing-icon">
                      <img src="{{ asset('/assets/images/icons/basic-plan.svg') }}" alt="B" class="img-fluid">
                    </div>
                    <div class="txt">
                      <h5>Basic plan</h5>
                      <h3> $10/mth </h3>
                      <h6>Billed monthly</h6>

                      <ul>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Access to all basic features</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Basic reporting and analytics</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Up to 10 individual users</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>20GB individual data each user</span>
                        </li>
                        <li>
                          <img src="{{ asset('/assets/images/icons/check.svg') }}" alt="C" class="img-fluid">
                          <span>Basic chat and email support</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="bttn">
                    <a href="#" class="will-subscribe">Edit Plan</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- pricing page wrapper end -->
@endsection