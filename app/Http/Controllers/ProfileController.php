<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\Controller;
use App\Http\Requests\StoreProfile;
use App\Http\Requests\UpdateProfile;
use App\Models\Profile;
use Validator;
use Auth;

class ProfileController extends Controller
{
    /**
     * Show the profile main index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.profile.index');
    }

    /**
     * Show the page to create a new profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.profile.create');
    }

    /**
     * Store a new user profile instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        // Create a user profile and attach to the authenticated user
        Auth::user()->profile()->create($request->all());
        // Flash the succes message
        $request->session()->flash('success', 'Profile created successfully');
        // Return to the correct route
        return redirect()->route('user.profile.index');
    }

    /**
     * Show the edit page of a specific resource
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user()->load('profile');
        return view('user.profile.edit')->with(compact('user'));
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
        Auth::user()->profile()->update($request->all());
        // Flash the succes message
        $request->session()->flash('success', 'Profile updated successfully');
        // Return to the correct route
        return redirect()->route('user.profile.index');
    }
}
