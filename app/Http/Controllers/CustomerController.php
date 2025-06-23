<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Customer;
=======
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
>>>>>>> ba3da6ef301860262896a0370b6d45bdf4309bd5
use Illuminate\Http\Request;
use DB;
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
<<<<<<< HEAD
        $products = DB::table('products')->get();
        return view('customer.menu',compact('products'));
    }
=======
   
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


>>>>>>> ba3da6ef301860262896a0370b6d45bdf4309bd5
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
