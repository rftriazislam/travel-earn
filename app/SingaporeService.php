<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SingaporeService extends Model
{
  protected $table = "singapore_services";

  public function traveller()
  {
    return $this->hasMany('App\SingaporeTraveller', 'id', 'travel_id');
  }

  public function User()
  {
    return $this->hasMany('App\SingaporeUser', 'id', 'user_id');
  }
  public function rating()
  {
    return $this->hasMany('App\SingaporeRating', 'user_id', 'user_id');
  }
  public function singletraveller()
  {
    return $this->hasOne('App\BDTraveller', 'id', 'travel_id');
  }

  public function  rating_avg()
  {
    return $this->hasMany('App\BdRating', 'travel_id', 'user_id');
  }
  public function Sucessfull_delivery()
  {
    return $this->hasMany('App\SingaporeTraveller', 'user_id', 'user_id')->where('sucessfull_delivery_count', 1);
  }

  public function user_info()
  {
    return $this->hasMany('App\SingaporeUser', 'id', 'user_id');
  }
  public function  delivery_success()
  {
    return $this->hasMany('App\SingaporeRequestService', 'traveller_id', 'travel_id')->where('active_status', 1);
  }
  public function  delivery_request_service()
  {
    return $this->hasOne('App\SingaporeRequestService', 'singapore_services_id', 'id');
  }
  //--------------------------------------web-----------------
  public function service_user_info()
  {
    return $this->hasOne('App\SingaporeUser', 'id', 'user_id');
  }
}