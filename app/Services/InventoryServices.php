<?php
/**
 * Created by PhpStorm.
 * Date: 8/23/2019
 * Time: 5:08 PM
 */

namespace App\Services;


use App\InventHis;
use App\Inventory;
use Carbon\Carbon;

class InventoryServices
{

    function __construct()
    {
        $this->allSchedulesPagination = 20;
    }

    public function allInventories($request)
    {
        $allInventories = Inventory::orderBy('id', 'desc');

        if ($request->search_title) {
            $title = $request->search_title;
            $allInventories = $allInventories->where('specification', 'like', '%' . $title . '%')
                ->orWhere('note', 'like', '%' . $title . '%');
        }
        if ($request->type_id) {
            $professional = $request->type_id;
            $allInventories = $allInventories->where('type_id', '=', $professional);
        }

        $data['allInventories'] = $allInventories->paginate($this->allSchedulesPagination);
        return $data;
    }

    public function addInventroyPost($request)
    {
        $inventory = Inventory::create([
            'is_active' => 1,
            "specification" => $request->specification,
            "type_id" => $request->type_id,
            "note" => $request->note,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now()->timezone(session('timezone')),
        ]);
        if ($inventory) {
            InventHis::create([
                'is_active' => 1,
                'status_id' => 1,
                "inventory_id" => $inventory->id,
                'user_id' => auth()->user()->id,
                'created_at' => Carbon::now()->timezone(session('timezone')),
            ]);
        }
    }

    public function updateInventroyPost($request, $inventoryId)
    {
//        dd($request->all());
        $inventory = Inventory::find($inventoryId);
        if ($inventory) {
            $inventory->type_id = $request->type_id;
            $inventory->specification = $request->specification;
            $inventory->note = $request->note;
            $inventory->user_id = auth()->user()->id;
            $inventory->save();
        }
    }

    public function assignInventroyPost($request)
    {
//        dd($request->all());
        if (!empty($request->on_date)) {
            $on_date = Carbon::parse(str_replace('-', '', $request->on_date))->format('Y-m-d');
        } else {
            $on_date = null;
        }
        InventHis::create([
            'is_active' => 1,
            "employee_id" => $request->employee_id,
            "inventory_id" => $request->inventory_id,
            'status_id' => $request->status_id,
            "on_date" => $on_date,
            "remarks" => $request->remarks,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now()->timezone(session('timezone')),
        ]);
    }

}