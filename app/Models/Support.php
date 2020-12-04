<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'tittle',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,);

    }

    public function messages()
    {
        return $this->hasMany(Message::class,'supports_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status',0);
    }

    public function scopeMySupport($query)
    {
        return $query->where('user_id',auth()->user()->id);
    }
}
