<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TicketComponent;
use App\Http\Controllers\PagosController;
use App\Http\Livewire\ServiciosComponent;
use App\Http\Controllers\ProductoController;
use App\Http\Livewire\ServiciosProductosComponent;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('servicios',ServiciosComponent::class)->name('servicios');
Route::get('/servicio/{servicio}', ServiciosProductosComponent::class)->name('servicio.show');
Route::get('ticket',TicketComponent::class)->name('ticket');

//Route::get('/mercadopago', 'PagosController@payment_mercadopago');
//Route::post('/mercadopago', [PagosController::class, 'payment_mercadopago'])->name('pagos.payment');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('/productos',ProductoController::class);
//Route::view('productos/lista', 'producto')->name('productos.lista');

Route::middleware(['auth:sanctum', 'verified'])->get('/users', function () {
    return view('users');
})->name('users');

