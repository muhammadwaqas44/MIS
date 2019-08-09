<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Exports\VendorExport;
use App\Professional;
use App\Services\VendorServices;
use App\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class VendorController extends Controller
{
    public function allVendor(Request $request, VendorServices $vendorServices)
    {
        $data['professional'] = Professional::where('id', '!=', 1)->get();
        $data['allVendor'] = $vendorServices->allVendor($request);
        return view('admin.vendor.all-vendors', compact('data'));
    }

    public function addVendor()
    {
        $matchThese = [2723, 2724, 2725, 2726, 2727, 2728, 2729];
        $data['city'] = City::whereIn('state_id', $matchThese)->orderBy('name')->get();
        $data['professional'] = Professional::where('id', '!=', 1)->get();
//        dd($data['city']);
        return view('admin.vendor.add-vendor', compact('data'));

    }

    public function addVendorPost(Request $request, VendorServices $vendorServices)
    {
        $vendorServices->addVendorPost($request);
        return redirect()->route('admin.all-vendors');

    }

    public function updateVendor($vendorId)
    {
        $vendor = Vendor::find($vendorId);
        $matchThese = [2723, 2724, 2725, 2726, 2727, 2728, 2729];
        $data['city'] = City::whereIn('state_id', $matchThese)->orderBy('name')->get();
        $data['professional'] = Professional::where('id', '!=', 1)->get();
        return view('admin.vendor.update-vendor', compact('vendor', 'data'));
    }

    public function updateVendorPost(Request $request, $vendorId, VendorServices $vendorServices)
    {
        $vendorServices->updateVendorPost($request, $vendorId);
        return redirect()->route('admin.all-vendors');

    }

    public function downloadAttachFile($vendorId)
    {
        $vendor = Vendor::where('id', $vendorId)->firstOrFail();
        if ($vendor->attech_file) {
            $file = public_path() . $vendor->attech_file;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }
    public function exportVendor(){
        return Excel::download(new VendorExport, 'All-Vendors.xlsx');
    }
}
