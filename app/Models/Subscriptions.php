<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Mail\NotificationEndsubscription;


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

        if ($request->renovated == true) {
            self::renovarSubscription($request);
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

    public static function renovarSubscription($request)
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
            return false;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearchSubscriptionToUserActive($query,$servicio)
    {
        if ($servicio) {
            return $query->where('user_id',auth()->user()->id)->where('servicio_id',$servicio)->where('status',1);
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

    public static function notificationEndsubscription()
    {
        $data = self::where('status',1)->get();
        $today = Date('Y-m-d');
        $v = false;

        foreach ($data as $d) {
            //$v [] = $today.' - '.$d->end_date->subDays($d->servicio->dias_notificar)->format('Y-m-d');
            if ($d->end_date->subDays($d->servicio->dias_notificar)->format('Y-m-d') <= $today) {
                $v = true;
                Mail::to($d->user->email)->send(new NotificationEndsubscription($d));
            }
        }

        return $v;
        
    }
    
}
