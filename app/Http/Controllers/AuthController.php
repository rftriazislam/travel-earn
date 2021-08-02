<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BDUser;
use App\INDUser;
use App\PakUser;
use App\SingaporeUser;

use App\Country;
use Symfony\Component\HttpFoundation\Session\Session;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;
use Image;
use App\BDTraveller;
use App\INDTraveller;
use App\PakTraveller;
use App\SingaporeTraveller;

class AuthController extends Controller
{

    public function createsignup(Request $Req, $country_code)
    {

        //    $country = Country::where( 'country_code', $country_code )->select( 'country_code' )->first();

        if ($country_code == +880) {
            $validator = Validator::make($Req->all(), [
                'country_code' => 'required|exists:countries,country_code',
                'name' => 'required|string',
                'email' => 'required|unique:bd_users',
                'mobile_number' => 'required|unique:bd_users',
                'password' => 'required|string',
                'present_address' => 'required|string',
                'permanent_address' => 'required|string',

            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }
            $userinformationadd = new BDUser;
            $userinformationadd->country_code = $Req->country_code;
            $userinformationadd->name = $Req->name;
            $userinformationadd->email = $Req->email;
            $userinformationadd->password = bcrypt($Req->password);
            $userinformationadd->present_address = $Req->present_address;
            $userinformationadd->mobile_number = $Req->mobile_number;



            // $sponsor_id = preg_replace('/[^\-\d]*(\-?\d*).*/', '$1', $Req->sponsor_id);


            $user_info   = BDTraveller::where('user_id', $Req->sponsor_id)->first();
            if ($user_info) {
                if ($user_info->total_verification_persentage >= 70) {
                    $userinformationadd->sponsor_id = $Req->sponsor_id;
                }
            }




            $userinformationadd->permanent_address = $Req->permanent_address;


            if ($userinformationadd->save()) {
                return response()->json(['success' => true, 'message' => ' User information Sucessfully Added'], 200);
            } else {
                return response()->json(['success' => false, 'message' => ' User information Unsucessfully Added'], 400);
            }
        } else if ($country_code == +91) {
            $validator = Validator::make($Req->all(), [
                'country_code' => 'required|exists:countries,country_code',
                'name' => 'required|string',
                'email' => 'required|string|unique:ind_users',
                'mobile_number' => 'required|unique:ind_users',
                'password' => 'required|string',
                'present_address' => 'required|string',
                'permanent_address' => 'required|string',

            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }
            $userinformationadd = new INDUser;
            $userinformationadd->country_code = $Req->country_code;
            $userinformationadd->name = $Req->name;
            $userinformationadd->email = $Req->email;
            $userinformationadd->password = bcrypt($Req->password);
            $userinformationadd->present_address = $Req->present_address;
            $userinformationadd->mobile_number = $Req->mobile_number;

            $user_info   = INDTraveller::where('user_id', $Req->sponsor_id)->first();
            if ($user_info) {
                if ($user_info->total_verification_persentage >= 70) {
                    $userinformationadd->sponsor_id = $Req->sponsor_id;
                }
            }
            $userinformationadd->permanent_address = $Req->permanent_address;


            if ($userinformationadd->save()) {
                return response()->json(['success' => true, 'message' => ' User information Sucessfully Added'], 200);
            } else {
                return response()->json(['success' => false, 'message' => ' User information Unsucessfully Added'], 400);
            }
        } else if ($country_code == +92) {
            $validator = Validator::make($Req->all(), [
                'country_code' => 'required|exists:countries,country_code',
                'name' => 'required|string',
                'email' => 'required|string|unique:pak_users',
                'mobile_number' => 'required|unique:pak_users',
                'password' => 'required|string',
                'present_address' => 'required|string',
                'permanent_address' => 'required|string',

            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }
            $userinformationadd = new PakUser;
            $userinformationadd->country_code = $Req->country_code;
            $userinformationadd->name = $Req->name;
            $userinformationadd->email = $Req->email;
            $userinformationadd->password = bcrypt($Req->password);
            $userinformationadd->present_address = $Req->present_address;
            $userinformationadd->mobile_number = $Req->mobile_number;

            $user_info   = PakTraveller::where('user_id', $Req->sponsor_id)->first();
            if ($user_info) {
                if ($user_info->total_verification_persentage >= 70) {
                    $userinformationadd->sponsor_id = $Req->sponsor_id;
                }
            }
            $userinformationadd->permanent_address = $Req->permanent_address;

            if ($userinformationadd->save()) {
                return response()->json(['success' => true, 'message' => ' User information Sucessfully Added'], 200);
            } else {
                return response()->json(['success' => false, 'message' => ' User information Unsucessfully Added'], 400);
            }
        } else if ($country_code == +65) {
            $validator = Validator::make($Req->all(), [
                'country_code' => 'required|exists:countries,country_code',
                'name' => 'required|string',
                'email' => 'required|string|unique:singapore_users',
                'mobile_number' => 'required|unique:singapore_users',
                'password' => 'required|string',
                'present_address' => 'required|string',
                'permanent_address' => 'required|string',


            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }
            $userinformationadd = new SingaporeUser;
            $userinformationadd->country_code = $Req->country_code;
            $userinformationadd->name = $Req->name;
            $userinformationadd->email = $Req->email;
            $userinformationadd->password = bcrypt($Req->password);
            $userinformationadd->present_address = $Req->present_address;
            $userinformationadd->permanent_address = $Req->permanent_address;
            $userinformationadd->mobile_number = $Req->mobile_number;

            $user_info   = SingaporeTraveller::where('user_id', $Req->sponsor_id)->first();
            if ($user_info) {
                if ($user_info->total_verification_persentage >= 70) {
                    $userinformationadd->sponsor_id = $Req->sponsor_id;
                }
            }

            if ($userinformationadd->save()) {
                return response()->json(['success' => true, 'message' => ' User information Sucessfully Added'], 200);
            } else {
                return response()->json(['success' => false, 'message' => ' User information Unsucessfully Added'], 400);
            }
        } else {
            return response()->json(['message' => 'country code did not  match'], 200);
        }
    }

    public function login(Request $request, $country_code)
    {

        // $countrybd = BDUser::where( 'country_code', $country_code )->select( 'country_code' )->first();

        if ($country_code == +880) {

            $loginData = $request->validate([
                'email' => 'required|string|exists:bd_users,email',
                'password' => 'required',
                'mobile_number' => 'required|exists:bd_users,mobile_number'
            ]);

            if (Auth::guard('bd_user')->attempt($loginData, $request->remember)) {
                $user = Auth::guard('bd_user')->user();
                $tokenUpdate = BDUser::where('id', $user->id)->where('country_code', $country_code)->first();
                $tokenUpdate->mac_id = $request->mac_id;
                $tokenUpdate->token = $request->token;
                $success['token'] =  $user->createToken('Bangladesh Personal Token')->accessToken;
                $travellerinformation = BDTraveller::where('user_id', $user->id)->get();
                if ($tokenUpdate->save()) {
                    return response()->json(['user' => $user, 'Traveller information ' => $travellerinformation, 'success' => $success]);
                }
            }
            $errors = new MessageBag(['password' => ['Email and Password incorrect.']]);

            return response()->json(['message' => 'The given data was invalid', 'errors' => $errors], 422);

            // return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'password'));
        } else if ($country_code == +91) {

            $loginData = $request->validate([
                'email' => 'required|string|exists:ind_users,email',
                'password' => 'required',
                'mobile_number' => 'required|exists:ind_users,mobile_number'
            ]);
            if (Auth::guard('ind_user')->attempt($loginData, $request->remember)) {
                $user = Auth::guard('ind_user')->user();
                $tokenUpdate = INDUser::where('id', $user->id)->where('country_code', $country_code)->first();
                $tokenUpdate->mac_id = $request->mac_id;
                $tokenUpdate->token = $request->token;
                $success['token'] =  $user->createToken('Bangladesh Personal Token')->accessToken;
                $travellerinformation = INDTraveller::where('user_id', $user->id)->get();
                if ($tokenUpdate->save()) {
                    return response()->json(['user' => $user, 'Traveller information' => $travellerinformation, 'success' => $success]);
                }
            }
            $errors = new MessageBag(['password' => ['Email and Password Incorrect.']]);
            return response()->json(['message' => 'The given data was invalid', 'errors' => $errors], 422);
            // return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'password'));
        } else if ($country_code == +92) {

            $loginData = $request->validate([
                'email' => 'required|string|exists:pak_users,email',
                'password' => 'required',
                'mobile_number' => 'required|exists:pak_users,mobile_number'
            ]);
            if (Auth::guard('pak_user')->attempt($loginData, $request->remember)) {
                $user = Auth::guard('pak_user')->user();
                $tokenUpdate = PakUser::where('id', $user->id)->where('country_code', $country_code)->first();
                $tokenUpdate->mac_id = $request->mac_id;
                $tokenUpdate->token = $request->token;
                $success['token'] =  $user->createToken('Bangladesh Personal Token')->accessToken;
                $travellerinformation = PakTraveller::where('user_id', $user->id)->get();
                if ($tokenUpdate->save()) {
                    return response()->json(['user' => $user, 'Traveller information' => $travellerinformation, 'success' => $success]);
                }
            }
            $errors = new MessageBag(['password' => ['Email and Password Incorrect']]);
            // return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'password'));
            return response()->json(['message' => 'The given data was invalid', 'errors' => $errors], 422);
        } else if ($country_code == +65) {

            $loginData = $request->validate([
                'email' => 'required|string|exists:singapore_users,email',
                'password' => 'required',
                'mobile_number' => 'required|exists:singapore_users,mobile_number'
            ]);

            if (Auth::guard('singapore_user')->attempt($loginData, $request->remember)) {
                $user = Auth::guard('singapore_user')->user();
                $tokenUpdate = SingaporeUser::where('id', $user->id)->where('country_code', $country_code)->first();
                $tokenUpdate->mac_id = $request->mac_id;
                $tokenUpdate->token = $request->token;
                $success['token'] =  $user->createToken('Singapore Personal Token')->accessToken;
                $travellerinformation = PakTraveller::where('user_id', $user->id)->get();
                if ($tokenUpdate->save()) {
                    return response()->json(['user' => $user, 'Traveller information' => $travellerinformation, 'success' => $success]);
                }
            }
            $errors = new MessageBag(['password' => ['Email and Password Incorrect']]);
            // return redirect()->back()->withErrors($errors)->withInput($request->only('email', 'password'));
            return response()->json(['message' => 'The given data was invalid', 'errors' => $errors], 422);
        } else {
            return response()->json(['message' => 'country code did not  match'], 400);
        }
    }

    public function profileupdate(Request $Req, $country_code, $user_id)
    {


        if ($country_code == +880) {
            $validator = Validator::make($Req->all(), [
                'name' => 'sometimes|nullable|string',
                'email' => 'sometimes|nullable|string',
                'password' => 'sometimes|nullable|string',
                'present_address' => 'sometimes|nullable|string',
                'permanent_address' => 'sometimes|nullable|string',
                'father_name' => 'sometimes|nullable|string',
                'mother_name' => 'sometimes|nullable|string',
                'mobile_number' => 'sometimes|nullable|string',
                'add_money_balance' => 'sometimes|nullable|string',
                'balance' => 'sometimes|nullable|string',
                'cover_image' => 'sometimes|nullable|image|mimes:jpg,png,jpeg|max:15360',
                'profile_image' => 'sometimes|nullable|image|mimes:jpg,png,jpeg|max:15360',
                'mac_id' => 'sometimes|nullable|string',

            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }

            $user_update_info = BDUser::where('id', $user_id)->where('country_code', $country_code)->first();
            //    $user_update_info = BDUser::find($user_id);


            $user_update_info->update($Req->all());

            if ($Req->password) {
                $password = bcrypt($Req->password);
                $user_update_info->update(
                    [$user_update_info->password = $password]
                );
            }


            if ($file = $Req->file("cover_image")) {
                $images = Image::canvas(200, 200);
                $image  = Image::make($file->getRealPath())->resize(400, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $nameReplacer = $Req->user_id . '.' . $file->getClientOriginalExtension();
                $image_path = public_path() . '/profile_image/bd_profile/cover_image/' . $Req->user_id . '.' . $file->getClientOriginalExtension();
                if ($nameReplacer == $image_path) {
                    unlink($image_path);
                } else {
                    $images->save(public_path() . '/profile_image/bd_profile/cover_image/' . $nameReplacer);
                }
                //    $user_update_info->cover_image =$nameReplacer;
                $user_update_info->update([
                    'cover_image' => $nameReplacer
                ]);
            }

            if ($file_profile = $Req->file("profile_image")) {
                $images = Image::canvas(200, 200);
                $image  = Image::make($file_profile->getRealPath())->resize(400, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $nameReplacer = $Req->user_id . '.' . $file_profile->getClientOriginalExtension();
                $image_path_profile = public_path() . '/profile_image/bd_profile/profile_image/' . $Req->user_id . '.' . $file_profile->getClientOriginalExtension();
                if ($nameReplacer == $image_path_profile) {
                    unlink($image_path);
                } else {
                    $images->save(public_path() . '/profile_image/bd_profile/profile_image/' . $nameReplacer);
                }
                // $user_update_info->profile_image = $nameReplacer;

                $user_update_info->update([
                    'profile_image' => $nameReplacer
                ]);
            }





            if ($Req->all()) {
                return response()->json(['success' => true, 'message' => 'Bangladesh User information Sucessfully Update'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Bangladesh User information Unsucessfull Update'], 400);
            }
        } elseif ($country_code == +91) {
            $validator = Validator::make($Req->all(), [
                'name' => 'sometimes|nullable|string',
                'email' => 'sometimes|nullable|string',
                'password' => 'sometimes|nullable|string',
                'present_address' => 'sometimes|nullable|string',
                'permanent_address' => 'sometimes|nullable|string',
                'father_name' => 'sometimes|nullable|string',
                'mother_name' => 'sometimes|nullable|string',
                'mobile_number' => 'sometimes|nullable|string',
                'add_money_balance' => 'sometimes|nullable|string',
                'balance' => 'sometimes|nullable|string',
                'cover_image' => 'sometimes|nullable|image|mimes:jpg,png,jpeg|max:15360',
                'profile_image' => 'sometimes|nullable|image|mimes:jpg,png,jpeg|max:15360',
                'mac_id' => 'sometimes|nullable|string',


            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }
            $user_update_info = INDUser::where('id', $user_id)->where('country_code', $country_code)->first();

            $user_update_info->update($Req->all());

            if ($Req->password) {
                $password = bcrypt($Req->password);
                $user_update_info->update(
                    [$user_update_info->password = $password]
                );
            }
            if ($file = $Req->file("cover_image")) {
                $images = Image::canvas(200, 200);
                $image  = Image::make($file->getRealPath())->resize(400, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $images->insert($image, 'center');
                $nameReplacer = $Req->user_id . '.' . $file->getClientOriginalExtension();
                $image_path = public_path() . '/profile_image/ind_profile/cover_image/' . $Req->user_id . '.' . $file->getClientOriginalExtension();
                if ($nameReplacer == $image_path) {
                    unlink($image_path);
                } else {
                    $images->save(public_path() . '/profile_image/ind_profile/cover_image/' . $nameReplacer);
                }
                //    $user_update_info->cover_image =$nameReplacer;
                $user_update_info->update([
                    'cover_image' => $nameReplacer
                ]);
            }
            if ($file_profile = $Req->file("profile_image")) {
                $images = Image::canvas(200, 200);
                $image  = Image::make($file_profile->getRealPath())->resize(400, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $nameReplacer = $Req->user_id . '.' . $file_profile->getClientOriginalExtension();
                $image_path_profile = public_path() . '/profile_image/ind_profile/profile_image/' . $Req->user_id . '.' . $file_profile->getClientOriginalExtension();
                if ($nameReplacer == $image_path_profile) {
                    unlink($image_path);
                } else {
                    $images->save(public_path() . '/profile_image/ind_profile/profile_image/' . $nameReplacer);
                }
                //    $user_update_info->profile_image = $nameReplacer;
                $user_update_info->update([
                    'profile_image' => $nameReplacer
                ]);
            }

            if ($Req->all()) {
                return response()->json(['success' => true, 'message' => 'India User information Sucessfully Update'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'India User information Unsucessfull Update'], 400);
            }
        } elseif ($country_code == +92) {
            $validator = Validator::make($Req->all(), [
                'name' => 'sometimes|nullable|string',
                'email' => 'sometimes|nullable|string',
                'password' => 'sometimes|nullable|string',
                'present_address' => 'sometimes|nullable|string',
                'permanent_address' => 'sometimes|nullable|string',
                'father_name' => 'sometimes|nullable|string',
                'mother_name' => 'sometimes|nullable|string',
                'mobile_number' => 'sometimes|nullable|string',
                'add_money_balance' => 'sometimes|nullable|string',
                'balance' => 'sometimes|nullable|string',
                'cover_image' => 'sometimes|nullable|image|mimes:jpg,png,jpeg|max:15360',
                'profile_image' => 'sometimes|nullable|image|mimes:jpg,png,jpeg|max:15360',
                'mac_id' => 'sometimes|nullable|string',

            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }
            $user_update_info = PakUser::where('id', $user_id)->where('country_code', $country_code)->first();
            $user_update_info->update($Req->all());
            if ($Req->password) {
                $password = bcrypt($Req->password);
                $user_update_info->update(
                    [$user_update_info->password = $password]
                );
            }

            if ($file = $Req->file("cover_image")) {
                $images = Image::canvas(200, 200);
                $image  = Image::make($file->getRealPath())->resize(400, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $nameReplacer = $Req->user_id . '.' . $file->getClientOriginalExtension();
                $image_path = public_path() . '/profile_image/pak_profile/cover_image/' . $Req->user_id . '.' . $file->getClientOriginalExtension();
                if ($nameReplacer == $image_path) {
                    unlink($image_path);
                } else {
                    $images->save(public_path() . '/profile_image/pak_profile/cover_image/' . $nameReplacer);
                }
                //    $user_update_info->cover_image =$nameReplacer;
                $user_update_info->update([
                    'cover_image' => $nameReplacer
                ]);
            }
            if ($file_profile = $Req->file("profile_image")) {
                $images = Image::canvas(200, 200);
                $image  = Image::make($file_profile->getRealPath())->resize(400, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $nameReplacer = $Req->user_id . '.' . $file_profile->getClientOriginalExtension();
                $image_path_profile = public_path() . '/profile_image/profile_image/' . $Req->user_id . '.' . $file_profile->getClientOriginalExtension();
                if ($nameReplacer == $image_path_profile) {
                    unlink($image_path);
                } else {
                    $images->save(public_path() . '/profile_image/pak_profile/profile_image/' . $nameReplacer);
                }
                //    $user_update_info->profile_image = $nameReplacer;
                $user_update_info->update([
                    'profile_image' => $nameReplacer
                ]);
            }

            if ($Req->all()) {
                return response()->json(['success' => true, 'message' => 'Pakistan User information Sucessfully Update'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Pakistan User information Unsucessfull Update'], 400);
            }
        } elseif ($country_code == +65) {
            $validator = Validator::make($Req->all(), [
                'name' => 'sometimes|nullable|string',
                'email' => 'sometimes|nullable|string',
                'password' => 'sometimes|nullable|string',
                'present_address' => 'sometimes|nullable|string',
                'permanent_address' => 'sometimes|nullable|string',
                'father_name' => 'sometimes|nullable|string',
                'mother_name' => 'sometimes|nullable|string',
                'mobile_number' => 'sometimes|nullable|string',
                'add_money_balance' => 'sometimes|nullable|string',
                'balance' => 'sometimes|nullable|string',
                'cover_image' => 'sometimes|nullable|image|mimes:jpg,png,jpeg|max:15360',
                'profile_image' => 'sometimes|nullable|image|mimes:jpg,png,jpeg|max:15360',
                'mac_id' => 'sometimes|nullable|string',

            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }
            $user_update_info = SingaporeUser::where('id', $user_id)->where('country_code', $country_code)->first();
            $user_update_info->update($Req->all());
            if ($Req->password) {
                $password = bcrypt($Req->password);
                $user_update_info->update(
                    [$user_update_info->password = $password]
                );
            }

            if ($file = $Req->file("cover_image")) {
                $images = Image::canvas(200, 200);
                $image  = Image::make($file->getRealPath())->resize(400, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $nameReplacer = $Req->user_id . '.' . $file->getClientOriginalExtension();
                $image_path = public_path() . '/profile_image/singapore_profile/cover_image/' . $Req->user_id . '.' . $file->getClientOriginalExtension();
                if ($nameReplacer == $image_path) {
                    unlink($image_path);
                } else {
                    $images->save(public_path() . '/profile_image/singapore_profile/cover_image/' . $nameReplacer);
                }
                //    $user_update_info->cover_image =$nameReplacer;
                $user_update_info->update([
                    'cover_image' => $nameReplacer
                ]);
            }
            if ($file_profile = $Req->file("profile_image")) {
                $images = Image::canvas(200, 200);
                $image  = Image::make($file_profile->getRealPath())->resize(400, 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $nameReplacer = $Req->user_id . '.' . $file_profile->getClientOriginalExtension();
                $image_path_profile = public_path() . '/profile_image/singapore_profile/profile_image/' . $Req->user_id . '.' . $file_profile->getClientOriginalExtension();
                if ($nameReplacer == $image_path_profile) {
                    unlink($image_path);
                } else {
                    $images->save(public_path() . '/profile_image/singapore_profile/profile_image/' . $nameReplacer);
                }
                //    $user_update_info->profile_image = $nameReplacer;
                $user_update_info->update([
                    'profile_image' => $nameReplacer
                ]);
            }

            if ($Req->all()) {
                return response()->json(['success' => true, 'message' => 'Singapore User information Sucessfully Update'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Singapore User information Unsucessfull Update'], 400);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Invalied country_code'], 400);
        }
    }
}