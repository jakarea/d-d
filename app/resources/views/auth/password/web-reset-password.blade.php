@extends('layouts/guest')

@section('title','Login Page')

@section('content')
<!-- login page wrapper start -->
<main class="auth-page-wrapper">
    <div class="container-fluid">
        <div class="row justify-content-center"> 
            <div class="col-12 col-xl-6">
                <!-- auth text start -->
                <div class="auth-txt-box">
                    <!-- auth login form start -->
                    <div class="auth-form-wrap"> 
                        <div class="text-center">
                            <a href="#">
                                <img src="{{ asset('public/assets/images/logo.svg') }}" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="title"> 
                            <h1>Reset Password</h1>
                        </div>

                        <form action="{{ route('password.update') }}" class="auth-form" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" class="@error('email') is-invalid @enderror" id="email" value="{{ $email }}">

                            <div class="form-group form-error">
                                <label for="email">Email Address <span>*</span></label>
                                <input type="email" placeholder="Input your registered email" value="{{ $email ?? old('email') }}" 
                                    class="form-control" disabled>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="form-group form-error">
                                <label for="password">Password <span>*</span></label>
                                <input type="password" placeholder="*********" class="form-control  @error('password') is-invalid @enderror" name="password" value="{{ old('password')}}" id="password">

                                <div class="fields-icons">
                                    <a href="javascript:void(0)" id="togglePassword">
                                        <i class="fa-regular fa-eye" id="eyeIcon"></i>
                                    </a>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> 
                            <div class="form-group form-error">
                                <label for="password-confirm">Confirm Password <span>*</span></label>
                                <input type="password" placeholder="*********" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password')}}" id="password-confirm">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div> 
                            <div class="form-submit">
                                <button class="btn btn-submit" type="submit">Reset Password</button>
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