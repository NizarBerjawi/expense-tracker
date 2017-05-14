<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreExpense;
use App\Http\Requests\UpdateExpense;
use App\Http\Requests\DeleteExpense;
use App\Models\Expense;

class ExpensesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function _construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the expenses main page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expenses.index');
    }

    /**
     * Show the page to create a new expense
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.new');
    }

    /**
    * Store a new expense.
    *
    * @param  App\Http\Requests\StoreExpense
    * @return \Illuminate\Http\Response
    */
    public function store(StoreExpense $request)
    {
        // Get an instance of the user making the request
        $user = $request->user();
        // Create the expense
        $user->expenses()->create($request->all());
        // Flash the success message
        $request->session()->flash('success', 'Expense created successfully');
        return redirect()->route('expenses.index');
    }

    /**
     * Show a specified expense
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('expenses.view');
    }

    /**
     * Show the edit page of a specified expense
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('expenses.edit');
    }

    /**
     * Update the details of a specified expense.
     *
     * @param  App\Http\Requests\UpdateExpense  $request
     * @param  int  $expenseId
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpense $request, $expenseId)
    {
        // Get an instance of the user making the request
        $user = $request->user();
        // Update the expense
        $user->expenses()
             ->where('id', $expenseId)
             ->update($request->except(['_token', '_method']));
        // Flash the success message
        $request->session()->flash('success', 'Expense updated successfully!');
        return redirect()->route('expenses.edit', $expenseId);
    }

    /**
     * Delete a specified expense
     *
     * @param App\Models\Expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteExpense $request, $expenseId = null)
    {
        // Get the expense ids to be deleted
        $expenseIds = $request->input('expense_ids', $expenseId);
        // Delete the selected expenses
        Expense::discard((array) $expenseIds);
        // Flash the success message
        $request->session()->flash('success', 'Expenses deleted successfully!');
        return redirect()->route('expenses.index');
    }
}
