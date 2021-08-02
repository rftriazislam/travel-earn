<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class BDUser extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'bd_users';



    public function user()
    {
        return $this->hasMany('App\BDUser', 'country_code', 'country_code');
    }

    protected $fillable = [
        'name', 'email', 'passwprd', 'present_address', 'permanent_address', 'father_name', 'mother_name',
        'mobile_number', 'add_money_balance', 'balance', 'total_earn', 'product_balance', 'cover_image',
        'profile_image', 'token', 'mac_id'
    ];


    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function available_service()
    {
        return $this->hasMany('App\BDService', 'user_id', 'id')->where('status', 1);
    }
    public function delivery_unsuccess()
    {
        return $this->hasMany('App\BDRequestService', 'user_id', 'id')->where('status', 1);
    }
    public function delivery_success()
    {
        return $this->hasMany('App\BDRequestService', 'user_id', 'id')->where('status', 1);
    }
    //-----------------------web------------------------------
    public function traveller_info()
    {
        return $this->hasOne('App\BDTraveller', 'user_id', 'id');
    }
    public function request_service_info()
    {
        return $this->hasMany('App\BDRequestService', 'user_id', 'id');
    }
    //-----------------------web------------------------------

    //   public function  rating_avg(){
    //     return $this->hasMany('App\BdRating','user_id','id');
    //   }

}