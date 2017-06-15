<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\Controller;
use App\Http\Requests\StoreProfile;
use App\Http\Requests\UpdateProfile;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Show the profile main index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('user.profiles.index')
                    ->with('dir', $request->dir)
                    ->with('col', $request->col);
    }

    /**
     * Show the page to create a new profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.profiles.create');
    }

    /**
     * Store a new user profile instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfile $request)
    {
        // Create a user profile and attach to the authenticated user
        $request->user()->profile()->create($request->all());
        // Flash the success message
        $request->session()->flash('success', 'Profile created successfully');


        if ($request->user()->liquidAssets->isEmpty()) {
            // Flash message
            $request->session()->flash('success', 'Now add some assets');
            return redirect()->route('user.assets.create');
        }


        
        // Return to the correct route
        return redirect()->route('user.profiles.index');
    }

    /**
     * Show the edit page of a specific resource
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.profiles.edit');
    }

    /**
     * Update the authenticated user's profile
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfile $request)
    {
        // Update the authenticated user's profile
        $request->user()->profile()
                    ->update($request->except(['_token', '_method']));
        // Flash the success message
        $request->session()->flash('success', 'Profile updated successfully');
        // Return to the correct route
        return redirect()->route('user.profiles.index');
    }
}
