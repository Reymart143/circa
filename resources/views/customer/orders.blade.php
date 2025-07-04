<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .order-card {
            border: 4px solid #5c0000;
            border-radius: 15px;
            padding: 50px 30px;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        .order-title {
            font-size: clamp(40px, 8vw, 80px);
            color: #5c0000;
            font-weight: bold;
            margin: 0;
        }
        .sub-title {
            margin-top: 20px;
            font-size: 20px;
            color: #333;
        }
    </style>
</head>
<body style="background-color: #f8f9fa;">

    <div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">

        <!-- Logo and Title -->
        <div class="text-center mb-4">
            @php
                $preference = \App\Models\UserPreference::first();
                $logoPath = $preference && $preference->logo
                    ? asset($preference->logo)
                    : asset('assets/images/OroSMap.png');
            @endphp

            <img class="img-fluid nav-fit mb-2" id="avatar-Image" src="{{ $logoPath }}" alt="System Logo">
            <h5 class="sitename fw-bold" style="color: #5c0000;">eMenu Express</h5>
        </div>

        <!-- Order Note -->
       <div class="order-card">
        Note: Please wait for the staff to get your payment .
       <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: calc(40vh - 150px); margin-top: 50px;">
            <div class="card shadow text-center p-4" style="max-width: 90%; border: 3px solid #5c0000;">
                
                 @if($table_no == 0)
                    <small> Take Out</small>
                    @else
                     <small>Table No: 
                        {{$table_no  }}    </small>
                    @endif
            
                <small>Your Order Number:</small>
                <h1 class="fw-bold" style="font-size: clamp(30px, 8vw, 70px); color: #5c0000;">{{ $order_no }}</h1>
            </div>
        </div>
        <a href="/menu" class="btn btn-success mt-4"><i class="fa fa-arrow-left"></i> Order More </a>
        <a href="/ordertime" class="btn btn-secondary mt-4"><i class="fa fa-clock"></i> Track Order </a>
        <div class="sub-title">
            Thank you for your order!
        </div>
    </div>

    </div>

    <style>
        .nav-fit {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #5c0000;
        }
    </style>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
