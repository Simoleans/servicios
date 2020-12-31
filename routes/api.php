<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiciosController;

Route::get('servicios',[ServiciosController::class,'apiServ']);
