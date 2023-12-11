@extends('layouts.auth')

@section('title','Plan Package Update')

@section('style')
{{-- <link rel="stylesheet" href="{{ url('public/assets/css/pricing.css') }}">  --}}
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
    <!-- plan 01 box start -->
    <div class="col-12 col-sm-8 col-md-6 col-xl-4">
      <div class="plan-single-edit-box">
        <form action="{{ route('pricing.package.update', $packageOne->id) }}" method="POST">
          @csrf
          <input type="hidden" name="package_id" value="{{ $packageOne->id }}">
          <!-- header -->
          <div class="header">
            <div class="form-check form-switch ps-0">
              <label class="form-check-label ms-0" for="is_featured">Feature Plan</label>
              <input class="form-check-input" type="checkbox" role="switch" name="is_featured" id="is_featured" {{
                $packageOne->is_featured ? 'checked' : '' }}>
            </div>
            <div class="icon">
              <p>Icon</p>
              <img src="{{ asset('public/assets/images/icons/basic-plan.svg') }}" alt="I" class="img-fluid">
            </div>
          </div>
          <!-- header -->
          <div class="form-group form-error">
            <label for="selectedName1">Plan Name <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="onlyName1">{{ $packageOne['name'] }}</span><i class="fa-solid fa-angle-down"></i>
              </button>
              <input type="hidden" name="name" id="selectedName1" value="{{ $packageOne['name'] }}">
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item plan-name1" href="#" data-name="Basic plan">Basic plan
                    @if ($packageOne['name'] == 'Basic plan')
                    <i class="fas fa-check"></i>
                    @endif
                  </a>
                </li>
                <li>
                  <a class="dropdown-item plan-name1" href="#" data-name="Business plan">Business plan
                    @if ($packageOne['name'] == 'Business plan')
                    <i class="fas fa-check"></i>
                    @endif
                  </a>
                </li>
                <li>
                  <a class="dropdown-item plan-name1" href="#" data-name="Enterprise plan">Enterprise plan
                    @if ($packageOne['name'] == 'Enterprise plan')
                    <i class="fas fa-check"></i>
                    @endif
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="form-group form-error">
            <label for="price">Price <span>*</span></label>
            <input type="text" placeholder="Enter Price" class="form-control @error('price') is-invalid @enderror"
              name="price" id="price" value="{{ $packageOne['price'] }}">

            <span class="invalid-feedback">
              @error('price'){{ $message }} @enderror
            </span>

          </div>
          <div class="form-group form-error">
            <label for="selectedPackageName1">Billed <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="onlyPack1">{{ $packageOne['package_type'] }}</span> <i class="fa-solid fa-angle-down"></i>
              </button>
              <input type="hidden" name="package_type" id="selectedPackageName1"
                value="{{ $packageOne['package_type'] }}">
              <ul class="dropdown-menu">
                <li><a class="dropdown-item pack-name1" href="#" data-pack-type="Monthly">Monthly
                    @if ($packageOne['package_type'] == 'Monthly')
                    <i class="fas fa-check"></i>
                    @endif
                  </a></li>
                <li><a class="dropdown-item pack-name1" href="#" data-pack-type="Yearly">Yearly
                    @if ($packageOne['package_type'] == 'Yearly')
                    <i class="fas fa-check"></i>
                    @endif
                  </a></li>
              </ul>
            </div>
          </div>

          <div class="form-group form-error {{ $packageOne['package_type'] == 'Monthly' ? 'd-none' : '' }}"
            id="yearlyPrice1">
            <label for="yearly_price">Yearly Price <span>*</span></label>
            <input type="text" placeholder="Enter Yearly Price"
              class="form-control @error('yearly_price') is-invalid @enderror" name="yearly_price" id="yearly_price"
              value="{{ $packageOne['yearly_price'] }}">

            <span class="invalid-feedback">
              @error('yearly_price'){{ $message }} @enderror
            </span>

          </div>

          <div class="features-list">
            <h6>Features</h6>
            @foreach ($packageOneFeatures as $feature)
            <!-- feat item -->
            <div class="input-box">
              <img src="./public/assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="{{ $feature }}" class="form-control" placeholder="Type here" name="features[]">
            </div>
            <!-- feat item -->
            @endforeach

            <div id="container1">
              <!-- Existing content or appended items will appear here -->
            </div>

            <!-- add more btn -->
            <div class="add-more">
              <a href="#" id="addMoreButtonOne">
                <i class="fas fa-plus"></i>
                Add more
              </a>
            </div>
            <!-- add more btn -->

          </div>
          <div class="form-submit">
            <button type="reset" class="btn btn-cancel">Cancel</button>
            <button type="submit" class="btn btn-submit">Update</button>
          </div>

        </form>
      </div>
    </div>
    <!-- plsan 01 box end -->
    <!-- plan 02 box start -->
    <div class="col-12 col-sm-8 col-md-6 col-xl-4">
      <div class="plan-single-edit-box">
        <form action="{{ route('pricing.package.update', $packageTwo->id) }}" method="POST">
          @csrf
          <input type="hidden" name="package_id" value="{{ $packageTwo->id }}">
          <!-- header -->
          <div class="header">
            <div class="form-check form-switch ps-0">
              <label class="form-check-label ms-0" for="is_featured">Feature Plan</label>
              <input class="form-check-input" type="checkbox" role="switch" name="is_featured" id="is_featured" {{
                $packageTwo->is_featured ? 'checked' : '' }}>
            </div>
            <div class="icon">
              <p>Icon</p>
              <img src="{{ asset('public/assets/images/icons/business-plan.svg') }}" alt="I" class="img-fluid">
            </div>
          </div>
          <!-- header -->
          <div class="form-group form-error">
            <label for="selectedName2">Plan Name <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="onlyName2">{{ $packageTwo['name'] }}</span><i class="fa-solid fa-angle-down"></i>
              </button>
              <input type="hidden" name="name" id="selectedName2" value="{{ $packageTwo['name'] }}">
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item plan-name2" href="#" data-name="Basic plan">Basic plan
                    @if ($packageTwo['name'] == 'Basic plan')
                    <i class="fas fa-check"></i>
                    @endif
                  </a>
                </li>
                <li>
                  <a class="dropdown-item plan-name2" href="#" data-name="Business plan">Business plan
                    @if ($packageTwo['name'] == 'Business plan')
                    <i class="fas fa-check"></i>
                    @endif
                  </a>
                </li>
                <li>
                  <a class="dropdown-item plan-name2" href="#" data-name="Enterprise plan">Enterprise plan
                    @if ($packageTwo['name'] == 'Enterprise plan')
                    <i class="fas fa-check"></i>
                    @endif
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="form-group form-error">
            <label for="price">Price <span>*</span></label>
            <input type="text" placeholder="Enter Price" class="form-control @error('price') is-invalid @enderror"
              name="price" id="price" value="{{ $packageTwo['price'] }}">

            <span class="invalid-feedback">
              @error('price'){{ $message }} @enderror
            </span>

          </div>
          <div class="form-group form-error">
            <label for="selectedPackageName2">Billed <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="onlyPack2">{{ $packageTwo['package_type'] }}</span> <i class="fa-solid fa-angle-down"></i>
              </button>
              <input type="hidden" name="package_type" id="selectedPackageName2"
                value="{{ $packageTwo['package_type'] }}">
              <ul class="dropdown-menu">
                <li><a class="dropdown-item pack-name2" href="#" data-pack-type="Monthly">Monthly
                    @if ($packageTwo['package_type'] == 'Monthly')
                    <i class="fas fa-check"></i>
                    @endif
                  </a></li>
                <li><a class="dropdown-item pack-name2" href="#" data-pack-type="Yearly">Yearly
                    @if ($packageTwo['package_type'] == 'Yearly')
                    <i class="fas fa-check"></i>
                    @endif
                  </a></li>
              </ul>
            </div>
          </div>

          <div class="form-group form-error {{ $packageTwo['package_type'] == 'Monthly' ? 'd-none' : '' }}"
            id="yearlyPrice2">
            <label for="yearly_price">Yearly Price <span>*</span></label>
            <input type="text" placeholder="Enter Yearly Price"
              class="form-control @error('yearly_price') is-invalid @enderror" name="yearly_price" id="yearly_price"
              value="{{ $packageTwo['yearly_price'] }}">

            <span class="invalid-feedback">
              @error('yearly_price'){{ $message }} @enderror
            </span>

          </div>

          <div class="features-list">
            <h6>Features</h6>
            @foreach ($packageTwoFeatures as $twoFeature)
            <!-- feat item -->
            <div class="input-box">
              <img src="./public/assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="{{ $twoFeature }}" class="form-control" placeholder="Type here"
                name="features[]">
            </div>
            <!-- feat item -->
            @endforeach

            <div id="container2">
              <!-- Existing content or appended items will appear here -->
            </div>

            <!-- add more btn -->
            <div class="add-more">
              <a href="#" id="addMoreButtonTwo">
                <i class="fas fa-plus"></i>
                Add more
              </a>
            </div>
            <!-- add more btn -->

          </div>
          <div class="form-submit">
            <button type="reset" class="btn btn-cancel">Cancel</button>
            <button type="submit" class="btn btn-submit">Update</button>
          </div>

        </form>
      </div>
    </div>
    <!-- plsan 02 box end -->
    <!-- plan 03 box start -->
    <div class="col-12 col-sm-8 col-md-6 col-xl-4">
      <div class="plan-single-edit-box">
        <form action="{{ route('pricing.package.update', $packageThree->id) }}" method="POST">
          @csrf
          <input type="hidden" name="package_id" value="{{ $packageThree->id }}">
          <!-- header -->
          <div class="header">
            <div class="form-check form-switch ps-0">
              <label class="form-check-label ms-0" for="is_featured">Feature Plan</label>
              <input class="form-check-input" type="checkbox" role="switch" name="is_featured" id="is_featured" {{
                $packageThree->is_featured ? 'checked' : '' }}>
            </div>
            <div class="icon">
              <p>Icon</p>
              <img src="{{ asset('public/assets/images/icons/enterprise-plan.svg') }}" alt="I" class="img-fluid">
            </div>
          </div>
          <!-- header -->
          <div class="form-group form-error">
            <label for="selectedName3">Plan Name <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="onlyName3">{{ $packageThree['name'] }}</span><i class="fa-solid fa-angle-down"></i>
              </button>
              <input type="hidden" name="name" id="selectedName3" value="{{ $packageThree['name'] }}">
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item plan-name3" href="#" data-name="Basic plan">Basic plan
                    @if ($packageThree['name'] == 'Basic plan')
                    <i class="fas fa-check"></i>
                    @endif
                  </a>
                </li>
                <li>
                  <a class="dropdown-item plan-name3" href="#" data-name="Business plan">Business plan
                    @if ($packageThree['name'] == 'Business plan')
                    <i class="fas fa-check"></i>
                    @endif
                  </a>
                </li>
                <li>
                  <a class="dropdown-item plan-name3" href="#" data-name="Enterprise plan">Enterprise plan
                    @if ($packageThree['name'] == 'Enterprise plan')
                    <i class="fas fa-check"></i>
                    @endif
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="form-group form-error">
            <label for="price">Price <span>*</span></label>
            <input type="text" placeholder="Enter Price" class="form-control @error('price') is-invalid @enderror"
              name="price" id="price" value="{{ $packageThree['price'] }}">

            <span class="invalid-feedback">
              @error('price'){{ $message }} @enderror
            </span>

          </div>
          <div class="form-group form-error">
            <label for="selectedPackageName3">Billed <span>*</span></label>
            <div class="dropdown">
              <button class="btn btn-plan" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="onlyPack3">{{ $packageThree['package_type'] }}</span> <i
                  class="fa-solid fa-angle-down"></i>
              </button>
              <input type="hidden" name="package_type" id="selectedPackageName3"
                value="{{ $packageThree['package_type'] }}">
              <ul class="dropdown-menu">
                <li><a class="dropdown-item pack-name3" href="#" data-pack-type="Monthly">Monthly
                    @if ($packageThree['package_type'] == 'Monthly')
                    <i class="fas fa-check"></i>
                    @endif
                  </a></li>
                <li><a class="dropdown-item pack-name3" href="#" data-pack-type="Yearly">Yearly
                    @if ($packageThree['package_type'] == 'Yearly')
                    <i class="fas fa-check"></i>
                    @endif
                  </a></li>
              </ul>
            </div>
          </div>

          <div class="form-group form-error {{ $packageThree['package_type'] == 'Monthly' ? 'd-none' : '' }}"
            id="yearlyPrice3">
            <label for="yearly_price">Yearly Price <span>*</span></label>
            <input type="text" placeholder="Enter Yearly Price"
              class="form-control @error('yearly_price') is-invalid @enderror" name="yearly_price" id="yearly_price"
              value="{{ $packageThree['yearly_price'] }}">

            <span class="invalid-feedback">
              @error('yearly_price'){{ $message }} @enderror
            </span>

          </div>

          <div class="features-list">
            <h6>Features</h6>
            @foreach ($packageThreeFeatures as $feature)
            <!-- feat item -->
            <div class="input-box">
              <img src="./public/assets/images/icons/check.svg" alt="I" class="img-fluid">
              <input type="text" value="{{ $feature }}" class="form-control" placeholder="Type here" name="features[]">
            </div>
            <!-- feat item -->
            @endforeach

            <div id="container3">
              <!-- Existing content or appended items will appear here -->
            </div>

            <!-- add more btn -->
            <div class="add-more">
              <a href="#" id="addMoreButtonThree">
                <i class="fas fa-plus"></i>
                Add more
              </a>
            </div>
            <!-- add more btn -->

          </div>
          <div class="form-submit">
            <button type="reset" class="btn btn-cancel">Cancel</button>
            <button type="submit" class="btn btn-submit">Update</button>
          </div>

        </form>
      </div>
    </div>
    <!-- plsan 03 box end -->
  </div>
  <!-- edit plas boxs end -->
