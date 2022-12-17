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
});
Route::get('/showFacturas/{id}', function ($id) {
    return view('showFacturas')->with('id',$id);
});
Route::get('search','App\Http\Controllers\ProductosController@search');
Route::get('storefactura','App\Http\Controllers\FacturasController@storefactura');
Route::resource('admin_panel','App\Http\Controllers\ProductosController');
Route::resource('user_panel','App\Http\Controllers\ComprasController');
Route::resource('factura','App\Http\Controllers\FacturasController');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboardUser', function () {
        return view('dashboardUser');
    })->name('dashboardUser');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
