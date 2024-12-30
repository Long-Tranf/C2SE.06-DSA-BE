<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Member extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = 'members';

    protected $fillable = [
        'user_name',
        'password',
        'avatar',
        'full_name',
        'subscriber_email',
        'phone_number',
        'address',
        'is_open'
    ];
}
