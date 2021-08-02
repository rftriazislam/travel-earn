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
use App\BDUser;
use App\BdRating;
use App\SingaporeService;

class GetServiceController extends Controller
{
  public function GetServiceSingle($country_code, $service_id)
  {
    if ($country_code == +880) {

      $Service = BDService::where('country_code', $country_code)->where('id', $service_id)->first();

      $singleService = array(
        'service_id' => $Service->id,
        'service_user_id' => $Service->user_id,
        'travel_id' => $Service->travel_id,
        'name' => $Service->singletraveller->user_info_traveller->name,
        'profile_picture' => $Service->singletraveller->user_info_traveller->profile_image,
        'travel_start_point' => $Service->travel_start_point,
        'travel_end_point' => $Service->travel_end_point,
        'starting_date' => $Service->starting_date,
        'ending_date' => $Service->ending_date,
        'Avarage_rating' => $Service->rating_avg->avg('rating_point'),
        'successfull_delivery' => $Service->delivery_success->count(),
        'delivery_status' => $Service->status,

      );

      if ($singleService) {
        return response()->json(['message' => 'true', 'Single Service Information' => $singleService], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    } elseif ($country_code == +91) {

      $Service = INDService::where('country_code', $country_code)->where('id', $service_id)->first();

      $singleService = array(
        'service_id' => $Service->id,
        'service_user_id' => $Service->user_id,
        'travel_id' => $Service->travel_id,
        'name' => $Service->singletraveller->user_info_traveller->name,
        'profile_picture' => $Service->singletraveller->user_info_traveller->profile_image,
        'travel_start_point' => $Service->travel_start_point,
        'travel_end_point' => $Service->travel_end_point,
        'starting_date' => $Service->starting_date,
        'ending_date' => $Service->ending_date,
        'Avarage_rating' => $Service->rating_avg->avg('rating_point'),
        'successfull_delivery' => $Service->delivery_success->count(),
        'delivery_status' => $Service->status,

      );

      if ($singleService) {
        return response()->json(['message' => 'true', 'Single Service Information' => $singleService], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    } elseif ($country_code == +92) {

      $Service = PakService::where('country_code', $country_code)->where('id', $service_id)->first();

      $singleService = array(
        'service_id' => $Service->id,
        'service_user_id' => $Service->user_id,
        'travel_id' => $Service->travel_id,
        'name' => $Service->singletraveller->user_info_traveller->name,
        'profile_picture' => $Service->singletraveller->user_info_traveller->profile_image,
        'travel_start_point' => $Service->travel_start_point,
        'travel_end_point' => $Service->travel_end_point,
        'starting_date' => $Service->starting_date,
        'ending_date' => $Service->ending_date,
        'Avarage_rating' => $Service->rating_avg->avg('rating_point'),
        'successfull_delivery' => $Service->delivery_success->count(),
        'delivery_status' => $Service->status,
      );

      if ($singleService) {
        return response()->json(['message' => 'true', 'Single Service Information' => $singleService], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    } elseif ($country_code == +65) {

      $Service = SingaporeService::where('country_code', $country_code)->where('id', $service_id)->first();

      $singleService = array(
        'service_id' => $Service->id,
        'service_user_id' => $Service->user_id,
        'travel_id' => $Service->travel_id,
        'name' => $Service->singletraveller->user_info_traveller->name,
        'profile_picture' => $Service->singletraveller->user_info_traveller->profile_image,
        'travel_start_point' => $Service->travel_start_point,
        'travel_end_point' => $Service->travel_end_point,
        'starting_date' => $Service->starting_date,
        'ending_date' => $Service->ending_date,
        'Avarage_rating' => $Service->rating_avg->avg('rating_point'),
        'successfull_delivery' => $Service->delivery_success->count(),
        'delivery_status' => $Service->status,
      );

      if ($singleService) {
        return response()->json(['message' => 'true', 'Single Service Information' => $singleService], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    } else {
      return response()->json(['Success' => 'false', 'message' => 'country code did not match'], 400);
    }
  }
}