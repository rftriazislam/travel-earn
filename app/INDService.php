<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class INDService extends Model
{
  protected $table = 'ind_services';

  public function traveller()
  {
    return $this->hasMany('App\INDTraveller', 'id', 'travel_id');
  }

  public function user()
  {
    return $this->hasMany('App\INDUser', 'id', 'user_id');
  }
  public function rating()
  {
    return $this->hasMany('App\IndRating', 'user_id', 'user_id');
  }
  public function singletraveller()
  {
    return $this->hasOne('App\BDTraveller', 'id', 'travel_id');
  }

  public function  rating_avg()
  {
    return $this->hasMany('App\BdRating', 'travel_id', 'user_id');
  }
  public function  delivery_success()
  {
    return $this->hasMany('App\INDRequestService', 'traveller_id', 'travel_id')->where('active_status', 1);
  }
  public function  delivery_request_service()
  {
    return $this->hasOne('App\INDRequestService', 'ind_services_id', 'id');
  }
  //--------------------------------------web-----------------
  public function service_user_info()
  {
    return $this->hasOne('App\INDUser', 'id', 'user_id');
  }
}