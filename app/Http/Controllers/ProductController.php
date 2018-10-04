<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Category;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('brand')->with('category')->get();

        return view('product.index')
        ->with('products', $products);
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

        $product->update($request->all());
        
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
        Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'item_code' => $request->item_code,
            'product_price' => $request->product_price,
            'critical_value' => $request->critical_value
        ]);

        
        
        return redirect('/product')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully added a new product.
                            </div>');
    }
}
