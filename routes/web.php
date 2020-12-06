<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TicketComponent;
use App\Http\Controllers\PagosController;
use App\Http\Livewire\DashboardComponent;
use App\Http\Livewire\ServiciosComponent;
use App\Http\Livewire\PagosAdminComponent;
use App\Http\Controllers\ProductoController;
use App\Http\Livewire\AdminSupportComponent;
use App\Http\Livewire\PaymentsUserComponent;
use App\Http\Livewire\SaleServicioComponent;
use App\Http\Livewire\ConfigurationComponent;
use App\Http\Livewire\SubscriptionsComponent;
use App\Http\Livewire\SupportCustomerComponent;
use App\Http\Livewire\SubscriptionUserComponent;
use App\Http\Livewire\ProductosCompradosComponent;
use App\Http\Livewire\ServiciosProductosComponent;
use App\Http\Livewire\ShowProductsSubscriptionsComponent;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->group( function () {
    Route::get('/dashboard',DashboardComponent::class)->name('dashboard');
    Route::get('servicios',ServiciosComponent::class)->name('servicios');
    Route::get('/servicio/{servicio}', ServiciosProductosComponent::class)->name('servicio.show');
    Route::get('/comprar/servicio/{slug}', SaleServicioComponent::class)->name('servicio.venta.show');
    Route::get('/renovar/servicio/{slug}', SaleServicioComponent::class)->name('servicio.renovar.show');
    Route::get('ticket',TicketComponent::class)->name('ticket');
    Route::get('mis-pagos',PaymentsUserComponent::class)->name('mis-pagos');
    Route::get('my-subscriptions',SubscriptionUserComponent::class)->name('my-subscriptions');
    Route::get('my-products',ProductosCompradosComponent::class)->name('my-products');
    Route::get('product/payment/{id}',[ProductoController::class,'indexPaymentProduct'])->name('payment-product');
});

Route::middleware(['auth:sanctum', 'verified','subscription-tienda'])->group( function () {
    Route::get('my-subscription/{slug}',ShowProductsSubscriptionsComponent::class)->name('my-store');
    Route::get('my-product/subscription/{id}/{slug?}',[ProductoController::class,'indexPayment'])->name('payment-product-subscription');
});

Route::middleware(['auth:sanctum', 'verified','admin'])->group( function () {
    Route::get('payments',PagosAdminComponent::class)->name('all-payments');
    Route::get('support',SupportCustomerComponent::class)->name('support');
    Route::get('admin-support',AdminSupportComponent::class)->name('admin-support');
    Route::get('admin-config',ConfigurationComponent::class)->name('admin-config');
});

Route::get('/comprar/serv/{slug}/{ciclo}', [PagosController::class, 'payment_mercadopago_index'])->name('payment_mercadopago_index');
Route::get('/renovar/serv/{slug}/{ciclo}', [PagosController::class, 'payment_renovar_mercadopago_index'])->name('payment_renovar_mercadopago_index');
Route::post('/mercadopago', [PagosController::class, 'payment_mercadopago'])->name('pagos.payment');

Route::resource('/productos',ProductoController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/users', function () {
    return view('users');
})->name('users');

