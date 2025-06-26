<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\kitchen;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(Auth::check()){
            
            return view('cashier.index');
        } else {
            return redirect()->route('login');
        }
    }

   public function fetchOrders()
    {
        $orders = DB::table('orders')
            ->select('order_no', 'table_no', 'payment_status', 'user_id','order_type')  // ✅ include user_id
            ->groupBy('order_no', 'table_no', 'payment_status', 'user_id','order_type')
            ->orderBy('order_no', 'desc')
            ->where('payment_status',0)
            ->get();
        
        foreach ($orders as $order) {
            $products = DB::table('orders')
                ->join('products', 'orders.food_id', '=', 'products.id')
                ->select('products.product_name', 'orders.quantity', 'orders.total_price')
                ->where('orders.order_no', $order->order_no)
                ->where('orders.table_no', $order->table_no)
                ->get();
            $order->products = $products;
          
        }
        
        return response()->json($orders);
    }
    // public function payorders(Request $request)
    // {
    //     $order_no = $request->query('order_no');
    //     $table_no = $request->query('table_no');
    //      $user_id = $request->query('user_id');
         
    //     $categories = DB::table('categories')->get();
    //     $foods = DB::table('products')->where('status', 0)->get();
    //     $orderItems = DB::table('orders')
    //         ->join('products', 'orders.food_id', '=', 'products.id')
    //         ->where('order_no', $order_no)
    //         ->where('table_no', $table_no)
    //         ->select('orders.food_id as product_id', 'products.product_name', 'orders.quantity', 'orders.total_price')
    //         ->get();

    //     return view('cashier.payorder', compact('orderItems', 'order_no', 'table_no', 'categories', 'foods','user_id'));
    // }
public function payorders(Request $request)
{
    $order_no = $request->query('order_no');
    $table_no = $request->query('table_no');
    $user_id = $request->query('user_id');
    $order_type = $request->query('order_type');
   
    if (!$order_no || !$table_no) {

        $lastOrder = DB::table('orders')
            ->where('order_no', 'like', 'circa%')
            ->orderBy('order_no', 'desc')
            ->first();

        if ($lastOrder) {
            $lastNumber = intval(substr($lastOrder->order_no, 5));  
            $nextOrderNumber = $lastNumber + 1;
        } else {
            $nextOrderNumber = 1;
        }
        $order_no = 'circa' . str_pad($nextOrderNumber, 3, '0', STR_PAD_LEFT);

        // $occupiedTable = DB::table('kitchens')
        //     ->whereNotIn('kitchen_status', [1,2,3])
        //     ->orderBy('table_no', 'asc')
        //     ->first();
        // // dd($occupiedTable);
        // if ($occupiedTable) {
        //     $table_no = $occupiedTable->table_no;
        //     //    dd($occupiedTable);
        // } else {
         
        //     $table_no = 1;  
        // }
    }
    // dd($table_no );
    $categories = DB::table('categories')->get();
    $foods = DB::table('products')->where('status', 0)->get();
    $orderItems = DB::table('orders')
        ->join('products', 'orders.food_id', '=', 'products.id')
        ->where('order_no', $order_no)
        ->where('table_no', $table_no)
        ->select('orders.food_id as product_id', 'products.product_name', 'orders.quantity', 'orders.total_price')
        ->get();

    return view('cashier.payorder', compact('orderItems', 'order_no', 'table_no', 'categories', 'foods', 'user_id','order_type'));
}

// public function finalizeOrder(Request $request)
// {
//     $orderNo = $request->order_no;
//     $tableNo = $request->table_no;
//     $items = $request->items;
   
//     foreach ($items as $item) {
//         // Either insert new or update existing rows
//          dd($orderNo,$tableNo,$item );
//         DB::table('orders')->updateOrInsert(
//             [
//                 'order_no' => $orderNo,
//                 'table_no' => $tableNo,
//                 'food_id' => $item['productId'],

//             ],
//             [
//                 'quantity' => $item['quantity'],
//                 'total_price' => $item['quantity'] * $item['price'],
//                 'updated_at' => now(),
//             ]
//         );
//     }

