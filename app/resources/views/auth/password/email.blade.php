@extends('layouts/guest')

@section('title','Login Page')

@section('content')
<!-- login page wrapper start -->
<main class="auth-page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-6 ps-lg-0">
                <!-- auth image start-->
                <div class="auth-image-box d-none d-xl-block">
                    <img src="{{ asset('public/assets/images/auth/side-image.png') }}" alt="Sidebar Image" class="img-fluid">
                    <div class="img-txt">
                        <h5>We're always ready for you</h5>
                        <p>We help to complete all your conveyancing needs easily</p>
                    </div>
                </div>
                <!-- auth image end-->
            </div>
            <div class="col-12 col-xl-6">
                <!-- auth text start -->
                <div class="auth-txt-box">
                    <!-- auth login form start -->
                    <div class="auth-form-wrap">
                        <div class="title">
                            <img src="{{ asset('public/assets/images/auth/arrow-down.svg') }}" alt="Arrow" class="img-fluid arrow-icon d-none d-xl-block">
                            <h1>{{ __('Reset Password') }}</h1>
                        </div>

                        <form action="{{ route('password.email') }}" class="auth-form" method="POST">
                            @csrf
                            <div class="form-group form-error">
                                <label for="email">Email Address <span>*</span></label>
                                <input type="email" placeholder="Input your registered email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" name="email" id="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div> 
                            <div class="form-submit">
                                <button class="btn btn-submit" type="submit">{{ __('Send Password Reset Link') }}</button>
                            </div>  
                            <div class="already-have">
                                <p>You're new in here? <a href="{{ url('register')}}">Create Account</a></p>
                            </div>
                        </form>
                    </div>
                    <!-- auth login form end -->

                    <!-- ftr -->
                    <div class="ftr-txt">
                        <p>&copy; 2023 <a href="#">Humanline</a> . Alrights reserved.</p>

                        <ul>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>

                    </div>
                    <!-- ftr -->
                </div>
                <!-- auth text end -->
            </div>
        </div>
    </div>
</main>
<!-- login page wrapper end -->
@endsection 