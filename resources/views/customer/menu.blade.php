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

  <!-- Vendor CSS Files -->
  <link href="assetsUsers/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assetsUsers/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assetsUsers/vendor/aos/aos.css" rel="stylesheet">
  <link href="assetsUsers/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assetsUsers/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
          <li><a href="/circa" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#menu">Menu</a></li>
          {{-- <li><a href="#events">Events</a></li> --}}
          {{-- <li><a href="#chefs">Chefs</a></li>
          <li><a href="#gallery">Gallery</a></li>
           --}}
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      {{-- <a class="btn-getstarted" href="index.html#book-a-table">Book a Table</a> --}}

    </div>
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
                    Hi , <small>{{ Auth::user()->f_name }}</small> 
                </span>
            </div>
        @endif

        <a href="" class="btn btn-warning" style="font-weight: bold; padding: 10px 20px;margin-right:2%">Your Order</a>
    </div>

   
   <div class="menu-header-wrapper" style="position: relative; text-align: center;">
    <img src="{{ asset('assets/images/pic.png') }}" alt="Chef" class="menu-image">
        <div class="container section-title">
            <p><span class="description-title">Menu</span></p>
        </div>
    </div>

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
    </style>

      <div class="container">

     <div class="category-wrapper">
        <ul class="category-scroll">
          <li class="category-item">
            <a href="#" class="category-tab active" data-category="all">
              <h4>All</h4>
            </a>
          </li>
          @foreach ($categories as $cat)
            <li class="category-item">
              <a href="#" class="category-tab" data-category="{{ $cat->id }}">
                <h4>{{ $cat->category_name }}</h4>
                {{-- <h6 class="text-success">{{ $cat->category_details }}</h6> --}}
              </a>
            </li>
          @endforeach
        </ul>
      </div>


       
        <script>
        $(document).ready(function () {
            $('.category-tab').on('click', function(e) {
                e.preventDefault();

                $('.category-tab').removeClass('active show');
                $(this).addClass('active show');

                const categoryId = $(this).data('category');
                
                $.ajax({
                    url: `/products-by-category/${categoryId}`,
                    method: 'GET',
                    success: function(products) {
                    
                        let html = '<div class="row gy-5">';
                        if (products.length === 0) {
                            html += '<p>No products found in this category.</p>';
                        } else {
                            products.forEach(food => {
                            html += `
                                <div class="col-12 col-md-6 col-lg-4">
                                  <div class="product-card d-flex align-items-start p-3 shadow-sm rounded gap-3 flex-nowrap">
                                    <div class="product-image">
                                      ${food.discount ? `<div class="discount-badge">-${food.discount}%</div>` : ''}
                                      <a href="${food.image ? food.image : '#'}" class="glightbox">
                                        <img src="${food.image ? food.image : '#'}" class="img-fluid rounded" alt="" />
                                      </a>
                                    </div>
                                    <div class="product-info">
                                      <h5 class="product-name mb-1">${food.product_name}</h5>
                                      <p class="mb-1 text-muted small"> ${food.description}</p>
                                      <p class="mb-1 text-muted small"><strong>Available Time:</strong> ${food.start_time || '--'} - ${food.end_time || '--'}</p>
                                      <p class="text-danger fw-bold">₱ ${parseFloat(food.price).toFixed(2)}</p>
                                    </div>
                                    <button class="btn btn-primary add-to-cart" data-id="${food.id}"> + </button>
                                  </div>
                                </div>
                              `;


                            });
                        }
                        html += '</div>';

                        $('#product-container').html(html);
                    },
                    error: function() {
                        alert('Failed to fetch products.');
                    }
                });
            });
        });
        </script>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
          <div class="tab-pane fade active show" id="menu-starters">
            <div class="tab-header text-center">
              {{-- <p>Menu</p> --}}
              {{-- <h3>Starters</h3> --}}
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
            <div id="product-container" class="tab-content" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">
                @foreach ($products as $food)
                  <div class="col-12 col-md-6 col-lg-4">
                    <div class="product-card d-flex align-items-start p-2 shadow-sm rounded">
                      <div class="product-image me-3">
                        <div class="discount-badge">-{{ $food->discount }}%</div>
                        <a href="{{ $food->image ? asset($food->image) : $food->image }}" class="glightbox">
                          <img src="{{ $food->image ? asset($food->image) : $food->image }}" alt="" class="img-fluid rounded">
                        </a>
                      </div>
                      <div class="product-info">
                        <h5 class="product-name mb-1">{{ $food->product_name }}</h5>
                        <p class="mb-1 text-muted small">{{ $food->description }}</p>
                        <p class="mb-1 text-muted small"><strong>Available Time:</strong> {{ $food->start_time }} - {{ $food->end_time }}</p>
                        <p class="text-danger fw-bold">₱ {{ number_format($food->price, 2) }}</p>
                      </div>

                       <button class="btn btn-primary add-to-cart" > + </button>
                    </div>
                   
                  </div>
                @endforeach
              </div>
            </div>
            <script>
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

            </script>
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