</section>
<!-- pricing page wrapper end -->
@endsection

@section('script')
{{-- add more feature input js --}}
<script>
  document.addEventListener('DOMContentLoaded', function () { 

  function addFeatureItem(id) {
    const container = document.getElementById('container' + id); 
    const newItem = document.createElement('div');
    newItem.innerHTML = `
      <div class="input-box">
        <img src="./public/assets/images/icons/check.svg" alt="I" class="img-fluid">
        <input type="text" placeholder="Type here" class="form-control" name="features[]">
      </div>
    `;
    container.appendChild(newItem);
  }
 
  // first pack
  document.getElementById('addMoreButtonOne').addEventListener('click', function (event) {
    event.preventDefault();
    addFeatureItem(1);
  });

  // two pack
  document.getElementById('addMoreButtonTwo').addEventListener('click', function (event) {
    event.preventDefault();
    addFeatureItem(2);
  });

  // three pack
  document.getElementById('addMoreButtonThree').addEventListener('click', function (event) {
    event.preventDefault();
    addFeatureItem(3);
  });

});
</script>

{{-- package name show to button js --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {

  function showName(id,item) {
    const selectedValueInput = document.getElementById('selectedName' + id);
    let onlyName = document.querySelector('.onlyName' + id);

    const selectedValue = item.getAttribute('data-name');
    selectedValueInput.value = selectedValue;
    onlyName.innerText = selectedValue; 
  }
  
  const dropdownItems1 = document.querySelectorAll('.plan-name1');
  const dropdownItems2 = document.querySelectorAll('.plan-name2');
  const dropdownItems3 = document.querySelectorAll('.plan-name3');

  function attachEventListeners(items, id) {
    items.forEach(function (item) {
      item.addEventListener('click', function (event) {
        event.preventDefault();
        showName(id,item);
      });
    });
  }
 
  attachEventListeners(dropdownItems1, 1);
  attachEventListeners(dropdownItems2, 2);
  attachEventListeners(dropdownItems3, 3);

});
</script>

{{-- package type show to button js --}}
<script>
  document.addEventListener('DOMContentLoaded', function () { 
  function showPackName(id) {
    const selectedValuePackName = document.getElementById('selectedPackageName' + id);
    const onlyPack = document.querySelector('.onlyPack' + id);
    const yearlyPrice = document.getElementById('yearlyPrice' + id);
    
    const packDropdownItems = document.querySelectorAll('.pack-name' + id);
    packDropdownItems.forEach(function (item) {
      item.addEventListener('click', function (event) { 
        event.preventDefault();
        selectedValuePackName.value = item.getAttribute('data-pack-type');
        onlyPack.innerText = item.getAttribute('data-pack-type');

        if (item.getAttribute('data-pack-type') == 'Yearly' ) {
          yearlyPrice.classList.remove('d-none');
        } else {
          yearlyPrice.classList.add('d-none');
        }
      });
    });
  }

  // Attach event listeners for each pack
  for (let i = 1; i <= 3; i++) {
    showPackName(i);
  }
});
</script>
@endsection