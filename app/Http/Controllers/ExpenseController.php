<?php

namespace App\Http\Controllers;

use App\Expenses;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    //index

    public function newExpense(Request $request)
    {
        return view('dashboard.new_expense');
    }

    public function addExpense(Request $request)
    {
        $expense_data = [
            'expenses_name' => $request->input('expense_name'),
            'expenses_price' => $request->input('expense_price'),
            'expenses_status' => 0,
        ];

        $stmt = Expenses::create($expense_data);
        if ($stmt) {
            return response()->json([
                'status' => 200,
                'data' => $stmt
            ]);
        }else{
            return response()->json([
                'status' => 300
            ]);
        };

    }

    public function recentExpenses(Request $request)
    {
        $view_data['expenses'] = Expenses::all();
        return view('dashboard.view_expenses', $view_data);
    }

    public function approveExpenses(Request $request, $id)
    {
        $stmt = Expenses::find($id);

        if ($stmt) {
            $expense_data = [
                'expenses_status' => 1,
            ];
            Expenses::where('id', $id)->update($expense_data);
            $request->session()->flash('status', 'Expenses Approved');
            return redirect(route('recent.expenses'));
        }else {
            $request->session()->flash('status', 'Expenses not found');
            return redirect(route('recent.expenses'));
        }

    }

    public function declineExpenses(Request $request, $id)
    {
        $stmt = Expenses::find($id);

        if ($stmt) {
            $expense_data = [
                'expenses_status' => 3,
            ];
            Expenses::where('id', $id)->update($expense_data);
            $request->session()->flash('status', 'Expenses Decline');
            return redirect(route('recent.expenses'));
        }else {
            $request->session()->flash('status', 'Expenses not found');
            return redirect(route('recent.expenses'));
        }
    }
}
