@extends('layouts.auth')

@section('title','Company Update Page')

@section('content')
<!-- main page wrapper start -->
<section class="main-page-wrapper marketplace-page-wrapper">
    <!-- page title -->
    <div class="page-title">
        <h1>Company Update</h1>
    </div>
    <!-- page title -->

    <!-- company list start -->
    <div class="row">
        <div class="col-12 col-md-4 col-xl-3">
            <!-- compnay about start -->
            <div class="company-about-box">
                <img src="./uploads/company/thumbnail.png" alt="a" class="img-fluid main-thumb">
                <div class="txt">
                    <h1>THE ROYAL COMPANY</h1>
                    <p>Empowering Innovation, Enriching Lives</p>

                    <hr>

                    <ul>
                        <li>
                            <p><img src="./assets/images/icons/envelope.svg" alt="I" class="img-fluid">
                                cassandre66@gmail.com</p>
                        </li>
                        <li>
                            <p><img src="./assets/images/icons/call.svg" alt="I" class="img-fluid"> 911-415-0350</p>
                        </li>
                        <li>
                            <p><img src="./assets/images/icons/global.svg" alt="I" class="img-fluid"> Bangladesh</p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- compnay about end -->
        </div>
        <div class="col-12 col-md-8 col-xl-9">
            <!-- company edit form start -->
            <div class="company-edit-from-wrapper">
                <form action="" class="form-box">
                    <div class="title">
                        <h3>Information</h3>
                        <a href="#">
                            <img src="./assets/images/icons/pen.svg" alt="I" class="img-fluid">
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="name">Company Name <span>*</span></label>
                        <input type="text" class="form-control" placeholder="Company Name.." value="THE ROYAL COMPANY"
                            name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="tagline">Company Tagline <span>*</span></label>
                        <input type="text" class="form-control" placeholder="Company Tagline.."
                            value="Empowering Innovation, Enriching Lives" name="tagline" id="tagline">
                    </div>
                    <div class="form-group">
                        <label for="description">About Company <span>*</span></label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control">Lure reprehenderit aut atque dolores. Impedit in et possimus velit assumenda laboriosam et ab nisi. Aut unde sed reiciendis totam labore eligendi dolor. Odio dolore voluptas asperiores. Saepe esse voluptatibus totam cupiditate ipsum sit autem sed unde. Perspiciatis quas saepe. Molestiae odit voluptatibus quia laboriosam id incidunt. Autem aspernatur fugit. Delectus accusamus omnis. Iusto voluptas repellendus sint non quam sunt laborum velit minus.
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" class="form-control" placeholder="Company Email"
                                    value="maeve_Zemlak88@gmail.com" name="email" id="email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Phone <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Enter phone number"
                                    value="879-362-0805" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="country">Country <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Enter country name" value=""
                                    name="country" id="country">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="location">Location <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Location.." value=""
                                    name="location" id="location">
                            </div>
                        </div>
                    </div>
                    <div class="form-submit">
                        <button type="submit" class="btn btn-submit">Save Changes</button>
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