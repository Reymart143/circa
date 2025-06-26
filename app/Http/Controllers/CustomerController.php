<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function homepage()
    {
        return view('customer.index');
    }
    public function menu()
    {
        $categories = DB::table('categories')->get();
        $products = DB::table('products')->where('status',0)->get();
            //  dd($products,$categories );
        return view('customer.menu',compact('products','categories'));
    }
    public function getProductsByCategory($categoryId)
    {
        if ($categoryId === 'all') {
            $products = Product::where('status', 0)->get();
        } else {
            $cat = Category::where('id', $categoryId)->first();
            if (!$cat) {
                return response()->json(['error' => 'Category not found'], 404);
            }
            $products = Product::where('status', 0)->where('category', $cat->category_name)->get();
        }

        return response()->json($products);
    }

    public function userProfile(){
        $user = Auth::user();

        $totalOrders = DB::table('orders')
            ->where('user_id', $user->id)
            ->where('payment_status',1)
            ->count();

        return view('customer.userProfile', compact('user', 'totalOrders'));
    }
   public function timeorder()
    {
     
        return view('customer.ordertime');
    }
public function getGroupedOrders()
{
    if(Auth::check()){
        $orders = DB::table('kitchens')
        ->select(
            'order_no',
            'table_no',
            DB::raw('MAX(updated_at) as updated_at'),
            DB::raw('MAX(timer) as timer'),
            DB::raw('MAX(kitchen_status) as kitchen_status')
        )
        ->groupBy('order_no', 'table_no')
        ->havingRaw('MIN(kitchen_status) = MAX(kitchen_status)')
        ->whereIn('kitchen_status', [2, 3])
        ->where('user_id',Auth::user()->id)
        ->get()
        ->map(function ($order) {
            $order->updated_at = \Carbon\Carbon::parse($order->updated_at)->toIso8601String();
            return $order;
        });
    }else{
        $orders = DB::table('kitchens')
        ->select(
            'order_no',
            'table_no',
            DB::raw('MAX(updated_at) as updated_at'),
            DB::raw('MAX(timer) as timer'),
            DB::raw('MAX(kitchen_status) as kitchen_status')
        )
        ->groupBy('order_no', 'table_no')
        ->havingRaw('MIN(kitchen_status) = MAX(kitchen_status)')
        ->whereIn('kitchen_status', [2, 3])
        ->get()
        ->map(function ($order) {
            $order->updated_at = \Carbon\Carbon::parse($order->updated_at)->toIso8601String();
            return $order;
        });
    }
    

    return response()->json($orders);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
