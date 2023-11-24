@extends('layouts.auth')
@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
      <!-- page title -->
      <div class="page-title">
        <h1>Category</h1>

        <!-- bttn -->
        <div class="page-bttn">
          <a href="#" class="bttn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Add Category</a>
        </div>
        <!-- bttn -->
      </div>
      <!-- page title -->

      <!-- company list start -->
      <div class="row">
        @foreach($categories as $category)
        <!-- company single box start -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-15">
          <div class="company-profile-box">
            <!-- avatar -->
            <div class="avatar">
              <img src="{{ $category->icon}}" alt="{{ $category->name}}" class="img-fluid">
            </div>
            <!-- avatar -->

            <div class="txt">
              <h4>{{ $category->name}}</h4>
              <hr>
              <div class="details-bttn">
                <a href="{{ route('category.show',$category)}}" class="bttn">View Details</a>
              </div>

            </div>
          </div>
        </div>
        <!-- company single box end -->
        @endforeach
      </div>
      <!-- company list end -->
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
                        <div class="form-group">
                            <label for="name">Name <span>*</span></label>
                            <input type="text" class="form-control" placeholder="Name.." value="{{ old('name')}}" name="name" id="name">
                            @error('name') <span>{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="icon">Icon<span>*</span></label>
                            <input type="file" class="form-control" placeholder="Enter icon" value="{{ old('icon')}}" name="icon" id="icon">
                            @error('icon') <span>{{ $message }}</span> @enderror
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