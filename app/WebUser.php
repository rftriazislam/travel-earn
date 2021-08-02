<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;;

class WebUser extends Authenticatable
{
    use  HasApiTokens , Notifiable;
    protected $table = 'web_users';
    protected $fillable = [
        'name', 'email', 'password',
    ]; 
    protected $hidden = [
        'password', 'remember_token',
    ];

}
