<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreExpense;
use App\Http\Requests\UpdateExpense;
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
    // Create the expense model
    $expense = Expense::create([
      'name'        => $request->input('name'),
      'date'        => $request->input('date'),
      'amount'      => $request->input('amount'),
      'category_id' => $request->input('categoryId'),
      'user_id'     => $request->user()->id,
      'description' => $request->input('description'),
    ]);
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
    // Update the expense
    Expense::where('id', $expenseId)
           ->update([
             'name'         => $request->input('name'),
             'description'  => $request->input('description'),
             'category_id'  => $request->input('categoryId'),
             'user_id'      => $request->user()->id,
             'date'         => $request->input('date'),
             'amount'       => $request->input('amount'),
           ]);
    $request->session()->flash('success', 'Expense updated successfully!');
    return redirect()->route('expenses.edit', $expenseId);
  }

  /**
   * Delete a specified expense
   *
   * @param App\Models\Expense
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, Expense $expense)
  {
    // Delete the expense
    $expense->delete();
    $request->session()->flash('success', 'Expense deleted successfully!');
    return redirect()->route('expenses.index');
  }
}
