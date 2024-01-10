@extends('layouts/guest')

@section('title','Success')

@section('style')
<link rel="stylesheet" href="{{ url('public/assets/css/payments.css') }}"> 
@endsection

@section('content')

<div class="wrap-outer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="top-logo">
                    <a href="#">
                        <img src="{{ asset('public/assets/images/logo.png') }}" alt="logo" class="img-fluid">
                    </a>
                </div>
                {{-- @if(session('success')) --}}
                <div class="payments-message-box">
                    <img src="{{ asset('public/assets/images/icons/success.svg') }}" alt="success" class="img-fluid">

                    <h4>Your password has been successfully changed!</h4>
                    <p>Please return to login page to continue.</p>

                    <a href="#">DONE</a>
                </div> 
                {{-- @endif  --}}
            </div>
        </div>
    </div>
</div> 
@endsection 