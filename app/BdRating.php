<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BdRating extends Model
{
    protected $table = "bd_ratings";
    public function rating_give_user_info()
    {
        return $this->hasMany('App\BDUser', 'id', 'user_id');
    }


    // public function service_info()
    // {
    //     return $this->hasOne('App\BDService', 'id', 'services_id');
    // }
    public function service_info()
    {
        return $this->hasOne('App\BDService', 'id', 'services_id');
    }
}