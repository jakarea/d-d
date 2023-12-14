@extends('layouts.auth')

@section('title','Payment Details')

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
    <!-- page title -->
    <div class="page-title">
        <h1>Payment Details</h1>
    </div>
    <!-- page title -->

    <!-- customer details start -->
    <div class="row">
        <div class="col-12 col-md-4 col-xl-3">
            <!-- customer about start -->
            <div class="company-about-box">
                <img src="{{ asset('public/assets/images/user-bi.png') }}" alt="U" class="img-fluid main-avatar">
                <div class="txt">
                    <h1>Lela Mraz</h1>
                    <p>lincoln@unpixel.com</p>

                    <hr>

                    <ul>
                        <li>
                            <p><img src="{{ asset('public/assets/images/icons/envelope.svg') }}" alt="I"
                                    class="img-fluid">zcassandre66@gmail.com</p>
                        </li>
                        <li>
                            <p><img src="{{ asset('public/assets/images/icons/call.svg') }}" alt="I" class="img-fluid">911-415-0350</p>
                        </li>
                        <li>
                            <p><img src="{{ asset('public/assets/images/icons/global.svg') }}" alt="I" class="img-fluid">Indonesia</p>
                        </li>
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
                        <h3>Details</h3>
                    </div>

                    <!-- table start -->
                    <div class="personal-info-table-wrap">
                        <table>
                            <tr>
                                <td width="20%">
                                    <p>Payment Date</p>
                                </td>
                                <td>
                                    <h6>Apr 21, 2024</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Payment Amount</p>
                                </td>
                                <td>
                                    <h6>€390</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Subscription Package</p>
                                </td>
                                <td>
                                    <h6>Standard</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Last Payment</p>
                                </td>
                                <td>
                                    <h6>25 days ago</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Access Remaining</p>
                                </td>
                                <td>
                                    <h6>5 days</h6>
                                </td>
                            </tr>
                        </table>
                        <div class="form-submit">
                            <button class="btn btn-download" type="submit">
                                <img src="{{ asset('public/assets/images/download.png') }}" class="im-fluid" alt="I"> Download Invoice
                            </button>
                        </div>
                    </div>
                    <!-- table end -->
                </div>
                <!-- customer personal info end -->
            </div>
            <!-- customer info end -->
        </div>
    </div>
    {{-- company details end --}}
</section>
<!-- main page wrapper end -->
@endsection
