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
                        <div class="badge badge-success">{{ $total_order = App\Models\Order::sum('total_price'); }} .00</div>
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
                                {{-- <a href="{{ route('order/index')}}" class="btn btn-gradient-info"><i class="fa fa-shopping-cart"></i> Add Orders</a> --}}
                            </div>
                            
                            <div class="table-responsive">
                                <table class="mb-0 table table-striped" id="order_table">
                                   <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Table #</th>
                                                <th>Customer Name</th>
                                                <th>Food Ordered</th>
                                                <th>Category</th>
                                                <th>Qty</th>
                                                <th>Total Amount</th>
                                                <th>Status</th> 
                                                <th>Transaction Date</th>
                                            </tr>
                                        </thead>


                                    <tbody>
                                   
                                     <script>
                                    $(document).ready(function() {
                                        $('#order_table').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            ajax: "{{ route('orders/orders') }}",
                                            columns: [
                                                {
                                                    data: 'order_no',
                                                    name: 'order_no',
                                                    render: data => `<button class="text-wrap btn btn-primary">${data ?? 'No data'}</button>`
                                                },
                                                {
                                                    data: 'table_no',
                                                    name: 'table_no',
                                                    render: data => `<button class="text-wrap btn btn-success">${data ?? 'No data'}</button>`
                                                },
                                                {
                                                    data: 'customer_name',
                                                    name: 'customer_name',
                                                    render: data => `<div class="text-wrap">${data ?? 'No data'}</div>`
                                                },
                                               {
                                                    data: 'food_items',
                                                    name: 'food_items',
                                                    orderable: false,
                                                    searchable: false,
                                                    render: function(data) {
                                                        return data ? data.replace(/\n/g, '<br>') : '';
                                                    }
                                                },
                                                {
                                                    data: 'category',
                                                    name: 'category',
                                                    render: data => data ? `<div class="text-wrap">${data}</div>` : '<div class="text-wrap text-danger">Deleted</div>'
                                                },
                                                {
                                                    data: 'quantity',
                                                    name: 'quantity',
                                                    visible: false 
                                                },
                                                {
                                                    data: 'total_price',
                                                    name: 'total_price',
                                                    render: data => `<div class="text-wrap">₱ ${Number(data).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>`
                                                },
                                                {
                                                    data: 'payment_status',
                                                    name: 'payment_status',
                                                    render: data => {
                                                        if (parseInt(data) === 0) {
                                                            return '<span class="badge badge-danger">Not Paid</span>';
                                                        }
                                                        return '<span class="badge badge-success">Paid</span>';
                                                    }
                                                },
                                                 {
                                                    data: 'created_at',
                                                    name: 'created_at',
                                                    render: function(data) {
                                                        if (!data) return '<div class="text-wrap">No date</div>';

                                                        const date = new Date(data);
                                                        const options = {
                                                            year: 'numeric',
                                                            month: 'short',
                                                            day: 'numeric',
                                                            hour: '2-digit',
                                                            minute: '2-digit',
                                                            hour12: true
                                                        };
                                                        return `<div class="text-wrap">${date.toLocaleString('en-US', options)}</div>`;
                                                    }
                                                },

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