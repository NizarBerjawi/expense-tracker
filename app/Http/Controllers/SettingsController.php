<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\Controller;
use Illuminate\Support\Facades\Hash;
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
     * Update the password for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        // Get the user's old password
        $oldPassword = $request->user()->password;
        if (Hash::check('plain-text', $hashedPassword)) {
            // The passwords match...
        }
        // Validate the new password length...
        $request->user()->fill([
            'password' => Hash::make($request->newPassword)
        ])->save();
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
