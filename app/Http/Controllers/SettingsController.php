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
}
