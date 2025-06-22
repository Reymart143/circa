<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use Illuminate\Http\Request;
use DB;
class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $categories = DB::table('categories')->get();

    if ($request->ajax()) {
        $category = $request->get('category');
        if ($category) {
            $foods = DB::table('products')->where('category', $category)->get();
        } else {
            $foods = DB::table('products')->get();
        }
        // Always pass both $categories and $foods to the view
        return view('cashier.index', compact('categories', 'foods'))->render();
    }

    $foods = DB::table('products')->get();
    return view('cashier.index', compact('categories', 'foods'));
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
