@extends('layouts.auth')

@section('title',$product->title)


@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
    <!-- page title -->
    <div class="page-title">
        <h1>Product Update</h1>
    </div>
    <!-- page title -->

    <!-- company list start -->
    <div class="row">
        <div class="col-12 col-md-4 col-xl-3">
            <!-- compnay about start -->
            <div class="company-about-box">
                @php
                    $imageUrls = [];
                    if (isset($product) && !empty($product->images)) {
                        $imageUrls = json_decode($product->images);
                    }
                @endphp
                
                @if(is_array($imageUrls) && count($imageUrls) > 0)
                    <img src="{{ $imageUrls[0] }}" alt="Product Thumbnail" class="img-fluid main-thumb">
                @else
                    <img src="{{ asset('public/uploads/products/product-thumbnail-01.png')}}" alt="Product Thumbnail" class="img-fluid main-thumb">
                @endif 

                <div class="txt">
                    <h1>{{ $product->title }}</h1>
                    <p>{{ optional($product->company)->name }} </p>
                    <p style="font-weight: 700; font-size:14px">Product Variant: {{ count($product->productVariants) }} </p>
                    <hr>

                    <ul> 
                        @if ($product->company)
                        <li>
                            <p>
                            <img src="{{ asset('public/assets/images/icons/envelope.svg') }}" alt="I" class="img-fluid">
                            {{ optional($product->company)->email }}
                            </p>
                        </li>
                        @endif
                        @if ($product->company)
                        <li>
                            <p>
                                <img src="{{ asset('public/assets/images/icons/call.svg') }}" alt="I" class="img-fluid"> 
                                {{ optional($product->company)->phone }}
                            </p>
                        </li>
                        @endif 
                      </ul>
                </div>
            </div>
            <!-- compnay about end -->
        </div>
        <div class="col-12 col-md-8 col-xl-9">
            <!-- company edit form start -->
            <div class="company-edit-from-wrapper">
                <form action="{{ route('product.update', $product->slug) }}" class="form-box" method="POST" enctype="multipart/form-data">
                    @csrf  

                    <input type="hidden" name="user_id" value="{{ $product->user_id }}">
                    <input type="hidden" name="company_id " value="{{ $product->company_id }}"> 

                    <div class="title">
                        <h3>Product Information</h3> 
                    </div>
                    <div class="form-group form-error">
                        <label for="title">Product Title <span>*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Product Title.." value="{{ $product->title }}" name="title" id="title">

                        <span class="invalid-feedback">
                            @error('name'){{ $message }} @enderror
                        </span>
                    </div>
                    {{-- <div class="form-group form-error">
                        <label for="cats">Product Categories <span>*</span></label>
                        <input type="text" class="form-control @error('cats') is-invalid @enderror" placeholder="Company cats.."
                            value="{{ $product->cats }}" name="cats" id="cats">
                        <span class="invalid-feedback">@error('cats'){{ $message }} @enderror</span>
                    </div> --}}

                    <div class="form-group form-error">
                        <label for="product_url">Product URL <span>*</span></label>
                        <input type="text" class="form-control @error('product_url') is-invalid @enderror" placeholder="Product URL.." value="{{ $product->product_url }}" name="product_url" id="product_url">

                        <span class="invalid-feedback">
                            @error('product_url'){{ $message }} @enderror
                        </span>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group form-error">
                                <label for="price">Price <span>*</span></label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" placeholder="Product URL.." value="{{ $product->price }}" name="price" id="price">
        
                                <span class="invalid-feedback">
                                    @error('price'){{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group form-error">
                                <label for="sell_price">Sell Price <span>*</span></label>
                                <input type="text" class="form-control @error('sell_price') is-invalid @enderror" placeholder="Product URL.." value="{{ $product->sell_price }}" name="sell_price" id="sell_price">
        
                                <span class="invalid-feedback">
                                    @error('price'){{ $message }} @enderror
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-error">
                        <label for="description">Description <span>*</span></label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Type here">{{ $product->description }}</textarea>

                        <span class="invalid-feedback">@error('description'){{ $message }}
                            @enderror</span>
                    </div> 
                    <div class="form-submit">
                        <button type="submit" class="btn btn-submit">Update Product</button>
                    </div>
                </form>
            </div>
            <!-- company edit form end -->
        </div>
    </div>
    <!-- company list end -->
</section>
<!-- main page wrapper end -->
@endsection
