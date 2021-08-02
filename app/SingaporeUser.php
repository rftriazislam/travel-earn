<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class SingaporeUser extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table='singapore_users';
  
    // public function traveller()
    // {  
    //    return $this->hasMany('App\SingaporeTraveller','user_id','id'); 
    // }
    
    protected $fillable = [
        'name', 'email','passwprd','present_address','permanent_address','father_name','mother_name',
        'mobile_number','add_money_balance','balance','total_earn','product_balance','cover_image',
        'profile_image','token','mac_id'
    ];

    protected $hidden =[
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function available_service(){
        return $this->hasMany('App\BDService','user_id','id')->where('status',1); 
    }
    //-----------------------web------------------------------
public function traveller_info(){
    return $this->hasOne('App\SingaporeTraveller','user_id','id'); 
}
public function request_service_info(){
    return $this->hasMany('App\SingaporeRequestService','user_id','id'); 
}
//---------------------web----------------------------------------

}