<?php
/**
 * Created by PhpStorm.
 * Date: 8/30/2019
 * Time: 6:31 PM
 */

namespace App\Services;


use App\Expense;
use App\Helpers\ImageHelpers;
use Carbon\Carbon;

class ExpenseServices
{
    function __construct()
    {
        $this->allSchedulesPagination = 20;
    }

    public function allExpenses($request)
    {
        $allExpenses = Expense::orderBy('id', 'desc');

        if ($request->search_title) {
            $title = $request->search_title;
            $allExpenses = $allExpenses->where('amount', '=', $title)
                ->orWhere('description', 'like', '%' . $title . '%');
        }
        if ($request->type_id) {
            $professional = $request->type_id;
            $allExpenses = $allExpenses->where('exp_type_id', '=', $professional);
        }
        if ($request->cat_id) {
            $professional = $request->cat_id;
            $allExpenses = $allExpenses->where('expCategory_id', '=', $professional);
        }

        $data['allExpenses'] = $allExpenses->paginate($this->allSchedulesPagination);
        return $data;
    }

    public function postExpense($request)
    {
        if (!empty($request->date)) {
            $date = Carbon::parse(str_replace('-', '', $request->date))->format('Y-m-d H:i:s');
        } else {
            $date = null;
        }
        if (!empty($request->image)) {
            $extension = $request->image->getClientOriginalExtension();
            $fileName = time() . "-" . 'expense-file.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('image'), $fileName);
            $image = "/project-assets/files/" . $fileName;
        } else {
            $image = null;
        }
        Expense::create([
            'expCategory_id' => $request->expCategory_id,
            'exp_type_id' => $request->exp_type_id,
            'is_active' => 1,
            'amount' => $request->amount,
            "date" => $date,
            "employee_id" => $request->employee_id,
            "description" => $request->description,
            "image" => $image,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now()->timezone(session('timezone')),
        ]);

    }

    public function postEditExpense($request, $expId)
    {
        $expense = Expense::find($expId);
        if (!empty($request->date)) {
            $date = Carbon::parse(str_replace('-', '', $request->date))->format('Y-m-d H:i:s');
        } else {
            $date = null;
        }
        if (!empty($request->image)) {
            $extension = $request->image->getClientOriginalExtension();
            $fileName = time() . "-" . 'expense-file.' . $extension;
            ImageHelpers::uploadFile('/project-assets/files/', $request->file('image'), $fileName);
            $image = "/project-assets/files/" . $fileName;
        } else {
            $image = $request->image_hide;
        }
        if ($expense) {
            $expense->image = $image;
            $expense->exp_type_id = $request->exp_type_id;
            $expense->expCategory_id = $request->expCategory_id;
            $expense->amount = $request->amount;
            $expense->date = $date;
            $expense->employee_id = $request->employee_id;
            $expense->description = $request->description;
            $expense->user_id = auth()->user()->id;
            $expense->save();
        }
    }
}