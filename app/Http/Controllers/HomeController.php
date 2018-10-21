<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\OrderList;
use App\Customer;

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
    public function index()
    {
        $invoice = Invoice::where('status', 0)->get();
        $totalSales = Invoice::where('status', "!=", 4)->sum("total"); // not cancelled
        $ordersQuantity = OrderList::join('invoice', 'invoice.id', 'invoice_id')->where('invoice.status', '!=', 4)->count();
        $customers = Customer::count();

        return view('home')
        ->with('invoice', $invoice)
        ->with('totalSales', $totalSales)
        ->with('ordersQuantity', $ordersQuantity)
        ->with('customers', $customers);
    }
}
