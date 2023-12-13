@extends('layouts.auth')

@section('title',$company->name)

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
    <!-- page title -->
    <div class="page-title">
        <h1>Company Update</h1>
    </div>
    <!-- page title -->

    <!-- company list start -->
    <div class="row">
        <div class="col-12 col-md-4 col-xl-3">
            <!-- compnay about start -->
            <div class="company-about-box">
                <div class="avatar-wrap">
                    <div id="avatar-container">
                        @if ($company->user->personalInfo && $company->user->personalInfo->avatar)
                        <img src="{{ $company->user->personalInfo->avatar }}" alt="A" class="img-fluid main-avatar" id="avatar-preview">
                        @else
                        <span class="no-avatar nva-lg">{!! strtoupper($company->user->name[0]) !!}</span>
                        @endif
                    </div>

                    <label for="avatar" class="avatar-label">
                        <div class="ol">
                            <img src="{{ asset('public/assets/images/icons/photo.png') }}" alt="U"
                                class="img-fluid logo-photo">
                            <span>Update Photo</span>
                        </div>
                    </label>
                </div>

                <div class="txt">
                    <h1>{{ $company->name }}</h1>
                    <p>{{ $company->tagline }}</p>
                    <hr>

                    <ul>
                        @if ($company->email)
                        <li>
                            <p>
                                <img src="{{ asset('public/assets/images/icons/envelope.svg') }}" alt="I"
                                    class="img-fluid">
                                {{ $company->email }}
                            </p>
                        </li>
                        @endif
                        @if ($company->phone)
                        <li>
                            <p>
                                <img src="{{ asset('public/assets/images/icons/call.svg') }}" alt="I" class="img-fluid">
                                {{ $company->phone }}
                            </p>
                        </li>
                        @endif
                        @if ($company->location)
                        <li>
                            <p>
                                <img src="{{ asset('public/assets/images/icons/gps.svg') }}" alt="I" class="img-fluid">
                                {{ $company->location }}
                            </p>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- compnay about end -->
        </div>
        <div class="col-12 col-md-8 col-xl-9">
            <!-- company edit form start -->
            <div class="company-edit-from-wrapper">
                <form action="{{ route('company.update', $company) }}" class="form-box" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="title">
                        <h3>Information</h3>
                    </div>
                    <input type="file" name="avatar" id="avatar" class="d-none">
                    <div class="form-group form-error">
                        <label for="name">Company Name <span>*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Company Name.." value="{{ $company->name }}" name="name" id="name">

                        <span class="invalid-feedback">
                            @error('name'){{ $message }} @enderror
                        </span>
                    </div>
                    <div class="form-group form-error">
                        <label for="tagline">Company Tagline <span>*</span></label>
                        <input type="text" class="form-control @error('tagline') is-invalid @enderror"
                            placeholder="Company Tagline.." value="{{ $company->tagline }}" name="tagline" id="tagline">
                        <span class="invalid-feedback">@error('tagline'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group form-error">
                        <label for="about">About Company <span>*</span></label>
                        <textarea name="about" id="about" cols="30" rows="5"
                            class="form-control @error('about') is-invalid @enderror"
                            placeholder="Type here">{{ $company->about }}</textarea>

                        <span class="invalid-feedback">@error('about'){{ $message }}
                            @enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group form-error">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Company Email" value="{{ $company->email }}" name="email" id="email">

                                <span class="invalid-feedback">@error('email'){{ $message }}
                                    @enderror</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group form-error">
                                <label for="phone">Phone <span>*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Enter phone number" value="{{ $company->phone }}" name="phone"
                                    id="phone">

                                <span class="invalid-feedback">@error('phone'){{ $message }}
                                    @enderror</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group form-error">
                                <label for="country">Country <span>*</span></label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror"
                                    placeholder="Enter country name" value="{{ $company->country }}" name="country"
                                    id="country">

                                <span class="invalid-feedback">@error('country'){{ $message }}
                                    @enderror</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group form-error">
                                <label for="location">Location <span>*</span></label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                    placeholder="Location.." value="{{ $company->location }}" name="location"
                                    id="location">

                                <span class="invalid-feedback">@error('location'){{ $message }}
                                    @enderror</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-submit">
                        <button type="submit" class="btn btn-submit">Save Changes</button>
                    </div>
                </form>
            </div>
            <!-- company edit form end -->
        </div>
    </div>
    <!-- company list end -->
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