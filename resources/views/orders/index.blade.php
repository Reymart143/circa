@extends('layouts.app')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
                        <a href="{{ route('orders/orders')}}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Cancel transaction</a>
             
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-7">
                    <div class="card">
                        <div class="card-body">
                            <form action="">
                                @csrf
                                 <div class="form-group col-md-12">
                                    <label for="warehouse">Search Categories</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="">Select Category</option>
                                        @foreach (DB::table('categories')->get() as $category)
                                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <script>
                                $(document).ready(function () {
                                    $('#category').on('change', function () {
                                        var categoryName = $(this).val();

                                        if (categoryName) {
                                            $.ajax({
                                                url: '/get-products-by-category/' + encodeURIComponent(categoryName),
                                                type: 'GET',
                                                success: function (data) {
                                                    $('#product').empty().append('<option value="">Select Product</option>');
                                                    $.each(data, function (key, product) {
                                                        $('#product').append('<option value="' + product.id + '">' + product.product_name + '</option>');
                                                    });
                                                }
                                            });
                                        } else {
                                            $('#product').html('<option value="">Select Product</option>');
                                        }
                                    });
                                });
                                </script>


                              <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="warehouse">Available Products</label>
                                    <select class="form-control" id="product" name="product" required>
                                        <option value="">Select Products</option>
                                        @foreach (DB::table('products')->get() as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="warehouse">Product Info</label>
                                    <div id="product_info" class="border p-2 rounded bg-light">
                                        <em>Select a product to view details...</em>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                <label for="quantity">Quantity</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-danger" id="minusBtn">−</button>
                                    </div>
                                    <input type="number" class="form-control text-center" id="quantity" name="quantity" value="0" min="0">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success" id="plusBtn">+</button>
                                    </div>
                                </div>
                                <span id="quantity-error" class="text-danger" role="alert"></span>
                            </div>
                               <div class="form-group col-md-6">
                                    <label for="warehouse">Total Amount</label>
                                    <br>
                                   <input type="text" class="form-control text-end" id="total_amount" name="total_amount" style="background-color:green; color:white;" readonly>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    let availableStock = 0;
                                    let productPrice = 0;

                                    function updateTotalAmount() {
                                        const quantity = parseInt($('#quantity').val()) || 0;
                                        const total = quantity * productPrice;
                                        $('#total_amount').val(`₱${total.toFixed(2)}`);
                                    }

                                    $('#product').on('change', function () {
                                        const productId = $(this).val();
                                        if (productId) {
                                            $.ajax({
                                                url: '/product/info/' + productId,
                                                type: 'GET',
                                                success: function (data) {
                                                    availableStock = parseInt(data.quantity);
                                                    productPrice = parseFloat(data.price);

                                                 const html = `
                                                        <div class="d-flex justify-content-between"><strong>Name:</strong> <span>${data.product_name}</span></div>
                                                        <div class="d-flex justify-content-between"><strong>Category:</strong> <span>${data.category}</span></div>
                                                        <div class="d-flex justify-content-between"><strong>Stock Available:</strong> <span class="badge badge-info">${data.quantity}</span></div>
                                                        <div class="d-flex justify-content-between"><strong>Price:</strong> <span>₱${parseFloat(data.price).toFixed(2)}</span></div>
                                                        <div class="d-flex justify-content-between"><strong>Warehouse:</strong> <span>${data.warehouse}</span></div>
                                                        <div class="d-flex justify-content-between"><strong>Reorder Point:</strong> <span>${data.reorder}</span></div>
                                                    `;
                                                    $('#product_info').html(html);

                                                    $('#quantity').val(0);
                                                    $('#quantity-error').text('');
                                                    $('#total_amount').val('₱ 0.00');
                                                },
                                                error: function () {
                                                    $('#product_info').html('<span class="text-danger">Unable to load product info.</span>');
                                                }
                                            });
                                        } else {
                                            $('#product_info').html('<em>Select a product to view details...</em>');
                                            availableStock = 0;
                                            productPrice = 0;
                                            $('#total_amount').val('₱ 0.00');
                                        }
                                    });

                                    $('#plusBtn').on('click', function () {
                                        let val = parseInt($('#quantity').val()) || 0;
                                        if (val + 1 > availableStock) {
                                            $('#quantity-error').text('Quantity exceeds available stock!');
                                        } else {
                                            $('#quantity').val(val + 1);
                                            $('#quantity-error').text('');
                                            updateTotalAmount();
                                        }
                                    });

                                    $('#minusBtn').on('click', function () {
                                        let val = parseInt($('#quantity').val()) || 0;
                                        if (val > 0) {
                                            $('#quantity').val(val - 1);
                                            $('#quantity-error').text('');
                                            updateTotalAmount();
                                        }
                                    });

                                $('#quantity').on('input', function () {
                                    let val = parseInt($(this).val()) || 0;
                                    if (val > availableStock) {
                                        $('#quantity-error').text('Quantity exceeds available stock! Reset to 0.');
                                        $('#quantity').val(0);
                                    } else {
                                        $('#quantity-error').text('');
                                    }
                                    updateTotalAmount();
                                });

                                });
                            </script>

                                <button class="btn btn-gradient-primary float-right"><i class="fa fa-plus"></i> Add to Order</button>
                            </form>
                        </div>
                    </div>
                </div>
                   <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('orders.store')}}" method="POST">
                                @csrf
                                <div class="form-group row align-items-center mb-3">
                                    <label class="col-md-4 col-form-label text-md-right">Customer Name:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control text-end" id="customer_name" name="customer_name" required>
                                    </div>
                                </div>

                                <div class="form-group row align-items-center mb-3">
                                    <label class="col-md-4 col-form-label text-md-right">Address:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control text-end" id="address" name="address" required>
                                    </div>
                                </div>

                                <div class="form-group row align-items-center mb-3">
                                    <label class="col-md-4 col-form-label text-md-right">Phone Number:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control text-end" id="phone_no" name="phone_no" required>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                <table class="mb-0 table table-striped" id="product_table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>
                                     
                                            <th>Action</th>
                                      
                                        </tr>
                                    </thead>
                                   <tbody id="order_items_body">
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-end">Grand Total:</th>
                                        <th colspan="2" id="grand_total">₱0.00</th>
                                    </tr>
                                </tfoot>
                                </table>
                                <style>
                                    #product_table td:last-child {
                                        white-space: nowrap;
                                    }

                                    #product_table td:last-child button,
                                    #product_table td:last-child a {
                                        margin-right: 5px;
                                    }

                               </style>
                               
                            </div>
                            <div class="form-group row align-items-center mb-3 mt-3">
                                <label class="col-md-4 col-form-label text-md-right" style="background-color:green;color:White">Status:</label>
                                <div class="col-md-8 d-flex align-items-center">
                                    <div class="form-check ">
                                        <input type="radio" class="form-check-input" id="status" name="status" value="0" required>
                                        <label class="form-check-label" for="paid">Paid</label>
                                    </div>
                                    <div class="form-check ml-4">
                                        <input type="radio" class="form-check-input" id="status" name="status" value="1" required>
                                        <label class="form-check-label" for="not_paid">Not Paid</label>
                                    </div>
                                </div>
                            </div>

                                 <input type="hidden" name="order_items_json" id="order_items_json">
                                <button class="btn btn-gradient-success mt-2 float-right"><i class="fa fa-check"></i> Save Order</button>
                            </form>
                         <script>
                            $(document).ready(function () {
                                $('form').on('submit', function (e) {
                                    e.preventDefault();

                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: 'Are you sure you want to add this order?',
                                        icon: 'question',
                                        showCancelButton: true,
                                        confirmButtonText: 'Yes, proceed',
                                        cancelButtonText: 'Cancel'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $('#order_items_json').val(JSON.stringify(orderItems));
                                            this.submit();
                                        }
                                    });
                                });
                            });
                        </script>

                          <script>
                            let orderItems = [];

                            function updateOrderTable() {
                                let tbody = $('#order_items_body');
                                tbody.empty();

                                let grandTotal = 0;

                                orderItems.forEach((item, index) => {
                                    const total = item.quantity * item.price;
                                    grandTotal += total;

                                    const row = `
                                        <tr>
                                            <td>${item.product_name}</td>
                                            <td>${item.quantity}</td>
                                            <td>₱${total.toFixed(2)}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-item" data-index="${index}">Remove</button>
                                            </td>
                                        </tr>
                                    `;
                                    tbody.append(row);
                                });

                                $('#grand_total').text('₱' + grandTotal.toFixed(2));
                            }

                            $(document).on('click', '.remove-item', function () {
                                const index = $(this).data('index');
                                orderItems.splice(index, 1);
                                updateOrderTable();
                            });

                            $('.btn.btn-gradient-primary').on('click', function (e) {
                                e.preventDefault();

                                const productId = $('#product').val();
                                const productName = $('#product option:selected').text();
                                const quantityToAdd = parseInt($('#quantity').val()) || 0;
                                const totalAmountText = $('#total_amount').val().replace(/[₱,]/g, '');
                                const price = parseFloat(totalAmountText) / quantityToAdd || 0;

                                if (!productId || quantityToAdd <= 0 || isNaN(price)) {
                                   
                                     Swal.fire({
                                            title: 'Something Went Wrong',
                                            text: 'This product is out of stock',
                                            icon: 'error',
                                        });
                                    return;
                                }

                                const existingIndex = orderItems.findIndex(item => item.product_id === productId);

                                if (existingIndex !== -1) {
                                    orderItems[existingIndex].quantity += quantityToAdd;
                                } else {
                                    orderItems.push({
                                        product_id: productId,
                                        product_name: productName,
                                        quantity: quantityToAdd,
                                        price: price
                                    });
                                }

                                $('#quantity').val(0);
                                $('#total_amount').val('₱0.00');
                                $('#product_info').html('<em>Select a product to view details...</em>');
                                $('#product').val('');
                                $('#quantity-error').text('');

                                updateOrderTable();
                            });
                        </script>

                            <script>
                                let orderItems = [];

                                function updateOrderTable() {
                                    let tbody = $('#order_items_body');
                                    tbody.empty();

                                    let grandTotal = 0;

                                    orderItems.forEach((item, index) => {
                                        const total = item.quantity * item.price;
                                        grandTotal += total;

                                        const row = `
                                            <tr>
                                                <td>${item.product_name}</td>
                                                <td>${item.quantity}</td>
                                                <td>₱${total.toFixed(2)}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm remove-item" data-index="${index}">Remove</button>
                                                </td>
                                            </tr>
                                        `;
                                        tbody.append(row);
                                    });

                                    $('#grand_total').text('₱' + grandTotal.toFixed(2));
                                }

                                $(document).on('click', '.remove-item', function () {
                                    const index = $(this).data('index');
                                    orderItems.splice(index, 1);
                                    updateOrderTable();
                                });

                                $('.btn.btn-gradient-primary').on('click', function (e) {
                                    e.preventDefault();
                                    console.log('dsa')
                                    const productId = $('#product').val();
                                    const productName = $('#product option:selected').text();
                                    const quantity = parseInt($('#quantity').val()) || 0;
                                    const price = parseFloat($('#total_amount').val().replace(/[₱,]/g, '')) / quantity || 0;

                                    if (!productId || quantity <= 0 || isNaN(price)) {
                                        alert("Please select a valid product and quantity.");
                                        return;
                                    }

                                    orderItems.push({
                                        product_id: productId,
                                        product_name: productName,
                                        quantity: quantity,
                                        price: price
                                    });

                                    $('#quantity').val(0);
                                    $('#total_amount').val('₱0.00');
                                    $('#product_info').html('<em>Select a product to view details...</em>');
                                    $('#product').val('');

                                    updateOrderTable();
                                });
                            </script>


                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        
    </div>
    
   @endsection