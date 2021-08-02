<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SingaporeRequestService extends Model
{
    protected $table="singapore_request_services";
    public function service_info(){
        return $this->hasOne('App\SingaporeService','id','singapore_services_id'); 
      }
          //---------------------------------------web-----------------------------
public function user_info(){
  return $this->hasOne('App\SingaporeUser','id','user_id'); 
}
public function traveller_info(){
  return $this->hasOne('App\SingaporeTraveller','id','traveller_id'); 
}
//---------------------------------------web-----------------------------
}
