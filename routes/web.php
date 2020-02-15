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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/tambahproduct', 'ProductController@tambah');
Route::get('/listproduct', 'ProductController@list');
Route::post('/produkstore', 'ProductController@store');
Route::post('/produkupdate', 'ProductController@update');
Route::post('/produkdelete', 'ProductController@delete');
Route::get('/updateproduct/{id}', function ($id) {
    $product = DB::table('products')->where([['id', '=',$id]])->get();
    return view('product/update',['product' => $product]);
})->middleware(['auth']);

Route::get('/listpenjualan', 'PenjualanController@list');
Route::post('/penjualandelete', 'PenjualanController@penjualandelete');
Route::post('/penjualanapproval', 'PenjualanController@penjualanapproval');

Route::get('/liststatus', 'StatusController@list');
Route::get('/statusdetail/{id}', function ($id) {
    $pembayaran = DB::table('pembayarans')->where([['code', '=',$id]])->get();
    $penjualan = DB::table('penjualans')->where([['code', '=',$id]])->get();
    foreach ($penjualan as $key) {
        $product = explode(",",$key->product); 
    }
    foreach ($product as $products) {
     $products = DB::table('products')->where([['id', '=',$products]])->get();
     $productss[] = $products[0];
    }
    return view('status/detail',['data' => $pembayaran,'code' => $id,'penjualan' => $penjualan,'product' => $productss]);
})->middleware(['auth']);
Route::get('/statustambah/{id}', function ($id) {
    return view('status/tambah',['code' => $id]);
})->middleware(['auth']);
Route::get('/resi/{id}', function ($id) {
    return view('status/resi',['code' => $id]);
})->middleware(['auth']);
Route::post('/addstatus', 'StatusController@addstatus');
Route::post('/addresi', 'StatusController@addresi');
Route::post('/statusdelete', 'StatusController@delete');
