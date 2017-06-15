<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\Controller;
use App\Http\Requests\UpdatePassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show the settings main index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.settings.index');
    }

    /**
     * Update the password for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(UpdatePassword $request)
    {
        // Update the password
        $request->user()->update([
            'password' => Hash::make($request->input('password'))
        ]);
        // Flash the success message
        $request->session()->flash('success', 'Password updated successfully');
        // Redirect to the dashboard
        return back();
    }

    /**
     * Delete a specific account.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // Get an instance of the authenticated user
        $user = $request->user();
        // Delete the user
        $user->delete();
        // Redirect to the login page
        return redirect()->route('login');
    }
}
