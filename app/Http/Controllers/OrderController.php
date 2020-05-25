<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Invoice;
use App\OrderList;
use App\Customer;
use App\CustomerAccount;
use Auth;
use App\Notifications\InvoiceDelivery;

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

        } else if($invoice->status == 1) {
            $deliveryDate = date('Y-m-d', strtotime($request->delivery_date));
            $invoice->update([
                'status' => 2,
                'delivery_date' => $deliveryDate
            ]);
            
            $orders = OrderList::where('invoice_id', $invoice->id)->get();

            $customer = Customer::where('id', $invoice->customer_id)->first();
            $customerAccount = CustomerAccount::where('customer_id', $customer->id)->first();
            
            $customerAccount->notify(new InvoiceDelivery($invoice, $customer, $orders));
            
            return redirect('/orders')
            ->with('message', '<div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success</h4>
                                You have successfully updated an invoice and it is now set for delivery on <strong>' . $request->delivery_date . '</strong>.
                                </div>');
        }
    }

    public function deliver(Request $request) {
        $invoice = Invoice::find($request->id);
        $invoice->update([
            'status' => 3
        ]);
        
        return redirect('/orders')
            ->with('message', '<div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Success</h4>
                                Congratulations the transaction has been completed!
                                </div>');
    }

    public function print(Request $request) {
        $invoice_id = $request->invoice_id;
        $invoice = Invoice::find($invoice_id);
        $ordersList = OrderList::where('invoice_id', $invoice_id)->get();
        
        $pdf = app('Fpdf');
        $pdf->AddPage('L');

        // Column width, header, data
        $w = array(100, 70, 35, 70);
        $header = ['Product', 'Price', 'Quantity', 'Subtotal'];

        // Report Header
        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(array_sum($w)-50, 15, "Order Report");
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(array_sum($w)-100, 6, 'Customer Name: ' . $invoice->customer->first_name . ' ' . $invoice->customer->last_name, '', 'L');
        $pdf->Cell(100, 6, "Date Ordered: " . date('F d, Y', strtotime($invoice->created_at)), '', '', 'R');
        $pdf->Ln();
        $pdf->Cell(array_sum($w)-100, 6, "Delivery Address: " . $invoice->addressBook->delivery_address);
        $pdf->Cell(100, 6, $invoice->payment_type == 0 ? "Payment Mode: Cash on Delivery" : "Payment Mode: Card", '', '', 'R');
        $pdf->Ln();
        $pdf->Cell(array_sum($w)-100, 6, "Province: " . $invoice->addressBook->province);
        $pdf->Cell(100, 6, "Tracking Number: " . $invoice->tracking_number, '', '', 'R');
        $pdf->Ln();
        $pdf->Cell(array_sum($w), 6, "City: " . $invoice->addressBook->city);
        $pdf->Ln();
        $pdf->Cell(array_sum($w), 6, "Barangay: " . $invoice->addressBook->barangay);
        $pdf->Ln();
        $pdf->Ln();

        // Table Header
        $pdf->SetFont('Arial','',12);
        for($i=0;$i<count($header);$i++) {
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        }

        // Data
        $pdf->Ln();
        $pdf->SetFont('Arial','',10);
        $grandTotal = 0;
        $totalQuantity = 0;
        foreach($ordersList as $order) {
            $pdf->Cell($w[0], 6, $order->product->product_name, 'LRB', '', 'L');
            $pdf->Cell($w[1], 6, 'Php ' . number_format($order->product->product_price, 2), 'LRB', '', 'R');
            $pdf->Cell($w[2], 6, $order->quantity, 'LRB', '', 'R');
            $pdf->Cell($w[3], 6, 'Php ' . number_format($order->product->product_price * $order->quantity, 2), 'LRB', '', 'R');
            $pdf->Ln();

            $grandTotal += $order->product->product_price * $order->quantity;
            $totalQuantity += $order->quantity;
        }

        $pdf->Cell(array_sum($w) - ($w[3] + $w[2]), 6, 'Total', 'LRB', '', 'L');
        $pdf->Cell($w[2], 6, $totalQuantity, 'LRB', '', 'R');
        $pdf->Cell($w[3], 6, 'Php ' . number_format($grandTotal, 2), 'LRB', '', 'R');

        $pdf->output();
    }
}
