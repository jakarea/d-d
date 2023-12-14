@extends('layouts.auth')

@section('title','Customer Address Update Page')

@section('content')
<section class="main-page-wrapper marketplace-page-wrapper">
  <!-- page title -->
  <div class="page-title">
    <h1>Customer Address Update</h1>
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
        <!-- customer personal info start -->
        <div class="form-box">
          <div class="title">
            <h3>Personal Info</h3>
            <a href="{{ route('users.edit', $user) }}">
              <img src="{{ asset('/public/assets/images/icons/pen.svg') }}" alt="I" class="img-fluid">
            </a>
          </div>

          <!-- table start -->
          @if ($user->personalInfo)
          <div class="personal-info-table-wrap">
            <table>
              <tr>
                <td>
                  <p>Full Name</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->name }}</h6>
                </td>
                <td>
                  <p>Gender</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->gender }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Designation</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->designation }} </h6>
                </td>
                <td>
                  <p>Marital Status</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->maritual_status }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Date of Birth</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->dob }}</h6>
                </td>
                <td>
                  <p>Phone Number</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->phone }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Nationality</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->nationality }}</h6>
                </td>
                <td>
                  <p>Email Address</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->email }}</h6>
                </td>
              </tr>
            </table>
          </div>
          @else 
          <div class="personal-info-table-wrap">
            <table>
              <tr>
                <td colspan="4" class="text-center">
                  <p>No Personal Information Found!</p>
                </td> 
              </tr> 
            </table>
          </div>
          @endif
          <!-- table end -->
        </div>
        <!-- customer personal info end -->
        <!-- customer address info start -->
        <form action="{{ route('users.updateAddress', $user->id) }}" method="POST">
          @csrf 
          {{-- @method('PATCH') --}}
          <div class="form-box mt-4">
            <div class="title">
              <h3>Address</h3>
            </div>
            <div class="form-group form-error">
              <label for="primary_address">Primary Address<span>*</span></label>
              <input type="text" class="form-control @error('primary_address') is-invalid @enderror" placeholder="Enter Name" value="{{ optional($user->address)->primary_address }}" name="primary_address" id="primary_address">
  
              <span class="invalid-feedback">
                @error('primary_address'){{ $message }} @enderror
              </span>
  
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group form-error">
                  <label for="country">Country<span>*</span></label>
                  <input type="text" class="form-control @error('country') is-invalid @enderror" placeholder="Enter Country Name" value="{{ optional($user->address)->country }}" name="country" id="country">
                  <span class="invalid-feedback">
                    @error('country'){{ $message }} @enderror
                  </span>
  
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group form-error">
                  <label for="city">City<span>*</span></label>
                  <input type="text" class="form-control @error('city') is-invalid @enderror" placeholder="Enter City Name" value="{{ optional($user->address)->city }}" name="city" id="city">
                  <span class="invalid-feedback">
                    @error('city'){{ $message }} @enderror
                  </span>
   
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group form-error">
                  <label for="state">State<span>*</span></label>
                  <input type="text" class="form-control @error('state') is-invalid @enderror" placeholder="Enter State Name" value="{{ optional($user->address)->state }}" name="state" id="state">
  
                  <span class="invalid-feedback">
                    @error('state'){{ $message }} @enderror
                  </span>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group form-error">
                  <label for="post_code">Post Code<span>*</span></label>
                  <input type="text" class="form-control @error('post_code') is-invalid @enderror" placeholder="Enter Post Code" value="{{ optional($user->address)->post_code }}" name="post_code" id="post_code">
  
                  <span class="invalid-feedback">
                    @error('post_code'){{ $message }} @enderror
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
  {{-- customer details end --}}
</section>
@endsection

@section('script')

@endsection 