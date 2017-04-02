<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function _construct() {

    }

    public function index()
    {
        return view('expenses.index');
    }
}
