<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $hidden = ['password'];
    protected $fillable = ['name', 'email', 'email_verified_at', 'password','is_active','token_activation','role'];
}
