<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreIncome;
use App\Http\Requests\UpdateIncome;
use App\Models\Income;

class IncomeController extends Controller
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
   * Show the income main page
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('income.index');
  }

  /**
   * Show the page to create a new income
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('income.new');
  }

  /**
   * Store a new income.
   *
   * @param  App\Http\Requests\StoreIncome
   * @return \Illuminate\Http\Response
   */
  public function store(StoreIncome $request)
  {
    // Create the expense model
    $income = Income::create([
      'name'        => $request->input('name'),
      'date'        => $request->input('date'),
      'amount'      => $request->input('amount'),
      'category_id' => $request->input('categoryId'),
      'user_id'     => $request->user()->id,
      'description' => $request->input('description'),
    ]);
    $request->session()->flash('success', 'Income created successfully');
    return redirect()->route('income.index');
  }

  /**
   * Show a specified income
   *
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    return view('income.view');
  }

  /**
   * Show the edit page of a specified income
   *
   * @return \Illuminate\Http\Response
   */
  public function edit()
  {
    return view('income.edit');
  }

  /**
   * Update the details of a specified income.
   *
   * @param  App\Http\Requests\UpdateIncome  $request
   * @param  int  $incomeId
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateIncome $request, $incomeId)
  {
    // Update the income
    Income::where('id', $incomeId)
           ->update([
             'name'         => $request->input('name'),
             'description'  => $request->input('description'),
             'category_id'  => $request->input('categoryId'),
             'user_id'      => $request->user()->id,
             'date'         => $request->input('date'),
             'amount'       => $request->input('amount'),
           ]);
    $request->session()->flash('success', 'Income updated successfully!');
    return redirect()->route('income.edit', $incomeId);
  }

  /**
   * Delete a specified income
   *
   * @param App\Models\Income
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, Income $income)
  {
    // Delete the income
    $income->delete();
    $request->session()->flash('success', 'Income deleted successfully!');
    return redirect()->route('income.index');
  }
}
