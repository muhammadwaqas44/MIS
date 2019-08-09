<?php
/**
 * Created by PhpStorm.
 * User: Sadaf Rana
 * Date: 8/6/2019
 * Time: 10:30 PM
 */

namespace App\Services;


use App\Helpers\ImageHelpers;
use App\Vendor;
use Carbon\Carbon;

class VendorServices
{
    function __construct()
    {
        $this->allSchedulesPagination = 20;
    }

    public function allVendor($request)
    {
        $allVendor = Vendor::orderBy('id', 'desc');

        if ($request->search_title) {
            $title = $request->search_title;
            $allVendor = $allVendor->where('name', 'like', '%' . $title . '%')
                    ->orWhere('contact_no_primary', 'like', '%' . $title . '%')
                    ->orWhere('contact_no_secondary', 'like', '%' . $title . '%')
                    ->orWhere('landline', 'like', '%' . $title . '%')
                    ->orWhere('address', 'like', '%' . $title . '%')
                    ->orWhere('user_phone', 'like', '%' . $title . '%');
        }
        if ($request->professional_id) {
            $professional= $request->professional_id;
            $allVendor = $allVendor->where('professional_id', '=', $professional);
        }

        $data['allVendor'] = $allVendor->paginate($this->allSchedulesPagination);
        return $data;
    }

    public function addVendorPost($request)
    {
//        dd($request->all());
        $extension = $request->attech_file->getClientOriginalExtension();
        $fileName = time() . "-" . 'vendor.' . $extension;
        ImageHelpers::uploadFile('/project-assets/files/', $request->file('attech_file'), $fileName);
        Vendor::create([
            'attech_file' => "/project-assets/files/" . $fileName,
            'is_active' => 1,
            "name" => $request->name,
            "contact_no_primary" => $request->contact_no_primary,
            "contact_no_secondary" => $request->contact_no_secondary,
            "landline" => $request->landline,
            "address" => $request->address,
            "city_id" => $request->city_id,
            "professional_id" => $request->professional_id,
            "remarks" => $request->remarks,
            'created_by' => auth()->user()->id,
            'created_at' => Carbon::now()->timezone(session('timezone')),
        ]);
    }

    public function updateVendorPost($request, $vendorId)
    {
//        dd($request->all());
        $vendor = Vendor::find($vendorId);
        if (!empty($request->attech_file)) {
            $extension = $request->attech_file->getClientOriginalExtension();
            $fileName = time() . "-" . 'vendor.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('attech_file'), $fileName);
            $attach_file = "/project-assets/files/" . $fileName;
        } else {
            $attach_file = $request->attech_file_hile;
        }
        if ($vendor) {
            $vendor->attech_file = $attach_file;
            $vendor->name = $request->name;
            $vendor->contact_no_primary = $request->contact_no_primary;
            $vendor->contact_no_secondary = $request->contact_no_secondary;
            $vendor->landline = $request->landline;
            $vendor->address = $request->address;
            $vendor->city_id = $request->city_id;
            $vendor->professional_id = $request->professional_id;
            $vendor->remarks = $request->remarks;
            $vendor->created_by = auth()->user()->id;
            $vendor->save();
        }
    }
}