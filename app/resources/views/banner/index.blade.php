@extends('layouts.auth')

@section('title','Banner List Page')

@section('style')
<link rel="stylesheet" href="{{ asset('public/assets/css/custom.css') }}">
@endsection

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper categories-wrapper">
    <!-- page title -->
    <div class="page-title">
        <h1>App Banners</h1>

        <!-- bttn -->
        <div class="page-bttn">
            <a href="#" class="bttn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight"><i class="fas fa-plus"></i> Update Banner</a>
        </div>
        <!-- bttn -->
    </div>
    <!-- page title -->

    <!-- category list start -->
    <div class="row">
        @foreach ($banners as $banner)
        <!-- product item start -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
            <div class="product-item-box">
                <!-- thumbnail start -->
                <div class="product-thumbnail">
                    <img src="{{ $banner->banner }}" alt="Banner Preview" class="img-fluid">
                </div>
                <!-- txt -->
                <div class="product-txt">
                    <h5 class="text-capitalize">
                        {{ $banner->banner_type }} Banner
                    </h5>
                    <p>Action button:</p>
                    <div class="take-deal-bttn">
                        @if ($banner->banner_type === 'guest')
                        <a href="#" class="bttn">Sign up</a>
                        @elseif ($banner->banner_type === 'client')
                        <a href="#" class="bttn">View All Deals</a>
                        @elseif ($banner->banner_type === 'company')
                        <a href="#" class="bttn">Make New Deal</a>
                        @endif
                    </div>
                </div>
                <!-- txt -->
            </div>
        </div>
        <!-- product item end -->
        @endforeach
    </div>
    <!-- category list end -->

</section>
<!-- main page wrapper end -->
@endsection

@section('drawer')

<!-- add comapny modal form start -->
<div class="add-company-modal-from">
    <div class="offcanvas offcanvas-end @error('name') show @enderror @error('icon') show @enderror" tabindex="-1"
        id="offcanvasRight" aria-labelledby="offcanvasRightLabel">

        <div class="offcanvas-body">
            <div class="add-new-company-from-wrap">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>App Banner</h3>
                    <button type="button" data-bs-dismiss="offcanvas" aria-label="Close" class="btn bttn-close">
                        <i class="fas fa-angle-right"></i>
                    </button>
                </div>

                <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group form-error">
                        <label for="" class="block">Banner Type<span class="text-danger">*</span></label> <br>

                        <div class="btn-group flex custom-bttn-group" role="group"
                            aria-label="Banner type toggle button">
                            <input type="radio" class="btn-check" name="banner_type" id="guest" value="guest"
                                autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="guest">Guest</label>

                            <input type="radio" class="btn-check" name="banner_type" id="client" value="client"
                                autocomplete="off">
                            <label class="btn btn-outline-primary" for="client">Client</label>

                            <input type="radio" class="btn-check" name="banner_type" id="company" value="company"
                                autocomplete="off">
                            <label class="btn btn-outline-primary" for="company">Company</label>
                        </div>

                    </div>

                    <div class="form-group form-error">
                        <label for="banner">Banner Image<span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('icon') is-invalid @enderror" name="banner"
                            id="banner">
                        @error('banner')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span class="mt-2 d-block text-primary" style="font-size: 12px">Recomended Banner size 335px by
                            152px</span>
                    </div>

                    <!-- Image container -->
                    <div id="icon-container" class="mt-2">
                        <img src="" alt="" id="banner-preview">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
  
        var avatarContainer = document.getElementById('icon-container');
        
        document.getElementById('banner').addEventListener('change', function (e) {
            var input = e.target;
            var file = input.files[0];
  
            var avatarPreview = document.getElementById('banner-preview');
            var closeIcon = document.getElementById('close-icon');
  
            if (file) {
                if (!avatarPreview) {
                    avatarPreview = document.createElement('img');
                    avatarPreview.id = 'banner-preview';
                    avatarPreview.className = 'img-fluid';
                    avatarContainer.innerHTML = '';
                    avatarContainer.appendChild(avatarPreview);
                }
  
                if (!closeIcon) {
                    closeIcon = document.createElement('span');
                    closeIcon.id = 'close-icon';
                    closeIcon.innerHTML = "Cancel";
                    closeIcon.className = 'close-icon btn btn-primary mt-2';
                    closeIcon.style.cursor = 'pointer';
                    closeIcon.addEventListener('click', function () {
                        avatarPreview.src = '';
                        avatarContainer.removeChild(closeIcon);
                        document.getElementById('banner').value = '';
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