<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\BrandRequest;

class BrandController extends Controller
{
    public function index() {
        $brands = Brand::get();

        return view('brand.index')
        ->with('brands', $brands);
    }

    public function edit(Request $request) {
    	$brand = Brand::find($request->id);

    	return view('brand.edit')
    	->with('brand', $brand);
    }

    public function update(BrandRequest $request) {
    	$brand = Brand::find($request->id);

        $brand->update([
            'brand_name' => $request->brand_name
        ]);
        
        return redirect('/brand')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated a brand.
                            </div>');
    }

    public function add() {
        return view('brand.add');
    }

    public function create(BrandRequest $request) {
        Brand::create([
            'brand_name' => $request->brand_name
        ]);
        
        return redirect('/brand')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully added a new brand.
                            </div>');
    }
}
