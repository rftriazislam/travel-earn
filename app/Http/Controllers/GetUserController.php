<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BDUser;
use App\BDTraveller;
use App\INDTraveller;
use App\PakTraveller;
use App\SingaporeTraveller;
use App\INDUser;
use App\PakUser;
use App\SingaporeUser;
use DB;

class GetUserController extends Controller
{
  public function GetUserSingleinfo($country_code, $user_id)
  {
    if ($country_code == +880) {

      $BangladeshSingleUser = BDUser::where('id', $user_id)->where('country_code', $country_code)->withCount('available_service')->with('traveller_info')->get();

      $traveller = BDTraveller::where('user_id', $user_id)->first();

      if ($traveller) {
        $rating = $traveller->rating_avg->avg('rating_point');
        $unsucessfull_delivery = $traveller->delivery_success->where('active_status', 0)->count();
        $sucessfull_delivery = $traveller->delivery_success->where('active_status', 1)->count();
      } else {
        $rating = null;
      }

      $profile  = asset('public/profile_image/bd_profile/profile_image/');

      $cover = asset('public/profile_image/bd_profile/cover_image/');


      if (count($BangladeshSingleUser) > 0) {
        return response()->json(['message' => 'true', 'User Information' => $BangladeshSingleUser, 'sucessfull_delivery ' => $sucessfull_delivery, 'unsucessfull_delivery ' => $unsucessfull_delivery,  'avarage_rating' => $rating, 'profile_image_link' => $profile, 'cover_image_link' => $cover], 200);
      } else {
        return response()->json(['success' => 'false', 'message' => 'No Data Found!'], 200);
      }
    } else if ($country_code == +91) {

      $IndiaSingleUser = INDUser::where('id', $user_id)->where('country_code', $country_code)->withCount('available_service')->with('traveller_info')->get();
      $traveller = INDTraveller::where('user_id', $user_id)->first();
      if ($traveller) {
        $rating = $traveller->rating_avg->avg('rating_point');
        $unsucessfull_delivery = $traveller->delivery_success->where('active_status', 0)->count();
        $sucessfull_delivery = $traveller->delivery_success->where('active_status', 1)->count();
      } else {
        $rating = null;
      }

      $profile = asset('public/profile_image/ind_profile/profile_image/');

      $cover = asset('public/profile_image/ind_profile/cover_image/');

      if (count($IndiaSingleUser) > 0) {
        return response()->json(['message' => 'true', 'User Information' => $IndiaSingleUser, 'sucessfull_delivery ' => $sucessfull_delivery, 'unsucessfull_delivery ' => $unsucessfull_delivery,  'avarage_rating' => $rating, 'profile_image_link' => $profile, 'cover_image_link' => $cover], 200);
      } else {
        return response()->json(['success' => 'false', 'message' => 'No Data Found!'], 200);
      }
    } else if ($country_code == +92) {

      $PakistanSingleUser = PakUser::where('id', $user_id)->where('country_code', $country_code)->withCount('available_service')->with('traveller_info')->get();
      $traveller = PakTraveller::where('user_id', $user_id)->first();
      if ($traveller) {
        $rating = $traveller->rating_avg->avg('rating_point');
        $unsucessfull_delivery = $traveller->delivery_success->where('active_status', 0)->count();
        $sucessfull_delivery = $traveller->delivery_success->where('active_status', 1)->count();
      } else {
        $rating = null;
      }
      $profile = asset('public/profile_image/pak_profile/profile_image/');

      $cover = asset('public/profile_image/pak_profile/cover_image/');

      if (count($PakistanSingleUser) > 0) {
        return response()->json(['message' => 'true', 'User Information' => $PakistanSingleUser, 'sucessfull_delivery ' => $sucessfull_delivery, 'unsucessfull_delivery ' => $unsucessfull_delivery,  'avarage_rating' => $rating, 'profile_image_link' => $profile, 'cover_image_link' => $cover], 200);
      } else {
        return response()->json(['success' => 'false', 'message' => 'No Data Found!'], 200);
      }
    } else if ($country_code == +65) {

      $SignpureSingleUser = SingaporeUser::where('id', $user_id)->where('country_code', $country_code)->withCount('available_service')->with('traveller_info')->get();


      $traveller = SingaporeTraveller::where('user_id', $user_id)->first();
      if ($traveller) {
        $rating = $traveller->rating_avg->avg('rating_point');
        $unsucessfull_delivery = $traveller->delivery_success->where('active_status', 0)->count();
        $sucessfull_delivery = $traveller->delivery_success->where('active_status', 1)->count();
      } else {
        $rating = null;
      }
      $profile  = asset('public/profile_image/singapore_profile/profile_image/');

      $cover = asset('public/profile_image/singapore_profile/cover_image/');

      if (count($SignpureSingleUser) > 0) {
        return response()->json(['message' => 'true', 'User Information' => $SignpureSingleUser, 'sucessfull_delivery ' => $sucessfull_delivery, 'unsucessfull_delivery ' => $unsucessfull_delivery,  'avarage_rating' => $rating, 'profile_image_link' => $profile, 'cover_image_link' => $cover], 200);
      } else {
        return response()->json(['success' => 'false', 'message' => 'No Data Found!'], 200);
      }
    } else {
      return response()->json(['message' => 'Country Code did not match'], 400);
    }
  }
}