@extends('layouts.home')

@section('title','Pricing plans')

@section('style')
<link rel="stylesheet" href="{{ url('public/assets/css/pricing.css') }}">
@endsection
@section('content')

<section class="main-page-wrapper pricing-plan-sec pb-5">
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
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Monthly billing</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Annual billing</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="row justify-content-center">
                    @if (count($packages) > 0)
                    @foreach ($packages as $package)
                    <!-- plan single monthly start -->
                    <div class="col-xl-4 col-sm-10 col-md-6 mb-3">
                        <div class="pricing-box">
                            <div>
                                <div class="pricing-icon">
                                    @if ($package->name == 'Basic plan')
                                    <img src="{{ asset('/public/assets/images/icons/basic-plan.svg') }}" alt="Basic"
                                        class="img-fluid">
                                    @elseif($package->name == 'Business plan')
                                    <img src="{{ asset('/public/assets/images/icons/business-plan.svg') }}"
                                        alt="Business" class="img-fluid">
                                    @elseif($package->name == 'Enterprise plan')
                                    <img src="{{ asset('/public/assets/images/icons/enterprise-plan.svg') }}"
                                        alt="Enterprise" class="img-fluid">
                                    @endif

                                </div>
                                <div class="txt">
                                    <h5>{{ $package->name }}</h5>
                                    <h3> €{{ $package->price }}/mth </h3>
                                    <h6>Billed Monthly</h6>

                                    <ul>
                                        @foreach (json_decode($package->features) as $feature)
                                        <li>
                                            <img src="{{ asset('/public/assets/images/icons/check.svg') }}" alt="C"
                                                class="img-fluid">
                                            <span>{{ $feature }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="bttn">
                                @if (Auth::check())
                                @if (optional($package->myPurchaseInfo)->package_type == 'Monthly')
                                <button class="cancel-subscribe current-plan-bttn">Cancel Subscription</button>
                                @else
                                <button class="will-subscribe" data-package-id="{{ $package->id }}"
                                    data-price="{{ $package->price }}" data-package-type="Monthly">Buy Now
                                </button>
                                @endif
                                @else

                                @php
                                    $encrypted_package_id = encrypt($package->id);
                                    $encrypted_package_price = encrypt($package->price);
                                    $encrypted_package_type = encrypt('Monthly');
                                @endphp

                                <a href="{{ url('register/'.$encrypted_package_id .'/'. $encrypted_package_price .'/'.$encrypted_package_type) }}"
                                    class="will-subscribe">Buy Now
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- plan single monthly end -->
                    @endforeach
                    @else
                    <div class="col-12">
                        {{-- no data found component --}}
                        <x-EmptyDataComponent :dynamicData="'Packages Not Found... '" />
                        {{-- no data found component --}}
                    </div>
                    @endif
                </div>
            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="row justify-content-center">
                    @if (count($packages) > 0)
                    @foreach ($packages as $package)
                    <!-- plan single monthly start -->
                    @if ($package->yearly_price > 0)
                    <div class="col-xl-4 col-sm-10 col-md-6 mb-3">
                        <div class="pricing-box">
                            <div>
                                <div class="pricing-icon">
                                    @if ($package->name == 'Basic plan')
                                    <img src="{{ asset('/public/assets/images/icons/basic-plan.svg') }}" alt="Basic"
                                        class="img-fluid">
                                    @elseif($package->name == 'Business plan')
                                    <img src="{{ asset('/public/assets/images/icons/business-plan.svg') }}"
                                        alt="Business" class="img-fluid">
                                    @elseif($package->name == 'Enterprise plan')
                                    <img src="{{ asset('/public/assets/images/icons/enterprise-plan.svg') }}"
                                        alt="Enterprise" class="img-fluid">
                                    @endif

                                </div>
                                <div class="txt">
                                    <h5>{{ $package->name }}</h5>
                                    <h3> €{{ $package->yearly_price }}/year </h3>
                                    <h6>Billed Yearly</h6>

                                    <ul>
                                        @foreach (json_decode($package->features) as $feature)
                                        <li>
                                            <img src="{{ asset('/public/assets/images/icons/check.svg') }}" alt="C"
                                                class="img-fluid">
                                            <span>{{ $feature }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="bttn">

                                @if (Auth::check())   
                                    @if (optional($package->myPurchaseInfo)->package_type == 'Yearly')
                                        <button class="cancel-subscribe current-plan-bttn">Cancel Subscription</button>
                                    @else 
                                    <button class="will-subscribe" data-package-id="{{ $package->id }}"
                                        data-price="{{ $package->yearly_price }}" data-package-type="Yearly">Buy
                                        Now</button>
                                    @endif
                                @else

                                @php
                                    $encrypted_package_id = encrypt($package->id);
                                    $encrypted_package_price = encrypt($package->yearly_price);
                                    $encrypted_package_type = encrypt('Yearly');
                                @endphp

                                <a href="{{ url('register/'.$encrypted_package_id .'/'. $encrypted_package_price .'/'.$encrypted_package_type) }}"
                                    class="will-subscribe">Buy Now
                                </a>
                                @endif  
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- plan single monthly end -->
                    @endforeach
                    @else
                    <div class="col-12">
                        {{-- no data found component --}}
                        <x-EmptyDataComponent :dynamicData="'Packages not Found... '" />
                        {{-- no data found component --}}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
<!-- pricing page wrapper end -->

@endsection

@section('script')
{{-- buy package --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.will-subscribe').forEach(function(button) {
        button.addEventListener('click', function() { 

            let userId = '{{ Auth::user() ? Auth::user()->id : '' }}';
            if (userId) {
            button.disabled = true;
            button.innerHTML = 'Loading..';

            let packageId = this.getAttribute('data-package-id');
            let price = this.getAttribute('data-price');
            let packageType = this.getAttribute('data-package-type');
            
            let csrfToken = '{{ csrf_token() }}';
           
                let data = {
                _token: csrfToken,
                package_id: packageId,
                price: price,
                package_type: packageType,
                user_id: userId
            }; 
            
            fetch('{{ url('api/company/purchase/request') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(response => {
                if (response.error === false) {
                    window.location.href = response.data;
                } else { 
                    button.disabled = false; 
                    button.innerHTML = response.message;
                }
            })
            .catch(error => { 
                button.disabled = false;
                button.innerHTML = 'Failed!';
            });
            }
            
        });
    });
});

</script>

{{-- cancel subscription --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.cancel-subscribe').forEach(function(button) {
            button.addEventListener('click', function() { 
                
                let userId = '{{ Auth::user() ? Auth::user()->id : '' }}';
                if (userId) {
                    button.disabled = true;
                    button.innerHTML = 'Cancelling..'; 
                    
                    let csrfToken = '{{ csrf_token() }}';
                    
                    fetch('{{ url('api/company/subscription/cancel') }}', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(response => {
                        if (response.error === false) { 
                            button.innerHTML = response.message 
                            
                        } else { 
                            button.disabled = false;
                            button.innerHTML = 'Failed!';
                        }
                    })
                    .catch(error => { 
                        button.disabled = false;
                        button.innerHTML = 'Failed!';
                    });
                } 
                
            });
        });
    }); 
</script>
@endsection