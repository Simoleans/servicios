<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function apiServ()
    {
        return response()->json(['status' => 200 , 'servicios' => Servicios::where('status',1)->get()]);
    }
}
