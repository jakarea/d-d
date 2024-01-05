@extends('layouts.auth')

@section('title',"Notification Page")

{{-- style section @S --}}
@section('style')
<link href="{{ asset('latest/assets/admin-css/elearning.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('latest/assets/admin-css/user.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- style section @E --}}

@section('content')
<main class="main-page-wrapper marketplace-page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- page title -->
                <div class="page-title">
                    <h1>All Notifications</h1>

                    <!-- filter -->
                    <form action="" method="GET" id="myForm">
                        <div class="page-filter">
                            <div class="dropdown">
                                <button class="btn" type="button" id="dropdownBttn" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Filter
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item filterItem" href="#" data-value="0">All Product</a></li>
                                    <li>
                                        <a class="dropdown-item filterItem" href="#" data-value="1">
                                            Yesterday <i class="fas fa-check"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item filterItem" href="#" data-value="7">
                                            Last 7 days <i class="fas fa-check"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item filterItem" href="#" data-value="30">
                                            Last 30 days <i class="fas fa-check"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item filterItem" href="#" data-value="365">
                                            Last 1 Year <i class="fas fa-check"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <input type="hidden" name="category" id="inputField">
                    </form>
                    <!-- filter -->
                </div>
                <!-- page title -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <hr class="line">
                <div class="notification-box-wrapper">
                    @foreach ($notifications as $notification)
                    <div class="show-notification-item">
                        <div class="single"> 
                            {{-- notify item start --}}
                            <div class="notify-item-box">
                                <div class="media">
                                    <div class="icon">

                                        @php
                                        $imageArray = optional($notification->product)->images ? explode(',',
                                        $notification->product->images) : [];
                                        $firstImageUrl = count($imageArray) > 0 ? $imageArray[0] :
                                        'public/uploads/products/product-thumbnail-01.png';
                                        @endphp

                                        @php 
                                           $user = \App\Models\User::find($notification->creator_id); 
                                        @endphp 
                                        

                                        @if ($notification->action_link == 'Product')
                                            @if($firstImageUrl)
                                            <img src="{{ $firstImageUrl }}" alt="T" class="img-fluid">
                                            @endif
                                        @elseif($notification->action_link == 'Earning')
                                            @if($user->personalInfo && $user->personalInfo->avatar)
                                            <img src="{{ optional($user->personalInfo)->avatar }}" alt="A" class="img-fluid">
                                            @else 
                                            <span class="no-avatar nva-sm" style="width: 2.5rem; height: 2.5rem;">
                                                {!! strtoupper($user->name[0]) !!}</span>
                                            @endif
                                        @endif 
 
                                    </div>
                                    <div class="media-body">
                                        <h5>
                                            @if ($notification->action_link == 'Product')
                                                <a href="{{ url('marketplace',optional($notification->product)->slug) }}">{{ optional($notification->product)->images ?  optional($notification->product)->title : 'This product has been deleted!' }}</a>
                                            @elseif($notification->action_link == 'Earning') 
                                                <a href="{{ url('earning',$notification->action_id) }}">New subscription has been purchased</a>
                                            @else 
                                                New Notification
                                            @endif
                                        </h5>
                                        <p>{{ $notification->message }} - <span>{{ $notification->created_at->diffForHumans() }}</span></p>
                                    </div>
                                </div>
                            </div>
                            {{-- notify item end --}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{-- pagginate --}}
                <div class="paggination-wrap">
                    {{-- {{ $lastOneYears->links('pagination::bootstrap-5') }} --}}
                </div>
                {{-- pagginate --}}
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection