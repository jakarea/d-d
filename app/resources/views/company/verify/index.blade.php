@extends('layouts/guest')

@section('title','Login Page')

@section('content')
<!-- login page wrapper start -->
<main class="auth-page-wrapper">
    <div class="container-fluid">
        <div class="row justify-content-center"> 
            <div class="col-12 col-xl-6"> 
                <div class="auth-txt-box"> 
                    <div class="auth-form-wrap">
                       
                        <div class="title mb-5 text-center"> 
                            <img src="{{ asset('public/assets/images/logo.svg') }}" alt="logo Image" class="img-fluid">
                            <h1>Verify to Continue</h1>
                            <p>Thank you for registering. Please use the following box to verify your account</p>
                        </div>
                        <form action="{{ route('verify.account.web') }}" class="auth-form" method="POST">
                            @csrf 
                            <div class="form-group form-error">
                                <label for="verify_code">Verify your account <span>*</span></label>
                                <input type="number" placeholder="Enter your code" value="{{ old('verify_code') }}"
                                    class="form-control @error('verify_code') is-invalid @enderror" name="verify_code" id="verify_code" maxlength="5" pattern="\d{1,5}" oninput="if(this.value.length > 5) this.value = this.value.slice(0, 5);">

                                @error('verify_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div> 
                            <div class="form-submit">
                                <button class="btn btn-submit" type="submit" style="background: #212529; color: #fff">Verify</button>
                            </div> 
                            <div class="already-have">
                                @if (Auth::check())
                                    <p>Want to verify later? <a href="{{ url('logout')}}">Logout Now!</a></p>
                                @endif
                            </div>
                        </form>
                    </div>
                    <!-- auth login form end -->

                    <!-- ftr -->
                    <div class="ftr-txt">
                        <p>&copy; 2023 <a href="https://dailydealsdiscounts.com/">dailydealsdiscounts</a> . Alrights reserved.</p>

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