@extends('layouts.auth')

@section('title','Admin Profile')

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">

    <!-- page title -->
    <div class="page-title">
        <h1>Admin Profile</h1>
    </div>
    <!-- page title -->

    <!-- customer details start -->
    <div class="row">
        <div class="col-12 col-md-4 col-xl-3">
            <!-- customer about start -->
            <div class="company-about-box">
                 
                @if ($profile->personalInfo && $profile->personalInfo->avatar)
                <img src="{{ $profile->personalInfo->avatar }}" alt="A" class="img-fluid main-avatar" id="avatar-preview">
                @else
                <span class="no-avatar nva-lg">{!! strtoupper($profile->name[0]) !!}</span>
                @endif

                <div class="txt">
                    <h1>{{ $profile->name }}</h1>
                    @if ($profile->roles)
                    @foreach ($profile->roles as $role)
                    <p>{{ $role->name ? $role->name : '--' }}</p>
                    @endforeach
                    @endif
                    <hr>
                    <ul>
                        <li>
                            <p><img src="{{ asset('/public/assets/images/icons/envelope.svg') }}" alt="I"
                                    class="img-fluid">
                                {{ $profile->email }}</p>
                        </li>
                        @if ($profile->personalInfo)
                        <li>
                            <p><img src="{{ asset('/public/assets/images/icons/call.svg') }}" alt="I" class="img-fluid">
                                {{ optional($profile->personalInfo)->phone }}
                            </p>
                        </li>
                        @endif
                        @if ($profile->address)
                        <li>
                            <p><img src="{{ asset('/public/assets/images/icons/global.svg') }}" alt="I"
                                    class="img-fluid">
                                {{ optional($profile->address)->country }}
                            </p>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>
            <!-- customer about end -->
        </div>
        <div class="col-12 col-md-8 col-xl-9">
            <!-- customer info start -->
            <div class="company-edit-from-wrapper">
                <!-- customer personal info start -->
                <div class="form-box">
                    <div class="title">
                        <h3>Personal Info</h3>
                        <a href="{{ route('admin.profile.edit') }}">
                            <img src="{{ asset('/public/assets/images/icons/pen.svg') }}" alt="I" class="img-fluid">
                        </a>
                    </div>

                    <!-- table start -->
                    @if ($profile->personalInfo)
                    <div class="personal-info-table-wrap">
                        <table>
                            <tr>
                                <td>
                                    <p>Full Name</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->personalInfo)->name }}</h6>
                                </td>
                                <td>
                                    <p>Gender</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->personalInfo)->gender }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Designation</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->personalInfo)->designation }} </h6>
                                </td>
                                <td>
                                    <p>Marital Status</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->personalInfo)->maritual_status }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Date of Birth</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->personalInfo)->dob }}</h6>
                                </td>
                                <td>
                                    <p>Phone Number</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->personalInfo)->phone }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Nationality</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->personalInfo)->nationality }}</h6>
                                </td>
                                <td>
                                    <p>Email Address</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->personalInfo)->email }}</h6>
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
                <div class="form-box mt-4">
                    <div class="title">
                        <h3>Address</h3>
                        <a href="{{ route('admin.profile.address.edit') }}">
                            <img src="{{ asset('/public/assets/images/icons/pen.svg') }}" alt="I" class="img-fluid">
                        </a>
                    </div>

                    <!-- table start -->
                    @if ($profile->address)
                    <div class="personal-info-table-wrap">
                        <table>
                            <tr>
                                <td>
                                    <p>Primary addresss</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->address)->primary_address }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Country</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->address)->country }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>State</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->address)->state }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>City</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->address)->city }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Post Code</p>
                                </td>
                                <td>
                                    <h6>{{ optional($profile->address)->post_code }}</h6>
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
    </div>

</section>
<!-- main page wrapper end -->
@endsection