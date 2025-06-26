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
    
    <section id="menu" class="menu section">
    <div class="d-flex justify-content-between align-items-center" style="margin-top: -50px;margin-left:3%;margin-bottom:2%">
        @if(Auth::check())
            <div>
                <span class="description-title" style="
                    color: #9c1d14;
                    font-size: 15px;
                    padding: 10px 20px;
                    background-color: #f8f9fa;
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                    border-radius: 10px;
                ">
                   <small><a href="/menu">View Menu</a></small> 
                </span>
            </div>
            @else
               {{-- <span class="description-title" style="
                    color: #9c1d14;
                    font-size: 15px;
                    padding: 10px 20px;
                    background-color: #f8f9fa;
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                    border-radius: 10px;
                ">
                    {{-- Hi , <small>Guest</small>  
                </span> --}}
                @endif

                  @if(Auth::check())
                <button id="logoutBtn" class="btn btn-danger" style="font-weight: bold; padding: 10px 20px; margin-right:2%"><i class="fa fa-sign-out-alt"></i></button>
                                                                    
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                
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
        @endif
    </div>
<style>
    /* body {
        background-color: #000;
        color: #fff;
        font-family: Arial, sans-serif;
    } */

    .order-title {
        font-size: 2rem;
        font-weight: bold;
        color: #000;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }

    .order-title.preparing {
        background-color: #f9f871;
        
    }

    .order-title.serving {
        background-color: #0e330e;
        color:white;
    }

    .order-section {
        margin-bottom: 2rem;
    }

    .order-header {
        display: flex;
        font-size: 1.2rem;
        font-weight: bold;
        color: #141414;
        justify-content: space-between;
        padding: 0 1rem;
    }

    .order-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        font-size: 1.8rem;
        font-weight: bold;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        background-color: #fff;
        color: #000;
        padding: 0.6rem 1rem;
        border-radius: 0.4rem;
    }

    @media (min-width: 768px) {
        .order-row {
            display: flex;
            justify-content: space-between;
            gap: 2rem;
        }

        .order-column {
            flex: 1;
        }
    }
</style>

<div class="container-fluid">
    <div class="order-row">
        <div class="order-column order-section">
            <div class="order-title preparing">Preparing...</div>
            <div class="order-header">
                <div>Order #</div>
                <div>Table #</div>
                <div>Time</div>
            </div>
            <div class="order-list" id="preparing-list"></div>
        </div>

        <div class="order-column order-section">
            <div class="order-title serving">Now Serving</div>
            <div class="order-header">
                <div>Order #</div>
                <div>Table #</div>
            </div>
            <div class="order-list" id="serving-list"></div>
        </div>
    </div>
</div>
    <script>
    function fetchOrdersAndRender() {
        fetch("{{ route('orders.json') }}")
            .then(response => response.json())
            .then(data => {
                const preparingList = document.getElementById("preparing-list");
                const servingList = document.getElementById("serving-list");
                preparingList.innerHTML = "";
                servingList.innerHTML = "";

                const now = Date.now();

                data.forEach(order => {
                    const status = parseInt(order.kitchen_status);
                    const timerMinutes = parseInt(order.timer) || 2;

                    const updatedAt = new Date(order.updated_at).getTime();
                    const endTime = updatedAt + timerMinutes * 60 * 1000;
                    const remaining = endTime - now;

                    const mins = Math.max(0, Math.floor(remaining / 60000));
                    const secs = Math.max(0, Math.floor((remaining % 60000) / 1000));
                    const timer = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;

                    if (status === 2) {
                        preparingList.innerHTML += `
                            <div class="order-item">
                                <div>${order.order_no}</div>
                                <div>${order.table_no}</div>
                                <div>${timer}</div>
                            </div>`;
                    } else if (status === 3) {
                        servingList.innerHTML += `
                            <div class="order-item">
                                <div>${order.order_no}</div>
                                <div>${order.table_no}</div>
                            </div>`;
                    }
                });
            });
    }

    setInterval(fetchOrdersAndRender, 1000);
    fetchOrdersAndRender();
    </script>

    </section><!-- /Menu Section -->

    
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