//     return response()->json(['success' => true]);
// }

    // public function finalizeOrder(Request $request)
    // {
    //     $orderNo = $request->order_no;
    //     $tableNo = $request->table_no;
    //     $userId = $request->user_id;
    //     $items = $request->items;

    //     $paymentType = $request->payment_type;
    //     $customerAmount = $request->customer_amount;
    //     // dd($paymentType, $customerAmount);  
    //     $existingFoodIds = DB::table('orders')
    //         ->where('order_no', $orderNo)
    //         ->where('table_no', $tableNo)
    //         ->pluck('food_id')
    //         ->toArray();

    //     $submittedFoodIds = array_column($items, 'productId');

    //     $toDelete = array_diff($existingFoodIds, $submittedFoodIds);
    //     if (!empty($toDelete)) {
    //         DB::table('orders')
    //             ->where('order_no', $orderNo)
    //             ->where('table_no', $tableNo)
    //             ->whereIn('food_id', $toDelete)
    //             ->delete();
    //     }

    //     foreach ($items as $item) {
    //         $exists = DB::table('orders')
    //             ->where('order_no', $orderNo)
    //             ->where('table_no', $tableNo)
    //             ->where('food_id', $item['productId'])
    //             ->exists();

    //         if ($exists) {
    //             DB::table('orders')
    //                 ->where('order_no', $orderNo)
    //                 ->where('table_no', $tableNo)
    //                 ->where('food_id', $item['productId'])
    //                 ->update([
    //                     'quantity' => $item['quantity'],
    //                     'total_price' => $item['quantity'] * $item['price'],
    //                     'payment_status' => 1,
    //                     'kitchen_status' => 1,
    //                     'payment_type' => $paymentType,
    //                     'customer_amount' => $customerAmount,
    //                     'updated_at' => now(),
    //                 ]);
    //         } else {
    //             DB::table('orders')->insert([
    //                 'order_no' => $orderNo,
    //                 'table_no' => $tableNo,
    //                 'food_id' => $item['productId'],
    //                 'quantity' => $item['quantity'],
    //                 'total_price' => $item['quantity'] * $item['price'],
    //                 'user_id' => $userId,
    //                 'payment_status' => 1,
    //                 'kitchen_status' => 1,
    //                 'payment_type' => $paymentType,
    //                 'customer_amount' => $customerAmount,
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]);
    //         }
    //     }

    //     return response()->json(['success' => true]);
    // }

public function finalizeOrder(Request $request)
{
    $orderNo = $request->order_no;
    $tableNo = $request->table_no;
    $userId = $request->user_id;
    $orderType = $request->order_type;
    $items = $request->items;
    // dd($orderType );
    $paymentType = $request->payment_type;
    $customerAmount = $request->customer_amount;

    $existingFoodIds = DB::table('orders')
        ->where('order_no', $orderNo)
        ->where('table_no', $tableNo)
        ->pluck('food_id')
        ->toArray();

    $submittedFoodIds = array_column($items, 'productId');

    $toDelete = array_diff($existingFoodIds, $submittedFoodIds);
    if (!empty($toDelete)) {
        DB::table('orders')
            ->where('order_no', $orderNo)
            ->where('table_no', $tableNo)
            ->whereIn('food_id', $toDelete)
            ->delete();

        Kitchen::where('order_no', $orderNo)
            ->where('table_no', $tableNo)
            ->whereIn('food_id', $toDelete)
            ->delete();
    }

    foreach ($items as $item) {
        $exists = DB::table('orders')
            ->where('order_no', $orderNo)
            ->where('table_no', $tableNo)
            ->where('food_id', $item['productId'])
            ->exists();

        if ($exists) {
            DB::table('orders')
                ->where('order_no', $orderNo)
                ->where('table_no', $tableNo)
                ->where('food_id', $item['productId'])
                ->update([
                    'quantity' => $item['quantity'],
                    'total_price' => $item['quantity'] * $item['price'],
                    'payment_status' => 1,
                    'kitchen_status' => 1,
                    'order_type'     => $orderType,
                    'payment_type' => $paymentType,
                    'customer_amount' => $customerAmount,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('orders')->insert([
                'order_no' => $orderNo,
                'table_no' => $tableNo,
                'food_id' => $item['productId'],
                'quantity' => $item['quantity'],
                'total_price' => $item['quantity'] * $item['price'],
                'user_id' => $userId,
                'payment_status' => 1,
                'kitchen_status' => 1,
                'order_type'     => $orderType,
                'payment_type' => $paymentType,
                'customer_amount' => $customerAmount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Kitchen::updateOrCreate(
            [
                'order_no' => $orderNo,
                'table_no' => $tableNo,
                 'order_type'  => $orderType,
                'food_id' => $item['productId'],
            ],
            [
                'user_id' => $userId,
                'quantity' => $item['quantity'],
                'kitchen_status' => 1,
                'order_type'     => $orderType,
                'timer' => null, 
            ]
        );
    }

    return response()->json(['success' => true]);
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
    public function show(Cashier $cashier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cashier $cashier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cashier $cashier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cashier $cashier)
    {
        //
    }
}
