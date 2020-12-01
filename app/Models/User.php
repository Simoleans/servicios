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


    public function closestEndSubscription()
    {
        $subs = $this->subscriptions;
        $date = date('Y-m-d');
        $r = [];

        foreach ($subs as $val) {
           if (Carbon::parse($date)->diffInDays($val->end_date) <= 7) {
               $r [] = $val->servicio->nombre;
           }
        }
        return $r;
    }
    
}
