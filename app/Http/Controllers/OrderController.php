<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {
        if(Auth::user()->role == 1) {
            $invoice = Invoice::orderBy('id', 'desc')->get();
        } else if(Auth::user()->role == 2) {
            $invoice = Invoice::where('status', 1)->orderBy('id', 'desc')->get();
        } else {
            $invoice = Invoice::where('status', 0)->orderBy('id', 'desc')->get();
        }

        return view('orders.index')
        ->with('invoice', $invoice);
    }
}
