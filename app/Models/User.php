<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function customer()
    {
        return $this->hasOne(CustomerMercadoPago::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscriptions::class);
    }

    public function suscribedService($servicio)
    {
        return Subscriptions::where('user_id',$this->id)->where('servicio_id',$servicio)->exists();
    }

    public function serviceExpired($servicio)
    {
        return Subscriptions::where('user_id',$this->id)->where('servicio_id',$servicio)->where('end_date','<',date('Y-m-d'))->exists();
    }

    public function serviceExpiredQuery()
    {
        return $this->subscriptions()->where('user_id',$this->id)->where('end_date','<',date('Y-m-d'));
    }


    public function closestEndSubscription()
    {
        // dd($subs);
        $date = date('Y-m-d');
        $r = [];

        foreach ( $this->subscriptions as $val) {
           if (Carbon::parse($date)->diffInDays($val->end_date) <= 7) {
               $r[] = array('nombre' => $val->servicio->nombre,'slug' => $val->servicio->slug);
           }
        }
        return $r;
    }

    public function expiredSubscription()
    {
        $subs = $this->subscriptions()->where('status',1)->get();
        $date = date('Y-m-d');
        $r = [];
        foreach ($subs as $val) {
           if (Carbon::parse($date)->greaterThanOrEqualTo($val->end_date)) {
                $r[] = array('nombre' => $val->servicio->nombre,'slug' => $val->servicio->slug);
           }
        }
        return $r;
    }

    public function admin()
    {
        
        $q = $this->allTeams();
        $v = false;

        foreach($q as $r) 
        {
            if ($r->name == 'Admin') {
                $v = true;
            }
            
        }

        return $v;
        
    }
    
}
