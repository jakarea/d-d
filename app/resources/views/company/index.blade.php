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
        @foreach ($companies as $company)
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    {{-- @if ($company->user)
                    <img src="{{ $company->user->avatar }}" alt="A" class="img-fluid">
                    @else --}}
                    <img src="{{asset('/public/uploads/users/avatar-01.png') }}" alt="A" class="img-fluid">
                    {{-- @endif --}}
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>{{ $company->name }}</h4>
                    <h6>{{ $company->tagline }}</h6>

                    <hr>

                    <a href="mailto:{{ $company->email }}" class="mail"><i class="fa-regular fa-envelope me-2"></i> {{
                        $company->email }}</a>

                    <div class="details-bttn">
                        <a href="{{ route('company.show', $company) }}" class="bttn">View Details </a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        @endforeach
    </div>
    <!-- company list end -->
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
                    <div class="form-group">
                        <label for="name">Company Name <span>*</span></label>
                        <input type="text" class="form-control" placeholder="Company Name.."
                            value="{{ old('company_name')}}" name="company_name" id="name">
                        @error('company_name') <span>{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="tagline">Company Tagline <span>*</span></label>
                        <input type="text" class="form-control" placeholder="Company Tagline.."
                            value="{{ old('tagline')}}" name="tagline" id="tagline">
                        @error('tagline') <span>{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address <span>*</span></label>
                        <input type="email" class="form-control" placeholder="Company Email" value="{{ old('email')}}"
                            name="email" id="email">
                        @error('email') <span>{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone <span>*</span></label>
                        <input type="text" class="form-control" placeholder="Company Phone Number"
                            value="{{ old('phone')}}" name="phone" id="phone">
                        @error('phone') <span>{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="location">Location <span>*</span></label>
                        <input type="text" class="form-control" placeholder="Company Location"
                            value="{{ old('location')}}" name="location" id="location">
                        @error('location') <span>{{ $message }}</span> @enderror
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
