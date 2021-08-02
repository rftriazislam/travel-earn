<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BDService extends Model
{
   protected $table = "bd_services";

   public function traveller()
   {
      return $this->hasMany('App\BDTraveller', 'id', 'travel_id');
   }

   public function user()
   {
      return $this->hasMany('App\BDUser', 'id', 'user_id');
   }
   public function rating()
   {
      return $this->hasMany('App\BdRating', 'user_id', 'user_id');
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
      return $this->hasMany('App\BDRequestService', 'traveller_id', 'travel_id')->where('active_status', 1);
   }

   public function  delivery_request_service()
   {
      return $this->hasOne('App\BDRequestService', 'bd_services_id', 'id');
   }
   //--------------------------------------web-----------------
   public function service_user_info()
   {
      return $this->hasOne('App\BDUser', 'id', 'user_id');
   }
}