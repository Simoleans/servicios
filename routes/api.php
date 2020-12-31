<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiciosController;

Route::get('user/subscriptions',[ServiciosController::class,'apiServ']);
