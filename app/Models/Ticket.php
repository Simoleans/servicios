<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public $fillable = [
        'codigo',
        'fecha_exp',
        'tipo',
        'monto',
    ];

    protected $casts = [
        'fecha_exp' => 'date',
    ];
}
