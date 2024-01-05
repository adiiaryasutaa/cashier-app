<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function show(Item $item)
    {
        return view('items.show', [
            'item' => $item,
        ]);
    }
    public function __invoke()
    {
        return view('items.index');
    }
}
