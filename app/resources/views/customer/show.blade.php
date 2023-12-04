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
        <img src="{{ asset('/public/assets/images/user-bi.png') }}" alt="U" class="img-fluid main-avatar">
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
                cassandre66@gmail.com</p>
            </li>
            <li>

            </li>
            <li>
              <p><img src="{{ asset('/public/assets/images/icons/global.svg') }}" alt="I" class="img-fluid"> Bangladesh</p>
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
            <h3>Personal Info</h3>
            <a href="#">
              <img src="{{ asset('/public/assets/images/icons/pen.svg') }}" alt="I" class="img-fluid">
            </a>
          </div>

          <!-- table start -->
          <div class="personal-info-table-wrap">
            <table>
              <tr>
                <td>
                  <p>Full Name</p>
                </td>
                <td>
                  <h6>Pristia Candra Nelson</h6>
                </td>
                <td>
                  <p>Gender</p>
                </td>
                <td>
                  <h6>Female</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Designation</p>
                </td>
                <td>
                  <h6>3D Designer</h6>
                </td>
                <td>
                  <p>Marital Status</p>
                </td>
                <td>
                  <h6>Unmarried</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Date of Birth</p>
                </td>
                <td>
                  <h6>21 Oct 1995</h6>
                </td>
                <td>
                  <p>Phone Number</p>
                </td>
                <td>
                  <h6>911-415-0350</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Nationality</p>
                </td>
                <td>
                  <h6>Indonesia</h6>
                </td>
                <td>
                  <p>Email Address</p>
                </td>
                <td>
                  <h6>cassandre66@gmail.com</h6>
                </td>
              </tr>
            </table>
          </div>
          <!-- table end -->
        </div>
        <!-- customer personal info end -->
        <!-- customer address info start -->
        <div class="form-box mt-4">
          <div class="title">
            <h3>Address</h3>
            <a href="#">
              <img src="{{ asset('/public/assets/images/icons/pen.svg') }}" alt="I" class="img-fluid">
            </a>
          </div>

          <!-- table start -->
          <div class="personal-info-table-wrap">
            <table>
              <tr>
                <td>
                  <p>Primary addresss</p>
                </td>
                <td>
                  <h6>Banyumanik Street, Central Java. Semarang Indonesia</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Country</p>
                </td>
                <td>
                  <h6>Indonesia</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>State</p>
                </td>
                <td>
                  <h6>Central Java</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>City</p>
                </td>
                <td>
                  <h6>Semarang</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Post Code</p>
                </td>
                <td>
                  <h6>03125</h6>
                </td>
              </tr>
            </table>
          </div>
          <!-- table end -->
        </div>
        <!-- customer address info end -->
      </div>
      <!-- customer info end -->
    </div>
    <div class="col-12">
      <!-- reviews box -->
      <div class="company-reviews customer-reviews-box">
        <h3>Reviews</h3>

        <!-- review list start -->
        <div class="review-list">
          @foreach ($user->reviews as $review)
          <!-- review single item start -->
          <div class="review-single-item">
            <div class="header">
              <div class="media">
                <img src="{{ asset('/public/assets/images/user.png') }}" alt="U" class="img-fluid">
                <div class="media-body">
                  <h5>Product Name</h5>
                  <span>{{ $review->created_at->diffForHumans() }} </span>
                </div>
              </div>
              <ul>
                <li><i class="fas fa-star"></i></li>
                <li><i class="fas fa-star"></i></li>
                <li><i class="fas fa-star"></i></li>
                <li><i class="fas fa-star"></i></li>
                <li><i class="fa-regular fa-star"></i></li>
              </ul>
            </div>
            <p>{{ $review->review }}</p>
          </div>
          <!-- review single item end --> 
          @endforeach
        </div>
        <!-- review list end -->
      </div>
      <!-- reviews box -->
    </div>
  </div>
  <!-- customer edit end -->
</section>
@endsection
