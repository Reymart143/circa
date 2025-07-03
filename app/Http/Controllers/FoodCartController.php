<?php

namespace App\Http\Controllers;

use App\Models\FoodCart;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class FoodCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
  public function customerorder($order_no,$table_no)
    {
        return view('customer.orders', compact('order_no','table_no'));
    }
    public function addToCart(Request $request)
    {
        $userId = auth()->id(); 

        $cart = \App\Models\Cart::where('user_id', $userId)
                    ->where('product_id', $request->product_id)
                    ->first();

        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            \App\Models\Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json(['success' => true]);
    }
    public function submitOrder(Request $request)
    {

        $orders = $request->input('orders');
       
        $table_no = $request->input('table_no'); 
        $order_type = $request->input('order_type');
        if($order_type == null){
            return response()->json(['error'=> 'Please select an order type.'],400);
        }
        if (Auth::check()) {
            $user = User::find(Auth::id());
            $user_id = $user->id;

            $used_points = floatval($request->input('used_points', 0));

            
            if ($user->points >= $used_points && $used_points > 0) {
                $user->points -= $used_points;
            }

            $user->points += 0.5;

            $user->save();

        } else {
            $lastGuest = DB::table('orders')
                            ->where('user_id', 'like', 'guest%')
                            ->orderBy('user_id', 'desc')
                            ->first();

            if ($lastGuest) {
                $lastNumber = intval(substr($lastGuest->user_id, 5)); 
                $nextGuestNumber = $lastNumber + 1;
            } else {
                $nextGuestNumber = 1;
            }
            $user_id = 'guest' . str_pad($nextGuestNumber, 3, '0', STR_PAD_LEFT);  
        }

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
        // dd($request->all());

        foreach ($orders as $order) {
            $pointused = Auth::check() ? $used_points : 0;              
            DB::table('orders')->insert([
                'food_id'         => $order['id'],
                'table_no'        => $table_no, 
                'user_id'         => $user_id,
                'quantity'        => $order['quantity'],
                'flavor'          => $order['flavor'],
                'size'            => $order['size'],
                'order_no'        => $order_no,
                'total_price'     => $order['price'] * $order['quantity'],
                'customer_amount' => 0,
                'pointused'       => $pointused,
                'order_type'      => $order_type,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
        return response()->json([
            'redirect_url' => route('yourorders', ['order_no' => $order_no,'table_no' => $table_no])
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodCart $foodCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodCart $foodCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodCart $foodCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodCart $foodCart)
    {
        //
    }
}
