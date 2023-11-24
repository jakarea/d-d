@extends('layouts.auth')
@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
    <!-- page title -->
    <div class="page-title">
        <h1>Dashboard</h1>
    </div>
    <!-- page title -->
</section>
<!-- main page wrapper end -->
@endsection

@section('drawer')

 <!-- add comapny modal form start -->
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
                            <input type="text" class="form-control" placeholder="Company Name.." value="{{ old('company_name')}}" name="company_name" id="name">
                            @error('company_name') <span>{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="tagline">Company Tagline <span>*</span></label>
                            <input type="text" class="form-control" placeholder="Company Tagline.." value="{{ old('tagline')}}" name="tagline" id="tagline">
                            @error('tagline') <span>{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address <span>*</span></label>
                            <input type="email" class="form-control" placeholder="Company Email" value="{{ old('email')}}" name="email" id="email">
                            @error('email') <span>{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone <span>*</span></label>
                            <input type="text" class="form-control" placeholder="Company Phone Number" value="{{ old('phone')}}" name="phone" id="phone">
                            @error('phone') <span>{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="location">Location <span>*</span></label>
                            <input type="text" class="form-control" placeholder="Company Location" value="{{ old('location')}}" name="location" id="location">
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
    <!-- add comapny modal form end -->
    @endsection