<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeaturedCategory;
use App\Category;
use App\Http\Requests\FeaturedCategoryRequest;

class FeaturedCategoryController extends Controller
{
    public function index() {
        $featuredCategory = FeaturedCategory::get();

        return view('featured.index')
        ->with('featuredCategory', $featuredCategory);
    }

    public function add() {
        $categories = Category::get();

        return view('featured.add')
        ->with('categories', $categories);
    }

    public function create(FeaturedCategoryRequest $request) {
        if($request->image) {
            $file = $request->file('image');
            $image = $file->openFile()->fread($file->getSize());

            FeaturedCategory::create([
                'title' => $request->title,
                'category_id' => $request->category,
                'image' => $image
            ]);
        } else {
            FeaturedCategory::create([
                'title' => $request->title,
                'category_id' => $request->category
            ]);
        }

        return redirect('/featured-category')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully added a new featured category.
                            </div>');
    }

    public function edit(Request $request) {
        $selectedCategory = FeaturedCategory::find($request->id);
        $categories = Category::get();

    	return view('featured.edit')
        ->with('selectedCategory', $selectedCategory)
        ->with('categories', $categories);
    }

    public function update(FeaturedCategoryRequest $request) {
        $category = FeaturedCategory::find($request->id);

        if($request->image) {
            $file = $request->file('image');
            $image = $file->openFile()->fread($file->getSize());
            $category->update([
                'title' => $request->title,
                'category_id' => $request->category,
                'status' => $request->status,
                'image' => $image
            ]);
        } else {
            $category->update([
                'title' => $request->title,
                'category_id' => $request->category,
                'status' => $request->status,
            ]);
        }
        
        return redirect('/featured-category')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated a featured category.
                            </div>');
    }
}
