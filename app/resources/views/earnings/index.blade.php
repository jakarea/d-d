@extends('layouts.auth')

@section('title','Earning Page')

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper analytics-page-wrapper">
    <div class="row">
        <!-- card item start -->
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
            <div class="analytics-card-box">
                <div class="top">
                    <img src="{{ asset('public/assets/images/icons/anlytic-01.svg') }}" alt="I" class="img-fluid">
                    <img src="{{ asset('public/assets/images/icons/arrow-up-01.svg') }}" alt="I" class="img-fluid">
                </div>

                <h4>€10,540</h4>
                <p>Total Earning</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
            <div class="analytics-card-box">
                <div class="top">
                    <img src="{{ asset('public/assets/images/icons/anlytic-02.svg') }}" alt="I" class="img-fluid">
                    <img src="{{ asset('public/assets/images/icons/arrow-up-02.svg') }}" alt="I" class="img-fluid">
                </div>

                <h4>€1,540</h4>
                <p>Earning Today</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
            <div class="analytics-card-box">
                <div class="top">
                    <img src="{{ asset('public/assets/images/icons/anlytic-03.svg') }}" alt="I" class="img-fluid">
                    <img src="{{ asset('public/assets/images/icons/arrow-up-03.svg') }}" alt="I" class="img-fluid">
                </div>

                <h4>€8,350</h4>
                <p>Total Customer Payment</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
            <div class="analytics-card-box">
                <div class="top">
                    <img src="{{ asset('public/assets/images/icons/anlytic-02.svg') }}" alt="I" class="img-fluid">
                    <img src="{{ asset('public/assets/images/icons/arrow-up-02.svg') }}" alt="I" class="img-fluid">
                </div>

                <h4>€1,240</h4>
                <p>Total Refund</p>
            </div>
        </div>
        <!-- card item end -->
    </div>

    <!-- payment from company user start -->
    <div class="payment-from-copany-user">
        <div class="header">
            <h3>Payment From Company User</h3>
        </div>
        <div class="user-payment-table">

            <table>
                <tr>
                    <th width="3%">No</th>
                    <th class="d-flex justify-content-between">
                        <span>Name</span>
                        <div class="filter-sort-box">
                            <div class="dropdown">
                                <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    id="dropdownBttn">
                                    <img src="{{ asset('public/assets/images/icons/sort-icon.svg') }}" alt="I"
                                        class="img-fluid">
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item filterItem" href="#" data-value="asc">In order
                                            A-Z</a></li>
                                    <li><a class="dropdown-item filterItem" href="#" data-value="desc">In order
                                            Z-A</a></li>
                                </ul>
                            </div>
                        </div>
                    </th>
                    <th>Payment Date</th>
                    <th>Payment Amount</th>
                    <th>Action</th>
                </tr>
                @if (count($earnings) > 0)
                @foreach ($earnings as $earning)
                <!-- payment single item start -->
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        <div class="media">
                            @if ($earning->user->personalInfo && $earning->user->personalInfo->avatar)
                            <img src="{{ $earning->user->personalInfo->avatar }}" alt="A" class="img-fluid">
                            @else
                            <span class="no-avatar nva-sm">{!! strtoupper($earning->user->name[0]) !!}</span>
                            @endif
                            <div class="media-body">
                                <h5><a href="{{ url('company',optional($earning->user)->id) }}">{{ optional($earning->user)->name }}</a></h5>
                                <span>{{ optional($earning->user)->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p>{{ $earning->created_at->format('d F Y') }}
                        </p>
                    </td>
                    <td>
                        <p>€{{ $earning->amount}}</p>
                    </td>
                    <td>
                        <ul>
                            <li>
                                <a href="#" class="btn-view btn-export">Export</a>
                            </li>
                            <li>
                                <a href="{{ url('earning',$earning->id) }}" class="btn-view">View</a>
                            </li>
                        </ul>
                    </td>
                </tr>
                <!-- payment single item end -->
                @endforeach
                @else
                <tr>
                    <td colspan="6" class="text-center">
                        No Payment history found!
                    </td>
                </tr>
                @endif
            </table>
        </div>
    </div>
    <!-- payment from company user end -->
</section>
<!-- main page wrapper end -->
@endsection