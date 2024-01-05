<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function __invoke()
    {
        return view('cashier.index');
    }
}
