<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * Les attributs autorisés pour l'enregistrement (Mass Assignment).
     */
    protected $fillable = [
        'name',
        'login',
        'email',
        'password',
        'phone_number',
    ];

    /**
     * Les attributs à cacher lors de la sérialisation (JSON/Array).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversion des types.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}