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
                @if ($company->user->personalInfo)
                    @if ($company->user->personalInfo->avatar)
                    <img src="{{ $company->user->personalInfo->avatar }}" alt="A" class="img-fluid main-thumb">
                    @else
                    <img src="{{asset('/public/uploads/users/avatar-01.png') }}" alt="A" class="img-fluid main-thumb">
                    @endif
                @else 
                <img src="{{asset('/public/uploads/users/avatar-01.png') }}" alt="A" class="img-fluid main-thumb">
                @endif
                <div class="txt">
                    <h1>{{ $company->name }}</h1>
                    <p>{{ $company->tagline }}</p>
                    <hr>

                    <ul>
                        @if ($company->email)
                        <li>
                            <p>
                            <img src="{{ asset('public/assets/images/icons/envelope.svg') }}" alt="I" class="img-fluid">
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
                <form action="{{ route('company.update', $company) }}" class="form-box" method="POST">
                    @csrf 
                    @method('PATCH')
                    <div class="title">
                        <h3>Information</h3>
                        {{-- <a href="#">
                            <img src="{{ asset('public/assets/images/icons/plus.svg') }}" alt="I" class="img-fluid">
                        </a> --}}
                    </div>
                    <div class="form-group">
                        <label for="name">Company Name <span>*</span></label>
                        <input type="text" class="form-control" placeholder="Company Name.." value="{{ $company->name }}"
                            name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="tagline">Company Tagline <span>*</span></label>
                        <input type="text" class="form-control" placeholder="Company Tagline.."
                            value="{{ $company->tagline }}" name="tagline" id="tagline">
                    </div>
                    <div class="form-group">
                        <label for="description">About Company <span>*</span></label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Enter description">{{ $company->description }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" class="form-control" placeholder="Company Email"
                                    value="{{ $company->email }}" name="email" id="email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Phone <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Enter phone number"
                                    value="{{ $company->phone }}" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="country">Country <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Enter country name" value="{{ $company->country }}"
                                    name="country" id="country">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="location">Location <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Location.." value="{{ $company->location }}"
                                    name="location" id="location">
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
