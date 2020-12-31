<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Servicios;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function apiServ()
    {

        return response()->json(['status' => 200 , 'users' =>  User::whereHas('subscriptions')->with('subscriptions.servicio')->get()]);
    }
}
