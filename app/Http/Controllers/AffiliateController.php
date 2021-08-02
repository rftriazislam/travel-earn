<?php

namespace App\Http\Controllers;

use App\BDTraveller;
use App\BDUser;
use App\INDTraveller;
use App\PakTraveller;
use App\SingaporeTraveller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function GetAffiliateLink($country_code, $user_id)
    {
        if ($country_code == +880) {


            $user_info = BDTraveller::where('status', 1)->where('id', $user_id)->first();
            if ($user_info->total_verification_persentage >= 70) {
                $link = 'thirdhand.net/' . $user_id;
                return response()->json(['success' => 'true', 'affiliate_link' => $link], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not enough percentage'], 400);
            }
        } elseif ($country_code == +91) {
        } elseif ($country_code == +92) {
        } elseif ($country_code == +65) {
        } else {
        }
    }



    public function GetSponsor($country_code, $user_id)
    {

        if ($country_code == +880) {


            $user_info = BDTraveller::where('user_id', $user_id)->first();
            if ($user_info) {
                if ($user_info->status == 1) {
                    if ($user_info->total_verification_persentage >= 70) {

                        $sponsor_id = $user_info->user_id;
                        return response()->json(['success' => 'true', 'message' => 'Varified', 'sponsor_id' => $sponsor_id], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Unvarified', 'sponsor_id' => null], 200);
                    }
                } else {
                    return response()->json(['success' => 'false', 'message' => 'Inactive', 'sponsor_id' => null], 200);
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Traveller'], 400);
            }
        } elseif ($country_code == +91) {
            $user_info = INDTraveller::where('user_id', $user_id)->first();
            if ($user_info) {
                if ($user_info->status == 1) {
                    if ($user_info->total_verification_persentage >= 70) {

                        $sponsor_id = $user_info->user_id;
                        return response()->json(['success' => 'true', 'message' => 'Varified', 'sponsor_id' => $sponsor_id], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Unvarified', 'sponsor_id' => null], 200);
                    }
                } else {
                    return response()->json(['success' => 'false', 'message' => 'Inactive', 'sponsor_id' => null], 200);
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Traveller'], 400);
            }
        } elseif ($country_code == +92) {
            $user_info = PakTraveller::where('user_id', $user_id)->first();
            if ($user_info) {
                if ($user_info->status == 1) {
                    if ($user_info->total_verification_persentage >= 70) {

                        $sponsor_id = $user_info->user_id;
                        return response()->json(['success' => 'true', 'message' => 'Varified', 'sponsor_id' => $sponsor_id], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Unvarified', 'sponsor_id' => null], 200);
                    }
                } else {
                    return response()->json(['success' => 'false', 'message' => 'Inactive', 'sponsor_id' => null], 200);
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Traveller'], 400);
            }
        } elseif ($country_code == +65) {
            $user_info = SingaporeTraveller::where('user_id', $user_id)->first();
            if ($user_info) {
                if ($user_info->status == 1) {
                    if ($user_info->total_verification_persentage >= 70) {

                        $sponsor_id = $user_info->user_id;
                        return response()->json(['success' => 'true', 'message' => 'Varified', 'sponsor_id' => $sponsor_id], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Unvarified', 'sponsor_id' => null], 200);
                    }
                } else {
                    return response()->json(['success' => 'false', 'message' => 'Inactive', 'sponsor_id' => null], 200);
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Traveller'], 400);
            }
        } else {
            return response()->json(['success' => 'false', 'message' => 'Country Code Invalied'], 400);
        }

        // echo preg_replace('/[^\-\d]*(\-?\d*).*/', '$1', '%^&*()$@@ss9ggg29');
        //output: 18
    }
}