<?php

namespace App\Models;


use Illuminate\Contracts\Auth\CanResetPassword;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'mobile',
        'wallet',
        'image',
        'invitation_code',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeDefaultUser($query)
    {
        return  $query;
    }


    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */
    /* public function sendPasswordResetNotification($token)
    {
        $url = 'https://127.0.0.1:8000/reset-password?token=' . $token;

        $this->notify(new ResetPasswordNotification($url));
    } */
}