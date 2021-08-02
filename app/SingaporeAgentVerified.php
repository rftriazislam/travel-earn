<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SingaporeAgentVerified extends Model
{
    
    public function agent_info(){
        return $this->hasOne('App\User','id','agent_id'); 
    }
    public function traveller_info(){
        return $this->hasOne('App\SingaporeTraveller','id','traveller_id'); 
    }
}