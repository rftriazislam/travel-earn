<?php

namespace App\Http\Controllers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BDUser;
use App\INDUser;
use App\PakUser;
use App\SingaporeUser;
use DB;


class UserController extends Controller
 {
    public function getUserTopEarn() {

      $BangladeshUserUser=BDUser::OrderBy('total_earn','DESC')->take(10)->get();
      $indiaUser=INDUser::OrderBy('total_earn','DESC')->take(10)->get();
      $pakuser=PakUser::OrderBy('total_earn','DESC')->take(10)->get();
      $SingaporeUser=SingaporeUser::OrderBy('total_earn','DESC')->take(10)->get();


      $all=array_merge($BangladeshUserUser->all(), $indiaUser->all(),$pakuser->all(),$SingaporeUser->all());

        $Topearn=collect($all)->sortByDesc('total_earn')->take(20);
       
foreach($Topearn as $v_topearn){
    $topearn_all[]=array(
        'country_code'=>$v_topearn->country_code,
        'user_id'=>$v_topearn->id,
        'name'=>$v_topearn->name,
        'total_earn'=>$v_topearn->total_earn,
        'profile_image'=>$v_topearn->profile_image,
);
}


        if(count($topearn_all) > 0){

            return response()->json(['Success'=>'True','Top_Earner'=>$topearn_all],200);
        }else{
            return response()->json(['Success'=>'false','Top_Earner'=>'data not found'],400); 
        }
      
      

    }
}