<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Məlumat bazası cədvəli
     */
    protected $table = 'users';

    /**
     * Hansı sahələr mass assignable olacaq
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * Şifrənin avtomatik gizlədilməsi (JSON cavabında görünməməsi üçün)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tip çevirmələri
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
