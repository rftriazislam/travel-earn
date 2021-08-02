<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class INDRequestService extends Model
{
    protected $table="ind_request_services";
    public function service_info(){
        return $this->hasOne('App\INDService','id','ind_services_id'); 
      }

//---------------------------------------web-----------------------------
public function user_info(){
  return $this->hasOne('App\INDUser','id','user_id'); 
}
public function traveller_info(){
  return $this->hasOne('App\INDTraveller','id','traveller_id'); 
}
//---------------------------------------web-----------------------------

}
