@extends('layouts/guest')

@section('title','Failed')

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
                        <img src="{{ asset('public/assets/images/logo.svg') }}" alt="logo" class="img-fluid">
                    </a>
                </div>
                {{-- @if(session('error'))  --}}
                <div class="payments-message-box cancel-box">
                    <img src="{{ asset('public/assets/images/icons/cancel.svg') }}" alt="success" class="img-fluid">

                    <h4>Failed to change your password!</h4>
                    <p>Please check your information then try again.</p>

                    <a href="#">FAILED</a>
                </div>
                {{-- @endif  --}}
            </div>
        </div>
    </div>
</div> 
@endsection 