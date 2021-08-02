<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BDService;
use App\INDService;
use App\PakService;
use App\SingaporeService;
use App\BDTraveller;
use App\INDTraveller;
use App\PaKTraveller;
use App\SingaporeTraveller;
use DB;

use Validator;

class ServiceController extends Controller
{
    public function insertservice(Request $R)
    {
        $country = $R->country_code;
        if ($country == +880) {

            $validator = Validator::make($R->all(), [
                'country_code' => 'required|string|exists:bd_users,country_code',
                'user_id' => 'required|integer|exists:bd_users,id',
                'travel_id' => 'required|integer|exists:bd_travellers,id',
                'travel_start_point' => 'required|string',
                'travel_start_point_latitude' => 'required|string',
                'travel_start_point_longitude' => 'required|string',
                'travel_end_point' => 'required|string',
                'travel_end_point_latitude' => 'required|string',
                'travel_end_point_longitude' => 'required|string',
                'starting_date' => 'required|date',
                'ending_date' => 'required|date',
                'starting_time' => 'required',
                'ending_time' => 'required',
                'traveling_type' => 'required|string',

            ]);

            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }

            $bdserviceadd = new BDService;
            $bdserviceadd->country_code = $R->country_code;
            $bdserviceadd->user_id = $R->user_id;
            $bdserviceadd->travel_id = $R->travel_id;
            $bdserviceadd->travel_start_point = $R->travel_start_point;
            $bdserviceadd->travel_start_point_latitude = $R->travel_start_point_latitude;
            $bdserviceadd->travel_start_point_longitude = $R->travel_start_point_longitude;
            $bdserviceadd->travel_end_point = $R->travel_end_point;
            $bdserviceadd->travel_end_point_latitude = $R->travel_end_point_latitude;
            $bdserviceadd->travel_end_point_longitude = $R->travel_end_point_longitude;
            $bdserviceadd->starting_date = $R->starting_date;
            $bdserviceadd->ending_date = $R->ending_date;
            $bdserviceadd->starting_time = $R->starting_time;
            $bdserviceadd->ending_time = $R->ending_time;
            $bdserviceadd->traveling_type = $R->traveling_type;

            $traveller = BDTraveller::where('id', $R->travel_id)->first();

            if ($traveller->total_verification_persentage >= 70) {
                $bdserviceadd->save();
                return response()->json(['success' => 'true', 'message' => 'Sucessfully added'], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => ' Unsucessfully'], 400);
            }
        } else if ($country == +91) {

            $validator = Validator::make($R->all(), [
                'country_code' => 'required|string|exists:ind_users,country_code',
                'user_id' => 'required|integer|exists:ind_users,id',
                'travel_id' => 'required|integer|exists:ind_travellers,id',
                'travel_start_point' => 'required|string',
                'travel_start_point_latitude' => 'required|string',
                'travel_start_point_longitude' => 'required|string',
                'travel_end_point' => 'required|string',
                'travel_end_point_latitude' => 'required|string',
                'travel_end_point_longitude' => 'required|string',
                'starting_date' => 'required|date',
                'ending_date' => 'required|date',
                'starting_time' => 'required',
                'ending_time' => 'required',
                'traveling_type' => 'required|string',

            ]);

            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }

            $indserviceadd = new INDService;
            $indserviceadd->country_code = $R->country_code;
            $indserviceadd->user_id = $R->user_id;
            $indserviceadd->travel_id = $R->travel_id;
            $indserviceadd->travel_start_point = $R->travel_start_point;
            $indserviceadd->travel_start_point_latitude = $R->travel_start_point_latitude;
            $indserviceadd->travel_start_point_longitude = $R->travel_start_point_longitude;
            $indserviceadd->travel_end_point = $R->travel_end_point;
            $indserviceadd->travel_end_point_latitude = $R->travel_end_point_latitude;
            $indserviceadd->travel_end_point_longitude = $R->travel_end_point_longitude;
            $indserviceadd->starting_date = $R->starting_date;
            $indserviceadd->ending_date = $R->ending_date;
            $indserviceadd->starting_time = $R->starting_time;
            $indserviceadd->ending_time = $R->ending_time;
            $indserviceadd->traveling_type = $R->traveling_type;

            $traveller = INDTraveller::where('id', $R->travel_id)->first();

            if ($traveller->total_verification_persentage >= 70) {
                $indserviceadd->save();

                return response()->json(['success' => 'true', 'message' => ' Sucessfully added'], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => ' Unsucessfully'], 400);
            }
        } else if ($country == +92) {

            $validator = Validator::make($R->all(), [
                'country_code' => 'required|string|exists:pak_users,country_code',
                'user_id' => 'required|integer|exists:pak_users,id',
                'travel_id' => 'required|integer|exists:pak_travellers,id',
                'travel_start_point' => 'required|string',
                'travel_start_point_latitude' => 'required|string',
                'travel_start_point_longitude' => 'required|string',
                'travel_end_point' => 'required|string',
                'travel_end_point_latitude' => 'required|string',
                'travel_end_point_longitude' => 'required|string',
                'starting_date' => 'required|date',
                'ending_date' => 'required|date',
                'starting_time' => 'required',
                'ending_time' => 'required',
                'traveling_type' => 'required|string',

            ]);

            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }

            $pakserviceadd = new PakService;
            $pakserviceadd->country_code = $R->country_code;
            $pakserviceadd->user_id = $R->user_id;
            $pakserviceadd->travel_id = $R->travel_id;
            $pakserviceadd->travel_start_point = $R->travel_start_point;
            $pakserviceadd->travel_start_point_latitude = $R->travel_start_point_latitude;
            $pakserviceadd->travel_start_point_longitude = $R->travel_start_point_longitude;
            $pakserviceadd->travel_end_point = $R->travel_end_point;
            $pakserviceadd->travel_end_point_latitude = $R->travel_end_point_latitude;
            $pakserviceadd->travel_end_point_longitude = $R->travel_end_point_longitude;
            $pakserviceadd->starting_date = $R->starting_date;
            $pakserviceadd->ending_date = $R->ending_date;
            $pakserviceadd->starting_time = $R->starting_time;
            $pakserviceadd->ending_time = $R->ending_time;
            $pakserviceadd->traveling_type = $R->traveling_type;

            $traveller =  PaKTraveller::where('id', $R->travel_id)->first();

            if ($traveller->total_verification_persentage >= 70) {
                $pakserviceadd->save();
                return response()->json(['success' => 'true', 'message' => ' Sucessfully added'], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => ' Unsucessfully'], 400);
            }
        } else if ($country == +65) {

            $validator = Validator::make($R->all(), [
                'country_code' => 'required|string|exists:singapore_users,country_code',
                'user_id' => 'required|integer|exists:singapore_users,id',
                'travel_id' => 'required|integer|exists:singapore_travellers,id',
                'travel_start_point' => 'required|string',
                'travel_start_point_latitude' => 'required|string',
                'travel_start_point_longitude' => 'required|string',
                'travel_end_point' => 'required|string',
                'travel_end_point_latitude' => 'required|string',
                'travel_end_point_longitude' => 'required|string',
                'starting_date' => 'required|date',
                'ending_date' => 'required|date',
                'starting_time' => 'required',
                'ending_time' => 'required',
                'traveling_type' => 'required|string',

            ]);

            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }

            $singaporeserviceadd = new SingaporeService;
            $singaporeserviceadd->country_code = $R->country_code;
            $singaporeserviceadd->user_id = $R->user_id;
            $singaporeserviceadd->travel_id = $R->travel_id;
            $singaporeserviceadd->travel_start_point = $R->travel_start_point;
            $singaporeserviceadd->travel_start_point_latitude = $R->travel_start_point_latitude;
            $singaporeserviceadd->travel_start_point_longitude = $R->travel_start_point_longitude;
            $singaporeserviceadd->travel_end_point = $R->travel_end_point;
            $singaporeserviceadd->travel_end_point_latitude = $R->travel_end_point_latitude;
            $singaporeserviceadd->travel_end_point_longitude = $R->travel_end_point_longitude;
            $singaporeserviceadd->starting_date = $R->starting_date;
            $singaporeserviceadd->ending_date = $R->ending_date;
            $singaporeserviceadd->starting_time = $R->starting_time;
            $singaporeserviceadd->ending_time = $R->ending_time;
            $singaporeserviceadd->traveling_type = $R->traveling_type;

            $traveller = SingaporeTraveller::where('id', $R->travel_id)->first();

            if ($traveller->total_verification_persentage >= 70) {
                $singaporeserviceadd->save();
                return response()->json(['success' => 'true', 'message' => ' Sucessfully added'], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => ' Unsucessfully'], 400);
            }
        } else {

            return response()->json(['message' => 'false', 'success' => 'Country Code did not match'], 400);
        }
    }


    public function GetAllSingleService($country_code, $traveller_id)
    {

        if ($country_code == +880) {

            $Service = BDService::where('country_code', $country_code)->where('travel_id', $traveller_id)->where('status', 1)->get();
            $singleService = [];
            foreach ($Service as $v_service) {

                $singleService[] = array(
                    'service_id' => $v_service->id,
                    'user_id' => $v_service->user_id,
                    'travel_id' => $v_service->travel_id,
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


            if (count($singleService) > 0) {
                return response()->json(['success' => 'true', 'All Single Service Information' => $singleService], 200);
            } else {
                return response()->json(['success' => 'false', 'All Single Service Information' => null], 200);
            }
        } elseif ($country_code == +91) {
            $Service = INDService::where('country_code', $country_code)->where('travel_id', $traveller_id)->where('status', 1)->get();
            $singleService = [];
            foreach ($Service as $v_service) {

                $singleService[] = array(
                    'service_id' => $v_service->id,
                    'user_id' => $v_service->user_id,
                    'travel_id' => $v_service->travel_id,
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


            if (count($singleService) > 0) {
                return response()->json(['success' => 'true', 'All Single Service Information' => $singleService], 200);
            } else {
                return response()->json(['success' => 'false', 'All Single Service Information' => null], 200);
            }
        } elseif ($country_code == +92) {

            $Service = PakService::where('country_code', $country_code)->where('travel_id', $traveller_id)->where('status', 1)->get();
            $singleService = [];
            foreach ($Service as $v_service) {

                $singleService[] = array(
                    'service_id' => $v_service->id,
                    'user_id' => $v_service->user_id,
                    'travel_id' => $v_service->travel_id,
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


            if (count($singleService) > 0) {
                return response()->json(['success' => 'true', 'All Single Service Information' => $singleService], 200);
            } else {
                return response()->json(['success' => 'false', 'All Single Service Information' => null], 200);
            }
        } elseif ($country_code == +65) {

            $Service = SingaporeService::where('country_code', $country_code)->where('travel_id', $traveller_id)->where('status', 1)->get();
            $singleService = [];
            foreach ($Service as $v_service) {

                $singleService[] = array(
                    'service_id' => $v_service->id,
                    'user_id' => $v_service->user_id,
                    'travel_id' => $v_service->travel_id,
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


            if (count($singleService) > 0) {
                return response()->json(['success' => 'true', 'All Single Service Information' => $singleService], 200);
            } else {
                return response()->json(['success' => 'false', 'All Single Service Information' => null], 200);
            }
        } else {
            return response()->json(['Success' => 'false', 'message' => 'country code did not match'], 400);
        }
    }
}