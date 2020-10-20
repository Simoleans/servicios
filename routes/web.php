<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/mercadopago', 'PagosController@payment_mercadopago');
Route::post('/mercadopago', [PagosController::class, 'payment_mercadopago'])->name('pagos.payment');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('/productos',ProductoController::class);
//Route::view('productos/lista', 'producto')->name('productos.lista');

Route::middleware(['auth:sanctum', 'verified'])->get('/users', function () {
    return view('users');
})->name('users');

