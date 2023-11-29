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
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{asset('/uploads/users/avatar-01.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Claude Mitchell</h4>
                    <h6>Finance Manager</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Dannie.King57@yahoo.com</a>

                    <div class="details-bttn">
                        <a href="{{ route('company.show', ['company' => 1]) }}" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{ asset('uploads/users/avatar-02.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Mrs. Ronald Nolan</h4>
                    <h6>Administrator</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Dianna74@yahoo.com</a>

                    <div class="details-bttn">
                        <a href="#" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{ asset('uploads/users/avatar-03.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Celia Walter</h4>
                    <h6>Representative</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Twila_Hansen@yahoo.com</a>

                    <div class="details-bttn">
                        <a href="#" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{ asset('uploads/users/avatar-04.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Tami Upton</h4>
                    <h6>Associate</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Guiseppe_Borer@gmail.com</a>

                    <div class="details-bttn">
                        <a href="#" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{ asset('uploads/users/avatar-05.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Ruben Senger</h4>
                    <h6>Officer</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Christiana98@gmail.com</a>

                    <div class="details-bttn">
                        <a href="#" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{ asset('uploads/users/avatar-06.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Ralph Hayes</h4>
                    <h6>Producer</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Brody.Hartmann@hotmail.com</a>

                    <div class="details-bttn">
                        <a href="#" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{ asset('uploads/users/avatar-07.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Rosa Ullrich</h4>
                    <h6>Supervisor</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Desiree_Kirlin@yahoo.com</a>

                    <div class="details-bttn">
                        <a href="#" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{ asset('uploads/users/avatar-08.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Kristopher Mills</h4>
                    <h6>Strategist</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Tracy.Kutch@yahoo.com</a>

                    <div class="details-bttn">
                        <a href="#" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{ asset('uploads/users/avatar-09.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Brendan Hoppe</h4>
                    <h6>Designer</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Shemar58@gmail.com</a>

                    <div class="details-bttn">
                        <a href="#" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{ asset('uploads/users/avatar-10.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Lee Greenfelder III</h4>
                    <h6>Executive</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Garland67@yahoo.com</a>

                    <div class="details-bttn">
                        <a href="#" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{ asset('uploads/users/avatar-05.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Christopher Upton</h4>
                    <h6>Executive</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Lennie21@gmail.com</a>

                    <div class="details-bttn">
                        <a href="#" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-6 col-xl-4 col-xxl-3 mb-15">
            <div class="company-profile-box">
                <!-- avatar -->
                <div class="avatar">
                    <img src="{{ asset('uploads/users/avatar-07.png') }}" alt="A" class="img-fluid">
                </div>
                <!-- avatar -->

                <div class="txt">
                    <h4>Hope Kemmer</h4>
                    <h6>Strategist</h6>

                    <hr>

                    <a href="#" class="mail"><i class="fa-regular fa-envelope me-2"></i> Sim_Maggio@yahoo.com</a>

                    <div class="details-bttn">
                        <a href="#" class="bttn">View Details</a>
                    </div>

                </div>
            </div>
        </div>
        <!-- company single box end -->
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