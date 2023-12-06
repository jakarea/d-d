@extends('layouts/guest')

@section('title','Register Page')

@section('content')
<!-- Register page wrapper start -->
<main class="auth-page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-6">
                <!-- auth text start -->
                <div class="auth-txt-box">
                    <!-- auth register form start -->
                    <div class="auth-form-wrap register-auth-txt">
                        <div class="title">
                            <h1 class="text-start">Get Started</h1>
                            <h6>Get started for free today!</h6>
                        </div>
                        <form action="" class="auth-form" method="POST">
                            @csrf
                            <div class="form-group form-error">
                                <label for="name">Name <span>*</span></label>
                                <input type="text" placeholder="Input your full name"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" id="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group form-error">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" placeholder="example@company.com"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email')}}" id="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group form-error">
                                <label for="password">Password <span>*</span></label>
                                <input type="password" placeholder="Input your password account"
                                    class="form-control  @error('password') is-invalid @enderror" name="password"
                                    id="password">

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
                            <div class="form-submit">
                                <button class="btn btn-submit" type="submit">Create Account</button>
                            </div>
                            <div class="options">
                                <hr>
                                <p>Or register with</p>
                            </div>
                            <div class="login-with-social">
                                <a href="#" class="bttn me-md-3 me-2"><img src="./public/assets/images/auth/google.svg"
                                        alt="G" class="img-fluid"> Google</a>
                                <a href="#" class="bttn ms-md-3 ms-2"><img src="./public/assets/images/auth/apple.svg"
                                        alt="A" class="img-fluid"> Apple</a>
                            </div>

                            <div class="already-have text-start">
                                <p>Already have an account? <a href="{{ url('login')}}">Login Here</a></p>
                            </div>
                        </form>
                    </div>
                    <!-- auth register form end -->

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
            <div class="col-12 col-xl-6 pe-xl-0">
                <!-- auth image start-->
                <div class="auth-register-image-box d-none d-xl-block">
                    <div class="img-txt">
                        <h5>We're always ready for you</h5>
                        <p>We help to complete all your conveyancing needs easily</p>
                    </div>
                    <img src="./public/assets/images/auth/side-image.png" alt="Sidebar Image" class="img-fluid">

                </div>
                <!-- auth image end-->
            </div>
        </div>
    </div>
</main>
<!-- register page wrapper end -->
@endsection