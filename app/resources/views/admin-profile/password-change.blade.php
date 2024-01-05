@extends('layouts.auth')

@section('title','Admin Security Settings')

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
    <!-- page title -->
    <div class="page-title">
        <h1>Password Update</h1>
    </div>
    <!-- page title -->

    <!-- customer details start -->
    <div class="row">
        <div class="col-12 col-md-4 col-xl-3">
          <!-- customer about start -->
          <div class="company-about-box">
            <div class="avatar-wrap">
              <div id="avatar-container">
                @if ($user->personalInfo && $user->personalInfo->avatar)
                <img src="{{ $user->personalInfo->avatar }}" alt="A" class="img-fluid main-avatar" id="avatar-preview">
                @else
                <span class="no-avatar nva-lg">{!! strtoupper($user->name[0]) !!}</span>
                @endif
              </div> 
            </div>
            <div class="txt">
              <h1>{{$user->name}}</h1>
              @if ($user->roles)
              @foreach ($user->roles as $role)
              <p>{{ $role->name ? $role->name : '--' }}</p>
              @endforeach
              @endif
    
              <hr>
    
              <ul>
                <li>
                  <p><img src="{{ asset('/public/assets/images/icons/envelope.svg') }}" alt="I" class="img-fluid">
                    {{ $user->email }}</p>
                </li>
                @if ($user->personalInfo)
                <li>
                  <p><img src="{{ asset('/public/assets/images/icons/call.svg') }}" alt="I" class="img-fluid">
                    {{ optional($user->personalInfo)->phone }}
                  </p>
                </li>
                @endif
                @if ($user->address)
                <li>
                  <p><img src="{{ asset('/public/assets/images/icons/global.svg') }}" alt="I" class="img-fluid">
                    {{ optional($user->address)->country }}
                  </p>
                </li>
                @endif
    
              </ul>
            </div>
          </div>
          <!-- customer about end -->
        </div>
        <!--pesonal info start-->
        <div class="col-12 col-md-8 col-xl-9">
          <!-- customer info start -->
          <div class="company-edit-from-wrapper">
            
            <!-- customer address info start -->
            <form action="{{ route('admin.security.update') }}" method="POST">
              @csrf  
              <div class="form-box mt-4">
                <div class="title">
                  <h3>Password</h3>
                </div>
                <div class="form-group form-error">
                  <label for="email">Email Address<span>*</span></label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" value="{{ $user->email }}" name="email" id="email" disabled>
      
                  <span class="invalid-feedback">
                    @error('email'){{ $message }} @enderror
                  </span>
      
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group form-error">
                      <label for="password">New Password<span>*</span></label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" name="password" id="password">

                      <div class="fields-icons">
                        <a href="javascript:void(0)" id="togglePassword">
                            <i class="fa-regular fa-eye" id="eyeIcon"></i>
                        </a>
                    </div>

                      <span class="invalid-feedback">
                        @error('password'){{ $message }} @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group form-error">
                      <label for="password_confirmation">Confirm Password<span>*</span></label>
                      <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter confirm password" name="password_confirmation" id="password_confirmation">
                      <span class="invalid-feedback">
                        @error('password_confirmation'){{ $message }} @enderror
                      </span>
       
                    </div>
                  </div> 
                </div>
                <div class="form-submit">
                  <button type="submit" class="btn btn-submit">Save Changes</button>
                </div>
              </div>
            </form>
            <!-- customer address info end -->
          </div>
          <!-- customer info end -->
        </div>
      </div>
</section>
<!-- main page wrapper end -->
@endsection


@section('script')

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

@endsection 