<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BDRequestService extends Model
{

  protected $fillable = [
    'active_status', 'updated_at'
  ];

  protected $table = "bd_request_services";


  public function service_info()
  {
    return $this->hasOne('App\BDService', 'id', 'bd_services_id');
  }

  public function user_info()
  {
    return $this->hasOne('App\BDUser', 'id', 'user_id');
  }
  //--------------------------web--------------------

  public function traveller_info()
  {
    return $this->hasOne('App\BDTraveller', 'id', 'traveller_id');
  }
}