<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     *
     *
     */
    public function index()
    {
        return view('user.settings.index');
    }

    /**
     *
     *
     */
    public function destroy(Request $request)
    {
        // Get an instance of the authenticated user
        $user = Auth::user();
        // Delete the user
        $user->delete();

    }
}
