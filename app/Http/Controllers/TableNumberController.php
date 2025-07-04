<?php

namespace App\Http\Controllers;

use App\Models\TableNumber;
use Illuminate\Http\Request;
use DB;
class TableNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        if ($request->ajax()) {
            $table = DB::table('table_numbers')
                ->select('id', 'table_no', 'status')
                ->get();

    
            return datatables()->of($table)->addIndexColumn()
                ->addColumn('action', function ($table) {
                    $button = '
                        <input type="hidden" id="account_' . $table->id . '" value="' . $table->table_no . '"/>
                       
                        <button type="button" name="edit" onclick="editmodaltable(' . $table->id . ')" class="action-button accept btn btn-success btn-sm" style="margin-left:7px;padding-top: 2mm;padding-bottom: 2mm;padding-left: 3mm; padding-right: 3mm;font-size: 10px;"><i class="fa fa-edit"></i>  <span class="action-text" style="font-size:12px">Edit</span></button>
                        <button type="button" name="softDelete" onclick="confirmDelete(' . $table->id . ')" class="action-button softDelete btn btn-danger btn-sm" style="margin-left:7px;padding-top: 2mm;padding-bottom: 2mm; padding-left: 3mm; padding-right: 3mm;font-size: 10px;"><i class="fa fa-trash"></i>  <span class="action-text" style="font-size:12px">Delete</span></button>
                        ';
                    return $button;
                })
                ->make(true);
        }
        return view('tablenumber.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_tableno(Request $request)
    {
        $input = $request->table_no;

        if (preg_match('/^(\d+)\s*-\s*(\d+)$/', $input, $matches)) {
            $start = intval($matches[1]);
            $end = intval($matches[2]);

            if ($start > $end || $start < 1) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid range. Start must be less than or equal to end, and greater than 0.',
                ], 400);
            }

            $existing = TableNumber::whereBetween('table_no', [$start, $end])
                        ->pluck('table_no')->toArray();

            if (!empty($existing)) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Table numbers already exist: ' . implode(', ', $existing),
                ], 400);
            }

            for ($i = $start; $i <= $end; $i++) {
                TableNumber::create(['table_no' => $i]);
            }

            return response()->json([
                'status' => 200,
                'message' => "Successfully added tables from $start to $end.",
            ]);
        }

        if (!is_numeric($input) || intval($input) < 1) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid table number input.',
            ], 400);
        }

        $input = intval($input);

        if (TableNumber::where('table_no', $input)->exists()) {
            return response()->json([
                'status' => 400,
                'message' => 'Table number ' . $input . ' already exists.',
            ], 400);
        }

        TableNumber::create(['table_no' => $input]);

        return response()->json([
            'status' => 200,
            'message' => 'Successfully added Table Number ' . $input,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit_tableno($id)
    {   
        if(request()->ajax())
        {
            $data = TableNumber::findOrFail($id);
            return response()->json(['result' => $data]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_tableno(Request $request)
    {
      
        $updateform = DB::table('table_numbers')->where('id', $request->id)->update([
            'table_no'=>$request->table_no,
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
    
    public function softDeletetableno($id){
        try {
            $tableno = TableNumber::findOrFail($id);
            $tableno->delete();
         
            return response()->json(['message' => 'Table Number deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Table Number not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the Table Number'], 500);
        }
    }
}
