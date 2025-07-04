<?php

namespace App\Http\Controllers;

use App\Models\Kitchen;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TableNumber;
class KitchenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kitchen.index');
    }

    public function fetchOrders()
    {
        $today = Carbon::today();

        Kitchen::whereDate('created_at', '<', $today)->delete();

        $grouped = Kitchen::with('food')
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('order_no')
            ->map(function ($items) {
                return [
                    'order_no' => $items->first()->order_no,
                    'table_no' => $items->first()->table_no,
                    'order_type' => $items->first()->order_type,
                    'created_at' => $items->first()->created_at,
                    'kitchen_status' => $items->first()->kitchen_status,
                    'timer' => $items->first()->timer,
                    'items' => $items->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'quantity' => $item->quantity,
                            'product_name' => $item->food->product_name ?? 'Unknown'
                        ];
                    })->values()
                ];
            })->values();

        return response()->json($grouped);
    }
    public function updateStatus(Request $request)
    {
        $order = Kitchen::find($request->id);

        if (!$order) {
            return response()->json(['success' => false]);
        }
        Kitchen::where('order_no', $order->order_no)
            ->update(['kitchen_status' => $request->status]);

        if ((int)$request->status === 4) {
            $tableNo = $order->table_no;

            $allStatusServed = Kitchen::where('table_no', $tableNo)
                ->where('order_no', $order->order_no)
                ->where('kitchen_status', '!=', 4)
                ->doesntExist();

            if ($allStatusServed) {
                \DB::table('table_numbers')->where('table_no', $tableNo)->update(['status' => 0]);
            }
        }

        return response()->json(['success' => true]);
    }



    public function setTimer(Request $request)
    {
        $order = Kitchen::find($request->id);
        if ($order) {
            Kitchen::where('order_no', $order->order_no)
                ->update(['timer' => $request->timer]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
   public function getAvailableTables()
    {
        $today = Carbon::today();

        $allTables = TableNumber::where('status',0)->pluck('table_no');

        $blockedTables = Kitchen::whereDate('created_at', $today)
            ->whereIn('kitchen_status', [0,1, 2, 3]) 
            ->pluck('table_no')
            ->unique();

        $availableTables = $allTables->diff($blockedTables)->values();

        return response()->json($availableTables);
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
    public function show(Kitchen $kitchen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kitchen $kitchen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kitchen $kitchen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kitchen $kitchen)
    {
        //
    }
}
