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
    pointer-events: none;
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
      <h5 class="sitename" style="color:white !important">    
         @php
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
    
       <button class="btn btn-warning position-relative" style="font-weight: bold; padding: 10px 20px; margin-right:2%" data-bs-toggle="modal" data-bs-target="#orderModal" id="viewOrderButton">
          View Order
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartCountBadge" style="display: none;">
              0
          </span>
      </button>
   
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
                    Hi , <small><a href="/userProfile">{{ Auth::user()->f_name }}</a></small> 
                   
                </span>
                 <a href="/ordertime" class="btn btn-secondary" style="margin-left:5mm"  >
                      <i class="fa fa-clock me-1" ></i> 
                    </a>
            </div>
            @else
               <span class="description-title" style="
                    color: #9c1d14;
                    font-size: 15px;
                    padding: 10px 20px;
                    background-color: #f8f9fa;
                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                    border-radius: 10px;
                ">
                    Hi , <small>Guest</small> 
                </span>
                 <a href="/ordertime" class="btn btn-secondary" style="margin-right:5mm"  >
                      <i class="fa fa-clock me-1" ></i> 
                    </a>
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

   
   {{-- <div class="menu-header-wrapper" style="position: relative; text-align: center;">
    <img src="{{ asset('assets/images/pic.png') }}" alt="Chef" class="menu-image">
        <div class="container section-title " >
            <p><span class="description-title">Menu</span></p>
        </div>
    </div> --}}

    <style>
    .menu-header-wrapper {
        position: relative; 
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .menu-image {
        position: absolute;
        top: -1px;
        height: 80px;
        z-index: 10; /* make sure it's above the text */
    }

    .section-title {
        position: relative;
        z-index: 1; /* text below the image */
        padding-top: 50px; /* give space for the image */
    }

    @media (max-width: 768px) {
        .menu-image {
            top: -1px;
            height: 60px;
        }
        .section-title {
            padding-top: 40px;
        }
    }

    @media (max-width: 480px) {
        .menu-image {
            top: -40px;
            height: 100px;
        }
        .section-title {
            padding-top: 30px;
        }
    }
    .fly-image {
        position: absolute;
        z-index: 9999;
        transition: transform 1s ease-in-out, opacity 1s;
    }
    </style>

  <div class="container">
    <small class="text-primary">Note: Click the 'View Order' button above for final order !</small>
    <style>
      .category-wrapper {
  white-space: nowrap;
  overflow-x: auto;
  padding-bottom: 10px;
}

.category-scroll {
  list-style: none;
  padding: 0;
  margin: 0;
}

.category-item {
  display: inline-block;
  text-align: center;
  flex: 0 0 auto;
}

.category-tab {
  text-decoration: none;
  color: #444;
  display: inline-block;
  transition: transform 0.3s ease;
}

.category-tab.active .circle-tab {
  border: 3px solid #ff5c5c;
  transform: scale(1.1);
}

.circle-tab {
  width: 70px;
  height: 70px;
  background-color: #fff;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto 5px;
  border: 2px solid #ddd;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: 0.3s;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.circle-tab img {
  width: 100%;
  height: auto;
  object-fit: cover;
  border-radius: 50%;
}

.category-tab:hover .circle-tab {
  transform: scale(1.1);
  border-color: #ff5c5c;
}

    </style>
<div class="category-wrapper px-2 mt-4">
    <ul class="category-scroll d-flex gap-3 overflow-auto flex-nowrap">
        @foreach ($mainCategories as $main)
            <li class="category-item text-center">
                <a href="#" class="category-tab {{ $loop->first ? 'active' : '' }}" data-category="{{ $main->id }}">
                    <div class="circle-tab">
                        <img src="{{ $logoPath }}" alt="{{ $main->main_name }}">
                    </div>
                    <small>{{ $main->main_name }}</small>
                    <br>
                    @php
                       $timeRange = ($main->start_time && $main->end_time)
                          ? Carbon\Carbon::createFromFormat('H:i:s', $main->start_time)->format('g:i A') . ' - ' . Carbon\Carbon::createFromFormat('H:i:s', $main->end_time)->format('g:i A')
                          : 'Available Anytime';
                  @endphp

                  <small style="font-size:3mm">{{ $timeRange }}</small>
                </a>
            </li>
        @endforeach
    </ul>
</div>

<div id="product-container" class="px-3 mt-4"></div>

<script>
  $(document).ready(function () {
    function formatTime(timeStr) {
        if (!timeStr) return '--';
        const [hours, minutes] = timeStr.split(':');
        const h = parseInt(hours);
        const m = parseInt(minutes);
        const ampm = h >= 12 ? 'PM' : 'AM';
        const hour12 = h % 12 === 0 ? 12 : h % 12;
        return `${hour12}:${m.toString().padStart(2, '0')} ${ampm}`;
    }

    function bindCategoryClick() {
        $('.category-tab').off('click').on('click', function(e) {
            e.preventDefault();

            $('.category-tab').removeClass('active');
            $(this).addClass('active');

            const mainCategoryId = $(this).data('category');

            $.ajax({
                url: `/main-category/${mainCategoryId}/categories`,
                method: 'GET',
                success: function(response) {
                    let html = '';

                    if (!response.data || response.data.length === 0) {
                        html += '<p class="text-danger">No categories/products available.</p>';
                    } else {
                        response.data.forEach(section => {
                            html += `<h5 class="mt-4 mb-2">${section.category}</h5>`;
                            html += `<div class="row gy-5">`;

                            section.products.forEach(food => {
                                html += `
                                    <div class="col-12 col-md-6 col-lg-4">
                                      <div class="product-card d-flex align-items-start p-3 shadow-sm rounded gap-3 flex-nowrap">
                                        <div class="product-image">
                                          <a href="${food.image ?? '#'}" class="glightbox">
                                            <img src="${food.image ?? '#'}" class="img-fluid rounded" alt="" />
                                          </a>
                                        </div>
                                        <div class="product-info">
                                          <h5 class="product-name mb-1">${food.product_name}</h5>
                                          <p class="mb-1 text-muted small">${food.description || 'No Added Description'}</p>
                                          <p class="text-danger fw-bold">₱ ${parseFloat(food.price).toFixed(2)}</p>
                                        </div>
                                        <button class="btn btn-primary add-to-cart" data-id="${food.id}"> + </button>
                                      </div>
                                    </div>`;
                            });

                            html += `</div>`;
                        });
                    }

                    $('#product-container').html(html);
                },
                error: function() {
                    alert('Failed to fetch products.');
                }
            });
        });
    }

    function fetchUpdatedCategories() {
        $.ajax({
            url: '/main-categories',
            method: 'GET',
            success: function (mainCategories) {
                const currentActive = $('.category-tab.active').data('category');
                let html = '';

                mainCategories.forEach((main, index) => {
                    const start = main.start_time ?? '';
                    const end = main.end_time ?? '';
                    const activeClass = main.id == currentActive ? 'active' : '';

                    let timeRange = (start && end)
                        ? formatTime(start) + ' - ' + formatTime(end)
                        : 'Available Anytime';

                    html += `
                        <li class="category-item text-center">
                            <a href="#" 
                               class="category-tab ${activeClass}" 
                               data-category="${main.id}"
                               data-start="${start}"
                               data-end="${end}">
                                <div class="circle-tab">
                                    <img src="${logoPath}" alt="${main.main_name}">
                                </div>
                                <small>${main.main_name}</small><br>
                                <small style="font-size:3mm">${timeRange}</small>
                            </a>
                        </li>`;
                });

                $('.category-scroll').html(html);

                bindCategoryClick();

                if ($(`.category-tab[data-category="${currentActive}"]`).length) {
                    $(`.category-tab[data-category="${currentActive}"]`).trigger('click');
                } else {
                    $('.category-tab').first().trigger('click');
                }
            },
            error: function () {
                console.error("Failed to update main categories.");
            }
        });
    }

    bindCategoryClick();

    $('.category-tab.active').trigger('click');

    setInterval(fetchUpdatedCategories, 1000);
});

</script>
<script> const logoPath = @json($logoPath); </script>
{{--        
      <script>
$(document).ready(function () {
    function formatTime(timeStr) {
        if (!timeStr) return '--';
        const [hours, minutes] = timeStr.split(':');
        const h = parseInt(hours);
        const m = parseInt(minutes);
        const ampm = h >= 12 ? 'PM' : 'AM';
        const hour12 = h % 12 === 0 ? 12 : h % 12;
        return `${hour12}:${m.toString().padStart(2, '0')} ${ampm}`;
    }

    $('.category-tab').on('click', function(e) {
        e.preventDefault();

        $('.category-tab').removeClass('active');
        $(this).addClass('active');

        const mainCategoryId = $(this).data('category');

        $.ajax({
            url: `/main-category/${mainCategoryId}/categories`,
            method: 'GET',
            success: function(response) {
                let html = '';

                if (!response.data || response.data.length === 0) {
                    html += '<p class="text-danger">No categories/products available.</p>';
                } else {
                    response.data.forEach(section => {
                        html += `<h5 class="mt-4 mb-2">${section.category}</h5>`;
                        html += `<div class="row gy-5">`;

                        section.products.forEach(food => {
                            html += `
                                <div class="col-12 col-md-6 col-lg-4">
                                  <div class="product-card d-flex align-items-start p-3 shadow-sm rounded gap-3 flex-nowrap">
                                    <div class="product-image">
                                      <a href="${food.image ?? '#'}" class="glightbox">
                                        <img src="${food.image ?? '#'}" class="img-fluid rounded" alt="" />
                                      </a>
                                    </div>
                                    <div class="product-info">
                                      <h5 class="product-name mb-1">${food.product_name}</h5>
                                      <p class="mb-1 text-muted small">${food.description || 'No Added Description'}</p>
                                      <p class="text-danger fw-bold">₱ ${parseFloat(food.price).toFixed(2)}</p>
                                    </div>
                                    <button class="btn btn-primary add-to-cart" data-id="${food.id}"> + </button>
                                  </div>
                                </div>
                            `;
                        });

                        html += `</div>`;
                    });
                }

                $('#product-container').html(html);
            },
            error: function() {
                alert('Failed to fetch products.');
            }
        });
    });

            const activeTab = $('.category-tab.active').data('category');
                if (activeTab !== undefined) {
                    $('.category-tab[data-category="' + activeTab + '"]').trigger('click');
                }
  });
  </script> --}}

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
          <div class="tab-pane fade active show" id="menu-starters">
            <div class="tab-header text-center">
       
            </div>
         <style>
            .food-fit {
                width: 500px;
                height: 150px;
                object-fit: cover; 
                border-radius: 10%; 
                border: 2px solid #ccc;
            }

        </style>
            {{-- <div id="product-container" class="tab-content" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">
                @foreach ($products as $food)
                  <div class="col-12 col-md-6 col-lg-4">
                    <div class="product-card d-flex align-items-start p-2 shadow-sm rounded">
                      <div class="product-image me-3">
                        
                        <a href="{{ $food->image ? asset($food->image) : $food->image }}" class="glightbox">
                          <img src="{{ $food->image ? asset($food->image) : $food->image }}" alt="" class="img-fluid rounded">
                        </a>
                      </div>
                      <div class="product-info">
                        <h5 class="product-name mb-1">{{ $food->product_name }}</h5>
                        <p class="mb-1 text-muted small">{{ $food->description }}</p>
                        <p class="mb-1 text-muted small">
                          <strong>Available Time:</strong>
                          {{ $food->start_time ? \Carbon\Carbon::parse($food->start_time)->format('g:i A') : '--' }} -
                          {{ $food->end_time ? \Carbon\Carbon::parse($food->end_time)->format('g:i A') : '--' }}
                        </p>


                        <p class="text-danger fw-bold">₱ {{ number_format($food->price, 2) }}</p>
                      </div>

                       <button class="btn btn-primary add-to-cart" data-id="{{ $food->id }}"> + </button>
                    </div>
                   
                  </div>
                @endforeach
              </div>
            </div> --}}
            <style>
              @media (max-width: 576px) {
                .modal-body table {
                  font-size: 13px;
                }
                .modal-body h5 {
                  font-size: 16px;
                }
              }
              </style>  

            <!-- Order Modal -->
      <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #5c0000;color:white !important">
              <h5 class="modal-title text-white" id="orderModalLabel">Your Order</h5>
           
            </div>
            <div class="modal-body">
              <div id="orderCardsContainer" class="row gy-3"></div>
              <h5 class="text-end mt-3" >Total: ₱ <span id="orderTotal" style="border: 1px solid #ccc; background-color: #107a29; color: rgb(255, 255, 255); padding: 5px 10px; border-radius: 5px;">0.00</span></h5>
              <div class="row">
                
             <div class="form-group col-md-6">
                <label>Dine Option</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="order_type" id="dine_in" value="0">
                    <label class="form-check-label" for="dine_in">Dine In</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="order_type" id="take_out" value="1">
                    <label class="form-check-label" for="take_out">Take Out</label>
                </div>
            </div>

              <div class="form-group col-md-6" id="table_no_wrapper">
                  <label for="table_no">Your Table Number?</label>
                  <select name="table_no" id="table_no" class="form-control">
                      <option value="">Select table</option>
                      @for ($i = 1; $i <= 6; $i++)
                          <option value="{{ $i }}">{{ $i }}</option>
                      @endfor
                  </select>
              </div>

              <script>
              document.addEventListener("DOMContentLoaded", function () {
                  const dineIn = document.getElementById('dine_in');
                  const takeOut = document.getElementById('take_out');
                  const tableNo = document.getElementById('table_no');
                  const tableWrapper = document.getElementById('table_no_wrapper');

                  function updateTableNoField() {
                      if (takeOut.checked) {
                          tableNo.innerHTML = '<option value="0" selected>0</option>';
                          tableWrapper.style.display = 'none';
                      } else {
                          tableWrapper.style.display = 'block';

                          fetch('/get-available-tables')
                              .then(response => {
                                  if (!response.ok) {
                                      throw new Error('Network response was not ok');
                                  }
                                  return response.json();
                              })
                              .then(data => {
                                  let options = '<option value="">Select table</option>';
                                  if (data.length === 0) {
                                      options += '<option disabled>No available tables today</option>';
                                  } else {
                                      data.forEach(num => {
                                          options += `<option value="${num}">${num}</option>`;
                                      });
                                  }
                                  tableNo.innerHTML = options;
                              })
                              .catch(error => {
                                  console.error('Error fetching table numbers:', error);
                                  tableNo.innerHTML = '<option disabled>Error loading tables</option>';
                              });
                      }
                  }

                  dineIn.addEventListener('change', updateTableNoField);
                  takeOut.addEventListener('change', updateTableNoField);

                  updateTableNoField(); // initial check
              });
              </script>



            </div>
          @if(Auth::check())
                <div class="form-group mt-2">
                    <div class="form-group d-flex align-items-center gap-2">
                      <label for="user_points" class="mb-0">Your Points</label>
                      <input type="text" id="user_points" class="form-control form-control-sm bg-warning text-white" style="width: 80px;" value="{{ number_format(Auth::user()->points ?? 0, 1) }}" readonly>
                  </div>

                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" id="usePointsCheckbox">
                        <label class="form-check-label" for="usePointsCheckbox">Use my points for this order</label>
                    </div>
                    <input type="hidden" id="auth_user" value="1">
                    <input type="hidden" id="user_available_points" value="{{ number_format(Auth::user()->points, 2, '.', '') }}">
                </div>
            @else
                <input type="hidden" id="auth_user" value="0">
                <input type="hidden" id="user_available_points" value="0">
            @endif

            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"> Add Order</button>
              <button type="button" class="btn btn-primary" id="placeOrderBtn">Send to Cashier </button>
            </div>
          </div>
        </div>
      </div>
      <style>
      @media (max-width: 576px) {
        .card {
          font-size: 12px;
        }
      }
      </style>

        <script>
          $(document).ready(function () {
            $(document).on('change', '#usePointsCheckbox', function () {
                updateOrderCards();
            });

            $('#orderModal').on('shown.bs.modal', function () {
                updateOrderCards();

                const userPoints = parseFloat($('#user_available_points').val()) || 0;
                if (userPoints <= 0) {
                    $('#usePointsCheckbox').prop('disabled', true);
                }
            });
        });

        </script>
          <script>
             let orders = [];
            $(document).on('click', '.add-to-cart', function () {
                const button = $(this);
                const productCard = button.closest('.product-card');
                const id = button.data('id');
                const name = productCard.find('.product-name').text();
                const priceText = productCard.find('.text-danger').text().replace('₱','').trim();
                const price = parseFloat(priceText.replace(',',''));
                const image = productCard.find('img').attr('src');

                const size = 'Small';
                const flavor = 'Spicy';

                const existing = orders.find(item => item.id === id);
                if (existing) {
                    existing.quantity += 1;
                } else {
                    orders.push({ id, name, price, quantity: 1, image, size, flavor });
                }

                updateOrderCards();
                updateCartCount();

                const flyImg = $('<img>', {
                    src: image,
                    class: 'fly-image',
                    css: {
                        width: '80px',
                        height: '80px',
                        borderRadius: '10px',
                        top: productCard.offset().top,
                        left: productCard.offset().left,
                        position: 'absolute',
                        zIndex: 9999,
                        opacity: 1
                    }
                }).appendTo('body');

                const target = $('#viewOrderButton');

                flyImg.css({
                    transform: `translate(${target.offset().left - productCard.offset().left}px, ${target.offset().top - productCard.offset().top}px) scale(0.1)`,
                    transition: 'transform 1s ease-in-out, opacity 1s'
                });

                setTimeout(() => {
                    flyImg.remove();
                }, 1000);
            });

         function updateOrderCards() {
            let html = '';
            let total = 0;

            orders.forEach((item, index) => {
                const subtotal = item.price * item.quantity;
                total += subtotal;

                html += `
                    <div class="col-12 mb-2" data-index="${index}">
                        <div class="card shadow-sm p-2 d-flex flex-row align-items-start">
                            <img src="${item.image}" class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover; border: 1px solid #ccc;">
                            <div class="flex-grow-1" style="font-size: 13px;">
                                <div class="d-flex justify-content-between">
                                    <div><strong>${item.name}</strong></div>
                                    <div>Size: ${item.size}</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>Price: ₱ ${item.price.toFixed(2)}</div>
                                    <div>Flavor: ${item.flavor}</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <label class="me-2 mb-0">Qty:</label>
                                        <input type="number" class="form-control quantity-input form-control-sm" value="${item.quantity}" min="1" style="width: 70px;">
                                    </div>
                                    <div style="border: 1px solid #ccc; background-color: #d4edda; color: black; padding: 5px 10px; border-radius: 5px;">
                                        <strong> ₱ ${subtotal.toFixed(2)}</strong>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-danger btn-sm remove-item mt-1">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            const isAuth = $('#auth_user').val() == '1';
            const usePoints = $('#usePointsCheckbox').is(':checked');
            const userPoints = parseFloat($('#user_available_points').val()) || 0;

            let discountedTotal = total;
            if (isAuth && usePoints && userPoints > 0) {
                discountedTotal = total - userPoints;
                if (discountedTotal < 0) discountedTotal = 0;
            }

            $('#orderCardsContainer').html(html);
            $('#orderTotal').text(discountedTotal.toFixed(2));
            updateCartCount();
        }


            $(document).on('change', '.quantity-input', function () {
                const index = $(this).closest('.col-12').data('index');
                const newQty = parseInt($(this).val());
                orders[index].quantity = newQty > 0 ? newQty : 1;
                updateOrderCards();
            });

            $(document).on('click', '.remove-item', function () {
                const index = $(this).closest('.col-12').data('index');
                orders.splice(index, 1);
                updateOrderCards();
            });

            $('#placeOrderBtn').on('click', function() {
                if (orders.length === 0) {
                        Swal.fire({
                          title: 'No orders to submit',
                          icon: 'warning',
                      });
                    return;
                }
                const tableNo = $('#table_no').val(); 
                const orderType = $('input[name="order_type"]:checked').val(); 
                const usePoints = $('#usePointsCheckbox').is(':checked');
                const usedPoints = usePoints ? parseFloat($('#user_available_points').val()) : 0;
                $.ajax({
                    url: '/submit-order',  
                    method: 'POST',
                    data: {
                        orders: orders,
                        table_no: tableNo,
                        order_type: orderType,
                        used_points: usedPoints,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href = response.redirect_url;
                    },
                 
                    error: function(xhr) {
                        let message = 'Something went wrong.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            title: message,
                            icon: 'warning',
                            confirmButtonText: 'OK',
                            customClass: {
                                popup: 'responsive-swal',
                                title: 'text-wrap',
                            }
                        });
                    }
                });
            });

            function updateCartCount() {
                let totalCount = orders.reduce((sum, item) => sum + item.quantity, 0);
                if (totalCount > 0) {
                    $('#cartCountBadge').text(totalCount).show();
                } else {
                    $('#cartCountBadge').hide();
                }
            }


          </script>

            {{-- <script>
              $(document).on('click', '.add-to-cart', function() {
                const productId = $(this).data('id');
                
                $.ajax({
                    url: '/add-to-cart',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: 1, // default quantity
                        _token: ' {{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Product added to cart!');
                        // Optionally update cart count, etc.
                    },
                    error: function() {
                        alert('Failed to add to cart.');
                    }
                });
            });

            </script> --}}
            <style>
                .product-card {
                  background: #fff;
                  border-radius: 12px;
                  display: flex;
                  gap: 12px;
                  height: 100%;
                  min-height: 120px;
                }

                .product-image {
                  position: relative;
                  width: 100px;
                  min-width: 100px;
                  flex-shrink: 0;
                }

                .product-image img {
                  width: 100%;
                  height: 100px;
                  object-fit: cover;
                  border-radius: 10px;
                }

                .discount-badge {
                  position: absolute;
                  top: 5px;
                  left: 5px;
                  background-color: #ff4d4f;
                  color: #fff;
                  font-size: 0.75rem;
                  padding: 2px 6px;
                  border-radius: 6px;
                  z-index: 1;
                }

                .product-info {
                  flex: 1;
                  display: flex;
                  flex-direction: column;
                  justify-content: space-between;
                }

                .product-name {
                  font-size: 1.1rem;
                  font-weight: 600;
                }

                .price {
                  font-size: 1rem;
                  font-weight: bold;
                  color: #d32f2f;
                }

                /* Optional spacing tweaks for tablets */
                @media (min-width: 768px) {
                  .product-card {
                    padding: 16px;
                  }
                }

            </style>
          </div><!-- End Starter Menu Content -->


        </div>

      </div>

    </section><!-- /Menu Section -->

 

  </main>

 {{-- <footer id="footer" class="footer dark-background">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div class="address">
            <h4>Address</h4>
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p></p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact</h4>
            <p>
              <strong>Phone:</strong> <span>+1 5589 55488 55</span><br>
              <strong>Email:</strong> <span>info@example.com</span><br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <strong>Mon-Sat:</strong> <span>11AM - 23PM</span><br>
              <strong>Sunday</strong>: <span>Closed</span>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Yummy</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
      </div>
    </div>

  </footer>  --}}

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