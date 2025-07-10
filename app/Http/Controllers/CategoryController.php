<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use Datatables;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        if ($request->ajax()) {
            $category = DB::table('categories as c')
                ->leftJoin('main_categories as mc', 'c.category_details', '=', 'mc.id')
                ->select('c.id', 'c.category_name', 'c.status', 'c.category_id', 'mc.main_name as category_details')
                ->get();

            return datatables()->of($category)->addIndexColumn()
                ->addColumn('action', function ($category) {
                    return '
                        <input type="hidden" id="account_' . $category->id . '" value="' . $category->category_name . '"/>
                        <button type="button" name="edit" onclick="editmodalcategory(' . $category->id . ')" class="action-button accept btn btn-success btn-sm" style="margin-left:7px;padding-top: 2mm;padding-bottom: 2mm;padding-left: 3mm; padding-right: 3mm;font-size: 10px;">
                            <i class="fa fa-edit"></i> <span class="action-text" style="font-size:12px">Edit</span>
                        </button>
                        <button type="button" name="softDelete" onclick="confirmDelete(' . $category->id . ')" class="action-button softDelete btn btn-danger btn-sm" style="margin-left:7px;padding-top: 2mm;padding-bottom: 2mm; padding-left: 3mm; padding-right: 3mm;font-size: 10px;">
                            <i class="fa fa-trash"></i> <span class="action-text" style="font-size:12px">Delete</span>
                        </button>
                    ';
                })
                ->make(true);
        }

        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_category(Request $request)
    {

        $latestCategory = DB::table('categories')
            ->select('category_id')
            ->orderBy('category_id', 'desc')
            ->first();
    
        if ($latestCategory && preg_match('/cat(\d+)/', $latestCategory->category_id, $matches)) {
            $number = intval($matches[1]) + 1;
        } else {
            $number = 1;
        }
        $newCategoryId = 'cat' . str_pad($number, 3, '0', STR_PAD_LEFT);
    
        $categoryform = Category::create([
            'category_id' => $newCategoryId,
            'category_name' => $request->category_name,
            'category_details' => $request->category_details,
        ]);
    
        if ($categoryform) {
          
            return response()->json([
                'status' => 200,
                'message' => 'Successfully Added Category',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'An error occurred',
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit_category($id)
    {   
        if(request()->ajax())
        {
            $data = Category::findOrFail($id);
            return response()->json(['result' => $data]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_category(Request $request)
    {
        $oldCategory = DB::table('categories')->where('id', $request->id)->first();

        $updateform = DB::table('categories')->where('id', $request->id)->update([
            'category_name'=>$request->category_name,
            'category_details'=>$request->category_details,
        ]);
       if( $updateform ){
       
        return response()->json([
            'status'=> 200,
            'message'=>'Success Update Info!!'
        ]);
       }else{
        return response()->json([
            'status'=> 400,
            'message'=>'ERROR Update Info!!'
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
            $category = Category::findOrFail($id);
            $category->delete();
         
            return response()->json(['message' => 'Category deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the Category'], 500);
        }
    }
}
