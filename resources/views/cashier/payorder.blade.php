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
    <div>
     
          <div class="d-flex justify-content-end align-items-center">
        <h5 class="mb-0 mr-3">{{ Auth::user()->f_name }}</h5>

        <button id="logoutBtn" class="btn btn-danger">
            <i class="fa fa-sign-out-alt"></i> Logout
        </button>

        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
        
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
        <div class="row mb-2 mt-2">
                <div class="col-md-11">
                    <span class="badge badge-primary category-filter active" style="cursor: pointer; padding:5mm; border: 2px solid red; border-radius: 10px;">
                        All
                    </span>
                    @foreach ($categories as $category)
                        <span class="badge badge-light category-filter" data-category="{{ $category->category_name }}" 
                            style="cursor: pointer; padding:5mm; border: 2px solid red; border-radius: 10px;">
                            {{ $category->category_name }}
                        </span>
                    @endforeach
                </div>
                 <div class="col-md-1 ">
                    <a href="/cashier" class="btn btn-secondary "><i class="fa fa-arrow-left"></i> Orders</a>
                </div>
            </div>
               
            <div class="row shadow border rounded p-2">
                <div class="col-md-7">
                    <div class="row" id="food-container">
                        @foreach ($foods as $food)
                            <div class="col-md-3">
                                <div class="card shadow-sm mb-4 product-card">
                                    <div class="card-body bg-white text-center">
                                        <img src="{{ $food->image ? asset($food->image) : $food->image }}" class="img-fluid avatar-fit" style="width:160px;height:100px;object-fit:cover;border:2px solid #ccc;">
                                        <h5 class="mt-2">{{ $food->product_name }}</h5>
                                        <p><strong>₱{{ number_format($food->price, 2) }}</strong></p>
                                        <button class="btn btn-success btn-sm add-to-order-btn"
                                            data-product-id="{{ $food->id }}"
                                            data-product-name="{{ $food->product_name }}"
                                            data-price="{{ $food->price }}">
                                            <i class="fa fa-check"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                    <div class="col-md-5">
                        <div class="card shadow-sm mb-4">
                            
                            <div class="card-body bg-white">
                                <div class="mb-4" style="background: #f8f9fa; padding: 20px; border: 2px solid #ccc; border-radius: 10px;">
                                    <div class="text-center" style="font-size: 36px; font-weight: bold; color: #222;">
                                        Order #: <span style="color: #007bff;">{{ $order_no }}</span> |
                                        @if($table_no == null)
                                        
                                        <label for="table_no">Table #:</label>
                                        <select name="table_no" id="table_no" class="form-control col-md-4 float-right">
                                            @for ($i = 1; $i <= 100; $i++)
                                                <option value="{{ $i }}" {{ $table_no == $i ? 'selected' : '' }}>
                                                    Table {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @else
                                        Table #: <span style="color: #007bff;">{{ $table_no }}</span>
                                        @endif
                                    </div>
                                </div>
                            
                             <input type="hidden" name="user_id" id="user_id" value="{{ $user_id}}">
                                <h5>Order Summary</h5>
                                <div class="table-responsive">

                                
                                <table class="table table-bordered" id="orderTable">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                               <h5 class="text-right mt-3">Grand Total: <strong id="grandTotalOriginalText">₱0.00</strong></h5>
                               <h5 class="text-right mt-3 text-success">Discounted Total: <strong id="grandTotalText">₱0.00</strong></h5>

                                <div class="text-right">
                                    <h5 class="mt-4"><span class="badge badge-primary">Payment Type</span></h5>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="payment_type" id="cash" value="cash" checked>
                                            <label class="form-check-label" for="cash">Cash (10% Discount)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="payment_type" id="card" value="card">
                                            <label class="form-check-label" for="card">Card (5% Discount)</label>
                                        </div>
                                    </div>
                                  <div class="form-group align-items-center">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="order_type" id="dine_in" value="0"
                                                {{ $order_type == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="dine_in">Dine In</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="order_type" id="take_out" value="1"
                                                {{ $order_type == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="take_out">Take Out</label>
                                        </div>
                                    </div>

                                    <div class="form-group d-flex justify-content-end align-items-center">
                                        <label for="customer_amount" class="mb-0 mr-2"><strong>Customer Cash:</strong></label>
                                        <input type="number" id="customer_amount" class="form-control form-control-sm mr-3" placeholder="Enter amount" style="width: 150px;">
                                        
                                        <label class="mb-0 mr-2"><strong>Change:</strong></label>
                                        <p id="changeText" class="mb-0" style="border: 1px solid #ccc; background-color: #107a29; color: rgb(255, 255, 255); padding: 5px 10px; border-radius: 5px;">₱0.00</p>
                                    </div>
                                </div>



                                <button id="placeOrderBtn" class="btn btn-success btn-sm float-right mt-3" style="background-color: rgb(228, 83, 21); color: white;">
                                    Place Order
                                </button>
                            </div>
                        </div>
                    </div>
            </div>

            <script>
               let currentOrder = {!! json_encode($orderItems) !!}.map(item => ({
                    productId: item.product_id,
                    productName: item.product_name,
                    price: item.total_price / item.quantity,
                    quantity: item.quantity
                }));

                renderOrderTable();

                $('.add-to-order-btn').click(function() {
                    const productId = parseInt($(this).data('product-id'));  
                    const productName = $(this).data('product-name');
                    const price = parseFloat($(this).data('price'));

                    let existingItem = currentOrder.find(item => parseInt(item.productId) === productId);

                    if (existingItem) {
                        existingItem.quantity = Number(existingItem.quantity) + 1;
                    } else {
                        currentOrder.push({ productId, productName, price, quantity: 1 });
                    }
                    renderOrderTable();
                });

                function renderOrderTable() {
                    const tbody = $('#orderTable tbody');
                    tbody.empty();
                    let grandTotal = 0;

                    currentOrder.forEach((item, index) => {
                        const totalPrice = item.quantity * item.price;
                        grandTotal += totalPrice;

                        tbody.append(`
                            <tr>
                                <td>${item.productName}</td>
                                <td><input type="number" class="form-control form-control-sm quantity-input" 
                                    data-index="${index}" value="${item.quantity}" min="1"></td>
                                <td>₱${item.price.toFixed(2)}</td>
                                <td>₱${totalPrice.toFixed(2)}</td>
                                <td><button class="btn btn-danger btn-sm remove-item" data-index="${index}">X</button></td>
                            </tr>
                        `);
                    });

                    calculatePaymentSummary();
                }

                $(document).on('change', '.quantity-input', function() {
                    const index = $(this).data('index');
                    const newQuantity = parseInt($(this).val());
                    if (newQuantity > 0) {
                        currentOrder[index].quantity = newQuantity;
                        renderOrderTable();
                    }
                });

                $(document).on('click', '.remove-item', function() {
                    const index = $(this).data('index');
                    currentOrder.splice(index, 1);
                    renderOrderTable();
                });

                function calculatePaymentSummary() {
                    let grandTotal = 0;
                    currentOrder.forEach(item => {
                        grandTotal += item.quantity * item.price;
                    });

                    let paymentType = $('input[name="payment_type"]:checked').val();
                    let discount = 0;

                    if (paymentType === 'cash') {
                        discount = grandTotal * 0.10;
                    } else if (paymentType === 'card') {
                        discount = grandTotal * 0.05;
                    }

                    let finalTotal = grandTotal - discount;
                    let customerCash = parseFloat($('#customer_amount').val()) || 0;
                    let change = customerCash - finalTotal;

                    // Display both original and discounted grand total
                    $('#grandTotalOriginalText').text(`₱${grandTotal.toFixed(2)}`);
                    $('#grandTotalText').text(`₱${finalTotal.toFixed(2)}`);
                    $('#changeText').text(`₱${change >= 0 ? change.toFixed(2) : '0.00'}`);
                }

                $('input[name="payment_type"]').change(function() {
                    calculatePaymentSummary();
                });

                $('#customer_amount').on('input', function() {
                    calculatePaymentSummary();
                });

                $('#placeOrderBtn').click(function() {
                    if (currentOrder.length === 0) {
                        alert("Order is empty.");
                        return;
                    }
                    let paymentType = $('input[name="payment_type"]:checked').val();
                    let grandTotal = 0;
                    let orderType = $('input[name="order_type"]:checked').val();

                    currentOrder.forEach(item => {
                        grandTotal += item.quantity * item.price;
                    });

                    let discount = (paymentType === 'cash') ? (grandTotal * 0.10) : (paymentType === 'card') ? (grandTotal * 0.05) : 0;
                    let finalTotal = grandTotal - discount;

                    let customerAmount = parseFloat($('#customer_amount').val()) || 0;
                    let change = customerAmount - finalTotal;

                    if (customerAmount < finalTotal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Insufficient Amount',
                            text: 'Customer must pay at least ₱' + finalTotal.toFixed(2),
                        });
                        return;
                    }
                    $.ajax({
                        url: "{{ route('finalize.order') }}",
                        method: "POST",
                        data: {
                            order_no: "{{ $order_no }}",
                            user_id: "{{ $user_id }}",
                            table_no: document.getElementById('table_no') ? document.getElementById('table_no').value : "{{ $table_no }}",
                            payment_type: paymentType,
                            order_type: orderType,
                            customer_amount: customerAmount,
                            discount: discount,
                            total_amount: finalTotal,
                            items: currentOrder,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                           
                             Swal.fire({
                                icon: 'success',
                                title: 'Order Submitted Successfully',
                                text: 'Order is transferred to the kitchen' ,
                            });
                            // location.reload();
                             generateReceipt();
                              $('#receiptModal').modal('show');
                        },
                        error: function() {
                             Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong',
                                text: 'Error placing order, please try again later',
                            });
                        }
                    });
                });
                </script>
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
                var newHtml = $(response).find('#food-container').html();
                $('#food-container').html(newHtml);
            }
        });
    });

});


