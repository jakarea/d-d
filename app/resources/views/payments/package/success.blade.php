<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="D&D is a Ecommerce Platform">
    <meta property="og:title" content="D&D">
    <meta property="og:type" content="E-Commerce">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="theme-color" content="#fff">

    <!-- Bootstrap CSS start -->
    <link rel="stylesheet" href="{{ url('public/assets/css/bootstrap.min.css') }}">
    <!-- Bootstrap CSS end --> 

    <!-- custom CSS start -->
    <link rel="stylesheet" href="{{ url('public/assets/css/payments.css') }}"> 
    <!-- custom CSS end -->

    <title>DnD || Payments</title>
</head>

<body>
      
    <div class="wrap-outer">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="top-logo">
                        <a href="#">
                            <img src="{{ asset('public/assets/images/logo.png') }}" alt="logo" class="img-fluid">
                        </a>
                    </div>
                    <div class="payments-message-box">
                        <img src="{{ asset('public/assets/images/icons/success.svg') }}" alt="success" class="img-fluid">

                        <h4>We received your payment</h4>
                        <p>Thank you for Purchasing our product</p>

                        @php
                            $sessionId = request('session_id');
                        @endphp

                        @if ($sessionId) 
                        <!-- Add an ID to the download link for easy reference in JavaScript -->
                        <a id="downloadInvoiceLink" href="#">Download Invoice</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <script>
        // Create a hidden link
        var link = document.createElement('a');
        link.style.display = 'none';

        // Set the href attribute to the PDF data
        link.href = 'data:application/pdf;base64,{{ base64_encode($pdfContent) }}';

        // Set the download attribute with the desired filename
        link.download = 'invoice.pdf';

        // Append the link to the body
        document.body.appendChild(link);

        // Get the download link element by ID
        var downloadLink = document.getElementById('downloadInvoiceLink');

        // Attach a click event to the link to trigger the download
        downloadLink.addEventListener('click', function(event) {
            // Prevent the default link behavior
            event.preventDefault();

            // Simulate a click on the hidden link to trigger the download
            link.click();
        });
    </script>

</body>

</html>