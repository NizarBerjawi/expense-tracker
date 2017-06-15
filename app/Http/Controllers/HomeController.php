<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseControllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        
        if (!Auth::user()->profile) {
            // Flash the message
            return redirect()->route('user.profiles.create');
        }


        return view('home');
    }

    /**
     * Show the calendar view
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
        return view('calendar');
    }

}