</script>


<!-- Receipt Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1"
     aria-labelledby="receiptModalLabel" aria-hidden="true"
     data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content p-3" style="font-family: monospace; font-size: 14px;">
      <div class="modal-body" id="receiptContent">
      </div>
      <div class="modal-footer justify-content-center">
        <button class="btn btn-primary btn-sm" onclick="printReceipt()">Print</button>
      </div>
    </div>
  </div>
</div>
<script>
    function generateReceipt() {
    let paymentType = $('input[name="payment_type"]:checked').val();
    let paymentText = (paymentType === 'cash') ? 'Cash (10% Discount)' : 'Card (5% Discount)';
    let now = new Date().toLocaleString();

    let receiptHTML = `
      <div class="text-center">
        <strong>CIRCA 1850</strong><br>
        OPTD BY: SPOON WORK INC.<br>
        GRN. FLR. TUNE HOTEL<br>
        C.M. RECTO AVENUE<br>
        CAGAYAN DE ORO CITY<br>
        VAT: TIN 005-972-127-001<br>
        MIN: 1401414736269961<br>
        SERIAL NO: W3T92P6R<br>
        ------------------------------------<br>
        BILL NO: <strong>{{ $order_no }}</strong><br>
        {{ $order_type == 0 ? 'DINE IN' : 'TAKE OUT' }}<br>
        ------------------------------------<br>
    `;

    let grandTotal = 0;
    currentOrder.forEach(item => {
        let itemTotal = item.quantity * item.price;
        grandTotal += itemTotal;
        receiptHTML += `
            ${item.productName}<br>
            ${item.quantity} x ₱${item.price.toFixed(2)} = ₱${itemTotal.toFixed(2)}<br>
        `;
    });

    let discount = (paymentType === 'cash') ? (grandTotal * 0.10) : (grandTotal * 0.05);
    let finalTotal = grandTotal - discount;
    let customerCash = parseFloat($('#customer_amount').val()) || 0;
    let change = customerCash - finalTotal;

    receiptHTML += `
        ------------------------------------<br>
        TOTAL: ₱${grandTotal.toFixed(2)}<br>
        DISCOUNT: -₱${discount.toFixed(2)}<br>
        FINAL: ₱${finalTotal.toFixed(2)}<br>
        PAYMENT: ${paymentText}<br>
        CASH: ₱${customerCash.toFixed(2)}<br>
        CHANGE: ₱${change.toFixed(2)}<br>
        ------------------------------------<br>
        Terminal: Terminal 1<br>
        Cashier: {{ Auth::user()->name }}<br>
        Trans Date: ${now}<br>
        Table Number: {{ $table_no }}<br>
        ------------------------------------<br>
        THIS DOCUMENT IS NOT VALID<br>
        FOR CLAIM OF INPUT TAX
    `;

    $('#receiptContent').html(receiptHTML);


  // ✅ Bootstrap 4: Show modal with static backdrop and no ESC close
  $('#receiptModal').modal({
    backdrop: 'static',
    keyboard: false
  });
}
function printReceipt() {
    let printContents = document.getElementById('receiptContent').innerHTML;
    let originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;

    window.location.href = "/cashier";
}


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
