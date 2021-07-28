<?php

namespace Modules\Expense\Http\Controllers;

use App\DataTables\ExpensesDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Expense\Entities\Expense;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

class ExpenseController extends Controller
{

    public function index(ExpensesDataTable $dataTable) {
        return $dataTable->render('expense::expenses.index');
    }


    public function create() {
        return view('expense::expenses.create');
    }


    public function store(Request $request) {
        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255|unique:expenses,reference',
            'category_id' => 'required',
            'amount' => 'required|integer',
            'details' => 'nullable|string|max:1000'
        ]);

        Expense::create([
            'date' => $request->date,
            'reference' => $request->reference,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'details' => $request->details
        ]);

        toast('Expense Created!', 'success');

        return redirect()->route('expenses.index');
    }


    public function edit(Expense $expense) {
        return view('expense::expenses.edit', compact('expense'));
    }


    public function update(Request $request, Expense $expense) {
        $request->validate([
            'date' => 'required|date',
            'reference' => 'required|string|max:255|unique:expenses,reference,' . $expense->id,
            'category_id' => 'required',
            'amount' => 'required|integer',
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
        $expense->delete();

        toast('Expense Deleted!', 'warning');

        return redirect()->route('expenses.index');
    }
}
