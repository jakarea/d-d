<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="D&D is a Ecommerce Platform">
    <meta property="og:title" content="D&D">
    <meta property="og:type" content="E-Commerce">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="theme-color" content="#fff">

    <!-- Bootstrap CSS start -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <!-- Bootstrap CSS end -->

    <!-- plugin CSS start -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- plugin CSS end -->

    <!-- custom CSS start -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/responsive.css') }}">
    <!-- custom CSS end -->

    <title>DnD || Authintication </title>
</head>

<body>
<!-- login page wrapper start -->
<main class="auth-page-wrapper">
    <div class="container-fluid">
        <div class="row justify-content-center"> 
            <div class="col-12 col-xl-6">
                <!-- auth text start -->
                <div class="auth-txt-box">
                    <!-- auth login form start -->
                    <div class="auth-form-wrap"> 

                        <div class="title"> 
                            <h1>Reset Password</h1>
                        </div>

                        <form action="{{ route('password.update') }}" class="auth-form" method="POST">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group form-error">
                                <label for="email">Email Address <span>*</span></label>
                                <input type="email" placeholder="Input your registered email" value="{{ $email ?? old('email') }}" 
                                    class="form-control @error('email') is-invalid @enderror" name="email" id="email">

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
 <!-- Bootstrap Bundle with Popper JS start -->
 <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script> 

 <script>
     var togglePassword = document.getElementById('togglePassword');
         var passwordInput = document.getElementById('password');
         var eyeIcon = document.getElementById('eyeIcon');
     
         togglePassword.addEventListener('click', function () {
             // Toggle the type attribute
             if (passwordInput.type === 'password') {
                 passwordInput.type = 'text';
                 eyeIcon.classList.remove('fa-eye');
                 eyeIcon.classList.add('fa-eye-slash');
             } else {
                 passwordInput.type = 'password';
                 eyeIcon.classList.remove('fa-eye-slash');
                 eyeIcon.classList.add('fa-eye');
             }
         });
 </script>  

</body>

</html>