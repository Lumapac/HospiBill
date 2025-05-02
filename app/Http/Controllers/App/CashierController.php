<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        return view('app.cashier.cashier-dashboard');
    }

    public function billing()
    {
        return view('app.cashier.billing');
    }
}
