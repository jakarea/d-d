@extends('layouts.auth')

@section('title','Admin Profile Update')

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
    <!-- page title -->
    <div class="page-title">
      <h1>Admin Profile Update</h1>
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
  
            <label for="avatar" class="avatar-label">
              <div class="ol">
                <img src="{{ asset('public/assets/images/icons/photo.png') }}" alt="U" class="img-fluid logo-photo">
                <span>Update Photo</span>
              </div>
            </label>
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
          <!-- customer personal info start -->
          <form action="{{ route('admin.profile.update') }}" class="form-box" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="title">
              <h3>Personal Info</h3>
  
            </div>
            {{-- user avatar --}}
            <input type="file" name="avatar" id="avatar" class="d-none">
            {{-- user avatar --}}
            <div class="form-group form-error">
              <label for="name">Full Name <span>*</span></label>
              <input type="text" class="form-control @error('name') is-invalid @enderror"
                placeholder="Enter Name.." value="{{ optional($user->personalInfo)->name }}" name="name"
                id="name">
  
              <span class="invalid-feedback">
                @error('name'){{ $message }} @enderror
              </span>
  
            </div>
            <div class="form-group form-error">
              <label for="designation">Designation<span>*</span></label>
              <input type="text" class="form-control @error('designation') is-invalid @enderror" placeholder="Input here"
                value="{{ optional($user->personalInfo)->designation }}" name="designation" id="designation">
  
              <span class="invalid-feedback">
                @error('designation'){{ $message }} @enderror
              </span>
  
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group form-error">
                  <label for="dob">Date of Birtht<span>*</span></label>
                  <input type="date" class="form-control @error('dob') is-invalid @enderror" placeholder="Input here"
                    value="{{ optional($user->personalInfo)->dob }}" name="dob" id="dob">
  
                  <span class="invalid-feedback">
                    @error('dob'){{ $message }} @enderror
                  </span>
  
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group form-error">
                  <label for="gender">Gender <span>*</span></label>
                  <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="" disabled>Select Below</option>
                    <option value="Male" {{ optional($user->personalInfo)->gender == 'Male' ? 'selected' : ''}}>Male
                    </option>
                    <option value="Felame" {{ optional($user->personalInfo)->gender == 'Felame' ? 'selected' : ''}}>Female
                    </option>
                    <option value="Others" {{ optional($user->personalInfo)->gender == 'Others' ? 'selected' : ''}}>Others
                    </option>
                  </select>
                  <div class="fields-icons">
                    <i class="fas fa-angle-down"></i>
                  </div>
  
                  <span class="invalid-feedback">
                    @error('gender'){{ $message }} @enderror
                  </span>
  
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group form-error">
                  <label for="email">Email Address <span>*</span></label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email"
                    value="{{ optional($user->personalInfo)->email }}" name="email" id="email">
                  <span class="invalid-feedback">
                    @error('email'){{ $message }} @enderror
                  </span>
  
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group form-error">
                  <label for="phone">Phone Number<span>*</span></label>
                  <input type="text" class="form-control @error('phone') is-invalid @enderror"
                    placeholder="Enter phone number" value="{{ optional($user->personalInfo)->phone }}" name="phone"
                    id="phone">
  
                  <span class="invalid-feedback">
                    @error('phone'){{ $message }} @enderror
                  </span>
  
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group form-error">
                  <label for="nationality">Nationality <span>*</span></label>
                  <input type="text" class="form-control @error('nationality') is-invalid @enderror"
                    placeholder="Nationality.." value="{{ optional($user->personalInfo)->nationality }}"
                    name="nationality" id="nationality">
  
                  <span class="invalid-feedback">
                    @error('nationality'){{ $message }} @enderror
                  </span>
  
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group form-error">
                  <label for="maritual_status">Marital Status<span>*</span></label>
                  <input type="text" class="form-control @error('maritual_status') is-invalid @enderror"
                    placeholder="Input here status" value="{{ optional($user->personalInfo)->maritual_status }}"
                    name="maritual_status" id="maritual_status">
  
                  <span class="invalid-feedback">
                    @error('maritual_status'){{ $message }} @enderror
                  </span>
  
                </div>
              </div>
            </div>
            <div class="form-submit">
              <button type="submit" class="btn btn-submit">Save Changes</button>
            </div>
          </form>
          <!-- customer personal info end -->
          <!-- customer address info start -->
          <div class="form-box mt-4">
            <div class="title">
              <h3>Address</h3>
              <a href="{{ route('admin.profile.address.edit') }}">
                <img src="{{ asset('/public/assets/images/icons/pen.svg') }}" alt="I" class="img-fluid">
              </a>
            </div>
            <!-- table start -->
            @if ($user->address)
            <div class="personal-info-table-wrap">
              <table>
                <tr>
                  <td>
                    <p>Primary addresss</p>
                  </td>
                  <td>
                    <h6>{{ optional($user->address)->primary_address }}</h6>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Country</p>
                  </td>
                  <td>
                    <h6>{{ optional($user->address)->country }}</h6>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>State</p>
                  </td>
                  <td>
                    <h6>{{ optional($user->address)->state }}</h6>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>City</p>
                  </td>
                  <td>
                    <h6>{{ optional($user->address)->city }}</h6>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Post Code</p>
                  </td>
                  <td>
                    <h6>{{ optional($user->address)->post_code }}</h6>
                  </td>
                </tr>
              </table>
            </div>
            @else
            <div class="personal-info-table-wrap">
              <table>
                <tr>
                  <td colspan="4" class="text-center">
                    <p>No Address Found!</p>
                  </td>
                </tr>
              </table>
            </div>
            @endif
            <!-- table end -->
          </div>
          <!-- customer address info end -->
        </div>
        <!-- customer info end -->
      </div>
      <!--personal info end-->
    </div>
  </section>
<!-- main page wrapper end -->
@endsection

@section('script')
{{-- image upload preview --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
      var avatarContainer = document.getElementById('avatar-container');
      var avatarPreview = document.getElementById('avatar-preview');
      document.getElementById('avatar').addEventListener('change', function (e) {
          var input = e.target;
          var file = input.files[0];

          if (file) { 
              if (!avatarPreview) {
                  avatarPreview = document.createElement('img');
                  avatarPreview.id = 'avatar-preview';
                  avatarPreview.className = 'img-fluid main-avatar';
                  avatarContainer.innerHTML = '';
                  avatarContainer.appendChild(avatarPreview);
              }
 
              var reader = new FileReader();
              reader.onload = function (e) {
                  avatarPreview.src = e.target.result;
              };
              reader.readAsDataURL(file);
          }
      });
  });
</script>
@endsection