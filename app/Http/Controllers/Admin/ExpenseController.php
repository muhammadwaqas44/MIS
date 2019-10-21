<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\ExpCategory;
use App\Expense;
use App\Exports\ExpensesExport;
use App\ExpType;
use App\Services\ExpenseServices;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseController extends Controller
{
    public function allExpenses(Request $request, ExpenseServices $expenseServices)
    {
        $data['type'] = ExpType::all();
        $funds = DB::table('expenses')
            ->select(DB::raw('SUM(amount) as count'))
            ->where([['exp_type_id', 1], ['employee_id', auth()->user()->id], ['is_active', 1]])
            ->first();
        $expense = DB::table('expenses')
            ->select(DB::raw('SUM(amount) as count'))
            ->where([['exp_type_id', 2], ['employee_id', auth()->user()->id], ['is_active', 1]])
            ->first();
        $amount = $funds->count - $expense->count;
//        dd($amount, $funds, $expense);
        $data['category'] = ExpCategory::all();
        $data['employees'] = Employee::withoutGlobalScopes()
            ->join('users', 'employees.email', '=', 'users.email')
            ->where('employees.is_active', 1)
            ->get();
        $data['allExpenses'] = $expenseServices->allExpenses($request);
        return view('admin.expense.all-expenses', compact('data', 'amount'));
    }

    public function addExpense()
    {
        $data['type'] = ExpType::all();
        $data['employees'] = Employee::withoutGlobalScopes()
            ->join('users', 'employees.email', '=', 'users.email')
            ->where('employees.is_active', 1)
            ->get();
        return view('admin.expense.add-expense', compact('data'));
    }

    public function editExpenseView($expID)
    {
        $expense = Expense::where('id', $expID)->firstOrFail();
        $data['type'] = ExpType::all();
        $data['employees'] = Employee::withoutGlobalScopes()
            ->join('users', 'employees.email', '=', 'users.email')
            ->where('employees.is_active', 1)
            ->get();
        return view('admin.expense.edit-expense', compact('data', 'expense'));
    }

    public function postExpense(Request $request, ExpenseServices $expenseServices)
    {
        $expenseServices->postExpense($request);
        return redirect()->route('admin.all-expenses');
    }

    public function postEditExpense(Request $request, $expId, ExpenseServices $expenseServices)
    {
        $expenseServices->postEditExpense($request, $expId);
        return redirect()->route('admin.all-expenses');
    }

    public function downloadFile($expID)
    {
        $expense = Expense::where('id', $expID)->firstOrFail();
        if ($expense->image) {
            $file = public_path() . $expense->image;
            return response()->file($file);
        } else {
            return 'File Does not Exist';
        }
    }

    public function deleteExpense($expID)
    {
        $expense = Expense::where('id', $expID)->firstOrFail();
        if ($expense->is_active == 1) {
            $expense->is_active = 0;
            $expense->save();
            return redirect()->back();
        }
    }

    public function searchExpenses(Request $request, ExpenseServices $expenseServices)
    {
        $data['employees'] = Employee::withoutGlobalScopes()
            ->join('users', 'employees.email', '=', 'users.email')
            ->where('employees.is_active', 1)
            ->get();
        $data['funds'] = $expenseServices->searchExpenses($request);
        $data['expenses'] = $expenseServices->searchExpenses($request);
//        $count_funds = $data['expenses_funds']->count();
//        $funds_type= $data['expenses_funds']->take(1);
        return view('admin.expense.summary', compact('data'));
    }

    public function exportExpenses()
    {
        return Excel::download(new ExpensesExport, 'All-Expenses.xlsx');
    }
}
