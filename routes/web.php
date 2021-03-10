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

use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::any('app/{any?}', function() {
    return view('app');
})->where('any', '.*');

Route::get('products', 'RetiringSoonProductController@paginate');

Route::get('scrape', function() {
    Artisan::call('scrape:retiring_soon_products');
    return 'OK';
});