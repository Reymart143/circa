@extends('layouts.app')
@section('content')



<div class="app-main__outer">
    <div class="app-main__inner">
     <div class="container">
            <div class="col-md-12">
                <div class="card shadow">
                    <div id="salesReportPrintArea">
                        <div class="card-body">
                            <div id="sales-report-header" style="text-align: center; margin-bottom: 20px;">
                                @php
                                    $preference = \App\Models\UserPreference::first();
                                    $logoPath = $preference && $preference->logo
                                        ? asset($preference->logo)
                                        : asset('assets/images/OroSMap.png');
                                @endphp

                                <div class="header-logo" style="display: flex; justify-content: center; align-items: center; gap: 10px; margin-bottom: 10px;">
                                    <img src="{{ $logoPath }}" alt="Logo" style="height: 50px; width: 50px; object-fit: cover; border-radius: 50%;">
                                    <h2 style="margin: 0;">CIRCA EMENU EXPRESS</h2>
                                </div>

                                <h5 style="margin-top: 5px;">SALES REPORT FOR {{ $currentYear }}</h5>
                            </div>

                            {{-- Your report table or content goes here --}}
                            <div>
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

                    <!-- Print Button - Hidden when printing -->
                    <button onclick="printSalesReport()" class="btn btn-primary mb-3 no-print">
                        <i class="fas fa-print"></i> Print Sales Report
                    </button>

                    <!-- Print Script -->
                    <script>
                        function printSalesReport() {
                            const printContents = document.getElementById('salesReportPrintArea').innerHTML;
                            const printWindow = window.open('', '', 'width=900,height=700');

                            printWindow.document.write('<html><head><title>Sales Report</title>');
                            printWindow.document.write(`
                                <style>
                                    body { font-family: Arial, sans-serif; padding: 20px; }
                                    h2, h5 { text-align: center; margin: 0; }
                                    .header-logo {
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        gap: 10px;
                                        margin-bottom: 10px;
                                    }
                                    .header-logo img {
                                        height: 50px;
                                        width: 50px;
                                        object-fit: cover;
                                        border-radius: 50%;
                                    }
                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                        margin-top: 20px;
                                    }
                                    th, td {
                                        border: 1px solid #333;
                                        padding: 8px;
                                        text-align: left;
                                    }
                                    .no-print {
                                        display: none !important;
                                    }
                                </style>
                            `);
                            printWindow.document.write('</head><body>');
                            printWindow.document.write(printContents);
                            printWindow.document.write('</body></html>');
                            printWindow.document.close();

                            setTimeout(() => {
                                printWindow.focus();
                                printWindow.print();
                                printWindow.close();
                            }, 500);
                        }
                    </script>

                    <!-- Optional: CSS for hiding buttons when printing -->
                    <style>
                        @media print {
                            .no-print {
                                display: none !important;
                            }
                        }
                    </style>


                        
            
                </div>
            </div>
        </div>
        
    </div>
   
    
@endsection