<?php

namespace Modules\Expense\Http\Controllers;

use Modules\Expense\DataTables\ExpensesDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Expense\Entities\Expense;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

class ExpenseController extends Controller
{

    public function index(ExpensesDataTable $dataTable) {
        abort_if(Gate::denies('access_expenses'), 403);

        return $dataTable->render('expense::expenses.index');
    }


    public function create() {
        abort_if(Gate::denies('create_expenses'), 403);

        return view('expense::expenses.create');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('create_expenses'), 403);

        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255',
            'category_id' => 'required',
            'amount' => 'required|numeric|max:2147483647',
            'details' => 'nullable|string|max:1000'
        ]);

        Expense::create([
            'date' => $request->date,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'details' => $request->details
        ]);

        toast('Expense Created!', 'success');

        return redirect()->route('expenses.index');
    }


    public function edit(Expense $expense) {
        abort_if(Gate::denies('edit_expenses'), 403);

        return view('expense::expenses.edit', compact('expense'));
    }


    public function update(Request $request, Expense $expense) {
        abort_if(Gate::denies('edit_expenses'), 403);

        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255',
            'category_id' => 'required',
            'amount' => 'required|numeric|max:2147483647',
            'details' => 'nullable|string|max:1000'
        ]);

        $expense->update([
            'date' => $request->date,
            'reference' => $request->reference,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'details' => $request->details
        ]);

        toast('Expense Updated!', 'info');

        return redirect()->route('expenses.index');
    }


    public function destroy(Expense $expense) {
        abort_if(Gate::denies('delete_expenses'), 403);

        $expense->delete();

        toast('Expense Deleted!', 'warning');

        return redirect()->route('expenses.index');
    }
}
