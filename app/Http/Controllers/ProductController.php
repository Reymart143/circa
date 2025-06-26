<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
 public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('products')
                ->select('id','product_name','start_time','end_time','description',
                        'price','discount','category','image','status');

            // ✅ Apply category filter if selected
            if (!empty($request->category)) {
                $query->where('category', $request->category);
            }

            return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($product) {
                    $button = '
                        <input type="hidden" id="account_' . $product->id . '" value="' . $product->product_name . '"/>
                    
                        <button type="button" name="edit" onclick="editmodalproduct(' . $product->id . ')" 
                            class="action-button accept btn btn-shadow btn-gradient-primary btn-sm" 
                            style="margin-left:7px;padding-top: 2mm;padding-bottom: 2mm;padding-left: 3mm; padding-right: 3mm;font-size: 10px;" >
                            <i class="fa fa-edit"></i> <span class="action-text" style="font-size:12px">Edit</span>
                        </button>
                        
                        <button type="button" name="softDelete" onclick="confirmDeleteProduct(' . $product->id . ')" 
                            class="action-button softDelete btn btn-shadow btn-gradient-danger btn-sm" 
                            style="margin-left:7px;padding-top: 2mm;padding-bottom: 2mm; padding-left: 3mm; padding-right: 3mm;font-size: 10px;">
                            <i class="fa fa-trash"></i> <span class="action-text" style="font-size:12px">Delete</span>
                        </button>
                        ';
                    return $button;
                })
                ->make(true);
        }

        return view('food_management.index'); 
    }
    public function updateStatus(Request $request)
    {
        $product = DB::table('products')->where('id', $request->id)->first();

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        DB::table('products')->where('id', $request->id)->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
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
            // dd($request->all());
            try {
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->start_time = $request->start_time;
            $product->category = $request->category;
            $product->end_time = $request->end_time;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->discount = $request->discount;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('food_image'), $filename);
                $product->image = 'food_image/' . $filename;
            }
            else{
                $product->image = 'No image uploaded';
            }
            $product->save();
        
            return response()->json(['success' => true, 'message' => 'Product saved successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to save product.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonnelProfile $personnelProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_product($id)
    {
      
        if(request()->ajax())
        {
            $data = Product::findOrFail($id);
            //   dd($person);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
 public function updateproduct(Request $request)
    {
        try {
            $product = Product::findOrFail($request->id);

            $product->product_name = $request->product_name;
            $product->category = $request->category;
            $product->start_time = $request->start_time;
            $product->end_time = $request->end_time;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->description = $request->description;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('food_image'), $filename);
                $product->image = 'food_image/' . $filename;
            }

            $product->save();

            return response()->json([
                'status' => 200,
                'message' => 'Successfully updated product info!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error updating product info!',
                'error' => $e->getMessage()
            ]);
        }
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
            $product = Product::findOrFail($id);
            $product->delete();
         
            return response()->json(['message' => 'Product deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the Product'], 500);
        }
    }
}
