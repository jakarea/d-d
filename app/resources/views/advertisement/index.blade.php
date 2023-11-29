@extends('layouts.auth')

@section('title','Advertisement')

@section('style')
<link rel="stylesheet" href="{{ url('assets/css/pricing.css') }}">
@endsection

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
    <!-- page title -->
    <div class="page-title">
        <h1>All Product</h1>

        <!-- filter -->
        <div class="page-filter d-flex">
            <div class="dropdown me-3">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    All Product <i class="fas fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">All Product <i class="fas fa-check"></i></a></li>
                    <li><a class="dropdown-item" href="#">Active Product</a></li>
                    <li><a class="dropdown-item" href="#">Inactive Product</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categories <i class="fas fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">All Product <i class="fas fa-check"></i></a></li>
                    <li><a class="dropdown-item" href="#">Motorcycle</a></li>
                    <li><a class="dropdown-item" href="#">New Car</a></li>
                    <li><a class="dropdown-item" href="#">Beauty</a></li>
                    <li><a class="dropdown-item" href="#">Toys</a></li>
                    <li><a class="dropdown-item" href="#">Electronic</a></li>
                    <li><a class="dropdown-item" href="#">House</a></li>
                    <li><a class="dropdown-item" href="#">Watch</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- page title -->

    <!-- product list start -->
    <div class="row">
        <!-- product item start -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-04.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-05.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-06.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-07.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-14.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-13.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-15.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-16.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-17.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-18.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-19.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-69">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <span>50%</span>
                    <img src="./uploads/products/product-thumbnail-20.png" alt="Product Tumbnail" class="img-fluid">
                    <a href=""><i class="fa-regular fa-heart"></i></a>
                </div>
                <!-- thumbnail end -->
                <!-- txt -->
                <div class="product-txt">
                    <h5>Complete car washes inside and out at R</h5>
                    <p>The Royal Company . 3981 Triston Lodge</p>

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
    <!-- product list end -->
</section>
<!-- main page wrapper end -->
@endsection