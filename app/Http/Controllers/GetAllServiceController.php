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


class GetAllServiceController extends Controller
{
  public function AllCountryServiceController(Request $request, $country_code)
  {
    if ($country_code == +880) {

      $all = BDService::where('country_code', $country_code)->where('status', 1)->orderBy('id', 'DESC')->get();

      // $Service=collect($all)->take(30);
      $allService = [];
      foreach ($all as $v_service) {
        $allService[] = array(

          'service_id' => $v_service->id,
          'travel_id' => $v_service->travel_id,
          'travel_user_id' => $v_service->singletraveller->user_info_traveller->id,
          'name' => $v_service->singletraveller->user_info_traveller->name,
          'profile_picture' => $v_service->singletraveller->user_info_traveller->profile_image,
          'travel_start_point' => $v_service->travel_start_point,
          'travel_end_point' => $v_service->travel_end_point,
          'starting_date' => $v_service->starting_date,
          'ending_date' => $v_service->ending_date,
          'Avarage_rating' => $v_service->rating_avg->avg('rating_point'),
          'successfull_delivery' => $v_service->delivery_success->count(),

        );
      }

      $allService = collect($allService)->take(30);
      // $sortedData = $unsortedData->sortByDesc('Avarage_rating');
      if (count($allService) > 0) {
        return response()->json(['message' => 'true', 'Service Information' => $allService], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    } else if ($country_code == +91) {

      $Service = INDService::where('country_code', $country_code)->where('status', 1)->orderBy('id', 'DESC')->get();
      $allService = [];
      foreach ($Service as $v_service) {
        $allService[] = array(

          'service_id' => $v_service->id,
          'travel_id' => $v_service->travel_id,
          'travel_user_id' => $v_service->singletraveller->user_info_traveller->id,
          'name' => $v_service->singletraveller->user_info_traveller->name,
          'profile_picture' => $v_service->singletraveller->user_info_traveller->profile_image,
          'travel_start_point' => $v_service->travel_start_point,
          'travel_end_point' => $v_service->travel_end_point,
          'starting_date' => $v_service->starting_date,
          'ending_date' => $v_service->ending_date,
          'Avarage_rating' => $v_service->rating_avg->avg('rating_point'),
          'successfull_delivery' => $v_service->delivery_success->count(),

        );
      }
      $allService = collect($allService)->take(30);
      if (count($allService) > 0) {
        return response()->json(['message' => 'true', 'Service Information' => $allService], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    } else if ($country_code == +92) {

      $Service = PakService::where('country_code', $country_code)->where('status', 1)->orderBy('id', 'DESC')->get();
      $allService = [];
      foreach ($Service as $v_service) {
        $allService[] = array(

          'service_id' => $v_service->id,
          'travel_id' => $v_service->travel_id,
          'travel_user_id' => $v_service->singletraveller->user_info_traveller->id,
          'name' => $v_service->singletraveller->user_info_traveller->name,
          'profile_picture' => $v_service->singletraveller->user_info_traveller->profile_image,
          'travel_start_point' => $v_service->travel_start_point,
          'travel_end_point' => $v_service->travel_end_point,
          'starting_date' => $v_service->starting_date,
          'ending_date' => $v_service->ending_date,
          'Avarage_rating' => $v_service->rating_avg->avg('rating_point'),
          'successfull_delivery' => $v_service->delivery_success->count(),

        );
      }
      $allService = collect($allService)->take(30);
      if (count($allService) > 0) {
        return response()->json(['message' => 'true', 'Service Information' => $allService], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    } else if ($country_code == +65) {

      $Service = SingaporeService::where('country_code', $country_code)->where('status', 1)->orderBy('id', 'DESC')->get();
      $allService = [];
      foreach ($Service as $v_service) {
        $allService[] = array(

          'service_id' => $v_service->id,
          'travel_id' => $v_service->travel_id,
          'travel_user_id' => $v_service->singletraveller->user_info_traveller->id,
          'name' => $v_service->singletraveller->user_info_traveller->name,
          'profile_picture' => $v_service->singletraveller->user_info_traveller->profile_image,
          'travel_start_point' => $v_service->travel_start_point,
          'travel_end_point' => $v_service->travel_end_point,
          'starting_date' => $v_service->starting_date,
          'ending_date' => $v_service->ending_date,
          'Avarage_rating' => $v_service->rating_avg->avg('rating_point'),
          'successfull_delivery' => $v_service->delivery_success->count(),

        );
      }
      $allService = collect($allService)->take(30);
      if (count($allService) > 0) {

        return response()->json(['message' => 'true', 'Service Information' => $allService], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    }
  }
  public function personalservice($user_id, $country_code)
  {

    if ($country_code == +880) {

      $personalservice = BDService::where('country_code', $country_code)->where('user_id', $user_id)->get();
      if (count($personalservice) > 0) {
        return response()->json(['success' => 'true', 'Service personal info' => $personalservice], 200);
      } else {
        return response()->json(['Success' => 'true', 'message' => 'Personal service Did not create'], 400);
      }
    } else if ($country_code == +91) {
      $personalservice = INDService::where('country_code', $country_code)->where('user_id', $user_id)->get();
      if (count($personalservice) > 0) {
        return response()->json(['success' => 'true', 'Service personal info' => $personalservice], 200);
      } else {
        return response()->json(['Success' => 'true', 'message' => 'Personal service Did not create'], 400);
      }
    } else if ($country_code == +92) {
      $personalservice = PakService::where('country_code', $country_code)->where('user_id', $user_id)->get();
      if (count($personalservice) > 0) {
        return response()->json(['success' => 'true', 'Service personal info' => $personalservice], 200);
      } else {
        return response()->json(['Success' => 'true', 'message' => 'Personal service Did not create'], 400);
      }
    } else if ($country_code == +65) {
      $personalservice = SingaporeService::where('country_code', $country_code)->where('user_id', $user_id)->get();
      if (count($personalservice) > 0) {
        return response()->json(['success' => 'true', 'Service personal info' => $personalservice], 200);
      } else {
        return response()->json(['Success' => 'true', 'message' => 'Personal service Did not create'], 400);
      }
    } else {
      return response()->json(['Success' => 'false', 'message' => 'country code did not match'], 400);
    }
  }
}