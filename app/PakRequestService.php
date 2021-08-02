<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PakRequestService extends Model
{
    protected $table="pak_request_services";
    public function service_info(){
        return $this->hasOne('App\PakService','id','pak_services_id'); 
      }
      //---------------------------------------web-----------------------------
public function user_info(){
  return $this->hasOne('App\PakUser','id','user_id'); 
}
public function traveller_info(){
  return $this->hasOne('App\PakTraveller','id','traveller_id'); 
}
//---------------------------------------web-----------------------------
}
