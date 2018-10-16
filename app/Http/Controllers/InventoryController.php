<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Product;
use App\Http\Requests\InventoryRequest;

class InventoryController extends Controller
{
    public function index() {
        $inventories = Inventory::with('product')
        ->orderBy('id', 'desc')
        ->get();

        return view('inventory.index')
        ->with('inventories', $inventories);
    }

    public function add() {
        $products = Product::get();

        return view('inventory.add')
        ->with('products', $products);
    }

    public function create(InventoryRequest $request) {
        $products = $request->product;

        foreach($products as $product) {
            Inventory::create([
                'product_id' => $product,
                'quantity' => $request->quantity
            ]);
        }

        return redirect('/inventory')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully added an inventory.
                            </div>');
    }

    public function edit(Request $request) {
        $inventory = Inventory::with('product')->find($request->id);
        
        return view('inventory.edit')
        ->with('inventory', $inventory);
    }
    
    public function update(InventoryRequest $request) {
        $inventory = Inventory::find($request->id);

        $inventory->update([
            'quantity' => $request->quantity
        ]);

        return redirect('/inventory')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated an inventory.
                            </div>');
    }
}
