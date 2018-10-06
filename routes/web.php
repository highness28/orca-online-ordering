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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/orders', 'OrderController@index');


Route::group(["middleware" => ["auth"]], function() {
    Route::get("/user", "UserController@index");
    Route::post("/user", "UserController@update");
});

Route::group(["middleware" => ["auth", "Admin"]], function() {
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
});

Route::group(['middleware' => ['auth', 'Sales']], function () {
    Route::get('/sales', 'SalesController@index');
});

Route::group(['middleware' => ['auth', 'Inventory']], function () {
    Route::get('/inventory', 'InventoryController@index');
});