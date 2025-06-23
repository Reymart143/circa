<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function Dashboard(){
    if(Auth::check()){
<<<<<<< HEAD
        // if(Auth::user()->role == 1 || Auth::user()->role == 2){ 
            return view('dashboard.Dashboard');
        // }
=======
        if(Auth::user()->role == 1){ 
            return view('dashboard.Dashboard');
        }
>>>>>>> ba3da6ef301860262896a0370b6d45bdf4309bd5
        
    }else{
        Auth::logout();
            return redirect('/login')->with('error', 'Technical Issues, Automatic Logout');
        }
    }
   public function getMonthlySalesData()
    {
        $rawSales = DB::table('orders')
            ->select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw("SUM(total_amount) as total_sales")
            )
            ->whereYear('created_at', 2025)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('total_sales', 'month'); 

        $fullYear = collect(range(1, 12))->map(function ($monthNumber) use ($rawSales) {
            return [
                'month_name' => Carbon::create()->month($monthNumber)->format('F'),
                'total_sales' => round($rawSales->get($monthNumber, 0), 2),
            ];
        });

        return response()->json($fullYear);
    }
}
