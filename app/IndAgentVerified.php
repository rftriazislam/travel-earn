<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndAgentVerified extends Model
{
    
    public function agent_info(){
        return $this->hasOne('App\User','id','agent_id'); 
    }
    public function traveller_info(){
        return $this->hasOne('App\INDTraveller','id','traveller_id'); 
    }
}