<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\Controller;
use App\Http\Requests\StoreBankAccount;
use App\Http\Requests\UpdateBankAccount;
use App\Models\BankAccount;
use Auth;

class BankAccountController extends Controller
{
    public function create()
    {
        return view('user.banks.create');
    }

    public function store(StoreBankAccount $request)
    {
        // Create the user's bank account
        $account = Auth::user()->bankAccounts()->create($request->all());
        // Flash the success message
        $request->session()->flash('success', 'Account created successfully');
        // Redirect to the correct route
        return redirect()->route('user.profiles.index');
    }

    public function edit()
    {
        return view('user.banks.edit');
    }

    public function update(UpdateBankAccount $request)
    {
    }

    public function show()
    {
        return 'show';
    }
}
