<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use DB;
use Datatables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function salesreport()
    {
        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $currentYear = now()->year;

        $sales = DB::table('orders')
            ->join('products', 'orders.food_id', '=', 'products.id')
            ->selectRaw('
                products.product_name as product_name,
                MONTH(orders.created_at) as month,
                SUM(orders.total_price) as total_sales
            ')
            ->whereYear('orders.created_at', $currentYear) // ✅ Only this year
            ->groupBy('products.product_name', DB::raw('MONTH(orders.created_at)'))
            ->get();

        $report = [];

        foreach ($sales as $sale) {
            $product = $sale->product_name;
            $month = $sale->month;
            $total = $sale->total_sales;

            if (!isset($report[$product])) {
                $report[$product] = array_fill(1, 12, 0); 
            }

            $report[$product][$month] = $total;
        }

        return view('reports.salesreport', compact('report', 'months', 'currentYear'));
    }
    public function paymenthistory()
    {
       $payments = DB::table('orders')
        ->select(
            'order_no',
            DB::raw('DATE(created_at) as date'),
            'order_type',
            'payment_type',
            DB::raw('SUM(customer_amount) as customer_amount'),
            DB::raw('SUM(total_price) as total_price')
        )
        ->groupBy('order_no', DB::raw('DATE(created_at)'), 'order_type', 'payment_type')
        ->orderBy(DB::raw('DATE(created_at)'), 'desc')
        ->paginate(10);


        return view('reports.paymenthistory', compact('payments'));
    }

    
public function index()
{
    return view('orders.index');
}
public function orders(Request $request)
{
    if ($request->ajax()) {

       $orders = DB::table('orders')
    ->leftJoin('products', 'orders.food_id', '=', 'products.id')
    ->leftJoin('users', 'orders.user_id', '=', 'users.id')
    ->select(
        'orders.order_no',
       DB::raw("GROUP_CONCAT(CONCAT(orders.quantity, 'x ', COALESCE(products.product_name, 'Deleted')) SEPARATOR '\n') AS food_items"),

        DB::raw('SUM(orders.quantity) AS quantity'),
        DB::raw('SUM(orders.total_price) AS total_price'),
        DB::raw('MAX(orders.user_id) AS user_id'),
        DB::raw("MAX(
            CASE 
                WHEN orders.user_id LIKE 'guest%' THEN CONCAT('Guest (', orders.user_id, ')')
                ELSE CONCAT(COALESCE(users.f_name, ''), ' ', COALESCE(users.l_name, ''))
            END
        ) AS customer_name"),
        DB::raw('MAX(products.category) AS category'),
        DB::raw('MAX(orders.created_at) AS created_at'),
        DB::raw('MAX(orders.payment_status) AS payment_status'),
        DB::raw('MAX(orders.table_no) AS table_no')
    )
    ->groupBy('orders.order_no')
    ->orderByDesc(DB::raw('MAX(orders.created_at)'))
    ->get();


        return datatables()->of($orders)->addIndexColumn()
            ->make(true);
    }

    return view('orders.orders');
}

    public function getProductsByCategory($category)
    {
        $products = DB::table('products')
            ->where('category', $category) 
            ->get();

        return response()->json($products);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
        {
            return view('confirm-delete', ['id' => $id]);
        }
    
    public function softDelete($id){
        try {
            $order = Order::findOrFail($id);
            $order->delete();
           
            return response()->json(['message' => 'Order deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Order not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the Order'], 500);
        }
    }
}
