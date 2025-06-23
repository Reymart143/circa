<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kitchen Display</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .order-card {
      border-radius: 10px;
      padding: 15px;
      color: #000;
      min-height: 300px;
      margin-bottom: 20px;
    }
    .header-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px;
      background-color: #1d2a35;
      color: white;
      border-radius: 8px;
    }
    .order-meta {
      font-size: 14px;
      margin-bottom: 5px;
    }
    .order-time {
      font-size: 12px;
      opacity: 0.8;
    }
    .badge-time {
      position: absolute;
      top: 15px;
      right: 15px;
      border-radius: 30px;
      padding: 5px 12px;
    }
  </style>
</head>
<body style="background-color: #1d2a35;">

<div class="container mt-4">
  <!-- Header -->
  <div class="header-bar mb-4">
    <div>
      <h5 class="mb-0">     @php
                $preference = \App\Models\UserPreference::first();
                $logoPath = $preference && $preference->logo
                    ? asset($preference->logo)
                    : asset('assets/images/OroSMap.png');
            @endphp
            
            <img class="img-fluid rounded-circle nav-fit" id="avatar-Image" src="{{ $logoPath }}" alt="System Logo">
            
            
            <style>
                .nav-fit {
                    width: 50px;
                    height: 50px;
                    object-fit: cover;
                    border-radius: 50%;
                    border: 2px solid #ccc;
                }
            </style> eMenu Express</h5>
      
    </div>
    <div>
      <span class="badge bg-danger me-2">2 New</span>
      <span class="badge bg-warning text-dark me-2">1 Process</span>
      <span class="badge bg-success me-2">1 Ready</span>
      <span class="badge bg-secondary">28 Served</span>
    </div>
  </div>

  <!-- Orders Row -->
  <div class="row">
    <!-- Order Card 1 (Red - New) -->
  <div class="col-md-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header text-white bg-danger d-flex justify-content-between align-items-center">
        <div>
            <strong>📡 Table 5</strong><br>
            <small>Order #11613</small>
        </div>
        <span class="badge bg-light text-dark">5 mins</span>
        </div>
        <div class="card-body bg-white">
        <div class="text-muted mb-2" style="font-size: 12px;">01:52 PM • Dine In</div>
        <ul class="mb-3">
            <li>2x Crispy Chicken Burger <em>Regular</em></li>
            <li>1x Cheese Veg Wrap <em>Regular</em></li>
            <li>2x Coke <em>Medium</em></li>
        </ul>
        <button class="btn btn-dark btn-sm me-2">Start</button>
        <button class="btn btn-success btn-sm" disabled>Finish</button>
        </div>
    </div>
    </div>


    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header text-white bg-success d-flex justify-content-between align-items-center">
            <div>
                <strong>📡 Table 5</strong><br>
                <small>Order #11613</small>
            </div>
            <span class="badge bg-light text-dark">5 mins</span>
            </div>
            <div class="card-body bg-white">
            <div class="text-muted mb-2" style="font-size: 12px;">01:52 PM • Dine In</div>
            <ul class="mb-3">
                <li>2x Crispy Chicken Burger <em>Regular</em></li>
                <li>1x Cheese Veg Wrap <em>Regular</em></li>
                <li>2x Coke <em>Medium</em></li>
            </ul>
            <button class="btn btn-dark btn-sm me-2">Start</button>
            <button class="btn btn-success btn-sm" disabled>Finish</button>
            </div>
        </div>
        </div>


    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header text-white bg-info d-flex justify-content-between align-items-center">
            <div>
                <strong>📡 Table 5</strong><br>
                <small>Order #11613</small>
            </div>
            <span class="badge bg-light text-dark">5 mins</span>
            </div>
            <div class="card-body bg-white">
            <div class="text-muted mb-2" style="font-size: 12px;">01:52 PM • Dine In</div>
            <ul class="mb-3">
                <li>2x Crispy Chicken Burger <em>Regular</em></li>
                <li>1x Cheese Veg Wrap <em>Regular</em></li>
                <li>2x Coke <em>Medium</em></li>
            </ul>
            <button class="btn btn-dark btn-sm me-2">Start</button>
            <button class="btn btn-success btn-sm" disabled>Finish</button>
            </div>
        </div>
    </div>

  </div>
</div>

</body>
</html>
