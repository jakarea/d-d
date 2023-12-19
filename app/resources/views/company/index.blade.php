@extends('layouts.auth')

@section('title','Company List Page')

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
    <!-- page title -->
    <div class="page-title">
        <h1>Companies</h1>

        <!-- bttn -->
        <div class="page-bttn">
            <a href="#" class="bttn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add Company</a>
        </div>
        <!-- bttn -->
    </div>
    <!-- page title -->

    <!-- company list start -->
    <div class="row">
        @if (count($companies) > 0)
            @foreach ($companies as $company)
            <!-- company single box start -->
            <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
                <div class="company-profile-box">
                    <!-- avatar -->
                    <div class="avatar">
                        @if ($company->user->personalInfo && $company->user->personalInfo->avatar)
                        <img src="{{ $company->user->personalInfo->avatar }}" alt="A" class="img-fluid">
                        @else
                        <span class="no-avatar nva-sm">{!! strtoupper($company->user->name[0]) !!}</span>
                        @endif
                    </div>
                    <!-- avatar -->

                    <div class="txt">
                        <h4>{{ $company->name }}</h4>
                        <h6>{{ $company->tagline ? $company->tagline : '--' }}</h6>
                        <hr>
                        <a href="mailto:{{ $company->email }}" class="mail"><i class="fa-regular fa-envelope me-2"></i> {{ $company->email }}</a>

                        <div class="details-bttn">
                            <a href="{{ route('company.show', $company) }}" class="bttn">View Details </a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- company single box end -->
            @endforeach
        @else
        {{-- no data found component --}}
        {{-- <x-EmptyDataComponent :dynamicData="'No Company Found!'" />  --}}
        <p>No Company Found!</p>
        {{-- no data found component --}}
    @endif
    </div>
    <!-- company list end -->

     {{-- paggination wrap --}}
  <div class="row">
    <div class="col-12 paggination-wrap">
      {{ $companies->links('pagination::bootstrap-5') }}
    </div>
  </div>
  {{-- paggination wrap --}}

</section>
<!-- main page wrapper end -->
@endsection

{{-- add company modal start --}}
@section('drawer')
<div class="add-company-modal-from">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">

        <div class="offcanvas-body">
            <div class="add-new-company-from-wrap">

                <div class="d-flex justify-content-between align-items-center">
                    <h3>Add New Company</h3>
                    <button type="button" data-bs-dismiss="offcanvas" aria-label="Close" class="btn bttn-close">
                        <i class="fas fa-angle-right"></i>
                    </button>
                </div>

                <form action="" method="POST">
                    @csrf
                    <div class="form-group form-error">
                        <label for="name">Company Name <span>*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Company Name.."
                            value="{{ old('name')}}" name="name" id="name">

                       <span class="invalid-feedback">
                            @error('name'){{ $message }} @enderror
                        </span>
                    </div>

                    <div class="form-group form-error">
                        <label for="tagline">Company Tagline <span>*</span></label>
                        <input type="text" class="form-control @error('tagline') is-invalid @enderror" placeholder="Company Tagline.."
                            value="{{ old('tagline')}}" name="tagline" id="tagline">
                            <span class="invalid-feedback">
                                @error('tagline'){{ $message }} @enderror
                              </span>
                    </div>

                    <div class="form-group form-error">
                        <label for="email">Email Address <span>*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Company Email" value="{{ old('email')}}"
                            name="email" id="email">
                            <span class="invalid-feedback">
                                @error('email'){{ $message }} @enderror
                              </span>
                    </div>

                    <div class="form-group form-error">
                        <label for="phone">Phone <span>*</span></label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Company Phone Number"
                            value="{{ old('phone')}}" name="phone" id="phone">
                            <span class="invalid-feedback">
                                @error('phone'){{ $message }} @enderror
                              </span>
                    </div>

                    <div class="form-group form-error">
                        <label for="location">Location <span>*</span></label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" placeholder="Company Location"
                            value="{{ old('location')}}" name="location" id="location">
                            <span class="invalid-feedback">
                                @error('location'){{ $message }} @enderror
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
{{-- add company modal end --}}
@endsection

@section('script')
<script>
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            // Handle the Enter key press
            console.log('Enter key pressed!');
        }
    });
</script>
@endsection
