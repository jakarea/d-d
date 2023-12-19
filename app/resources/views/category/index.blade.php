@extends('layouts.auth')

@section('title','Category List Page')

@section('style')
<link rel="stylesheet" href="{{ asset('public/assets/css/custom.css') }}">
@endsection

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper categories-wrapper">
  <!-- page title -->
  <div class="page-title">
    <h1>All Categories</h1>

    <!-- bttn -->
    <div class="page-bttn">
      <a href="#" class="bttn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add Category</a>
    </div>
    <!-- bttn -->
  </div>
  <!-- page title -->

  <!-- category list start -->
  <div class="row">
    @if (count($categories) > 0)
        @foreach($categories as $category)
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-15">
          <div class="company-profile-box">
            <a href="{{ route('category.edit', $category) }}">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <!-- avatar -->
            <div class="avatar">

              @if ($category->icon)
                <img src="{{ $category->icon }}" alt="ICON" class="img-fluid">
                @else
                <span class="no-avatar nva-lg">{!! strtoupper($category->name[0]) !!}</span>
                @endif
            </div>
            <!-- avatar -->

            <div class="txt">
              <h4>{{ $category->name}}</h4>
              <hr>
              <div class="details-bttn">
                <a href="{{ url('marketplace?category='.$category->id) }}" class="bttn">View Products</a>
              </div>

            </div>
          </div>
        </div>
        <!-- company single box end -->
        @endforeach
    @else
        {{-- no data found component --}}
        {{-- <x-EmptyDataComponent :dynamicData="'No Category Found!'" />  --}}
        <p>No Category Found!</p>
        {{-- no data found component --}}
    @endif
  </div>
  <!-- category list end -->

  {{-- paggination wrap --}}
  <div class="row">
    <div class="col-12 paggination-wrap">
      {{ $categories->links('pagination::bootstrap-5') }}
    </div>
  </div>
  {{-- paggination wrap --}}

</section>
<!-- main page wrapper end -->
@endsection

@section('drawer')

<!-- add comapny modal form start -->
<div class="add-company-modal-from">
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">

    <div class="offcanvas-body">
      <div class="add-new-company-from-wrap">
        <div class="d-flex justify-content-between align-items-center">
          <h3>Add New Category</h3>
          <button type="button" data-bs-dismiss="offcanvas" aria-label="Close" class="btn bttn-close">
            <i class="fas fa-angle-right"></i>
          </button>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group form-error">
            <label for="name">Name <span>*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name.." name="name"
              id="name">
            @error('name') <span>{{ $message }}</span> @enderror
          </div>

          <div class="form-group form-error">
            <label for="icon">Icon<span>*</span></label>
            <input type="file" class="form-control @error('icon') is-invalid @enderror" placeholder="Enter icon"
              name="icon" id="icon">
            @error('icon') <span>{{ $message }}</span> @enderror
          </div>

          <div id="icon-container" class="mt-2">
            <img src="" alt="" class="img-fluid rounded" id="icon-preview">
          </div>

          <div class="form-submit">
            <button type="reset" class="btn btn-cancel">Cancel</button>
            <button type="submit" class="btn btn-submit">Add</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<!-- add comapny modal form end -->
@endsection

@section('script')
{{-- image upload preview --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {

      var avatarContainer = document.getElementById('icon-container');
      var avatarPreview = document.getElementById('icon-preview');
      var closeIcon = document.getElementById('close-icon');

      document.getElementById('icon').addEventListener('change', function (e) {
          var input = e.target;
          var file = input.files[0];

          if (file) {
              if (!avatarPreview) {
                  avatarPreview = document.createElement('img');
                  avatarPreview.id = 'icon-preview';
                  avatarPreview.className = 'img-fluid';
                  avatarContainer.innerHTML = '';
                  avatarContainer.appendChild(avatarPreview);
              }

              if (!closeIcon) {
                  closeIcon = document.createElement('i');
                  closeIcon.id = 'close-icon';
                  closeIcon.className = 'fas fa-times close-icon';
                  closeIcon.style.cursor = 'pointer';
                  closeIcon.addEventListener('click', function () {
                      avatarPreview.src = '';
                      avatarContainer.removeChild(closeIcon);
                      document.getElementById('icon').value = ''; // Clear the file input
                  });
                  avatarContainer.appendChild(closeIcon);
              }

              var reader = new FileReader();
              reader.onload = function (e) {
                  avatarPreview.src = e.target.result;
              };
              reader.readAsDataURL(file);
          } else {
              // Hide close icon if no file is selected
              if (closeIcon) {
                  avatarContainer.removeChild(closeIcon);
              }
          }
      });
  });
</script>
@endsection
