<?php

namespace App\Http\Controllers;

use App\Models\FoodCart;
use Illuminate\Http\Request;

class FoodCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function customerorder(){
        return view('customer.orders');
    }
    public function addToCart(Request $request)
    {
        // For authenticated user. If you're not using auth, we can adjust
        $userId = auth()->id(); 

        // Check if already in cart
        $cart = \App\Models\Cart::where('user_id', $userId)
                    ->where('product_id', $request->product_id)
                    ->first();

        if ($cart) {
            // If exists, increment quantity
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            // If not exists, create new cart item
            \App\Models\Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
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
