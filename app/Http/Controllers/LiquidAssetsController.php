<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\Controller;
use App\Http\Requests\StoreAsset;
use App\Http\Requests\UpdateAsset;
use Illuminate\Http\Request;
use App\Models\LiquidAsset;
use Auth;

class LiquidAssetsController extends Controller
{
    /**
     * Show the page to create a new bank account
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.assets.create');
    }

    /**
     * Store a new instance of the bank account
     *
     * @param  App\Http\Requests\StoreBankAccount $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAsset $request)
    {
        // Add the initial balance to the request
        $request->merge(['balance' => $request->input('starting_balance')]);
        // Create the user's bank account
        $account = Auth::user()->liquidAssets()->create($request->all());
        // Flash the success message
        $request->session()->flash('success', 'Asset created successfully');
        // Redirect to the correct route
        return redirect()->route('user.profiles.index');
    }

    /**
     * Show a specific bank account details
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('user.assets.view');
    }

    /**
     * Show the edit page of a specific bank account
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.assets.edit');
    }

    /**
     * Update a specific bank account
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $accountId
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAsset $request, $assetId)
    {
        // Find the bank account and update
        LiquidAsset::where('id', $assetId)
                   ->update($request->except(['_token', '_method']));
        // Flash the success message
        $request->session()->flash('success', 'Asset successfully deleted');
        // Redirect to the correct route
        return redirect()->route('user.profiles.index');
    }

    /**
     * Delete a specific bank account
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $accountId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $assetId)
    {
        // Delete the bank account
        LiquidAsset::discard((array) $assetId);
        // Flash the success message
        $request->session()->flash('success', 'Asset successfully deleted');
        // Redirect to the correct route
        return redirect()->route('user.profiles.index');
    }

    /**
     * Show transfer amount page
     *
     * @return \Illuminate\Http\Response
     */
    public function showTransfer()
    {
        $assets = LiquidAsset::where('user_id', Auth::id())->get();
        return view('user.assets.transfer')->with(compact('assets'));
    }

    /**
     * Transfer a specific amount from one account to another
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request)
    {
        // Find the From account
        $transferFrom =  LiquidAsset::where('id', $request->input('transfer_from'))
                                    ->where('user_id', Auth::id())
                                    ->first();
        // Find the To account
        $transferTo =  LiquidAsset::where('id', $request->input('transfer_to'))
                                    ->where('user_id', Auth::id())
                                    ->first();
        // Calculate new balances
        $transferFrom->balance = $transferFrom->balance - $request->input('amount');
        $transferTo->balance = $transferTo->balance + $request->input('amount');
        // Store new balances in the database
        $transferFrom->save();
        $transferTo->save();
        // Redirect to the correct route
        return redirect()->route('user.profiles.index');
    }
}
