<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BDTraveller;
use App\INDTraveller;
use App\PakTraveller;
use App\SingaporeTraveller;
use App\BDService;
use App\INDService;
use App\PakService;
use App\SingaporeService;

class SuccessfullDeliveryController extends Controller
{
  public function getSucessfullDelivery($country_code)

  {
    if ($country_code == +880) {

      $all = BDTraveller::where('country_code', $country_code)->get();
      $Sucessfulldelivery = collect($all)->take(20);

      foreach ($Sucessfulldelivery as $v_delivery) {
        $alldelivery[] = array(


          'travel_id' => $v_delivery->id,
          'user_id' => $v_delivery->user_info_traveller->id,
          'name' => $v_delivery->user_info_traveller->name,
          'profile_picture' => $v_delivery->user_info_traveller->profile_image,
          'Avarage_rating' => $v_delivery->rating_avg->avg('rating_point'),
          'success_delivery' => $v_delivery->delivery_success->where('active_status', 1)->count(),
          'unsuccess_delivery' => $v_delivery->delivery_success->where('active_status', 0)->count(),


        );
      }



      if (count($alldelivery) > 0) {
        return response()->json(['message' => 'true', 'delivery' => $alldelivery], 200);
      } else {
        return response()->json(['message' => 'false', 'Traveller' => 'Did not Sucessful delivery'], 200);
      }
    } else if ($country_code == +91) {

      $all = INDTraveller::where('country_code', $country_code)->get();
      $Sucessfulldelivery = collect($all)->take(20);
      foreach ($Sucessfulldelivery as $v_delivery) {
        $alldelivery[] = array(


          'travel_id' => $v_delivery->id,
          'user_id' => $v_delivery->user_info_traveller->id,
          'name' => $v_delivery->user_info_traveller->name,
          'profile_picture' => $v_delivery->user_info_traveller->profile_image,
          'Avarage_rating' => $v_delivery->rating_avg->avg('rating_point'),
          'success_delivery' => $v_delivery->delivery_success->where('active_status', 1)->count(),
          'unsuccess_delivery' => $v_delivery->delivery_success->where('active_status', 0)->count(),


        );
      }

      if (count($alldelivery) > 0) {
        return response()->json(['message' => 'true', 'delivery' => $alldelivery], 200);
      } else {
        return response()->json(['message' => 'false', 'delivery' => 'Did not Sucessful delivery'], 200);
      }
    } else if ($country_code == +92) {

      $all = PakTraveller::where('country_code', $country_code)->get();
      $Sucessfulldelivery = collect($all)->take(20);
      foreach ($Sucessfulldelivery as $v_delivery) {
        $alldelivery[] = array(


          'travel_id' => $v_delivery->id,
          'user_id' => $v_delivery->user_info_traveller->id,
          'name' => $v_delivery->user_info_traveller->name,
          'profile_picture' => $v_delivery->user_info_traveller->profile_image,
          'Avarage_rating' => $v_delivery->rating_avg->avg('rating_point'),
          'success_delivery' => $v_delivery->delivery_success->where('active_status', 1)->count(),
          'unsuccess_delivery' => $v_delivery->delivery_success->where('active_status', 0)->count(),


        );
      }

      if (count($alldelivery) > 0) {
        return response()->json(['message' => 'true', 'delivery' => $alldelivery], 200);
      } else {
        return response()->json(['message' => 'false', 'delivery' => 'Did not Sucessful delivery'], 200);
      }
    } else if ($country_code == +65) {
      $all = SingaporeTraveller::where('country_code', $country_code)->get();
      $Sucessfulldelivery = collect($all)->take(20);
      foreach ($Sucessfulldelivery as $v_delivery) {
        $alldelivery[] = array(


          'travel_id' => $v_delivery->id,
          'user_id' => $v_delivery->user_info_traveller->id,
          'name' => $v_delivery->user_info_traveller->name,
          'profile_picture' => $v_delivery->user_info_traveller->profile_image,
          'Avarage_rating' => $v_delivery->rating_avg->avg('rating_point'),
          'success_delivery' => $v_delivery->delivery_success->where('active_status', 1)->count(),
          'unsuccess_delivery' => $v_delivery->delivery_success->where('active_status', 0)->count(),


        );
      }

      if (count($alldelivery) > 0) {
        return response()->json(['message' => 'true', 'delivery' => $alldelivery], 200);
      } else {
        return response()->json(['message' => 'false', 'delivery' => 'Did not Sucessful delivery'], 200);
      }
    } else {
      return response()->json(['message' => 'false', 'message' => 'Country Code did not match'], 400);
    }
  }
}