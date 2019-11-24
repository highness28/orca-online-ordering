<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Auth::routes(['verify' => true]);
Route::get('/orders', 'OrderController@index');
Route::get('/orders/edit', 'OrderController@edit');
Route::post('/orders/edit', 'OrderController@update');
Route::get('/orders/deliver/{id}', 'OrderController@deliver');

Route::group(["middleware" => ["auth", "verified"]], function() {
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get("/user", "UserController@index");
    Route::post("/user", "UserController@update");
});

Route::group(["middleware" => ["auth", "Admin", "verified"]], function() {
    Route::get("/featured-category", "FeaturedCategoryController@index");
    Route::get("/featured-category/edit", "FeaturedCategoryController@edit");
    Route::post("/featured-category/edit", "FeaturedCategoryController@update");
    Route::get("/featured-category/add", "FeaturedCategoryController@add");
    Route::post("/featured-category/add", "FeaturedCategoryController@create");

    Route::get("/category", "CategoryController@index");
    Route::get("/category/edit", "CategoryController@edit");
    Route::post("/category/edit", "CategoryController@update");
    Route::get("/category/add", "CategoryController@add");
    Route::post("/category/add", "CategoryController@create");

    Route::get("/brand", "BrandController@index");
    Route::get("/brand/edit", "BrandController@edit");
    Route::post("/brand/edit", "BrandController@update");
    Route::get("/brand/add", "BrandController@add");
    Route::post("/brand/add", "BrandController@create");

    Route::get("/product", "ProductController@index");
    Route::get("/product/edit", "ProductController@edit");
    Route::post("/product/edit", "ProductController@update");
    Route::get("/product/add", "ProductController@add");
    Route::post("/product/add", "ProductController@create");

    Route::get("/product/delete/{id}", "ProductController@delete");
});

Route::group(['middleware' => ['auth', 'Sales', "verified"]], function () {
    Route::get('/sales', 'SalesController@index');
});

Route::group(['middleware' => ['auth', 'Inventory', "verified"]], function () {
    Route::get('/inventory', 'InventoryController@index');
    Route::get('/inventory/add', 'InventoryController@add');
    Route::post('/inventory/add', 'InventoryController@create');
    Route::get('/inventory/edit', 'InventoryController@edit');
    Route::post('/inventory/edit', 'InventoryController@update');
});