<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BdRating;
use App\IndRating;
use App\PakRating;
use App\SingaporeRating;


class GetAllRatingController extends Controller
{
  public function GetAllRating($country_code)
  {

    if ($country_code == +880) {
      $BangladeshRating = BdRating::where('country_code', $country_code)
        ->OrderBy('id', 'ASC')->get();
      if (count($BangladeshRating) > 0) {
        return response()->json(['message' => 'true', 'Bangladesh Rating Information' => $BangladeshRating], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    } elseif ($country_code == +91) {
      $IndiaRating = IndRating::where('country_code', $country_code)
        ->OrderBy('id', 'ASC')->get();
      if (count($IndiaRating) > 0) {
        return response()->json(['message' => 'true', 'India Rating Information' => $IndiaRating], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    } elseif ($country_code == +92) {
      $PakistanRating = PakRating::where('country_code', $country_code)
        ->OrderBy('id', 'ASC')->get();
      if (count($PakistanRating) > 0) {
        return response()->json(['message' => 'true', 'Pakistan Rating Information' => $PakistanRating], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    } elseif ($country_code == +65) {
      $SingaporeRating = SingaporeRating::where('country_code', $country_code)
        ->OrderBy('id', 'ASC')->get();
      if (count($SingaporeRating) > 0) {
        return response()->json(['message' => 'true', 'Singapore Rating Information' => $SingaporeRating], 200);
      } else {
        return response()->json(['message' => 'false', 'No Data Found!'], 400);
      }
    } else {
      return response()->json(['message' => 'false', 'Invalied country code'], 400);
    }
  }

  public function GetAllRatingTravel($country_code, $travel_user_id)
  {


    if ($country_code == +880) {
      $RatingUser = BdRating::where('country_code', $country_code)->where('travel_id', $travel_user_id)->OrderBy('id', 'DESC')->get();
      $all = [];
      foreach ($RatingUser as $v_rating) {
        $all[] = array(

          'service_id' => $v_rating->services_id,
          'travel_start_point' => $v_rating->service_info->travel_start_point,
          'travel_end_point' => $v_rating->service_info->travel_end_point,
          'rating_point' => $v_rating->rating_point,
          'review' => $v_rating->review,
        );
      }
      if (count($RatingUser) > 0) {
        return response()->json(['success' => 'true', 'Rating User Information' => $all], 200);
      } else {
        return response()->json(['success' => 'false', 'message' => 'No Data Found!'], 400);
      }
    } elseif ($country_code == +91) {
      $RatingUser = IndRating::where('country_code', $country_code)->where('travel_id', $travel_user_id)->OrderBy('id', 'DESC')->get();

      foreach ($RatingUser as $v_rating) {
        $all[] = array(

          'service_id' => $v_rating->services_id,
          'travel_start_point' => $v_rating->service_info->travel_start_point,
          'travel_end_point' => $v_rating->service_info->travel_end_point,
          'rating_point' => $v_rating->rating_point,
          'review' => $v_rating->review,
        );
      }
      if (count($RatingUser) > 0) {
        return response()->json(['success' => 'true', 'Rating User Information' => $all], 200);
      } else {
        return response()->json(['success' => 'false', 'message' => 'No Data Found!'], 400);
      }
    } elseif ($country_code == +92) {
      $RatingUser = PakRating::where('country_code', $country_code)->where('travel_id', $travel_user_id)->OrderBy('id', 'DESC')->get();

      foreach ($RatingUser as $v_rating) {
        $all[] = array(

          'service_id' => $v_rating->services_id,
          'travel_start_point' => $v_rating->service_info->travel_start_point,
          'travel_end_point' => $v_rating->service_info->travel_end_point,
          'rating_point' => $v_rating->rating_point,
          'review' => $v_rating->review,
        );
      }
      if (count($RatingUser) > 0) {
        return response()->json(['success' => 'true', 'Rating User Information' => $all], 200);
      } else {
        return response()->json(['success' => 'false', 'message' => 'No Data Found!'], 400);
      }
    } elseif ($country_code == +65) {
      $RatingUser = SingaporeRating::where('country_code', $country_code)->where('travel_id', $travel_user_id)->OrderBy('id', 'DESC')->get();

      foreach ($RatingUser as $v_rating) {
        $all[] = array(

          'service_id' => $v_rating->services_id,
          'travel_start_point' => $v_rating->service_info->travel_start_point,
          'travel_end_point' => $v_rating->service_info->travel_end_point,
          'rating_point' => $v_rating->rating_point,
          'review' => $v_rating->review,
        );
      }
      if (count($RatingUser) > 0) {
        return response()->json(['success' => 'true', 'Rating User Information' => $all], 200);
      } else {
        return response()->json(['success' => 'false', 'message' => 'No Data Found!'], 400);
      }
    } else {
      return response()->json(['message' => 'false', 'Invalied country code'], 400);
    }
  }
}