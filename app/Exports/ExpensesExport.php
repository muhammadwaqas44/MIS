<?php

namespace App\Exports;

use App\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpensesExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $allVendors = collect(Expense::all());
        $valueArray = [];
        foreach ($allVendors as $vendor) {
            $valueArray[] = [
                'id' => $vendor->id,
                "amount" => $vendor->amount,
                "date" => $vendor->date,
                "exp_type_id" => $vendor->typeName->name,
                "expCategory_id" => $vendor->categoryName->name,
                "employee_id" => $vendor->empName->name,
                "description" => $vendor->description,
                'created_first_name' => $vendor->createdBy->first_name,
                'created_last_name' => $vendor->createdBy->last_name,
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
            'Amount',
            'Date',
            'Expense Type',
            'Expense Category',
            'Employee',
            'Description',
            'Created By First Name',
            'Created By Last Name',

        ];
    }
}
