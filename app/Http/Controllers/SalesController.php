<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Invoice;
use App\Customer;

class SalesController extends Controller
{
    public function index() {
        $invoice = Invoice::where('status', '3')->get();
        
        return view('sales.index')
        ->with('invoice', $invoice);
    }
    
    public function print(Request $request) {
        $pdf = app('Fpdf');
        $pdf->AddPage('L');

        // Column width, header, data
        $w = array(15, 50, 50, 30, 45, 45, 40);
        $header = ["#", "Customer", "Email", "Contact", "Delivery Date", "Date Ordered", "Total"];
        $data = json_decode($request->invoice, true);

        // Report Header
        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(array_sum($w)-50, 15, "Sales Report");
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 15, date('F d, Y'), '', 'B', 'R');
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
        foreach($data as $order)
        {
            $customer = Customer::find($order['customer_id']);
            $pdf->Cell($w[0], 6, $order['id'], 'LRB', 0, 'C');
            $pdf->Cell($w[1], 6, $customer->first_name . ' ' . $customer->last_name, 'LRB', 0, 'L');
            $pdf->Cell($w[2], 6, $customer->account->email, 'LRB', 0, 'L');
            $pdf->Cell($w[3], 6, $customer->phone_number, 'LRB', 0, 'R');
            $pdf->Cell($w[4], 6, date('F d, Y', strtotime($order['created_at'])), 'LRB', 0, 'L');
            $pdf->Cell($w[5], 6, $order['delivery_date'] ? date('F d, Y', strtotime($order['delivery_date'])) : 'Not set', 'LRB', 0, 'L');
            $pdf->Cell($w[6], 6, 'Php ' . number_format($order['total'], 2), 'LRB', 0, 'R');
            $pdf->Ln();

            $grandTotal += floatval($order['total']);
        }

        // Closing line
        // $pdf->Cell(array_sum($w),0,'','T');
        $pdf->Cell($w[0], 6, 'Total', 'LB', 0, 'L');
        $pdf->Cell($w[1], 6, '', 'B');
        $pdf->Cell($w[2], 6, '', 'B');
        $pdf->Cell($w[3], 6, '', 'B');
        $pdf->Cell($w[4], 6, '', 'B');
        $pdf->Cell($w[5], 6, '', 'B');
        $pdf->Cell($w[6], 6, 'Php ' . number_format($grandTotal, 2), 'RB', 0, 'R');
        $pdf->Ln();
        $pdf->output();
    }
}
