<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\Controller;
use Illuminate\Http\Request;
use Auth;

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
     * Update the User password.
     *
     * @param App\Http\Requests\ChangePasswordRequest  $request
     * @return Response
     */
     public function update(Request $request)
     {
         // Update the user's password
         Auth::user()->updatePassword($request->input('password'));
         // Flash the success message
         $request->session()->flash('success', 'Password updated successfully');
         return redirect()->route('account.index');
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
        $user = Auth::user();
        // Delete the user
        $user->delete();
        // Redirect to the login page
        return redirect()->route('login');
    }
}
