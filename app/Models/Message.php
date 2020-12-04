<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'supports_id',
        'file',
        'message'
    ];

    public function support()
    {
        return $this->belongsTo(Support::class,'supports_id');
    }
}
