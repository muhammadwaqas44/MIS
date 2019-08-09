<?php

namespace App\Exports;

use App\Vendor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VendorExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $allVendors= collect(Vendor::all());
        $valueArray = [];
        foreach ($allVendors as $vendor) {
            $valueArray[] = [
                'id' => $vendor->id,
                "name" => $vendor->name,
                "contact_no_primary" => $vendor->contact_no_primary,
                "contact_no_secondary" => $vendor->contact_no_secondary,
                "landline" => $vendor->landline,
                "address" => $vendor->address,
                "city_id" => $vendor->city->name,
                "professional_id" => $vendor->professional->name,
                "remarks" => $vendor->remarks,
                'created_first_name' => $vendor->user->first_name,
                'created_last_name' => $vendor->user->last_name,
            ];
        }
        return collect([
            $valueArray
        ]);
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Contact No Primary',
            'Contact No Secondary',
            'Land Line',
            'Address',
            'City',
            'Professional',
            'Remarks',
            'Created By First Name',
            'Created By Last Name',

        ];
    }
}
