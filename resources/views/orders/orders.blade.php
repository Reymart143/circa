@extends('layouts.app')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
       <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-calculator icon-gradient bg-mean-fruit"></i>
                    </div> 
                    <div>
                       Total Amount
                        <div class="badge badge-success">{{ $total_order = App\Models\Order::sum('total_amount'); }} .00</div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-0"><i class=" fa fa-clipboard-list"></i> Order List</h5>
                                <a href="{{ route('order/index')}}" class="btn btn-gradient-info"><i class="fa fa-shopping-cart"></i> Add Orders</a>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="mb-0 table table-striped" id="order_table">
                                   <thead>
                                            <tr>
                                                <th>Transaction #</th>
                                                <th>Customer Name</th>
                                                <th>Address</th>
                                                <th>Phone #</th>
                                                <th>Product Name</th>
                                                <th>Category</th>
                                                <th>Total Ordered</th>
                                                <th>Total Amount</th>
                                                <th>Status</th> 
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                    <tbody>
                                   
                                        <script>
                                            $(document).ready(function() {
                                            $('#order_table').DataTable({
                                        
                                                "processing": true,
                                            
                                                serverSide: true,
                                                ajax: "{{ route('orders/orders') }}",
                                                columns: [
                                                     {
                                                        data: 'transaction_no',
                                                        name: 'transaction_no',
                                                        render: function(data) {
                                                            return data ? `<button class="text-wrap btn btn-outline-warning">${data}</button>` : '<div class="text-wrap">No data</div>';
                                                        }
                                                    },
                                                        {
                                                        data: 'customer_name',
                                                        name: 'customer_name',
                                                        render: function(data) {
                                                            return data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap">No data</div>';
                                                        }
                                                    },
                                                    {
                                                        data: 'address',
                                                        name: 'address',
                                                        render: function(data) {
                                                            return data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap">No data</div>';
                                                        }
                                                    },
                                                    {
                                                        data: 'phone_no',
                                                        name: 'phone_no',
                                                        render: function(data) {
                                                            return data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap">No data</div>';
                                                        }
                                                    },
                                                    {
                                                        data: 'product_name',
                                                        name: 'product_name',
                                                        render: function(data) {
                                                            return data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap text-danger">This product has been deleted</div>';
                                                        }
                                                    },
                                                    {
                                                        data: 'category',
                                                        name: 'category',
                                                        render: function(data) {
                                                            return data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap text-danger">This product has been deleted</div>';
                                                        }
                                                    },

                                                      {
                                                        data: 'quantity',
                                                        name: 'quantity',
                                                        render: function(data) {
                                                            return data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap">No data</div>';
                                                        }
                                                    },
                                                       {
                                                        data: 'total_amount',
                                                        name: 'total_amount',
                                                        render: function(data) {
                                                        return data ? `<div class="text-wrap">₱ ${Number(data).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>` : '<div class="text-wrap">No data</div>';

                                                        }
                                                    },
                                                   
                                                  
                                                      {
                                                        data: 'status',
                                                        name: 'status',
                                                        render: function(data) {
                                                            if(data === 0){
                                                                return data ? `<span class="text-wrap badge badge-success"> Paid </span>` : '<span class="text-wrap badge badge-success"> Paid </span>';
                                                            }else{
                                                                return data ? `<span class="text-wrap badge badge-danger"> Not Paid </span>` : '<span class="text-wrap badge badge-danger"> Not Paid </span>';
                                                            }
                                                            
                                                        }
                                                    },
                                                    
                                                   
                                                    {
                                                        data: 'action',
                                                        name: 'action',
                                                        orderable: false,
                                                        searchable: false
                                                    }
                                                ]
                                            });
                                        });
                                         function confirmDeleteOrder(id) {
                        
                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    text: "You won't be able to revert this!",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Yes, delete it!',
                                                    reverseButtons: true,
                                                    buttonsStyling: false,
                                                    customClass: {
                                                        confirmButton: 'btn btn-primary mx-2', 
                                                        cancelButton: 'btn btn-danger mx-2'    
                                                    }
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        deleteCom(id);
                                                    } else {
                                                        Swal.fire(
                                                            'Deletion canceled',
                                                            'The Order was not deleted.',
                                                            'info'
                                                        )
                                                    }
                                                });
                                            }

                                            function deleteCom(id) {
                                                
                                                $.ajax({
                                                
                                                    url: "{{ url('orders.delete/') }}/" + id,
                                                    type: 'DELETE',
                                                    
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    },
                                                    
                                                    success: function(response) {
                                                        
                                                        Swal.fire(
                                                            'Deleted!',
                                                            'The order has been deleted.',
                                                            'success'
                                                        ).then(() => {

                                                            $('#order_table').DataTable().ajax.reload();
                                                        });
                                                    },
                                                    error: function(xhr, status, error) {
                                                    
                                                        Swal.fire(
                                                            'Error!',
                                                            'An error occurred while deleting the order.',
                                                            'error'
                                                        );
                                                    }
                                                });
                                            }
                                        </script>
                                    </tbody>
                                </table>
                                <style>
                                    #order_table td:last-child {
                                        white-space: nowrap;
                                    }

                                    #order_table td:last-child button,
                                    #order_table td:last-child a {
                                        margin-right: 5px;
                                    }

                               </style>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        
    </div>
     
@endsection