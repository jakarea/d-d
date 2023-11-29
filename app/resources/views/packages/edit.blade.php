@extends('layouts.auth')

@section('title','Plan Package Update')

@section('style')
<link rel="stylesheet" href="{{ url('assets/css/pricing.css') }}">
@endsection

@section('content')
<!-- pricing page wrapper start -->
<section class="main-page-wrapper plan-page-wrapper">
  <!-- page title -->
  <div class="page-title">
    <h1>Edit Plans </h1>
  </div>
  <!-- page title -->

  <!-- edit plas boxs start -->
  <div class="row">
    <!-- plsan single box start -->
    <div class="col-12 col-sm-8 col-md-6 col-xl-4">
      <div class="plan-single-edit-box">
        <form action="">
          <!-- header -->
          <div class="header">
            <div class="form-check form-switch">
              <label class="form-check-label" for="featurePlan">Feature Plan</label>
              <input class="form-check-input" type="checkbox" role="switch" id="featurePlan" checked="">
            </div>
            <div class="icon">
              <p>Icon</p>
              <img src="./assets/images/icons/basic-plan.svg" alt="I" class="img-fluid">
            </div>
          </div>
          <!-- header -->
          <div class="form-group">
            <label for="">Plan Name <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Basic plan <i class="fa-solid fa-angle-down"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Business plan <i class="fa-solid fa-check"></i></a></li>
                <li><a class="dropdown-item" href="#">Enterprise plan<i class="fa-solid fa-check"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="form-group">
            <label for="">Prince <span>*</span></label>
            <input type="text" placeholder="Enter Price" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Billed <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Monthly <i class="fa-solid fa-angle-down"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Yearly <i class="fa-solid fa-check"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="features-list">
            <h6>Features</h6>

            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Access to all basic features" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->

            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Basic reporting and analytics" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Up to 10 individual users" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="20GB individual data each user" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Basic chat and email support" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" placeholder="Type here" class="form-control">
            </div>
            <!-- feat item -->

            <div id="container">
              <!-- Existing content or appended items will appear here -->
            </div>

            <!-- add more btn -->
            <div class="add-more">
              <a href="#" id="addMoreButton">
                <i class="fas fa-plus"></i>
                Add more
              </a>
            </div>
            <!-- add more btn -->

          </div>
          <div class="form-submit">
            <button type="button" class="btn btn-cancel">Cancel</button>
            <button type="submit" class="btn btn-submit">Update</button>
          </div>

        </form>
      </div>
    </div>
    <!-- plsan single box end -->
    <!-- plsan single box start -->
    <div class="col-12 col-sm-8 col-md-6 col-xl-4">
      <div class="plan-single-edit-box">
        <form action="">
          <!-- header -->
          <div class="header">
            <div class="form-check form-switch">
              <label class="form-check-label" for="featurePlan">Feature Plan</label>
              <input class="form-check-input" type="checkbox" role="switch" id="featurePlan" checked="">
            </div>
            <div class="icon">
              <p>Icon</p>
              <img src="./assets/images/icons/business-plan.svg" alt="I" class="img-fluid">
            </div>
          </div>
          <!-- header -->
          <div class="form-group">
            <label for="">Plan Name <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Basic plan <i class="fa-solid fa-angle-down"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Business plan <i class="fa-solid fa-check"></i></a></li>
                <li><a class="dropdown-item" href="#">Enterprise plan<i class="fa-solid fa-check"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="form-group">
            <label for="">Prince <span>*</span></label>
            <input type="text" placeholder="Enter Price" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Billed <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Monthly <i class="fa-solid fa-angle-down"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Yearly<i class="fa-solid fa-check"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="features-list">
            <h6>Features</h6>

            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="200+ integrations" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->

            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Advanced reporting and analytics" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Up to 20 individual users" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="40GB individual data each user" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Priority chat and email support" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" placeholder="Type here" class="form-control">
            </div>
            <!-- feat item -->

            <div id="container">
              <!-- Existing content or appended items will appear here -->
            </div>

            <!-- add more btn -->
            <div class="add-more">
              <a href="#" id="addMoreButton">
                <i class="fas fa-plus"></i>
                Add more
              </a>
            </div>
            <!-- add more btn -->

          </div>
          <div class="form-submit">
            <button type="button" class="btn btn-cancel">Cancel</button>
            <button type="submit" class="btn btn-submit">Update</button>
          </div>

        </form>
      </div>
    </div>
    <!-- plsan single box end -->
    <!-- plsan single box start -->
    <div class="col-12 col-sm-8 col-md-6 col-xl-4">
      <div class="plan-single-edit-box">
        <form action="">
          <!-- header -->
          <div class="header">
            <div class="form-check form-switch">
              <label class="form-check-label" for="featurePlan">Feature Plan</label>
              <input class="form-check-input" type="checkbox" role="switch" id="featurePlan" checked="">
            </div>
            <div class="icon">
              <p>Icon</p>
              <img src="./assets/images/icons/business-plan.svg" alt="I" class="img-fluid">
            </div>
          </div>
          <!-- header -->
          <div class="form-group">
            <label for="">Plan Name <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Basic plan <i class="fa-solid fa-angle-down"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Business plan <i class="fa-solid fa-check"></i></a></li>
                <li><a class="dropdown-item" href="#">Enterprise plan<i class="fa-solid fa-check"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="form-group">
            <label for="">Prince <span>*</span></label>
            <input type="text" placeholder="Enter Price" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Billed <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Monthly<i class="fa-solid fa-angle-down"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Yearly<i class="fa-solid fa-check"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="features-list">
            <h6>Features</h6>

            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Advanced custom fields" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->

            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Audit log and data history" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Unlimited individual users" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Unlimited individual data" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="Personalised+priotity service" class="form-control" placeholder="Type here">
            </div>
            <!-- feat item -->
            <div class="input-box">
              <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" placeholder="Type here" class="form-control">
            </div>
            <!-- feat item -->

            <div id="container">
              <!-- Existing content or appended items will appear here -->
            </div>

            <!-- add more btn -->
            <div class="add-more">
              <a href="#" id="addMoreButton">
                <i class="fas fa-plus"></i>
                Add more
              </a>
            </div>
            <!-- add more btn -->

          </div>
          <div class="form-submit">
            <button type="button" class="btn btn-cancel">Cancel</button>
            <button type="submit" class="btn btn-submit">Update</button>
          </div>

        </form>
      </div>
    </div>
    <!-- plsan single box end -->
  </div>
  <!-- edit plas boxs end -->
</section>
<!-- pricing page wrapper end -->
@endsection

@section('script')

<script> 
  function addFeatureItem() {
    const container = document.getElementById('container');

    // Create a div element with the specified content
    const newItem = document.createElement('div');
    newItem.innerHTML = `
  <div class="input-box">
    <img src="./assets/images/icons/check.svg" alt="I" class="img-fluid">
    <input type="text" placeholder="Type here" class="form-control">
  </div>
`;
 
    container.appendChild(newItem);
  }

  // Event listener for the "Add more" button click
  document.getElementById('addMoreButton').addEventListener('click', function (event) {
    event.preventDefault();
    addFeatureItem();
  });

</script>

@endsection