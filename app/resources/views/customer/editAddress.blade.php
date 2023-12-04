@extends('layouts.auth')

@section('title','Customer Address Update Page')

@section('content')
<section class="main-page-wrapper marketplace-page-wrapper">
  <!-- page title -->
  <div class="page-title">
    <h1>Customer Address Update</h1>
  </div>
  <!-- page title -->

  <!-- customer details start -->
  <div class="row">
    <div class="col-12 col-md-4 col-xl-3">
      <!-- customer about start -->
      <div class="company-about-box">

        <div class="avatar-wrap">
          <img src="{{ asset('/public/assets/images/user-bi.png') }}" alt="U" class="img-fluid">
          <div class="ol">
            <img src="{{ asset('assets/images/icons/photo.png') }}" alt="U" class="img-fluid logo-photo">
            <span>Update Photo</span>
          </div>
        </div>


        <div class="txt">
          <h1>Pristia Candra</h1>
          <p>3D Designer</p>

          <hr>

          <ul>
            <li>
              <p><img src="{{ asset('/public/assets/images/icons/envelope.svg') }}" alt="I" class="img-fluid">
                cassandre66@gmail.com</p>
            </li>
            <li>
              <p><img src="{{ asset('/public/assets/images/icons/call.svg') }}" alt="I" class="img-fluid"> 911-415-0350</p>
            </li>
            <li>
              <p><img src="{{ asset('/public/assets/images/icons/global.svg') }}" alt="I" class="img-fluid"> Bangladesh</p>
            </li>
          </ul>
        </div>
      </div>
      <!-- customer about end -->
    </div>
    <!--pesonal info start-->
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
              <tbody>
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
              </tbody>
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
              <img src="./public/assets/images/icons/pen.svg" alt="I" class="img-fluid">
            </a>
          </div>
          <div class="form-group">
            <label for="name">Primary Address<span>*</span></label>
            <input type="text" class="form-control" placeholder="Pristia Candra Nelson" value="" name="name" id="name">
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="text">Country<span>*</span></label>
                <input type="text" class="form-control" placeholder="Enter Your Country" value="" name="text" id="text">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="text">City<span>*</span></label>
                <select name="" id="" class="form-control">
                  <option value="">Downers Grove</option>
                  <option value="">Boston</option>
                </select>
                <div class="fields-icons">
                  <i class="fas fa-angle-down"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="text">State<span>*</span></label>
                <input type="text" class="form-control" placeholder="Enter Your State" value="" name="state" id="state">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="number">Post Code<span>*</span></label>
                <select name="" id="" class="form-control">
                  <option value="">78959</option>
                  <option value="">32564</option>
                </select>
                <div class="fields-icons">
                  <i class="fas fa-angle-down"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="form-submit">
            <button type="submit" class="btn btn-submit">Save Changes</button>
          </div>
        </div>
        <!-- customer address info end -->
      </div>
      <!-- customer info end -->
    </div>
  </div>
  {{-- customer details end --}}
</section>
@endsection
