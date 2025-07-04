<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Circa- eMenu Express</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assetsUsers/img/favicon.png" rel="icon">
  <link href="assetsUsers/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet"> --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Vendor CSS Files -->
  <link href="assetsUsers/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assetsUsers/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assetsUsers/vendor/aos/aos.css" rel="stylesheet">
  <link href="assetsUsers/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assetsUsers/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Main CSS File -->
  <link href="assetsUsers/css/main.css" rel="stylesheet">
</head>
<style>
  .menu-item .card-wrapper {
    position: relative;
    border: 2px solid transparent;
    transition: transform 0.3s ease, border-color 0.3s ease;
    padding: 15px;
    border-radius: 10px;
    background: white;
}

.menu-item .discount-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background-color: red;
    color: white;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 50px;
    font-size: 0.85rem;
    z-index: 10;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    pointer-events: none; /* So the badge doesn’t interfere with clicks */
}

/* Zoom and border color on hover */
.menu-item .card-wrapper:hover {
    transform: scale(1.05);
    border-color: red;
    cursor: pointer;
}
.category-wrapper {
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  white-space: nowrap;
  padding: 10px 0;
  background-color: #fff;
}

.category-scroll {
  display: flex;
  flex-wrap: nowrap;
  list-style: none;
  padding-left: 10px;
  margin: 0;
  gap: 12px;
}

.category-item {
  flex: 0 0 auto;
  text-align: center;
}

.category-tab {
  display: block;
  padding: 10px;
  border-radius: 12px;
  background: #f5f5f5;
  color: #333;
  text-decoration: none;
  min-width: 80px;
  transition: background 0.3s;
}

