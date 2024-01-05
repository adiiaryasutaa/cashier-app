<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function show(Transaction $transaction)
    {
        return view('transactions.show', [
            'transaction' => $transaction,
        ]);
    }
    public function __invoke()
    {
        return view('transactions.index');
    }
}
