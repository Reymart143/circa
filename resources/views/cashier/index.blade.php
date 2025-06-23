<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<<<<<<< HEAD
  <title>Kitchen Display</title>
=======
  <title>Cashier Display</title>
>>>>>>> ba3da6ef301860262896a0370b6d45bdf4309bd5
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
      <link rel="stylesheet" href="../assets/css/base.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<body style="background-color: #ffffff;">

<div class="container-fluid mt-4">
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
      <a href="" class="btn btn-danger"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>
<div class="row mb-2 mt-2">
    <div class="col-md-8">
        <label for=""> Search by Categories: </label>
        <span class="badge badge-primary category-filter active" data-category="" 
              style="cursor: pointer; padding:5mm; border: 2px solid red; border-radius: 10px;">
            All
        </span>

        @foreach ($categories as $category)
            <span class="badge badge-light category-filter" data-category="{{ $category->category_name }}" 
                  style="cursor: pointer; padding:5mm; border: 2px solid red; border-radius: 10px;">
                {{ $category->category_name }}    <br> <small>{{ $category->category_details }} </small>
            </span>
       
        @endforeach
    </div>
</div>


<div class="row shadow border rounded p-2 " >
    <div class="col-md-8">
        <div class="row" id="food-container">
            @foreach ($foods as $food)
                <div class="col-md-3">
                   <div class="card shadow-sm mb-4  product-card">
                      <div class="card-body bg-white">
                          <div class="d-flex flex-column align-items-center justify-content-center">
                              <div class="upload-container">
                                  <img id="avatarImage"
                                      src="{{ $food->image ? asset($food->image) : $food->image  }}"
                                      alt="No Picture Upload"
                                      class="img-fluid avatar-fit">
                              </div>
                              <style>
                                  .avatar-fit {
                                      width: 160px;
                                      height: 100px;
                                      object-fit: cover; 
                                      border: 2px solid #ccc;
                                  }
                                  .product-card {
                                      transition: transform 0.3s ease, box-shadow 0.3s ease;
                                  }
                                  .product-card:hover {
                                      transform: scale(1.05);
                                      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
                                  }
                              </style>
                          </div> 

                          
                                <h5 class="mt-2 text-center">{{ $food->product_name }}</h5>

                              <!-- Product Price -->
                              <p class="text-center mb-3">
                                  <strong> ₱{{ number_format($food->price, 2) }}</strong>
                              </p>

                         <!-- Quantity Selector -->
                          <div class="d-flex justify-content-center align-items-center">
                              <div class="input-group" style="max-width: 90px; margin-right: 10px;">
                                  <div class="input-group-prepend">
                                      <button class="btn btn-danger btn-sm" type="button" onclick="decreaseQuantity(this)">
                                          <i class="fa fa-minus"></i>
                                      </button>
                                  </div>
                                  <input type="number" name="quantity" value="0" min="0" 
                                        class="form-control text-center" style="width: 10px; padding: 2px 5px;">
                                  <div class="input-group-append">
                                      <button class="btn btn-success btn-sm" type="button" onclick="increaseQuantity(this)">
                                          <i class="fa fa-plus"></i>
                                      </button>
                                  </div>
                              </div>

                              <!-- Add to Order Button -->
                              <button class="btn btn-primary btn-sm" style="max-width: 90px; margin-right: 10px;height:38px">
                                  <i class="fa fa-check"></i>
                              </button>
                          </div>

                      </div>
                  </div>

                  <script>
                    function increaseQuantity(button) {
                        var input = $(button).closest('.input-group').find('input[name="quantity"]');
                        var current = parseInt(input.val()) || 0;
                        input.val(current + 1);
                    }
                    function decreaseQuantity(button) {
                        var input = $(button).closest('.input-group').find('input[name="quantity"]');
                        var current = parseInt(input.val()) || 0;
                        if (current > 1) {
                            input.val(current - 1);
                        }
                    }
                  </script>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body bg-white">
                <div class="text-muted mb-2" style="font-size: 12px;"> Orders</div>
                <input type="text" name="code" id="code" class="form-control" placeholder="Enter Order Code">
                <h5 class="mt-2 mb-2">Order Summary Here</h5>
                <button class="btn btn-success btn-sm float-right" style="background-color: rgb(228, 83, 21); color: white;">Place Order</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    $('.category-filter').on('click', function() {
        $('.category-filter').removeClass('badge-primary').addClass('badge-light');
        $(this).removeClass('badge-light').addClass('badge-primary');

        var selectedCategory = $(this).data('category');

        $.ajax({
            url: "{{ route('cashier') }}",
            type: "GET",
            data: { category: selectedCategory },
            success: function(response) {
                // Only replace the food list, not the full page
                var newHtml = $(response).find('#food-container').html();
                $('#food-container').html(newHtml);
            }
        });
    });

});


</script>



</div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <!-- DataTables CSS -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
 <!-- DataTables JS -->
 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/metismenu"></script>
<script src="../assets/js/scripts-init/app.js"></script>
<script src="../assets/js/scripts-init/demo.js"></script>
</body>
</html>
