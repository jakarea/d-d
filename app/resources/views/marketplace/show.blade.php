@extends('layouts.auth')

@section('title','All Product Page')

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper company-page-wrapper">
    <!-- company detils box start -->
    <div class="company-details-box">
      <!-- top part -->
      <div class="company-information">
        <div class="media align-items-start">
          <img src="./uploads/company/thumbnail.png" alt="Company Thumbnail" class="img-fluid main-thumb">
          <div class="media-body">
            <div class="d-flex">
              <h5>THE ROYAL COMPANY</h5>
              <a href="#">
                <img src="./assets/images/icons/pen.svg" alt="I" class="img-fluid">
              </a>
            </div>
            <h6>Empowering Innovation, Enriching Lives</h6>

            <ul>
              <li><img src="./assets/images/icons/envelope.svg" alt="I" class="img-fluid">
                <span>cormier6@gmail.com</span>
              </li>
              <li><img src="./assets/images/icons/call.svg" alt="I" class="img-fluid"> <span>437-782-0236</span></li>
              <li><img src="./assets/images/icons/gps.svg" alt="I" class="img-fluid"> <span>491 Gaylord Ridges,
                  UK</span></li>
            </ul>

            <p>Iure reprehenderit aut atque dolores. Impedit in et possimus velit assumenda laboriosam et ab nisi. Aut
              unde sed reiciendis totam labore eligendi dolor. Odio dolore voluptas asperiores. Saepe esse
              voluptatibus totam cupiditate ipsum sit autem sed unde. Perspiciatis quas saepe. Molestiae odit
              voluptatibus quia laboriosam id incidunt. Autem aspernatur fugit. Delectus accusamus omnis. Iusto
              voluptas repellendus sint non quam sunt laborum velit minus.</p>

          </div>
        </div>
      </div>
      <!-- top part -->

      <div class="row mt-20">
        <div class="col-lg-6">
          <!-- reviews box -->
          <div class="company-reviews">
            <h3>Reviews</h3>

            <div class="review-statics-box">
              <div>
                <h4>4.9<span class="h5">/5</span></h4>
                <p>23 Rating . 890 Reviews</p>
                <ul>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fas fa-star"></i></li>
                  <li><i class="fa-regular fa-star"></i></li>
                </ul>
              </div>
              <div class="rev-item-list">

                <!-- item -->
                <div class="item">
                  <p>5 star</p>
                  <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                </div>
                <!-- item -->
                <!-- item -->
                <div class="item">
                  <p>4 star</p>
                  <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="80"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 80%"></div>
                  </div>
                </div>
                <!-- item -->
                <!-- item -->
                <div class="item">
                  <p>3 star</p>
                  <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="60"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 60%"></div>
                  </div>
                </div>
                <!-- item -->
                <!-- item -->
                <div class="item">
                  <p>2 star</p>
                  <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="40"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 40%"></div>
                  </div>
                </div>
                <!-- item -->
                <!-- item -->
                <div class="item">
                  <p>1 star</p>
                  <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="20"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: 20%"></div>
                  </div>
                </div>
                <!-- item -->

              </div>
            </div>

            <!-- review list start -->
            <div class="review-list">
              <!-- review single item start -->
              <div class="review-single-item">
                <div class="header">
                  <div class="media">
                    <img src="./assets/images/user.png" alt="U" class="img-fluid">
                    <div class="media-body">
                      <h5>Dr. Mable Ullrich</h5>
                      <span>1 days ago</span>
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
                <p>The shoe runs really, really big!! I usually take an 11 for Nike, but this is really huge!</p>
              </div>
              <!-- review single item end -->
              <!-- review single item start -->
              <div class="review-single-item">
                <div class="header">
                  <div class="media">
                    <img src="./uploads/users/avatar-03.png" alt="U" class="img-fluid">
                    <div class="media-body">
                      <h5>Marion Koch</h5>
                      <span>2 days ago</span>
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
                <p>The shoe runs really, really big!! I usually take an 11 for Nike, but this is really huge!</p>
              </div>
              <!-- review single item end -->
                <!-- review single item start -->
                <div class="review-single-item">
                  <div class="header">
                    <div class="media">
                      <img src="./uploads/users/avatar-04.png" alt="U" class="img-fluid">
                      <div class="media-body">
                        <h5>Ian Lueilwitz</h5>
                        <span>25 Sep, 2023</span>
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
                  <p>The shoe runs really, really big!! I usually take an 11 for Nike, but this is really huge!</p>
                </div>
                <!-- review single item end -->
                <!-- review single item start -->
              <div class="review-single-item">
                <div class="header">
                  <div class="media">
                    <img src="./uploads/users/avatar-05.png" alt="U" class="img-fluid">
                    <div class="media-body">
                      <h5>Billy Schmidt</h5>
                      <span>23 Sep, 2023</span>
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
                <p>The shoe runs really, really big!! I usually take an 11 for Nike, but this is really huge!</p>
              </div>
              <!-- review single item end -->                  <!-- review single item start -->
              <div class="review-single-item">
                <div class="header">
                  <div class="media">
                    <img src="./uploads/users/avatar-06.png" alt="U" class="img-fluid">
                    <div class="media-body">
                      <h5>Marion Koch</h5>
                      <span>2 days ago</span>
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
                <p>The shoe runs really, really big!! I usually take an 11 for Nike, but this is really huge!</p>
              </div>
              <!-- review single item end -->
            </div>
            <!-- review list end -->
          </div>
          <!-- reviews box -->
        </div>
        <div class="col-lg-6">
          <div class="advertismewnt-deal-box">
            <h3>Advertisement Deals</h3>

            <div class="row">
              <!-- product item start -->
              <div class="col-12 col-xl-6 mb-3 mb-3">
                <div class="product-item-box">
                  <!-- thumbnail start -->
                  <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/company/product-01.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                  </div>
                  <!-- thumbnail end -->
                  <!-- txt -->
                  <div class="product-txt">
                    <h5>Complete car washes insi..</h5>
                    <p>The Royal Company . 3981 Triston..</p>

                    <ul>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fa-regular fa-star"></i></li>
                      <li><span class="avg-star">4.5</span></li>
                      <li><span class="total-rev">(920 Reviews)</span></li>
                    </ul>

                    <h4>$59.00 <span>$100.00</span></h4>

                    <div class="take-deal-bttn">
                      <button class="btn bttn" type="button">Take Deal</button>
                    </div>
                  </div>
                  <!-- txt -->
                </div>
              </div>
              <!-- product item end -->
              <!-- product item start -->
              <div class="col-12 col-xl-6 mb-3 mb-3">
                <div class="product-item-box">
                  <!-- thumbnail start -->
                  <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/company/product-02.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                  </div>
                  <!-- thumbnail end -->
                  <!-- txt -->
                  <div class="product-txt">
                    <h5>Complete car washes insi..</h5>
                    <p>The Royal Company . 3981 Triston..</p>

                    <ul>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fa-regular fa-star"></i></li>
                      <li><span class="avg-star">4.5</span></li>
                      <li><span class="total-rev">(920 Reviews)</span></li>
                    </ul>

                    <h4>$59.00 <span>$100.00</span></h4>

                    <div class="take-deal-bttn">
                      <button class="btn bttn" type="button">Take Deal</button>
                    </div>
                  </div>
                  <!-- txt -->
                </div>
              </div>
              <!-- product item end -->
              <!-- product item start -->
              <div class="col-12 col-xl-6 mb-3 mb-3">
                <div class="product-item-box">
                  <!-- thumbnail start -->
                  <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/company/product-01.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                  </div>
                  <!-- thumbnail end -->
                  <!-- txt -->
                  <div class="product-txt">
                    <h5>Complete car washes insi..</h5>
                    <p>The Royal Company . 3981 Triston..</p>

                    <ul>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fa-regular fa-star"></i></li>
                      <li><span class="avg-star">4.5</span></li>
                      <li><span class="total-rev">(920 Reviews)</span></li>
                    </ul>

                    <h4>$59.00 <span>$100.00</span></h4>

                    <div class="take-deal-bttn">
                      <button class="btn bttn" type="button">Take Deal</button>
                    </div>
                  </div>
                  <!-- txt -->
                </div>
              </div>
              <!-- product item end -->
              <!-- product item start -->
              <div class="col-12 col-xl-6 mb-3 mb-3">
                <div class="product-item-box">
                  <!-- thumbnail start -->
                  <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/company/product-02.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                  </div>
                  <!-- thumbnail end -->
                  <!-- txt -->
                  <div class="product-txt">
                    <h5>Complete car washes insi..</h5>
                    <p>The Royal Company . 3981 Triston..</p>

                    <ul>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fas fa-star"></i></li>
                      <li><i class="fa-regular fa-star"></i></li>
                      <li><span class="avg-star">4.5</span></li>
                      <li><span class="total-rev">(920 Reviews)</span></li>
                    </ul>

                    <h4>$59.00 <span>$100.00</span></h4>

                    <div class="take-deal-bttn">
                      <button class="btn bttn" type="button">Take Deal</button>
                    </div>
                  </div>
                  <!-- txt -->
                </div>
              </div>
              <!-- product item end -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- company detils box end -->
  </section>
<!-- main page wrapper end -->
@endsection