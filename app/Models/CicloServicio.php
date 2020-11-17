<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloServicio extends Model
{
    use HasFactory;

    public $fillable = ['servicio_id','mes','porcentaje'];

}
