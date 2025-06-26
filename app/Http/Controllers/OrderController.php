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
        DB::raw('SUM(orders.total_price) AS total_price'), // ✅ Sum total price per order
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


    public function getInfo($id)
        {
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json([
            'product_name' => $product->product_name,
            'category' => $product->category,
            'quantity' => $product->quantity,
            'price' => $product->price,
            'warehouse' => $product->warehouse,
            'reorder' => $product->reorder,
        ]);
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
    $orderItems = json_decode($request->order_items_json, true);
    $errors = [];

    if ($orderItems) {
        foreach ($orderItems as $item) {
            $product = DB::table('products')->where('id', $item['product_id'])->first();

            if (!$product) {
                $errors[] = "Product with ID {$item['product_id']} not found.";
                continue;
            }

            if ($item['quantity'] > $product->quantity) {
                $errors[] = "Cannot proceed: Ordered quantity for '<strong>{$product->product_name}</strong>' exceeds available stock (<strong>{$product->quantity}</strong>).";
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->with('error', implode("<br>", $errors));
        }

        $latestOrder = DB::table('orders')
            ->orderBy('id', 'desc')
            ->first();

        $latestId = $latestOrder ? intval(substr($latestOrder->transaction_no ?? 'TRNO000', 4)) : 0;
        $transactionNo = 'TRNO' . str_pad($latestId + 1, 3, '0', STR_PAD_LEFT);

        foreach ($orderItems as $item) {
            DB::table('orders')->insert([
                'product_id'     => $item['product_id'],
                'customer_name'  => $request->customer_name,
                'address'        => $request->address,
                'phone_no'       => $request->phone_no,
                'quantity'       => $item['quantity'],
                'total_amount'   => $item['quantity'] * $item['price'],
                'transaction_no' => $transactionNo, 
                'status'         => $request->status,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            DB::table('products')
                ->where('id', $item['product_id'])
                ->decrement('quantity', $item['quantity']);
        }

        return redirect()->back()->with('success', 'Order saved successfully. Transaction No: ' . $transactionNo);
    } else {
        return redirect()->back()->with('error', 'Cannot proceed transaction, no product selected.');
    }
}



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
