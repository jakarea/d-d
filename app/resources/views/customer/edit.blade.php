@extends('layouts.auth')
@section('content')
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

            <div class="avatar-wrap">
              <img src="{{ asset('/assets/images/user-bi.png') }}" alt="U" class="img-fluid">
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
                  <p><img src="{{ asset('/assets/images/icons/envelope.svg') }}" alt="I" class="img-fluid"> cassandre66@gmail.com</p>
                </li>
                <li>
                  <p><img src="{{ asset('/assets/images/icons/call.svg') }}" alt="I" class="img-fluid"> 911-415-0350</p>
                </li>
                <li>
                  <p><img src="{{ asset('/assets/images/icons/global.svg') }}" alt="I" class="img-fluid"> Bangladesh</p>
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
            <form action="" class="form-box">
              <div class="title">
                <h3>Personal Info</h3>
                <a href="#">
                  <img src="{{ asset('/assets/images/icons/pen.svg') }}" alt="I" class="img-fluid">
                </a>
              </div>
              <div class="form-group">
                <label for="name">Full Name <span>*</span></label>
                <input type="text" class="form-control" placeholder="Pristia Candra Nelson" value="THE ROYAL COMPANY" name="name" id="name">
              </div>
              <div class="form-group">
                <label for="tagline">Designation<span>*</span></label>
                <input type="text" class="form-control" placeholder="Input here" value="Empowering Innovation, Enriching Lives" name="tagline" id="tagline">
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="date">Date of Birtht<span>*</span></label>
                    <input type="date" class="form-control" placeholder="Input here" value="" name="date" id="date">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="text">Gender <span>*</span></label>
                    <select name="" id="" class="form-control">
                      <option value="">Male</option>
                      <option value="">Female</option>
                    </select>
                    <div class="fields-icons">
                      <i class="fas fa-angle-down"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="email">Email Address <span>*</span></label>
                    <input type="email" class="form-control" placeholder="Enter email" value="" name="email" id="email">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="number">Phone Number<span>*</span></label>
                    <input type="number" class="form-control" placeholder="Enter phone number" value="Phone Number" name="number" id="number">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="country">Nationality <span>*</span></label>
                    <select name="" id="" class="form-control">
                      <option value="">Bangladesh</option>
                      <option value="">Indonesia</option>
                    </select>
                    <div class="fields-icons">
                      <i class="fas fa-angle-down"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="marital-text">Marital Status<span>*</span></label>
                    <input type="text" class="form-control" placeholder="Input here status" value="" name="marital-text" id="marital-text">
                  </div>
                </div>
              </div>
              <div class="form-submit">
                <button type="submit" class="btn btn-submit">Save Changes</button>
              </div>
            </form>
            <!-- customer personal info end -->
            <!-- customer address info start -->
            <div class="form-box mt-4">
              <div class="title">
                <h3>Address</h3>
                <a href="#">
                  <img src="{{ asset('/assets/images/icons/pen.svg') }}" alt="I" class="img-fluid">
                </a>
              </div>               
              <!-- table start -->
              <div class="personal-info-table-wrap">
                  <table>
                    <tbody><tr>
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
                  </tbody></table>
              </div>
              <!-- table end -->
            </div>
            <!-- customer address info end -->
          </div>
          <!-- customer info end -->
         </div>
        <!--personal info end-->
        </div>
    </section>
@endsection