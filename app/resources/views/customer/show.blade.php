@extends('layouts.auth')

@section('title','Customer Details Page')

@section('content')

<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
  <!-- page title -->
  <div class="page-title">
    <h1>Customer Details</h1>
  </div>
  <!-- page title -->

  <!-- customer details start -->
  <div class="row">
    <div class="col-12 col-md-4 col-xl-3">
      <!-- customer about start -->
      <div class="company-about-box">
        @if ($user->personalInfo && $user->personalInfo->avatar)
          <img src="{{ $user->personalInfo->avatar ? $user->personalInfo->avatar : '' }}" alt="A" class="img-fluid main-avatar">
          @else 
          <span class="no-avatar nva-lg">{!! strtoupper($user->name[0]) !!}</span>
          @endif 

        <div class="txt">
          <h1>{{ $user->name }}</h1>
          @if ($user->roles)
          @foreach ($user->roles as $role)
          <p>{{ $role->name ? $role->name : '--' }}</p>
          @endforeach
          @endif
          <hr>
          <ul>
            <li>
              <p><img src="{{ asset('/public/assets/images/icons/envelope.svg') }}" alt="I" class="img-fluid">
                {{ $user->email }}</p>
            </li>
            @if ($user->personalInfo)
            <li>
              <p><img src="{{ asset('/public/assets/images/icons/call.svg') }}" alt="I" class="img-fluid">
                {{ optional($user->personalInfo)->phone }} 
              </p>
            </li>
            @endif
            @if ($user->address)  
            <li>
              <p><img src="{{ asset('/public/assets/images/icons/global.svg') }}" alt="I" class="img-fluid">
                {{ optional($user->address)->country }} 
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
            <a href="{{ route('users.edit', $user) }}">
              <img src="{{ asset('/public/assets/images/icons/pen.svg') }}" alt="I" class="img-fluid">
            </a>
          </div>
 
          <!-- table start -->
          @if ($user->personalInfo)
          <div class="personal-info-table-wrap">
            <table>
              <tr>
                <td>
                  <p>Full Name</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->name }}</h6>
                </td>
                <td>
                  <p>Gender</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->gender }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Designation</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->designation }} </h6>
                </td>
                <td>
                  <p>Marital Status</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->maritual_status }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Date of Birth</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->dob }}</h6>
                </td>
                <td>
                  <p>Phone Number</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->phone }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Nationality</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->nationality }}</h6>
                </td>
                <td>
                  <p>Email Address</p>
                </td>
                <td>
                  <h6>{{ optional($user->personalInfo)->email }}</h6>
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
            <a href="{{ route('users.editAddress', $user->id) }}">
              <img src="{{ asset('/public/assets/images/icons/pen.svg') }}" alt="I" class="img-fluid">
            </a>
          </div>

          <!-- table start -->
          @if ($user->address)
          <div class="personal-info-table-wrap">
            <table>
              <tr>
                <td>
                  <p>Primary addresss</p>
                </td>
                <td>
                  <h6>{{ optional($user->address)->primary_address }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Country</p>
                </td>
                <td>
                  <h6>{{ optional($user->address)->country }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>State</p>
                </td>
                <td>
                  <h6>{{ optional($user->address)->state }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>City</p>
                </td>
                <td>
                  <h6>{{ optional($user->address)->city }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Post Code</p>
                </td>
                <td>
                  <h6>{{ optional($user->address)->post_code }}</h6>
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
    <div class="col-12">
      <!-- reviews box -->
      @if (count($user->reviews) > 0)
      <div class="company-reviews customer-reviews-box">
        <h3>Reviews</h3>
        <!-- review list start -->
        <div class="review-list">
          @foreach ($user->reviews as $review)
          <!-- review single item start -->
          <div class="review-single-item">
              <div class="header">
                  <div class="media">
                    @php 
                      $jsonString = $review->product->images;
                      $imageLinks = json_decode($jsonString);
                      $firstImageLink = "";
                      if ($imageLinks !== null && is_array($imageLinks) && count($imageLinks) > 0) {
                        $firstImageLink = $imageLinks[0];
                      }
                    @endphp
                      <img src="{{ $firstImageLink }}" alt="Product Image" class="img-fluid">
                      <div class="media-body">
                          <h5>{{ $review->product->title }}</h5>
                          <span>{{ $review->created_at->diffForHumans() }} </span>
                      </div>
                  </div>
      
                  <ul class="star-rating">
                      @for ($i = 1; $i <= 5; $i++)
                          @if ($i <= $review->rating)
                              <li><i class="fas fa-star"></i></li>
                          @else
                              <li><i class="far fa-star"></i></li>
                          @endif
                      @endfor
                  </ul>
              </div>
              <p>{{ $review->review }}</p>
          </div>
          <!-- review single item end -->
          @endforeach
        </div>
        <!-- review list end -->
      </div> 
      @endif
      <!-- reviews box -->
    </div>
  </div>
  <!-- customer edit end -->
</section>
@endsection