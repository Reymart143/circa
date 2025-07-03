@extends('layouts.app')
@section('content')



<div class="app-main__outer">
    <div class="app-main__inner">
     <div class="container">
            <div class="col-md-12">
                <div class="card shadow">
                    <div id="salesReportPrintArea">
                    <div class="card-body">
                        <h5>SALES REPORT FOR {{ $currentYear }}</h5>
                        <button onclick="printSalesReport()" class="btn btn-primary mb-3">
                            <i class="fas fa-print"></i> Print Sales Report
                        </button>
                        <script>
                            function printSalesReport() {
                                var printContents = document.getElementById('salesReportPrintArea').innerHTML;
                                var originalContents = document.body.innerHTML;

                                document.body.innerHTML = printContents;
                                window.print();

                                document.body.innerHTML = originalContents;
                                location.reload(); // optional: reloads to restore JS bindings
                            }
                        </script>

                        
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>FOOD</th>
                                        @foreach($months as $month)
                                            <th>{{ $month }}</th>
                                        @endforeach
                                        <th>Total</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp

                                @foreach($report as $product => $data)
                                    <tr>
                                        <td>{{ $product }}</td>
                                        @php $rowTotal = 0; @endphp
                                        @for($i = 1; $i <= 12; $i++)
                                            <td>₱{{ number_format($data[$i], 2) }}</td>
                                            @php $rowTotal += $data[$i]; @endphp
                                        @endfor
                                        <td><strong>₱{{ number_format($rowTotal, 2) }}</strong></td>
                                        @php $grandTotal += $rowTotal; @endphp
                                    </tr>
                                @endforeach

                                @if(count($report) === 0)
                                    <tr>
                                        <td colspan="14">No sales data available.</td>
                                    </tr>
                                @else
                                    <!-- GRAND TOTAL ROW -->
                                    <tr class="bg-success text-white font-weight-bold">
                                        <td>Grand Total</td>
                                        @for($i = 1; $i <= 12; $i++)
                                            @php
                                                $columnTotal = 0;
                                                foreach ($report as $product => $data) {
                                                    $columnTotal += $data[$i];
                                                }
                                            @endphp
                                            <td>₱{{ number_format($columnTotal, 2) }}</td>
                                        @endfor
                                        <td><strong>₱{{ number_format($grandTotal, 2) }}</strong></td>
                                    </tr>
                                @endif
                            </tbody>

                            </table>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
   
    
@endsection