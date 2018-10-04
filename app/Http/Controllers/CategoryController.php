<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::get();

        return view('category.index')
        ->with('categories', $categories);
    }

    public function edit(Request $request) {
    	$category = Category::find($request->id);

    	return view('category.edit')
    	->with('category', $category);
    }

    public function update(CategoryRequest $request) {
    	$category = Category::find($request->id);

        $category->update([
            'category_name' => $request->category_name
        ]);
        
        return redirect('/category')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated a category.
                            </div>');
    }

    public function add() {
        return view('category.add');
    }

    public function create(CategoryRequest $request) {
        Category::create([
            'category_name' => $request->category_name
        ]);
        
        return redirect('/category')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully added a new category.
                            </div>');
    }
}
