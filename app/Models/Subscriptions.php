<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Subscriptions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'servicio_id',
        'ciclo_id',
        'start_date',
        'end_date',
        'status'
    ];

    protected $casts = [
        'end_date' => 'datetime',
    ];


    public static function storeSubscription($request)
    {
        $ciclo = CicloServicio::findOrfail($request->ciclo_id);

        $existsSubscription = self::searchSubscriptionToUserActive($request->servicio_id)->exists(); // verifico si tiene una subscripcion activa

        // si ya tengo una verificacion activa, entonces le aumento la fecha de fin
        if($existsSubscription)
        {
            
            $servicioActivo = self::searchSubscriptionToUserActive($request->servicio_id)->first();
            $servicioActivo->end_date = $servicioActivo->end_date->addMonths($ciclo->mes);
            $servicioActivo->save();

        }else{
            self::create([
                'user_id' => auth()->user()->id,
                'servicio_id' => $request->servicio_id,
                'ciclo_id' => $request->ciclo_id,
                'start_date' => Carbon::now()->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths($ciclo->mes)
            ]);
        }

        
    }

    public function scopeSearchSubscriptionToUserActive($query,$servicio)
    {
        if ($servicio) {
            return $query->where('user_id',auth()->user()->id)->where('servicio_id',$servicio)->where('end_date','>=',Carbon::now()->format('Y-m-d'))->where('status',1);
        }
    }

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicios::class);
    }
    
}
