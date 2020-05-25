<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Brand;
use App\Category;
use App\Http\Requests\ProductRequest;
use App\Helpers\ProductHelper;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('brand')
        ->with('category')
        ->where('deleted_at', '=', NULL)
        ->get();

        return view('product.index')
        ->with('products', $products);
    }

    public function delete(Request $request) {
        $product = Product::find($request->id);

        $product->update([
            'deleted_at' => date('Y-m-d h:i:s')
        ]);

        return redirect('/product')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully deleted a product.
                            </div>');
    }

    public function reorder_print(Request $reuqest) {
        $products = Product::with('brand')
        ->with('category')
        ->where('deleted_at', '=', NULL)
        ->get()
        ->toArray();

        $filteredProducts = array_filter($products, function($product) {
            return ($product['critical_value'] >= getStock($product['id']));
        });

        $pdf = app('Fpdf');
        $pdf->AddPage('L');

        $w = array(60, 40, 35, 35, 40, 20, 40);
        $header = [
            "Product Name",
            "Item Code",
            "Category",
            "Brand",
            "Price",
            "Quantity",
            "Subtotal"
        ];

        // Report Header
        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(array_sum($w)-50, 15, "Reorder Report");
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
        $quantityTotal = 0;
        foreach($filteredProducts as $filtered) {
            // dd($filtered);

            $pdf->Cell($w[0], 6, $filtered['product_name'], 'LRB', 0, 'L');
            $pdf->Cell($w[1], 6, $filtered['item_code'], 'LRB', 0, 'R');
            $pdf->Cell($w[2], 6, $filtered['category']['category_name'], 'LRB', 0, 'L');
            $pdf->Cell($w[3], 6, $filtered['brand']['brand_name'], 'LRB', 0, 'L');
            $pdf->Cell($w[4], 6, 'Php ' . number_format($filtered['product_price'], 2), 'LRB', 0, 'R');
            $pdf->Cell($w[5], 6, $filtered['critical_value'] * 10, 'LRB', 0, 'R');
            $pdf->Cell($w[6], 6, 'Php ' . number_format($filtered['critical_value'] * 10 * $filtered['product_price'], 2), 'LRB', 0, 'R');
            $pdf->Ln();

            $quantityTotal += $filtered['critical_value'] * 10;
            $grandTotal += $filtered['critical_value'] * 10 * $filtered['product_price'];
        }

        // Closing line
        $pdf->Cell($w[0], 6, 'Total', 'LB', 0, 'L');
        $pdf->Cell($w[1], 6, '', 'B');
        $pdf->Cell($w[2], 6, '', 'B');
        $pdf->Cell($w[3], 6, '', 'B');
        $pdf->Cell($w[4], 6, '', 'B', 0, 'R');
        $pdf->Cell($w[5], 6, $quantityTotal, 'LB', 0, 'R');
        $pdf->Cell($w[6], 6, 'Php ' . number_format($grandTotal, 2), 'LRB', 0, 'R');
        $pdf->Ln();
        $pdf->output();
    }

    public function print(Request $request) {
        $pdf = app('Fpdf');
        $pdf->AddPage('P');

        $w = array(48, 33, 28, 20, 17, 17, 31);
        $header = [
            "Product Name",
            "Item Code",
            "Category",
            "Brand",
            "Critical",
            "Quantity",
            "Price"
        ];

        // Report Header
        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(array_sum($w)-50, 15, "Product Report");
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
        $quantityTotal = 0;
        $criticalTotal = 0;
        foreach($request->products as $product) {
            $decodedProduct = json_decode($product);
            
            $pdf->Cell($w[0], 6, $decodedProduct->product_name, 'LRB', 0, 'L');
            $pdf->Cell($w[1], 6, $decodedProduct->item_code, 'LRB', 0, 'L');
            $pdf->Cell($w[2], 6, $decodedProduct->category, 'LRB', 0, 'L');
            $pdf->Cell($w[3], 6, $decodedProduct->brand, 'LRB', 0, 'L');
            $pdf->Cell($w[4], 6, $decodedProduct->critical_value, 'LRB', 0, 'R');
            $pdf->Cell($w[5], 6, $decodedProduct->quantity_left, 'LRB', 0, 'R');
            $pdf->Cell($w[6], 6, 'Php ' . number_format($decodedProduct->price, 2), 'LRB', 0, 'R');
            $pdf->Ln();

            $grandTotal += floatval($decodedProduct->price);
            $quantityTotal += $decodedProduct->quantity_left;
            $criticalTotal += $decodedProduct->critical_value;
        }

        // Closing line
        $pdf->Cell($w[0], 6, 'Total', 'LB', 0, 'L');
        $pdf->Cell($w[1], 6, '', 'B');
        $pdf->Cell($w[2], 6, '', 'B');
        $pdf->Cell($w[3], 6, '', 'B');
        $pdf->Cell($w[4], 6, $criticalTotal, 'LB', 0, 'R');
        $pdf->Cell($w[5], 6, $quantityTotal, 'LB', 0, 'R');
        $pdf->Cell($w[6], 6, 'Php ' . number_format($grandTotal, 2), 'LRB', 0, 'R');
        $pdf->Ln();
        $pdf->output();
    }

    public function edit(Request $request) {
        $product = Product::find($request->id);
        $brands = Brand::get();
        $categories = Category::get();

    	return view('product.edit')
        ->with('product', $product)
        ->with('brands', $brands)
        ->with('categories', $categories);
    }

    public function update(ProductRequest $request) {
        $product = Product::find($request->id);

        if($request->image) {
            $file = $request->file('image');
            $image = $file->openFile()->fread($file->getSize());
            $product->update([
                'product_name' => $request->product_name,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'item_code' => $request->item_code,
                'product_price' => $request->product_price,
                'critical_value' => $request->critical_value,
                'description' => $request->description,
                'specification' => $request->specification,
                'image' => $image
            ]);
        } else {
            $product->update([
                'product_name' => $request->product_name,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'item_code' => $request->item_code,
                'product_price' => $request->product_price,
                'critical_value' => $request->critical_value,
                'description' => $request->description,
                'specification' => $request->specification
            ]);
        }
        
        return redirect('/product')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated a product.
                            </div>');
    }

    public function add() {
        $brands = Brand::get();
        $categories = Category::get();

        return view('product.add')
        ->with('brands', $brands)
        ->with('categories', $categories);
    }

    public function create(ProductRequest $request) {
        if($request->image) {
            $file = $request->file('image');
            $image = $file->openFile()->fread($file->getSize());

            Product::create([
                'product_name' => $request->product_name,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'item_code' => $request->item_code,
                'product_price' => $request->product_price,
                'critical_value' => $request->critical_value,
                'description' => $request->description,
                'specification' => $request->specification,
                'image' => $image
            ]);
        } else {
            Product::create([
                'product_name' => $request->product_name,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'item_code' => $request->item_code,
                'product_price' => $request->product_price,
                'critical_value' => $request->critical_value,
                'description' => $request->description,
                'specification' => $request->specification
            ]);
        }
        
        return redirect('/product')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully added a new product.
                            </div>');
    }
}

// IMAGE FETCHING CODE
// Route::get('user/{id}/avatar', function ($id) {
//     // Find the user
//     $user = App\User::find(1);

//     // Return the image in the response with the correct MIME type
//     return response()->make($user->avatar, 200, array(
//         'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($user->avatar)
//     ));
// });