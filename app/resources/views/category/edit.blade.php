@extends('layouts.auth')

@section('title',$category->name)

@section('content')
<section class="main-page-wrapper marketplace-page-wrapper">
    <!-- page title -->
    <div class="page-title">
        <h1>Category Update</h1>
    </div>
    <!-- page title -->

    <!-- customer details start -->
    <div class="row">
        <div class="col-12 col-md-4 col-xl-3">
            <!-- customer about start -->
            <div class="company-about-box">
                <div class="avatar-wrap cate-icon">
                    <div id="avatar-container">
                        @if ($category && $category->icon)
                        <img src="{{ $category->icon }}" alt="A" class="img-fluid main-avatar" id="avatar-preview">
                        @else
                        <span class="no-avatar nva-lg">{!! strtoupper($category->name[0]) !!}</span>
                        @endif
                    </div>

                    <label for="avatar" class="avatar-label">
                        <div class="ol">
                            <img src="{{ asset('public/assets/images/icons/photo.png') }}" alt="U"
                                class="img-fluid logo-photo">
                            <span>Update Icon</span>
                        </div>
                    </label>
                </div>
                <div class="txt">
                    <h1>{{$category->name}}</h1>
                    <hr>

                    <ul>
                        <li>
                            <p> 
                               Number of Product:  {{ $category->number_of_product }}</p>
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
                <form action="{{ route('category.update', $category) }}" class="form-box" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="title">
                        <h3>Category Info</h3>

                    </div>
                    {{-- user avatar --}}
                    <input type="file" name="icon" id="avatar" class="d-none">
                    {{-- user avatar --}}
                    <div class="form-group form-error">
                        <label for="name">Name <span>*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter Category Name" value="{{ optional($category)->name }}" name="name"
                            id="name">

                        <span class="invalid-feedback">
                            @error('name'){{ $message }} @enderror
                        </span>

                    </div>
                    <div class="form-submit">
                        <button type="submit" class="btn btn-submit">Save Changes</button>
                    </div>
                </div>

            </form>
            <!-- customer personal info end -->

        </div>
        <!-- customer info end -->
    </div>
    <!--personal info end-->
    </div>
</section>
@endsection

@section('script')
{{-- image upload preview --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var avatarContainer = document.getElementById('avatar-container');
      var avatarPreview = document.getElementById('avatar-preview');
      document.getElementById('avatar').addEventListener('change', function (e) {
          var input = e.target;
          var file = input.files[0];

          if (file) { 
              if (!avatarPreview) {
                  avatarPreview = document.createElement('img');
                  avatarPreview.id = 'avatar-preview';
                  avatarPreview.className = 'img-fluid main-avatar';
                  avatarContainer.innerHTML = '';
                  avatarContainer.appendChild(avatarPreview);
              }
 
              var reader = new FileReader();
              reader.onload = function (e) {
                  avatarPreview.src = e.target.result;
              };
              reader.readAsDataURL(file);
          }
      });
  });
</script>
@endsection