<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class INDTraveller extends Model
{

    protected $fillable = [
        'country_code', 'user_id', 'mobile_verification', 'email_verification', 'NID_verification', 'NID_number',
        'NID_image', 'NID_back_image', 'self_video', 'video_verification', 'security_money',
        'security_money_verification', 'resident_verification', 'agent_verification', 'total_verification_persentage',
        'sucessfull_delivery_count', 'unsucessfull_delivery', 'status', 'updated_at'
    ];

    protected $table = "ind_travellers";

    public function user_balance()
    {
        return $this->hasOne('App\INDUser', 'id', 'user_id');
    }

    public function user_info()
    {
        return $this->hasMany('App\INDUser', 'id', 'user_id');
    }
    //--------------------------web---------------------------
    public function request_service_info()
    {
        return $this->hasMany('App\INDRequestService', 'traveller_id', 'id');
    }
    public function user_info_traveller()
    {
        return $this->hasOne('App\INDUser', 'id', 'user_id');
    }

    public function  rating_avg()
    {
        return $this->hasMany('App\IndRating', 'travel_id', 'user_id');
    }


    public function  delivery_success()
    {
        return $this->hasMany('App\INDRequestService', 'traveller_id', 'id');
    }


    public function agentverified()
    {
        return $this->hasOne('App\IndAgentVerified', 'traveller_id', 'id')->where('status', 0);
    }







    //-------------------------------------web------------------------
}