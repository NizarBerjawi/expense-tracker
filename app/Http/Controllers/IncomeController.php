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
        // Get an instance of the user making the request
        $user = $request->user();
        // Create the income
        $user->income()->create($request->all());
        // Flash the success message
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
        // Get an instance of the user making the request
        $user = $request->user();
        // Update the income
        $user->income()
             ->where('id', $incomeId)
             ->update($request->except(['_token', '_method']));
        // Flash the success message
        $request->session()->flash('success', 'Income updated successfully!');
        return redirect()->route('income.edit', $incomeId);
    }

    /**
     * Delete a specified income
     *
     * @param App\Models\Income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $incomeId = null)
    {
        if (!$request->exists('income_ids') && !$incomeId) { return back(); }
        // Get the income ids to be deleted
        $incomeIds = $request->input('income_ids', $incomeId);
        // Delete the selected income
        Income::discard((array) $incomeIds);
        // Flash the success message
        $request->session()->flash('success', 'Income deleted successfully!');
        return redirect()->route('income.index');
    }
}
