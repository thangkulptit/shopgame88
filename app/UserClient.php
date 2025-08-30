<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class UserClient extends Authenticatable
{
    use Notifiable;
    protected $guard = 'users_client';
    protected $table = 'user_clients';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'uid', 'username', 'password', 'money'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}

