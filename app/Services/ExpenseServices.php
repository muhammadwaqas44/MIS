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
use Illuminate\Support\Facades\DB;

class ExpenseServices
{
    function __construct()
    {
        $this->allSchedulesPagination = 20;
//            env('Paginate_Value');
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
            $cat = $request->cat_id;
            $allExpenses = $allExpenses->where('expCategory_id', '=', $cat);
        }
        if ($request->emp_id) {
            $emp = $request->emp_id;
            $allExpenses = $allExpenses->where('employee_id', '=', $emp);
        }
        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $allExpenses = $allExpenses->whereBetween('created_at', [$start, $end]);
        }

        $data['allExpenses'] = $allExpenses->paginate($this->allSchedulesPagination);

        $data['amount'] = $data['allExpenses']->sum('amount');

//          $data['unko'] = $data['allExpenses']->select(DB::raw('SUM(amount) as sum'))
//            ->first();
//        dd($data);
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
        DB::beginTransaction();
        try {
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
            DB::commit();
            return 'success';
        } catch (\Exception $e) {
            DB::rollback();
            return 'error';
        }

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
        DB::beginTransaction();
        try {
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
            DB::commit();
            return 'success';
        } catch (\Exception $e) {
            DB::rollback();
            return 'error';
        }
    }


    public function searchExpenses($request)
    {
        $funds = Expense::select('expCategory_id', DB::raw('COUNT(*) as count'))
            ->groupBy('expCategory_id')
            ->selectRaw('SUM(amount) as sum')
            ->where([['exp_type_id', 1], ['is_active', 1]]);

        $expenses = Expense::select('expCategory_id', DB::raw('COUNT(*) as count'))
            ->groupBy('expCategory_id')
            ->selectRaw('SUM(amount) as sum')
            ->where([['exp_type_id', 2], ['is_active', 1]]);

        if ($request->emp_id) {
            $emp = $request->emp_id;
            $funds = $funds->where('employee_id', '=', $emp);
        }
        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $funds = $funds->whereBetween('created_at', [$start, $end]);
        }
        if ($request->emp_id) {
            $emp = $request->emp_id;
            $expenses = $expenses->where('employee_id', '=', $emp);
        }
        if ($request->date1 && $request->date2) {
            $start = Carbon::parse(str_replace('-', '', $request->date1));
            $end = Carbon::parse(str_replace('-', '', $request->date2));
            $expenses = $expenses->whereBetween('created_at', [$start, $end]);
        }
        $data['funds'] = $funds->get();
        $data['expenses'] = $expenses->get();
//        dd($data['funds']);
        return $data;
    }
}