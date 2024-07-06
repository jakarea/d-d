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
                    <h2>Our Plans</h2>
                    <p>Choose your plan and start promoting your deals! Start your 7 days free trial today.</p>
                </div>
            </div>
        </div>
    

        {{-- pricing package start --}}
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
 
                                <h3> €{{ $package->price }}/{{ substr($package->package_type, 0, -2) }}
                                </h3>
                                <h6>Billed {{ $package->package_type }} {{ $package->package_type == 'Yearly' ? ',Safe €90!' : '' }}</h6>
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
                                @if (optional($package->myPurchaseInfo)->pricing_packages_id == $package->id)
                                <button class="current-plan-bttn">Current Plan</button>
                                @else
                                <button class="will-subscribe" data-package-id="{{ $package->id }}"
                                    data-price="{{ $package->price }}" data-package-type="{{$package->package_type}}">Start Now!
                                </button>
                                @endif
                            @else

                            @php 
                            $encrypted_package_id = encrypt($package->id);
                            $encrypted_package_price = encrypt($package->price);
                            $encrypted_package_type = encrypt($package->package_type);
                            @endphp 

                            <a href="{{ url('register/'.$encrypted_package_id .'/'. $encrypted_package_price .'/'.$encrypted_package_type) }}"
                                class="will-subscribe">Start Now! 
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
        {{-- pricing package end --}}
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
{{-- <script>
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
</script> --}}
@endsection