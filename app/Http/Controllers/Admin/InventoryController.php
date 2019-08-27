<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\InventHis;
use App\Inventory;
use App\InventoryStatus;
use App\InventoryType;
use App\Services\InventoryServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function allInventories(Request $request, InventoryServices $inventoryServices)
    {
        $data['type'] = InventoryType::all();
        $data['allInventories'] = $inventoryServices->allInventories($request);
        return view('admin.inventory.all-inventories', compact('data'));
    }

    public function createInventory()
    {
        $data['type'] = InventoryType::all();
        return view('admin.inventory.create-inventory', compact('data'));
    }

    public function editInventory($inventoryId)
    {
        $inventory = Inventory::find($inventoryId);
        $data['type'] = InventoryType::all();
        return view('admin.inventory.edit-inventory', compact('data', 'inventory'));
    }

    public function viewInventroyAssign($inventoryId)
    {
        $inventory = Inventory::find($inventoryId);
        $data['employees'] = Employee::all();
        $data['statuses'] = InventoryStatus::where('id','!=',1)->get();
//        dd($data['statuses']);
        $data['inventHis'] = InventHis::orderBy('id','desc')->get();
        return view('admin.inventory.asign-inventory', compact('data', 'inventory'));
    }

    public function addInventroyPost(Request $request, InventoryServices $inventoryServices)
    {
        $inventoryServices->addInventroyPost($request);
        return redirect()->route('admin.all-inventories');
    }

    public function updateInventroyPost(Request $request, $inventoryId, InventoryServices $inventoryServices)
    {
        $inventoryServices->updateInventroyPost($request, $inventoryId);
        return redirect()->route('admin.all-inventories');
    }

    public function assignInventroyPost(Request $request, InventoryServices $inventoryServices)
    {
//        dd($request->all());
        $inventoryServices->assignInventroyPost($request);
        return redirect()->route('admin.all-inventories');
    }
}
