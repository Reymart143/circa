<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Cashier Display</title>
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
    <div class="d-flex justify-content-end align-items-center">
        <h5 class="mb-0 mr-3">{{ Auth::user()->f_name }}</h5>

        <button id="logoutBtn" class="btn btn-danger">
            <i class="fa fa-sign-out-alt"></i> Logout
        </button>

        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
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
    </div>
  </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0">Order List</h5>
                            <button class="btn btn-success" onclick="openModal()"><i class="fa fa-plus"></i>Add Order</button>
                        </div>
                        
                        {{-- <div class="table-responsive"> --}}
                            {{-- <div class="container mt-4"> --}}
                          
                       <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text" id="orderNoInput" class="form-control" placeholder="Search Order No">
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="tableNoInput" class="form-control" placeholder="Search Table No">
                        </div>
                    </div>

                        {{-- </div> --}}
                        {{-- </div> --}}

                        <div class="row" id="orders-body">
                            <!-- Cards will be loaded here -->
                        </div>

                        <script>
                        function getStatusText(payment_status) {
                            if (payment_status == 0) return '<span class="badge badge-warning text-white">Pending</span>';
                            if (payment_status == 1) return '<span class="badge badge-primary text-white">Paid</span>';
                            if (payment_status == 2) return '<span class="badge badge-success text-white">Served</span>';
                            return payment_status;
                        }

                        let allOrders = [];

                        function renderOrders(filteredData) {
                            $('#orders-body').empty();

                            filteredData.forEach(order => {
                                let productList = '<ul class="list-group list-group-flush">';
                                let grandTotal = 0;

                                order.products.forEach(product => {
                                    grandTotal += parseFloat(product.total_price);
                                    productList += `<li class="list-group-item d-flex justify-content-between">
                                        ${product.product_name} <span>${product.quantity}x - ₱${product.total_price.toFixed(2)}</span>
                                    </li>`;
                                });

                                productList += `
                                    <li class="list-group-item d-flex justify-content-between font-weight-bold bg-light">
                                        Grand Total: <span>₱${grandTotal.toFixed(2)}</span>
                                    </li>
                                `;
                                productList += '</ul>';

                                $('#orders-body').append(`
                                    <div class="col-md-3 mb-4">
                                        <div class="card shadow-sm h-90">
                                            <div class="card-header bg-danger text-white">
                                                <div><strong>Order No :</strong> ${order.order_no}</div>
                                               
                                                <div class="ml-5"><strong>Table No :</strong> ${order.table_no}</div>
                                            </div>
                                            <div class="card-body p-2">
                                                ${productList}
                                            </div>
                                            <div class="card-footer d-flex justify-content-between align-items-center">
                                                ${getStatusText(order.payment_status)}
                                                <a href="/payorders?order_no=${order.order_no}&table_no=${order.table_no}&user_id=${order.user_id}" class="btn btn-sm btn-success">
                                                    Pay Order
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            });
                        }

                        function fetchOrders() {
                            $.ajax({
                                url: '/fetch-orders',
                                method: 'GET',
                                success: function(data) {
                                    allOrders = data; // store all orders globally
                                    applyFilter();
                                }
                            });
                        }

                        // Apply filters from both inputs
                        function applyFilter() {
                            let orderKeyword = $('#orderNoInput').val().toLowerCase().trim();
                            let tableKeyword = $('#tableNoInput').val().toLowerCase().trim();

                            let filtered = allOrders.filter(order => {
                                let matchOrder = orderKeyword === '' || order.order_no.toLowerCase().includes(orderKeyword);
                                let matchTable = tableKeyword === '' || order.table_no.toString().includes(tableKeyword);
                                return matchOrder && matchTable;
                            });

                            renderOrders(filtered);
                        }

                        // Initial fetch
                        fetchOrders();

                        // Auto refresh only if both search boxes are empty
                        setInterval(function() {
                            let orderKeyword = $('#orderNoInput').val().trim();
                            let tableKeyword = $('#tableNoInput').val().trim();
                            if (orderKeyword === '' && tableKeyword === '') {
                                fetchOrders();
                            }
                        }, 3000);

                        // Bind search events
                        $('#orderNoInput, #tableNoInput').on('input', applyFilter);
                        </script>



                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>




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
