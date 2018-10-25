<?php

function getStock($product_id) {
    $soldQuantity = Illuminate\Support\Facades\DB::table('orders_list')
    ->select(Illuminate\Support\Facades\DB::raw("SUM(quantity) as quantity"))
    ->join('invoice', 'invoice.id', 'orders_list.invoice_id')
    ->groupBy('product_id')
    ->where('product_id', $product_id)
    ->whereIn('invoice.status', [1,2,3])
    ->first();
    
    $soldQuantity = $soldQuantity ? $soldQuantity->quantity : 0;

    $inventoryQuantity = Illuminate\Support\Facades\DB::table('inventories')
    ->select(Illuminate\Support\Facades\DB::raw("SUM(quantity) as quantity"))
    ->where('product_id', $product_id)
    ->where('status', '0')
    ->first();

    $inventoryQuantity = $inventoryQuantity->quantity ? $inventoryQuantity->quantity : 0;

    return $inventoryQuantity - $soldQuantity;
}