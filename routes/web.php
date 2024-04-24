<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/products/{id}', 'App\Http\Controllers\ProductController@index')->name('product');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/track-visit', 'App\Http\Controllers\VisitController@trackVisit')->name('track-visit');
Route::get('/generate-unique-id', 'App\Http\Controllers\VisitController@generateUniqueId')->name('generate-unique-id');


Route::group(['middleware' => ['auth:sanctum', config('jetstream.auth_session'),'verified']], function () {
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});
