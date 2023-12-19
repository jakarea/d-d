@extends('layouts.auth')

@section('title','Customer List Page')

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
  <!-- page title -->
  <div class="page-title">
    <h1>Customer</h1>

    <!-- bttn -->
    <div class="page-bttn">
      <a href="#" class="bttn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add Customer</a>
    </div>
    <!-- bttn -->
  </div>
  <!-- page title -->

  <!-- user list start -->
  <div class="row">
    @if (count($users) > 0)
      @foreach ($users as $user)
      <!-- user single box start -->
      <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-15">
        <div class="company-profile-box">
          <!-- avatar -->
          <div class="avatar">
            @if ($user->personalInfo && $user->personalInfo->avatar)
            <img src="{{ $user->personalInfo->avatar }}" alt="Avatar" class="img-fluid">
            @else
            <span class="no-avatar nva-sm">{!! strtoupper($user->name[0]) !!}</span>
            @endif

          </div>
          <!-- avatar -->

          <div class="txt">
            <h4>{{$user->name}}</h4>
            @if ($user->roles)
                @foreach ($user->roles as $role)
                  <h6>{{ $role->name ? $role->name : '--' }}</h6>
                @endforeach
            @endif

            <hr>

            <a href="mailto:{{ $user->email }}" class="mail"><i class="fa-regular fa-envelope me-2"></i> {{ $user->email }}</a>

            <div class="details-bttn">
              <a href="{{ route('users.show', $user) }}" class="bttn">View Details</a>
            </div>

          </div>
        </div>
      </div>
      <!-- user single box end -->
      @endforeach
    @else
        {{-- no data found component --}}
        {{-- <x-EmptyDataComponent :dynamicData="'No Customer Found!'" />  --}}
        <p>No Customer Found!</p>
        {{-- no data found component --}}
    @endif
  </div>
  <!-- user list end -->

  {{-- paggination wrap --}}
  <div class="row">
    <div class="col-12 paggination-wrap">
      {{ $users->links('pagination::bootstrap-5') }}
    </div>
  </div>
  {{-- paggination wrap --}}


</section>
<!-- main page wrapper end -->
@endsection

{{-- add custmer form start --}}
@section('drawer')
<div class="add-company-modal-from">
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">

    <div class="offcanvas-body">
      <div class="add-new-company-from-wrap">

        <div class="d-flex justify-content-between align-items-center">
          <h3>Add New Customer</h3>
          <button type="button" data-bs-dismiss="offcanvas" aria-label="Close" class="btn bttn-close">
            <i class="fas fa-angle-right"></i>
          </button>
        </div>

        <form action="" method="POST">
          @csrf
          <div class="form-group form-error">
            <label for="name">Name <span>*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name.." value="{{ old('name')}}" name="name"
              id="name">

              <span class="invalid-feedback">
                @error('name'){{ $message }} @enderror
              </span>

          </div>

          <div class="form-group form-error">
            <label for="email">Email Address <span>*</span></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" value="{{ old('email')}}" name="email"
              id="email">

              <span class="invalid-feedback">
                @error('email'){{ $message }} @enderror
              </span>

          </div>

          <div class="form-group form-error">
            <label for="kvk_number">kvk number </label>
            <input type="text" class="form-control @error('kvk_number') is-invalid @enderror" placeholder="Enter kvk number Number" value="{{ old('kvk_number')}}" name="kvk_number" id="kvk_number">

            <span class="invalid-feedback">
                @error('kvk_number'){{ $message }} @enderror
              </span>

          </div>

          <div class="form-submit">
            <button type="reset" class="btn btn-cancel">Cancel</button>
            <button type="submit" class="btn btn-submit">Add</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
{{-- add custmer form end --}}
