<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PakService extends Model
{
   protected $table = "pak_services";

   public function traveller()
   {
      return $this->hasMany('App\PakTraveller', 'id', 'travel_id');
   }

   public function user()
   {
      return $this->hasMany('App\PakUser', 'id', 'user_id');
   }
   public function rating()
   {
      return $this->hasMany('App\PakRating', 'user_id', 'user_id');
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
      return $this->hasMany('App\PakTraveller', 'user_id', 'user_id')->where('sucessfull_delivery_count', 1);
   }

   public function user_info()
   {
      return $this->hasMany('App\PakUser', 'id', 'user_id');
   }
   public function  delivery_success()
   {
      return $this->hasMany('App\PakRequestService', 'traveller_id', 'travel_id')->where('active_status', 1);
   }
   public function  delivery_request_service()
   {
      return $this->hasOne('App\PakRequestService', 'pak_services_id', 'id');
   }
   //--------------------------------------web-----------------
   public function service_user_info()
   {
      return $this->hasOne('App\PakUser', 'id', 'user_id');
   }
}