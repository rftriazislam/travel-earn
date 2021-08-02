<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndRating extends Model
{
    protected $table="ind_ratings";
    
    public function rating_give_user_info(){
        return $this->hasMany('App\INDUser','id','user_id'); 
    }
    public function service_info(){
        return $this->hasOne('App\INDService','id','services_id'); 
    }
}