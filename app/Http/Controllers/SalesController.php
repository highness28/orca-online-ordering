<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;

class SalesController extends Controller
{
    public function index() {
        $invoice = Invoice::where('status', '3')->get();
        
        return view('sales.index')
        ->with('invoice', $invoice);
    }
}
