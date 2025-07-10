@extends('layouts.app')
@section('content')



<div class="app-main__outer">
    <div class="app-main__inner">
    <div class="container">
        <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
        <h5 class="mb-3">Transaction History</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Order No</th>
                        <th>Date</th>
                        <th>Order Type</th>
                        <th>Payment Type</th>
                        <th >Customer Amount (₱)</th>
                        <th>Total Price (₱)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>{{ $payment->order_no }}</td>
                            <td>{{ \Carbon\Carbon::parse($payment->date)->format('M d, Y') }}</td>
                            <td>
                                @if($payment->order_type == 0)
                                    Dine In
                                @elseif($payment->order_type == 1)
                                    Take Out
                                @else
                                    Unknown
                                @endif
                            </td>
                               <td>{{ $payment->payment_type == 0 ? 'Cash' : 'Card' }}</td>
                            <td class="text-right">₱ {{ number_format($payment->customer_amount, 2) }}</td>
                            <td class="text-right">₱ {{ number_format($payment->total_price, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No Transaction history found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-body">
                         <div class="d-flex pagination-rounded">
                            {{ $payments->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
           </div>
    </div>
        
    </div>
    </div>
   
    
@endsection