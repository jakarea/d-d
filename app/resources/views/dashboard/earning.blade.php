@extends('layouts/auth')
@section('content')
     <!-- main page wrapper start -->
     <section class="main-page-wrapper analytics-page-wrapper">
      <div class="row">
        <!-- card item start -->
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
          <div class="analytics-card-box">
            <div class="top">
              <img src="./assets/images/icons/anlytic-01.svg" alt="I" class="img-fluid">
              <img src="./assets/images/icons/arrow-up-01.svg" alt="I" class="img-fluid">
            </div>

            <h4>$10,540</h4>
            <p>Total Earning</p>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
          <div class="analytics-card-box">
            <div class="top">
              <img src="./assets/images/icons/anlytic-02.svg" alt="I" class="img-fluid">
              <img src="./assets/images/icons/arrow-up-02.svg" alt="I" class="img-fluid">
            </div>

            <h4>$1,540</h4>
            <p>Earning Today</p>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
          <div class="analytics-card-box">
            <div class="top">
              <img src="./assets/images/icons/anlytic-03.svg" alt="I" class="img-fluid">
              <img src="./assets/images/icons/arrow-up-03.svg" alt="I" class="img-fluid">
            </div>

            <h4>$8,350</h4>
            <p>Total Customer Payment</p>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-15">
          <div class="analytics-card-box">
            <div class="top">
              <img src="./assets/images/icons/anlytic-02.svg" alt="I" class="img-fluid">
              <img src="./assets/images/icons/arrow-up-02.svg" alt="I" class="img-fluid">
            </div>

            <h4>$1,240</h4>
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
            <tbody><tr>
              <th width="3%">No</th>
              <th class="d-flex justify-content-between">
                <span>Name</span>
                <div class="filter-sort-box">
                  <div class="dropdown">
                    <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownBttn">
                      <img src="./assets/images/icons/sort-icon.svg" alt="I" class="img-fluid">
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
            <!-- payment single item start -->
            <tr>
              <td>
                1
              </td>
              <td>
                <div class="media">
                  <img src="./uploads/users/avatar-01.png" alt="A" class="img-fluid">
                  <div class="media-body">
                    <h5>Lela Mraz</h5>
                    <span>zlincoln@unpixel.com</span>
                  </div>
                </div>
              </td>
              <td>
                <p>09 Oct, 2023</p>
              </td>
              <td>
                <p>$1,290</p>
              </td>
              <td>
                <ul>
                  <li>
                    <a href="#" class="btn-view btn-export">Export</a>
                  </li>
                  <li>
                    <a href="#" class="btn-view">View</a>
                  </li>
                </ul>
              </td>
            </tr>
            <!-- payment single item end -->
            <!-- payment single item start -->
            <tr>
              <td>
                2
              </td>
              <td>
                <div class="media">
                  <img src="./uploads/users/avatar-02.png" alt="A" class="img-fluid">
                  <div class="media-body">
                    <h5>Cecil Sporer</h5>
                    <span>lincoln@unpixel.com</span>
                  </div>
                </div>
              </td>
              <td>
                <p>09 Oct, 2023</p>
              </td>
              <td>
                <p>$2,640</p>
              </td>
              <td>
                <ul>
                  <li>
                    <a href="#" class="btn-view btn-export">Export</a>
                  </li>
                  <li>
                    <a href="#" class="btn-view">View</a>
                  </li>
                </ul>
              </td>
            </tr>
            <!-- payment single item end -->
            <!-- payment single item start -->
            <tr>
              <td>
                3
              </td>
              <td>
                <div class="media">
                  <img src="./uploads/users/avatar-03.png" alt="A" class="img-fluid">
                  <div class="media-body">
                    <h5>Leah Skiles</h5>
                    <span>lincoln@unpixel.com</span>
                  </div>
                </div>
              </td>
              <td>
                <p>09 Oct, 2023</p>
              </td>
              <td>
                <p>$1,290</p>
              </td>
              <td>
                <ul>
                  <li>
                    <a href="#" class="btn-view btn-export">Export</a>
                  </li>
                  <li>
                    <a href="#" class="btn-view">View</a>
                  </li>
                </ul>
              </td>
            </tr>
            <!-- payment single item end -->
            <!-- payment single item start -->
            <tr>
              <td>
                4
              </td>
              <td>
                <div class="media">
                  <img src="./uploads/users/avatar-04.png" alt="A" class="img-fluid">
                  <div class="media-body">
                    <h5>Bradley Heathcote</h5>
                    <span>lincoln@unpixel.com</span>
                  </div>
                </div>
              </td>
              <td>
                <p>09 Oct, 2023</p>
              </td>
              <td>
                <p>$2,609</p>
              </td>
              <td>
                <ul>
                  <li>
                    <a href="#" class="btn-view btn-export">Export</a>
                  </li>
                  <li>
                    <a href="#" class="btn-view">View</a>
                  </li>
                </ul>
              </td>
            </tr>
            <!-- payment single item end -->
            <!-- payment single item start -->
            <tr>
              <td>
                5
              </td>
              <td>
                <div class="media">
                  <img src="./uploads/users/avatar-05.png" alt="A" class="img-fluid">
                  <div class="media-body">
                    <h5>Claire Turcotte</h5>
                    <span>lincoln@unpixel.com</span>
                  </div>
                </div>
              </td>
              <td>
                <p>09 Oct, 2023</p>
              </td>
              <td>
                <p>$2,608</p>
              </td>
              <td>
                <ul>
                  <li>
                    <a href="#" class="btn-view btn-export">Export</a>
                  </li>
                  <li>
                    <a href="#" class="btn-view">View</a>
                  </li>
                </ul>
              </td>
            </tr>
            <!-- payment single item end -->
            <!-- payment single item start -->
            <tr>
              <td>
                6
              </td>
              <td>
                <div class="media">
                  <img src="./uploads/users/avatar-06.png" alt="A" class="img-fluid">
                  <div class="media-body">
                    <h5>Rita Kovacek</h5>
                    <span>lincoln@unpixel.com</span>
                  </div>
                </div>
              </td>
              <td>
                <p>09 Oct, 2023</p>
              </td>
              <td>
                <p>$6,560</p>
              </td>
              <td>
                <ul>
                  <li>
                    <a href="#" class="btn-view btn-export">Export</a>
                  </li>
                  <li>
                    <a href="#" class="btn-view">View</a>
                  </li>
                </ul>
              </td>
            </tr>
            <!-- payment single item end -->
            <!-- payment single item start -->
            <tr>
              <td>
                7
              </td>
              <td>
                <div class="media">
                  <img src="./uploads/users/avatar-07.png" alt="A" class="img-fluid">
                  <div class="media-body">
                    <h5>Mr. Roy Cole</h5>
                    <span>lincoln@unpixel.com</span>
                  </div>
                </div>
              </td>
              <td>
                <p>09 Oct, 2023</p>
              </td>
              <td>
                <p>$2,880</p>
              </td>
              <td>
                <ul>
                  <li>
                    <a href="#" class="btn-view btn-export">Export</a>
                  </li>
                  <li>
                    <a href="#" class="btn-view">View</a>
                  </li>
                </ul>
              </td>
            </tr>
            <!-- payment single item end -->
            <!-- payment single item start -->
            <tr>
              <td>
                8
              </td>
              <td>
                <div class="media">
                  <img src="./uploads/users/avatar-08.png" alt="A" class="img-fluid">
                  <div class="media-body">
                    <h5>Cecilia Fisher</h5>
                    <span>lincoln@unpixel.com</span>
                  </div>
                </div>
              </td>
              <td>
                <p>09 Oct, 2023</p>
              </td>
              <td>
                <p>$9,365</p>
              </td>
              <td>
                <ul>
                  <li>
                    <a href="#" class="btn-view btn-export">Export</a>
                  </li>
                  <li>
                    <a href="#" class="btn-view">View</a>
                  </li>
                </ul>
              </td>
            </tr>
            <!-- payment single item end -->
            <!-- payment single item start -->
            <tr>
              <td>
                9
              </td>
              <td>
                <div class="media">
                  <img src="./uploads/users/avatar-09.png" alt="A" class="img-fluid">
                  <div class="media-body">
                    <h5>Shelley Collins</h5>
                    <span>lincoln@unpixel.com</span>
                  </div>
                </div>
              </td>
              <td>
                <p>09 Oct, 2023</p>
              </td>
              <td>
                <p>$9365</p>
              </td>
              <td>
                <ul>
                  <li>
                    <a href="#" class="btn-view btn-export">Export</a>
                  </li>
                  <li>
                    <a href="#" class="btn-view">View</a>
                  </li>
                </ul>
              </td>
            </tr>
        <!-- payment single item end -->
                    <!-- payment single item start -->
                    <tr>
                      <td>
                        10
                      </td>
                      <td>
                        <div class="media">
                          <img src="./uploads/users/avatar-10.png" alt="A" class="img-fluid">
                          <div class="media-body">
                            <h5>Shelley Collins</h5>
                            <span>lincoln@unpixel.com</span>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p>09 Oct, 2023</p>
                      </td>
                      <td>
                        <p>$9365</p>
                      </td>
                      <td>
                        <ul>
                          <li>
                            <a href="#" class="btn-view btn-export">Export</a>
                          </li>
                          <li>
                            <a href="#" class="btn-view">View</a>
                          </li>
                        </ul>
                      </td>
                    </tr>
                    <!-- payment single item end -->
          </tbody></table>
        </div>
      </div>
      <!-- payment from company user end -->
    </section>
    <!-- main page wrapper end -->
@endsection