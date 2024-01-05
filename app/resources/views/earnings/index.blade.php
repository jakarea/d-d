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
                    <img src="{{ asset('public/assets/images/icons/arrow-up-01.svg') }}" alt="I"
                        class="img-fluid {{ $totalEarnings < 1 ? 'down-arrw' : ''}}">
                </div>

                <h4>€{{ number_format($totalEarnings) }}</h4>
                <p>Total Earning</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
            <div class="analytics-card-box">
                <div class="top">
                    <img src="{{ asset('public/assets/images/icons/anlytic-02.svg') }}" alt="I" class="img-fluid">
                    <img src="{{ asset('public/assets/images/icons/arrow-up-02.svg') }}" alt="I"
                        class="img-fluid {{ $todayEarnings < 1 ? 'down-arrw' : ''}}">
                </div>

                <h4>€{{ number_format($todayEarnings) }}</h4>
                <p>Earning Today</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
            <div class="analytics-card-box">
                <div class="top">
                    <img src="{{ asset('public/assets/images/icons/anlytic-03.svg') }}" alt="I" class="img-fluid">
                    <img src="{{ asset('public/assets/images/icons/arrow-up-03.svg') }}" alt="I"
                        class="img-fluid {{ $totalCurrentPayment < 1 ? 'down-arrw' : ''}}">
                </div>

                <h4>€{{ number_format($totalCurrentPayment) }}</h4>
                <p>Total Customer Payment</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
            <div class="analytics-card-box">
                <div class="top">
                    <img src="{{ asset('public/assets/images/icons/anlytic-02.svg') }}" alt="I" class="img-fluid">
                    <img src="{{ asset('public/assets/images/icons/arrow-up-02.svg') }}" alt="I" class="img-fluid">
                </div>

                <h4>€0</h4>
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
            {{-- filter form --}}
            <form action="" method="GET" id="myForm">
                <input type="hidden" name="status" id="inputField">
            </form>
            {{-- filter form --}}
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
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
                @if (count($earnings) > 0)
                @foreach ($earnings as $key => $earning)
                <!-- payment single item start -->
                <tr>
                    <td>
                        {{ $key + 1 }}
                    </td>
                    <td>
                        <div class="media">
                            @if ($earning->user)
                            @if ($earning->user->personalInfo)
                            <img src="{{ $earning->user->personalInfo->avatar }}" alt="A" class="img-fluid">
                            @else
                            <span class="no-avatar nva-sm">{!! strtoupper($earning->user->name[0]) !!}</span>
                            @endif
                            @endif

                            @php
                            $company = \App\Models\Company::where('user_id',$earning->user->id)->first();
                            @endphp

                            <div class="media-body">
                                <h5>
                                    @if ($company)
                                    <a href="{{ url('company',$company->id ) }}">{{ optional($earning->user)->name
                                        }}</a>
                                    @else
                                    <a href="{{ url('users', optional($earning->user)->id ) }}">{{
                                        optional($earning->user)->name }}</a>
                                    @endif

                                </h5>
                                <span>{{ optional($earning->user)->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p>{{ \Carbon\Carbon::parse($earning->start_at)->format('d F Y') }}

                        </p>
                    </td>
                    <td>
                        <p>€{{ $earning->amount}}</p>
                    </td>
                    <td class="text-uppercase">
                        @if ($earning->status == 'paid')
                        <span class="status paid">
                            {{ $earning->status }}
                        </span>
                        @elseif ($earning->status == 'expired')
                        <span class="status expired">
                            {{ $earning->status }}
                        </span>
                        @else
                        <span class="status">
                            {{ $earning->status }}
                        </span>
                        @endif

                    </td>
                    <td>
                        <ul>
                            @if ($earning->status != 'Pending')
                            <li>
                                <a href="{{ url('earning/generate-pdf',encrypt($earning->payment_id)) }}"
                                    class="btn-view btn-export">Export</a>
                            </li>
                            <li>
                                <a href="{{ url('earning',$earning->id) }}" class="btn-view">View</a>
                            </li>
                            @else
                            <li>
                                <a href="javascript:void(0)" class="btn-view btn-export"
                                    style="opacity: .5;cursor: not-allowed;">Export</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="btn-view"
                                    style="opacity: .5; cursor: not-allowed;">View</a>
                            </li>
                            @endif
                            <li>
                        </ul>
                    </td>
                </tr>

                @endforeach
                @else
                <tr>
                    <td colspan="6" class="text-center">
                        {{-- no data found component --}}
                        <x-EmptyDataComponent :dynamicData="'No Payment history found!'" />
                        {{-- no data found component --}}
                    </td>
                </tr>
                @endif
            </table>
        </div>
        {{-- paggination wrap --}}
        <div class="row">
            <div class="col-12 paggination-wrap mt-3">
                {{ $earnings->links('pagination::bootstrap-5') }}
            </div>
        </div>
        {{-- paggination wrap --}}
    </div>
    <!-- payment from company user end -->
</section>
<!-- main page wrapper end -->
@endsection


{{-- page script @S --}}
@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
            let inputField = document.getElementById("inputField");
            let form = document.getElementById("myForm");
            let dropdownItems = document.querySelectorAll(".filterItem");

            dropdownItems.forEach(item => {
                item.addEventListener("click", function(e) {
                    e.preventDefault();
                    inputField.value = this.getAttribute("data-value");
                    form.submit();
                });
            });
        });
</script>
@endsection
{{-- page script @E --}}