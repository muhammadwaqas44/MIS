<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\ExpCategory;
use App\Expense;
use App\Exports\ExpensesExport;
use App\ExpType;
use App\Services\ExpenseServices;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseController extends Controller
{
    public function allExpenses(Request $request, ExpenseServices $expenseServices)
    {
        $data['type'] = ExpType::all();
        $data['category'] = ExpCategory::all();
        $data['allExpenses'] = $expenseServices->allExpenses($request);
        return view('admin.expense.all-expenses', compact('data'));
    }

    public function addExpense()
    {
        $data['type'] = ExpType::all();
        $data['employees'] = User::orderBy('first_name')->get();
        return view('admin.expense.add-expense', compact('data'));
    }

    public function editExpenseView($expID)
    {
        $expense = Expense::where('id', $expID)->firstOrFail();
        $data['type'] = ExpType::all();
        $data['employees'] = User::orderBy('first_name')->get();
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

    public function exportExpenses()
    {
        return Excel::download(new ExpensesExport, 'All-Expenses.xlsx');
    }
}
