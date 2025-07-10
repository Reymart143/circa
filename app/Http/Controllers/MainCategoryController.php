<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use Illuminate\Http\Request;
use DB;
use Datatables;
use Illuminate\Support\Facades\Auth;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $maincategory = DB::table('main_categories')
                ->select('id', 'main_name', 'start_time','end_time')
                ->get();

            return datatables()->of($maincategory)->addIndexColumn()
                ->addColumn('action', function ($maincategory) {
                    $button = '
                        <input type="hidden" id="account_' . $maincategory->id . '" value="' . $maincategory->main_name . '"/>
                       
                        <button type="button" name="edit" onclick="editmodalcategory(' . $maincategory->id . ')" class="action-button accept btn btn-success btn-sm" style="margin-left:7px;padding-top: 2mm;padding-bottom: 2mm;padding-left: 3mm; padding-right: 3mm;font-size: 10px;"><i class="fa fa-edit"></i>  <span class="action-text" style="font-size:12px">Edit</span></button>
                        <button type="button" name="softDelete" onclick="confirmDelete(' . $maincategory->id . ')" class="action-button softDelete btn btn-danger btn-sm" style="margin-left:7px;padding-top: 2mm;padding-bottom: 2mm; padding-left: 3mm; padding-right: 3mm;font-size: 10px;"><i class="fa fa-trash"></i>  <span class="action-text" style="font-size:12px">Delete</span></button>
                        ';
                    return $button;
                })
                ->make(true);
        }
        return view('maincategory.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_maincategory(Request $request)
    {

        $maincategoryform = MainCategory::create([
            'main_name' => $request->main_name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
    
        if ($maincategoryform) {
          
            return response()->json([
                'status' => 200,
                'message' => 'Successfully Added Main Category',
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
    public function edit_maincategory($id)
    {   
        if(request()->ajax())
        {
            $data = MainCategory::findOrFail($id);
            return response()->json(['result' => $data]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_maincategory(Request $request)
    {
        $oldCategory = DB::table('main_categories')->where('id', $request->id)->first();

        $mainupdateform = DB::table('main_categories')->where('id', $request->id)->update([
            'main_name'=>$request->main_name,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
       if( $mainupdateform ){
       
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
    
    public function softDeletemain($id){
        try {
            $maincategory = MainCategory::findOrFail($id);
            $maincategory->delete();
         
            return response()->json(['message' => 'Category deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the Category'], 500);
        }
    }
}