.category-tab.active,
.category-tab:hover {
  background: #f5e2e1;
  color: #2e7d32;
  font-weight: bold;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

</style>
<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top" style="background-color: #5c0000;color;white !important">
    <div class="container position-relative d-flex align-items-center justify-content-between tex">

      <a href="/circa" class="logo d-flex align-items-center me-auto me-xl-0">
      <div>
      <h5 class="sitename" style="color:white !important">     @php
                $preference = \App\Models\UserPreference::first();
                $logoPath = $preference && $preference->logo
                    ? asset($preference->logo)
                    : asset('assets/images/OroSMap.png');
            @endphp
            
            <img class="img-fluid rounded-circle nav-fit" id="avatar-Image" src="{{ $logoPath }}" alt="System Logo">
            
            
            <style>
                .nav-fit {
                    width: 50px;
                    height: 70px;
                    object-fit: cover;
                    border-radius: 50%;
                    border: 2px solid #ccc;
                }
            </style> eMenu Express</h5>
      
    </div>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul class="text-white" >
          {{-- <li><a href="/circa" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#menu">Menu</a></li> --}}
          {{-- <li><a href="#events">Events</a></li> --}}
          {{-- <li><a href="#chefs">Chefs</a></li>
          <li><a href="#gallery">Gallery</a></li>
           --}}
          {{-- <li><a href="#contact">Contact</a></li> --}}
        </ul>
        <i class="mobile-nav-toggle d-xl-none"></i>
      </nav>

      {{-- <a class="btn-getstarted" href="index.html#book-a-table">Book a Table</a> --}}
      

    </div>
       {{-- <button class="btn btn-warning position-relative" style="font-weight: bold; padding: 10px 20px; margin-right:2%" data-bs-toggle="modal" data-bs-target="#orderModal" id="viewOrderButton">
          View Order
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartCountBadge" style="display: none;">
              0
          </span>
      </button> --}}
   
  </header>

  <main class="main">
 @php
    $user = Auth::user();
    $points = $user->points ?? 0;
    $maxPoints = 100;
    $percent = min(100, round(($points / $maxPoints) * 100));

    $level = floor($points / $maxPoints); // Example: 85 points = Level 0, 120 = Level 1
    $preference = \App\Models\UserPreference::first();
    $logoPath = $preference && $preference->logo
        ? asset($preference->logo)
        : asset('assets/images/OroSMap.png');
@endphp

<style>
    .profile-header {
        background: linear-gradient(145deg, #0c1b3f, #182d59);
        padding: 30px 20px;
        border-bottom-left-radius: 40px;
        border-bottom-right-radius: 40px;
        text-align: center;
        color: #fff;
        position: relative;
    }

    .profile-logo {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .profile-level {
        color: #ccc;
        font-size: 14px;
    }

    .menu-actions {
        position: absolute;
        top: 20px;
        width: 100%;
        left: 0;
        padding: 0 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .menu-actions a,
    .menu-actions button {
        font-weight: bold;
        padding: 8px 16px;
        border-radius: 20px;
        border: none;
        font-size: 14px;
        color: #fff;
        text-decoration: none;
    }

    .btn-menu {
        background-color: #ffc107;
        color: #1b1b1b;
    }

    .btn-menu:hover {
        background-color: #e0b900;
    }

    .btn-logout {
        background-color: #dc3545;
    }

    .btn-logout:hover {
        background-color: #bb2d3b;
    }

    .points-section {
        background-color: #fff;
        margin-top: -30px;
        border-radius: 30px 30px 0 0;
        padding: 30px 20px;
        text-align: center;
    }

    .circle-progress {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: conic-gradient(#ffc107 {{ $percent }}%, #e9ecef {{ $percent }}%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: bold;
        margin: 20px auto;
        color: #000;
    }

    .skills-legend {
        display: flex;
        justify-content: space-around;
        margin-top: 15px;
    }

    .legend-yellow { color: #ffc107; font-size: 14px; }
    .legend-dark { color: #0c1b3f; font-size: 14px; }
    .legend-light { color: #adb5bd; font-size: 14px; }

    .stat-box {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 15px;
        margin-top: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-box i {
        font-size: 24px;
        color: #198754;
    }

    .stat-value {
        font-size: 20px;
        font-weight: bold;
        color: #000;
    }

    .stat-label {
        font-size: 14px;
        color: #666;
    }

    @media (max-width: 768px) {
        .menu-actions {
            flex-direction: column;
            gap: 10px;
            top: 10px;
        }
    }
</style>

<section class="profile-header">
    {{-- Header Actions --}}
    <div class="menu-actions">
        <div class="d-flex justify-content-between align-items-center px-4" style="position: absolute; top: 10px; width: 100%;">
            <a href="/menu" class="btn btn-info fw-bold d-flex align-items-center px-3 py-2 rounded-pill shadow-sm">
                View Menu
            </a>
            <button id="logoutBtn" class="btn btn-danger fw-bold d-flex align-items-center px-3 py-2 rounded-pill shadow-sm">
                <i class="fa fa-sign-out-alt me-2"></i> Logout
            </button>
        </div>


        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    {{-- Profile --}}
    <img src="{{ $logoPath }}" alt="Logo" class="profile-logo">
    <h5 class="mt-2 mb-0 text-white">{{ $user->f_name ?? 'User' }} {{ $user->l_name ?? '' }}</h5>
    {{-- <small class="profile-level">Level {{ $level }}</small> --}}
</section>

<div class="points-section">
    <p class="text-muted mb-1 mt-2 " style="font-weight:bold">Your Points</p>
    {{-- <p class="small text-success">+{{ rand(10, 30) }} since last week</p> --}}
     <div class="fw-bold text-dark" style="font-size: 18px;">
         {{ number_format($user->points ?? 0) }}
     </div>
    <div class="circle-progress">
        {{-- {{ $points }} --}}
    </div>


    <div class="stat-box mt-4">
        <i class="fa fa-receipt"></i>
        <div>
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
    </div>
</div>

<script>
    document.getElementById('logoutBtn').addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, logout',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-success mx-2',
                cancelButton: 'btn btn-danger mx-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>

    
  </main>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assetsUsers/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assetsUsers/vendor/php-email-form/validate.js"></script>
  <script src="assetsUsers/vendor/aos/aos.js"></script>
  <script src="assetsUsers/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assetsUsers/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assetsUsers/vendor/swiper/swiper-bundle.min.js"></script>
  
  <!-- Main JS File -->
  <script src="assetsUsers/js/main.js"></script>

</body>

</html>