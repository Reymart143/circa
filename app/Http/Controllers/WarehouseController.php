<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use DB;

class WarehouseController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $warehouse = DB::table('warehouses')
                ->select('id',    
                         'warehouse_name',
                        'location',
                        'status',)
                ->get();

    
            return datatables()->of($warehouse)->addIndexColumn()
                ->addColumn('action', function ($warehouse) {
                    $button = '
                        <input type="hidden" id="account_' . $warehouse->id . '" value="' . $warehouse->warehouse_name . '"/>
                    
                        <button type="button" name="edit" onclick="editmodalWarehouse(' . $warehouse->id . ')" class="action-button accept btn btn-shadow btn-gradient-primary btn-sm" style="margin-left:7px;padding-top: 2mm;padding-bottom: 2mm;padding-left: 3mm; padding-right: 3mm;font-size: 10px;"><i class="fa fa-edit"></i>  <span class="action-text" style="font-size:12px">Edit</span></button>
                        <button type="button" name="softDelete" onclick="confirmDeleteWarehouse(' . $warehouse->id . ')" class="action-button softDelete btn btn-shadow btn-gradient-danger btn-sm" style="margin-left:7px;padding-top: 2mm;padding-bottom: 2mm; padding-left: 3mm; padding-right: 3mm;font-size: 10px;"><i class="fa fa-trash"></i>  <span class="action-text" style="font-size:12px">Delete</span></button>
                        ';
                    return $button;
                })
                ->make(true);
        }
        return view('warehouse.index');
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
        
        $warehouseform = Warehouse::create([
            'warehouse_name' => $request->warehouse_name,
            'status' => $request->status,
            'location' => $request->location,
         
        ]);
    
        if ($warehouseform) {
            
            return response()->json([
                'status' => 200,
                'message' => 'Successfully Added Warehouse Details',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'An error occurred',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MachineryDetail $MachineryDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_warehouse($id)
    {
        if(request()->ajax())
        {
           
            $data = Warehouse::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_Warehouse(Request $request)
    {
      
    
        $updateWarehouse= DB::table('warehouses')->where('id', $request->id)->update([
           'warehouse_name' => $request->warehouse_name,
            'status' => $request->status,
            'location' => $request->location,
        ]);
        if($updateWarehouse ){
         
            return response()->json([
                'status'=> 200,
                'message'=>'Success Update Info!!'
            ]);
        }else{
            return response()->json([
                'status'=> 400,
                'message'=>'Error Update Info!!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function Deletewarehouse($id)
    {
          try {
            $warehouse= Warehouse::findOrFail($id);
            $warehouse->delete();
          
            return response()->json(['message' => 'Warehouse Details deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Commoditiy not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the Machinery Details'], 500);
        }
    }
}
