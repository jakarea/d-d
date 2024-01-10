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
                @if ($earning->user)
                    @if ($earning->user->personalInfo)
                    <img src="{{ $earning->user->personalInfo->avatar }}" alt="A" class="img-fluid main-avatar">
                    @else
                    <span class="no-avatar nva-lg">{!! strtoupper($earning->user->name[0]) !!}</span>
                    @endif
                @endif
                <div class="txt">
                    <h1><a href="{{ url('company',optional($earning->user)->id) }}">{{ optional($earning->user)->name }}</a></h1>
                    <p>{{ optional($earning->user)->email }}</p>
                    <hr>
                    <ul>
                        <li>
                            <p><img src="{{ asset('public/assets/images/icons/envelope.svg') }}" alt="I"
                                    class="img-fluid">{{ optional($earning->user)->email }}</p>
                        </li>
                        @if ($earning->user && $earning->user->personalInfo)
                            <li>
                                <p><img src="{{ asset('public/assets/images/icons/call.svg') }}" alt="I" class="img-fluid">
                                    {{ optional($earning->user)->personalInfo->phone }}
                                </p>
                            </li>
                        @endif
                        @if ($earning->user && $earning->user->personalInfo)
                            <li>
                                <p><img src="{{ asset('public/assets/images/icons/global.svg') }}" alt="I" class="img-fluid">
                                    {{ optional($earning->user)->personalInfo->nationality }}
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
                                    <h6>{{ \Carbon\Carbon::parse($earning->start_at)->format('d F Y') }}
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Payment Amount</p>
                                </td>
                                <td>
                                    <h6>€{{ $earning->amount}}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Subscription Package</p>
                                </td>
                                <td>
                                    <h6>{{ $earning->package_type}}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Subscription End Date</p>
                                </td>
                                <td>
                                    <h6>{{ \Carbon\Carbon::parse($earning->end_at)->format('d F Y') }}
                                    </h6>
                                </td>
                            </tr>
                            @php
                                $startAt = \Carbon\Carbon::parse($earning->start_at);
                                $endAt = \Carbon\Carbon::parse($earning->end_at);
                                $totalDays = $startAt->diffInDays($endAt);
                            @endphp 

                            <tr>
                                <td>
                                    <p>Access Remaining</p>
                                </td>
                                <td>
                                    <h6>{{ $totalDays }} {{ $totalDays > 1 ? 'Days' : 'Day' }}</h6>
                                </td>
                            </tr>
                        </table>
                        <div class="form-submit">
                            @if ($earning->status != 'pending')
                            <a class="btn btn-download" style="display: inline-flex!important" href="{{ url('earning/generate-pdf',encrypt($earning->payment_id)) }}">
                                <img src="{{ asset('public/assets/images/download.png') }}" class="img-fluid" alt="I"> Download Invoice
                            </a>
                            @endif
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
