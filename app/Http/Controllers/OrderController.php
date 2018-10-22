<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\OrderList;
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
            $invoice = Invoice::whereIn('status', [1,2])->orderBy('id', 'desc')->get();
        } else {
            $invoice = Invoice::where('status', 0)->orderBy('id', 'desc')->get();
        }
        
        return view('orders.index')
        ->with('invoice', $invoice);
    }

    public function edit(Request $request) {
        $invoice = Invoice::find($request->id);
        $ordersList = OrderList::where('invoice_id', $invoice->id)->get();

        return view('orders.edit')
        ->with('invoice', $invoice)
        ->with('ordersList', $ordersList);
    }

    public function update(Request $request) {
        $invoice = Invoice::find($request->invoice_id);
        
        if($invoice->status == 0) {
            $invoice->update([
                'status' => 1
            ]);
            
            return redirect('/orders')
            ->with('message', '<div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success</h4>
                                You have successfully updated an invoice and it is now set for delivery by sales team.
                                </div>');

        } else if($invoice->status == 1 || $invoice->status == 2) {
            $deliveryDate = date('Y-m-d', strtotime($request->delivery_date));
            $invoice->update([
                'status' => 2,
                'delivery_date' => $deliveryDate
            ]);
            
            return redirect('/orders')
            ->with('message', '<div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success</h4>
                                You have successfully updated an invoice and it is now set for delivery on <strong>' . $request->delivery_date . '</strong>.
                                </div>');
        }
    }
}
