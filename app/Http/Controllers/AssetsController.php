<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreAsset;
use App\Http\Requests\UpdateAsset;
use Illuminate\Http\Request;
use App\Models\Asset;
use Auth;

class AssetsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('profile');
    }

    /**
     * Show the page to create a new asset
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.assets.create');
    }

    /**
     * Store a new instance of the asset
     *
     * @param  App\Http\Requests\StoreAsset $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAsset $request)
    {
        // Add the initial balance to the request
        $request->merge(['balance' => $request->input('starting_balance')]);
        // Create the user's asset
        $account = Auth::user()->assets()->create($request->all());
        // Flash the success message
        $request->session()->flash('success', 'Asset created successfully');
        // Redirect to the correct route
        return redirect()->route('user.profiles.index');
    }

    /**
     * Show a specific asset details
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('user.assets.view');
    }

    /**
     * Show the edit page of a specific asset
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.assets.edit');
    }

    /**
     * Update a specific asset
     *
     * @param  App\Http\Requests\UpdateAsset $request
     * @param  int $accountId
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAsset $request, $assetId)
    {
        // Find the asset and update
        Asset::where('id', $assetId)
                   ->update($request->except(['_token', '_method']));
        // Flash the success message
        $request->session()->flash('success', 'Asset successfully deleted');
        // Redirect to the correct route
        return redirect()->route('user.profiles.index');
    }

    /**
     * Delete a specific asset
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $accountId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $assetId)
    {
        // Delete the asset
        Asset::discard((array) $assetId);
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
        $assets = Asset::where('user_id', Auth::id())->get();
        return view('user.assets.transfer')->with(compact('assets'));
    }

    /**
     * Transfer a specific amount from one asset to another
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request)
    {
        // UPDATE click_table SET clicks = clicks + 1 WHERE team = <team>;

        // Find the "From" asset
        $transferFrom =  Asset::where('id', $request->input('transfer_from'))
                                    ->where('user_id', Auth::id())
                                    ->update([
                                        'balance' => DB::raw('balance - '.$request->input('amount'))
                                    ]);
        // Find the "To" asset
        $transferTo =  Asset::where('id', $request->input('transfer_to'))
                                    ->where('user_id', Auth::id())
                                    ->update([
                                        'balance' => DB::raw('balance + '.$request->input('amount'))
                                    ]);
        // Calculate new balances
        // $transferFrom->balance = $transferFrom->balance - $request->input('amount');
        // $transferTo->balance = $transferTo->balance + $request->input('amount');
        // // Store new balances in the database
        // $transferFrom->save();
        // $transferTo->save();
        // Redirect to the correct route
        return redirect()->route('user.profiles.index');
    }
}
