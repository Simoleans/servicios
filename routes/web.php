<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TicketComponent;
use App\Http\Controllers\PagosController;
use App\Http\Livewire\DashboardComponent;
use App\Http\Livewire\ServiciosComponent;
use App\Http\Controllers\ProductoController;
use App\Http\Livewire\PaymentsUserComponent;
use App\Http\Livewire\ProductosCompradosComponent;
use App\Http\Livewire\SaleServicioComponent;
use App\Http\Livewire\SubscriptionsComponent;
use App\Http\Livewire\ServiciosProductosComponent;
use App\Http\Livewire\SubscriptionUserComponent;
use App\Http\Livewire\ShowProductsSubscriptionsComponent;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->group( function () {
    Route::get('/dashboard',DashboardComponent::class)->name('dashboard');
    Route::get('servicios',ServiciosComponent::class)->name('servicios');
    Route::get('/servicio/{servicio}', ServiciosProductosComponent::class)->name('servicio.show');
    Route::get('/comprar/servicio/{slug}', SaleServicioComponent::class)->name('servicio.venta.show');
    //Route::get('/comprar/servicio/{slug}/{ciclo}', SubscriptionsComponent::class)->name('servicio.venta.payment');
    Route::get('ticket',TicketComponent::class)->name('ticket');
    Route::get('mis-pagos',PaymentsUserComponent::class)->name('mis-pagos');
    Route::get('my-subscriptions',SubscriptionUserComponent::class)->name('my-subscriptions');
    Route::get('my-products',ProductosCompradosComponent::class)->name('my-products');
    Route::get('product/payment/{id}',[ProductoController::class,'indexPaymentProduct'])->name('payment-product');
    //Route::get('my-subscription/{slug}',ShowProductsSubscriptionsComponent::class)->name('my-subscriptions');
});

Route::middleware(['auth:sanctum', 'verified','subscription-tienda'])->group( function () {
    Route::get('my-subscription/{slug}',ShowProductsSubscriptionsComponent::class)->name('my-store');
    Route::get('my-product/subscription/{id}/{slug?}',[ProductoController::class,'indexPayment'])->name('payment-product-subscription');
});

Route::get('/comprar/serv/{slug}/{ciclo}', [PagosController::class, 'payment_mercadopago_index'])->name('payment_mercadopago_index');
Route::post('/mercadopago', [PagosController::class, 'payment_mercadopago'])->name('pagos.payment');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::resource('/productos',ProductoController::class);
//Route::view('productos/lista', 'producto')->name('productos.lista');

Route::middleware(['auth:sanctum', 'verified'])->get('/users', function () {
    return view('users');
})->name('users');

