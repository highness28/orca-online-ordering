<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'Sales']);
    }

    public function index() {
        return view('orders.index');
    }
}
