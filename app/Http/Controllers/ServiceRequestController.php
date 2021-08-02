<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BDRequestService;
use App\INDRequestService;
use App\PakRequestService;
use App\SingaporeRequestService;
use App\BDService;
use App\INDService;
use App\PakService;
use App\SingaporeService;
use App\BDUser;
use App\INDUser;
use App\PakUser;
use App\SingaporeUser;
use App\BDTraveller;
use App\INDTraveller;
use App\PakTraveller;
use App\SingaporeTraveller;
use App\PenaltyCharge;
use App\CompanyBalance;
use Validator;
use DB;

class ServiceRequestController extends Controller
{


    public function insertservicerequest(Request $request)
    {
        $country = $request->country_code;

        if ($country == +880) {



            $validator = Validator::make($request->all(), [

                'user_id' => 'required|integer|exists:bd_users,id',
                'country_code' => 'required|exists:countries,country_code',
                'weight' => 'required',
                'product_type' => 'required|string',
                'product_name' => 'required|string',
                'pyment_type' => 'required',
                'delivery_cost' => 'required',
                'traveller_id' => 'required|exists:bd_travellers,id',
                'bd_services_id' => 'required|exists:bd_services,id',
            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }
            $bdservicerequestadd = BDRequestService::where('user_id', $request->user_id)->where('bd_services_id', $request->bd_services_id)->where('traveller_id', $request->traveller_id)->first();
            if ($bdservicerequestadd) {

                $balance_update = BDUser::where('id', $request->user_id)->first();
                $result_delivery = $request->delivery_cost - $bdservicerequestadd->delivery_cost;
                $result = $request->product_buy_price - $bdservicerequestadd->product_buy_price;

                // $travel_info = BDTraveller::where('id', $request->traveller_id)->first();
                // $travel_update_balance = BDUser::where('id', $travel_info->user_id)->first();
                // $result_traveller = $request->delivery_cost - $bdservicerequestadd->delivery_cost;

                $bdservicerequestadd->user_id = $request->user_id;
                $bdservicerequestadd->traveller_id = $request->traveller_id;
                $bdservicerequestadd->bd_services_id = $request->bd_services_id;
                $bdservicerequestadd->country_code = $request->country_code;
                $bdservicerequestadd->weight = $request->weight;
                $bdservicerequestadd->delivery_cost = $request->delivery_cost;
                $bdservicerequestadd->product_type = $request->product_type;
                $bdservicerequestadd->product_name = $request->product_name;
                $bdservicerequestadd->pyment_type = $request->pyment_type;
                $bdservicerequestadd->product_buy_price = $request->product_buy_price;
                $bdservicerequestadd->product_description = $request->product_description;

                if ($request->pyment_type == 'Balance') {
                    if ($balance_update->drop_balance >= $request->delivery_cost) {
                        if ($bdservicerequestadd->save()) {


                            $balance_update->update([

                                $balance_update->drop_balance = $balance_update->drop_balance - $result_delivery,
                            ]);


                            if ($request->product_buy_price != NULL) {
                                $balance_update->update([
                                    $balance_update->product_balance = $balance_update->product_balance - $result,
                                ]);
                            }

                            return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                        } else {
                            return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                        }
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Balance Empty!'], 400);
                    }
                } elseif ($request->pyment_type == 'Cash on Delevery') {

                    if ($bdservicerequestadd->save()) {
                        // $travel_update_balance->update([
                        //     $travel_update_balance->drop_balance = $travel_update_balance->drop_balance - $result_traveller,
                        // ]);


                        if ($request->product_buy_price != NULL) {
                            $balance_update->update([
                                $balance_update->product_balance = $balance_update->product_balance - $result,
                            ]);
                        }

                        return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                    }
                }
            } else {


                $bdservicerequestadd = new BDRequestService;

                $bdservicerequestadd->user_id = $request->user_id;
                $bdservicerequestadd->traveller_id = $request->traveller_id;
                $bdservicerequestadd->bd_services_id = $request->bd_services_id;
                $bdservicerequestadd->country_code = $request->country_code;
                $bdservicerequestadd->weight = $request->weight;
                $bdservicerequestadd->delivery_cost = $request->delivery_cost;
                $bdservicerequestadd->product_type = $request->product_type;
                $bdservicerequestadd->product_name = $request->product_name;
                $bdservicerequestadd->pyment_type = $request->pyment_type;
                $bdservicerequestadd->product_description = $request->product_description;
                $bdservicerequestadd->product_buy_price = $request->product_buy_price;

                if ($request->pyment_type == 'Balance') {
                    $balance_update = BDUser::where('id', $request->user_id)->first();
                    if ($balance_update->drop_balance >= $request->delivery_cost) {

                        if ($bdservicerequestadd->save()) {

                            if ($request->product_buy_price != NULL) {
                                $balance_update->update([
                                    $balance_update->product_balance = $balance_update->product_balance - $request->product_buy_price,
                                    $balance_update->drop_balance = $balance_update->drop_balance - $request->delivery_cost,
                                ]);
                            } else {
                                $balance_update->update([
                                    $balance_update->drop_balance = $balance_update->drop_balance - $request->delivery_cost,
                                ]);
                            }
                            return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                        } else {
                            return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                        }
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Balance Empty!'], 400);
                    }
                } elseif ($request->pyment_type == 'Cash on Delevery') {
                    // $travel_info = BDTraveller::where('id', $request->traveller_id)->first();
                    // $travel_update_balance = BDUser::where('id', $travel_info->user_id)->first();


                    if ($bdservicerequestadd->save()) {

                        // $travel_update_balance->update([
                        //     $travel_update_balance->drop_balance = $travel_update_balance->drop_balance - $request->delivery_cost,
                        // ]);

                        $balance_update = BDUser::where('id', $request->user_id)->first();
                        if ($request->product_buy_price != NULL) {
                            $balance_update->update([
                                $balance_update->product_balance = $balance_update->product_balance - $request->product_buy_price,
                            ]);
                        }
                        return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                    }
                }
            }
        } else if ($country == +91) {
            $validator = Validator::make($request->all(), [

                'user_id' => 'required|integer|exists:ind_users,id',
                'country_code' => 'required|exists:countries,country_code',
                'weight' => 'required',
                'product_type' => 'required|string',
                'product_name' => 'required|string',
                'pyment_type' => 'required',
                'delivery_cost' => 'required',
                'traveller_id' => 'required|exists:ind_travellers,id',
                'ind_services_id' => 'required|exists:ind_services,id',

            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }

            $indservicerequestadd = INDRequestService::where('user_id', $request->user_id)->where('ind_services_id', $request->ind_services_id)->where('traveller_id', $request->traveller_id)->first();

            if ($indservicerequestadd) {
                $balance_update = INDUser::where('id', $request->user_id)->first();
                $result_delivery = $request->delivery_cost - $indservicerequestadd->delivery_cost;
                $result = $request->product_buy_price - $indservicerequestadd->product_buy_price;

                $indservicerequestadd->user_id = $request->user_id;
                $indservicerequestadd->country_code = $request->country_code;
                $indservicerequestadd->weight = $request->weight;
                $indservicerequestadd->product_type = $request->product_type;
                $indservicerequestadd->delivery_cost = $request->delivery_cost;
                $indservicerequestadd->traveller_id = $request->traveller_id;
                $indservicerequestadd->ind_services_id = $request->ind_services_id;
                $indservicerequestadd->product_name = $request->product_name;
                $indservicerequestadd->pyment_type = $request->pyment_type;
                $indservicerequestadd->product_description = $request->product_description;
                $indservicerequestadd->product_buy_price = $request->product_buy_price;

                if ($request->pyment_type == 'Balance') {
                    if ($balance_update->drop_balance >= $request->delivery_cost) {
                        if ($indservicerequestadd->save()) {


                            $balance_update->update([

                                $balance_update->drop_balance = $balance_update->drop_balance - $result_delivery,
                            ]);


                            if ($request->product_buy_price != NULL) {
                                $balance_update->update([
                                    $balance_update->product_balance = $balance_update->product_balance - $result,
                                ]);
                            }

                            return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                        } else {
                            return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                        }
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Balance Empty!'], 400);
                    }
                } elseif ($request->pyment_type == 'Cash on Delevery') {

                    if ($indservicerequestadd->save()) {
                        // $travel_update_balance->update([
                        //     $travel_update_balance->drop_balance = $travel_update_balance->drop_balance - $result_traveller,
                        // ]);


                        if ($request->product_buy_price != NULL) {
                            $balance_update->update([
                                $balance_update->product_balance = $balance_update->product_balance - $result,
                            ]);
                        }

                        return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                    }
                }
            } else {

                $indservicerequestadd = new INDRequestService;
                $indservicerequestadd->user_id = $request->user_id;
                $indservicerequestadd->country_code = $request->country_code;
                $indservicerequestadd->weight = $request->weight;
                $indservicerequestadd->product_type = $request->product_type;
                $indservicerequestadd->delivery_cost = $request->delivery_cost;
                $indservicerequestadd->traveller_id = $request->traveller_id;
                $indservicerequestadd->ind_services_id = $request->ind_services_id;
                $indservicerequestadd->product_name = $request->product_name;
                $indservicerequestadd->pyment_type = $request->pyment_type;
                $indservicerequestadd->product_description = $request->product_description;
                $indservicerequestadd->product_buy_price = $request->product_buy_price;

                if ($request->pyment_type == 'Balance') {
                    $balance_update = INDUser::where('id', $request->user_id)->first();
                    if ($balance_update->drop_balance >= $request->delivery_cost) {

                        if ($indservicerequestadd->save()) {

                            if ($request->product_buy_price != NULL) {
                                $balance_update->update([
                                    $balance_update->product_balance = $balance_update->product_balance - $request->product_buy_price,
                                    $balance_update->drop_balance = $balance_update->drop_balance - $request->delivery_cost,
                                ]);
                            } else {
                                $balance_update->update([
                                    $balance_update->drop_balance = $balance_update->drop_balance - $request->delivery_cost,
                                ]);
                            }
                            return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                        } else {
                            return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                        }
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Balance Empty!'], 400);
                    }
                } elseif ($request->pyment_type == 'Cash on Delevery') {
                    // $travel_info = BDTraveller::where('id', $request->traveller_id)->first();
                    // $travel_update_balance = BDUser::where('id', $travel_info->user_id)->first();


                    if ($indservicerequestadd->save()) {

                        // $travel_update_balance->update([
                        //     $travel_update_balance->drop_balance = $travel_update_balance->drop_balance - $request->delivery_cost,
                        // ]);

                        $balance_update = INDUser::where('id', $request->user_id)->first();
                        if ($request->product_buy_price != NULL) {
                            $balance_update->update([
                                $balance_update->product_balance = $balance_update->product_balance - $request->product_buy_price,
                            ]);
                        }
                        return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                    }
                }
            }
        } else if ($country == +92) {
            $validator = Validator::make($request->all(), [

                'user_id' => 'required|integer|exists:pak_users,id',
                'country_code' => 'required|exists:countries,country_code',
                'weight' => 'required',
                'product_type' => 'required|string',
                'product_name' => 'required|string',
                'pyment_type' => 'required',
                'delivery_cost' => 'required',
                'traveller_id' => 'required|exists:pak_travellers,id',
                'pak_services_id' => 'required|exists:pak_services,id',

            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }
            $pakservicerequestadd = PakRequestService::where('user_id', $request->user_id)->where('pak_services_id', $request->pak_services_id)->where('traveller_id', $request->traveller_id)->first();
            if ($pakservicerequestadd) {
                $balance_update = PakUser::where('id', $request->user_id)->first();
                $result_delivery = $request->delivery_cost - $pakservicerequestadd->delivery_cost;
                $result = $request->product_buy_price - $pakservicerequestadd->product_buy_price;

                $pakservicerequestadd->user_id = $request->user_id;
                $pakservicerequestadd->country_code = $request->country_code;
                $pakservicerequestadd->weight = $request->weight;
                $pakservicerequestadd->delivery_cost = $request->delivery_cost;
                $pakservicerequestadd->traveller_id = $request->traveller_id;
                $pakservicerequestadd->pak_services_id = $request->pak_services_id;
                $pakservicerequestadd->product_type = $request->product_type;
                $pakservicerequestadd->product_name = $request->product_name;
                $pakservicerequestadd->pyment_type = $request->pyment_type;
                $pakservicerequestadd->product_description = $request->product_description;
                $pakservicerequestadd->product_buy_price = $request->product_buy_price;
                if ($request->pyment_type == 'Balance') {
                    if ($balance_update->drop_balance >= $request->delivery_cost) {
                        if ($pakservicerequestadd->save()) {


                            $balance_update->update([

                                $balance_update->drop_balance = $balance_update->drop_balance - $result_delivery,
                            ]);


                            if ($request->product_buy_price != NULL) {
                                $balance_update->update([
                                    $balance_update->product_balance = $balance_update->product_balance - $result,
                                ]);
                            }

                            return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                        } else {
                            return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                        }
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Balance Empty!'], 400);
                    }
                } elseif ($request->pyment_type == 'Cash on Delevery') {

                    if ($pakservicerequestadd->save()) {
                        // $travel_update_balance->update([
                        //     $travel_update_balance->drop_balance = $travel_update_balance->drop_balance - $result_traveller,
                        // ]);


                        if ($request->product_buy_price != NULL) {
                            $balance_update->update([
                                $balance_update->product_balance = $balance_update->product_balance - $result,
                            ]);
                        }

                        return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                    }
                }
            } else {

                $pakservicerequestadd = new PakRequestService;
                $pakservicerequestadd->user_id = $request->user_id;
                $pakservicerequestadd->country_code = $request->country_code;
                $pakservicerequestadd->weight = $request->weight;
                $pakservicerequestadd->delivery_cost = $request->delivery_cost;
                $pakservicerequestadd->traveller_id = $request->traveller_id;
                $pakservicerequestadd->pak_services_id = $request->pak_services_id;
                $pakservicerequestadd->product_type = $request->product_type;
                $pakservicerequestadd->product_name = $request->product_name;
                $pakservicerequestadd->pyment_type = $request->pyment_type;
                $pakservicerequestadd->product_description = $request->product_description;
                $pakservicerequestadd->product_buy_price = $request->product_buy_price;
                if ($request->pyment_type == 'Balance') {
                    $balance_update = PakUser::where('id', $request->user_id)->first();
                    if ($balance_update->drop_balance >= $request->delivery_cost) {

                        if ($pakservicerequestadd->save()) {

                            if ($request->product_buy_price != NULL) {
                                $balance_update->update([
                                    $balance_update->product_balance = $balance_update->product_balance - $request->product_buy_price,
                                    $balance_update->drop_balance = $balance_update->drop_balance - $request->delivery_cost,
                                ]);
                            } else {
                                $balance_update->update([
                                    $balance_update->drop_balance = $balance_update->drop_balance - $request->delivery_cost,
                                ]);
                            }
                            return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                        } else {
                            return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                        }
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Balance Empty!'], 400);
                    }
                } elseif ($request->pyment_type == 'Cash on Delevery') {
                    // $travel_info = BDTraveller::where('id', $request->traveller_id)->first();
                    // $travel_update_balance = BDUser::where('id', $travel_info->user_id)->first();


                    if ($pakservicerequestadd->save()) {

                        // $travel_update_balance->update([
                        //     $travel_update_balance->drop_balance = $travel_update_balance->drop_balance - $request->delivery_cost,
                        // ]);

                        $balance_update = PakUser::where('id', $request->user_id)->first();
                        if ($request->product_buy_price != NULL) {
                            $balance_update->update([
                                $balance_update->product_balance = $balance_update->product_balance - $request->product_buy_price,
                            ]);
                        }
                        return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                    }
                }
            }
        } else if ($country == +65) {
            $validator = Validator::make($request->all(), [

                'user_id' => 'required|integer|exists:singapore_users,id',
                'country_code' => 'required|exists:countries,country_code',
                'weight' => 'required',
                'product_type' => 'required|string',
                'product_name' => 'required|string',
                'pyment_type' => 'required',
                'delivery_cost' => 'required',
                'traveller_id' => 'required|exists:singapore_travellers,id',
                'singapore_services_id' => 'required|exists:singapore_services,id',

            ]);
            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }

            $singaporeservicerequestadd = SingaporeRequestService::where('user_id', $request->user_id)->where('singapore_services_id', $request->singapore_services_id)->where('traveller_id', $request->traveller_id)->first();
            if ($singaporeservicerequestadd) {
                $balance_update = SingaporeUser::where('id', $request->user_id)->first();
                $result_delivery = $request->delivery_cost - $singaporeservicerequestadd->delivery_cost;
                $result = $request->product_buy_price - $singaporeservicerequestadd->product_buy_price;

                $singaporeservicerequestadd->user_id = $request->user_id;
                $singaporeservicerequestadd->country_code = $request->country_code;
                $singaporeservicerequestadd->weight = $request->weight;
                $singaporeservicerequestadd->delivery_cost = $request->delivery_cost;
                $singaporeservicerequestadd->traveller_id = $request->traveller_id;
                $singaporeservicerequestadd->singapore_services_id = $request->singapore_services_id;
                $singaporeservicerequestadd->product_type = $request->product_type;
                $singaporeservicerequestadd->product_name = $request->product_name;
                $singaporeservicerequestadd->product_description = $request->product_description;
                $singaporeservicerequestadd->product_buy_price = $request->product_buy_price;
                $singaporeservicerequestadd->pyment_type = $request->pyment_type;
                if ($request->pyment_type == 'Balance') {
                    if ($balance_update->drop_balance >= $request->delivery_cost) {
                        if ($singaporeservicerequestadd->save()) {


                            $balance_update->update([

                                $balance_update->drop_balance = $balance_update->drop_balance - $result_delivery,
                            ]);


                            if ($request->product_buy_price != NULL) {
                                $balance_update->update([
                                    $balance_update->product_balance = $balance_update->product_balance - $result,
                                ]);
                            }

                            return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                        } else {
                            return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                        }
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Balance Empty!'], 400);
                    }
                } elseif ($request->pyment_type == 'Cash on Delevery') {

                    if ($singaporeservicerequestadd->save()) {
                        // $travel_update_balance->update([
                        //     $travel_update_balance->drop_balance = $travel_update_balance->drop_balance - $result_traveller,
                        // ]);


                        if ($request->product_buy_price != NULL) {
                            $balance_update->update([
                                $balance_update->product_balance = $balance_update->product_balance - $result,
                            ]);
                        }

                        return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                    }
                }
            } else {
                $singaporeservicerequestadd = new SingaporeRequestService;


                $singaporeservicerequestadd->user_id = $request->user_id;
                $singaporeservicerequestadd->country_code = $request->country_code;
                $singaporeservicerequestadd->weight = $request->weight;
                $singaporeservicerequestadd->delivery_cost = $request->delivery_cost;
                $singaporeservicerequestadd->traveller_id = $request->traveller_id;
                $singaporeservicerequestadd->singapore_services_id = $request->singapore_services_id;
                $singaporeservicerequestadd->product_type = $request->product_type;
                $singaporeservicerequestadd->product_name = $request->product_name;
                $singaporeservicerequestadd->product_description = $request->product_description;
                $singaporeservicerequestadd->product_buy_price = $request->product_buy_price;


                $singaporeservicerequestadd->pyment_type = $request->pyment_type;

                if ($request->pyment_type == 'Balance') {
                    $balance_update = SingaporeUser::where('id', $request->user_id)->first();
                    if ($balance_update->drop_balance >= $request->delivery_cost) {

                        if ($singaporeservicerequestadd->save()) {

                            if ($request->product_buy_price != NULL) {
                                $balance_update->update([
                                    $balance_update->product_balance = $balance_update->product_balance - $request->product_buy_price,
                                    $balance_update->drop_balance = $balance_update->drop_balance - $request->delivery_cost,
                                ]);
                            } else {
                                $balance_update->update([
                                    $balance_update->drop_balance = $balance_update->drop_balance - $request->delivery_cost,
                                ]);
                            }
                            return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                        } else {
                            return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                        }
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'Balance Empty!'], 400);
                    }
                } elseif ($request->pyment_type == 'Cash on Delevery') {
                    // $travel_info = BDTraveller::where('id', $request->traveller_id)->first();
                    // $travel_update_balance = BDUser::where('id', $travel_info->user_id)->first();


                    if ($singaporeservicerequestadd->save()) {

                        // $travel_update_balance->update([
                        //     $travel_update_balance->drop_balance = $travel_update_balance->drop_balance - $request->delivery_cost,
                        // ]);

                        $balance_update = SingaporeUser::where('id', $request->user_id)->first();
                        if ($request->product_buy_price != NULL) {
                            $balance_update->update([
                                $balance_update->product_balance = $balance_update->product_balance - $request->product_buy_price,
                            ]);
                        }
                        return response()->json(['Success' => 'true', 'message' => ' Request services sucessfully added'], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'something went Wrong!'], 400);
                    }
                }
            }
        } else {
            return response()->json(['success' => 'false', 'message' => 'Country Code did not match'], 400);
        }
    }

    public function GetServiceRequest($country_code, $traveller_id, $service_id)
    {

        if ($country_code == +880) {
            $ServiceRequest_info = BDRequestService::where('traveller_id', $traveller_id)->where('bd_services_id', $service_id)->get();
            $Service_data = [];
            foreach ($ServiceRequest_info as $data) {
                $Service_data[] = array(
                    'id' => $data->id,
                    'user_id' => $data->user_id,
                    'user_phone' => $data->user_info->mobile_number,
                    'traveller_id' => $data->traveller_id,
                    'bd_services_id' => $data->bd_services_id,
                    'country_code' => $data->country_code,
                    'weight' => $data->weight,
                    'product_type' => $data->product_type,
                    'product_name' => $data->product_name,
                    'product_description' => $data->product_description,
                    'product_buy_price' => $data->product_buy_price,
                    'pyment_type' => $data->pyment_type,
                    'qr_code' => $data->qr_code,
                    'delivery_cost' => $data->delivery_cost,
                    'active_status' => $data->active_status,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,

                );
            }
            if (count($Service_data) > 0) {
                return response()->json(['success' => 'true', 'All Single Service Request' => $Service_data], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Found'], 400);
            }
        } elseif ($country_code == +91) {
            $ServiceRequest_info = INDRequestService::where('traveller_id', $traveller_id)->where('ind_services_id', $service_id)->get();
            $Service_data = [];
            foreach ($ServiceRequest_info as $data) {
                $Service_data[] = array(
                    'id' => $data->id,
                    'user_id' => $data->user_id,
                    'user_phone' => $data->user_info->mobile_number,
                    'traveller_id' => $data->traveller_id,
                    'ind_services_id' => $data->bd_services_id,
                    'country_code' => $data->country_code,
                    'weight' => $data->weight,
                    'product_type' => $data->product_type,
                    'product_name' => $data->product_name,
                    'product_description' => $data->product_description,
                    'product_buy_price' => $data->product_buy_price,
                    'pyment_type' => $data->pyment_type,
                    'qr_code' => $data->qr_code,
                    'delivery_cost' => $data->delivery_cost,
                    'active_status' => $data->active_status,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,

                );
            }
            if (count($Service_data) > 0) {
                return response()->json(['success' => 'true', 'All Single Service Request' => $Service_data], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Found'], 400);
            }
        } elseif ($country_code == +92) {
            $ServiceRequest_info = PakRequestService::where('traveller_id', $traveller_id)->where('pak_services_id', $service_id)->get();
            $Service_data = [];
            foreach ($ServiceRequest_info as $data) {
                $Service_data[] = array(
                    'id' => $data->id,
                    'user_id' => $data->user_id,
                    'user_phone' => $data->user_info->mobile_number,
                    'traveller_id' => $data->traveller_id,
                    'pak_services_id' => $data->bd_services_id,
                    'country_code' => $data->country_code,
                    'weight' => $data->weight,
                    'product_type' => $data->product_type,
                    'product_name' => $data->product_name,
                    'product_description' => $data->product_description,
                    'product_buy_price' => $data->product_buy_price,
                    'pyment_type' => $data->pyment_type,
                    'qr_code' => $data->qr_code,
                    'delivery_cost' => $data->delivery_cost,
                    'active_status' => $data->active_status,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,

                );
            }
            if (count($Service_data) > 0) {
                return response()->json(['success' => 'true', 'All Single Service Request' => $Service_data], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Found'], 400);
            }
        } elseif ($country_code == +65) {
            $ServiceRequest_info = SingaporeRequestService::where('traveller_id', $traveller_id)->where('singapore_services_id', $service_id)->get();
            $Service_data = [];
            foreach ($ServiceRequest_info as $data) {
                $Service_data[] = array(
                    'id' => $data->id,
                    'user_id' => $data->user_id,
                    'user_phone' => $data->user_info->mobile_number,
                    'traveller_id' => $data->traveller_id,
                    'singapore_services_id' => $data->bd_services_id,
                    'country_code' => $data->country_code,
                    'weight' => $data->weight,
                    'product_type' => $data->product_type,
                    'product_name' => $data->product_name,
                    'product_description' => $data->product_description,
                    'product_buy_price' => $data->product_buy_price,
                    'pyment_type' => $data->pyment_type,
                    'qr_code' => $data->qr_code,
                    'delivery_cost' => $data->delivery_cost,
                    'active_status' => $data->active_status,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,

                );
            }
            if (count($Service_data) > 0) {
                return response()->json(['success' => 'true', 'All Single Service Request' => $Service_data], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Found'], 400);
            }
        } else {
            return response()->json(['success' => 'false', 'message' => 'Country Code did not match'], 400);
        }
    }

    public function GetUserAllServiceRequest($country_code, $user_id)
    {

        if ($country_code == +880) {
            $ServiceRequest_info = BDRequestService::where('user_id', $user_id)->get();
            $Service_data = [];
            foreach ($ServiceRequest_info as $data) {
                $Service_data[] = array(
                    'id' => $data->id,
                    'user_id' => $data->user_id,
                    'traveller_id' => $data->traveller_id,
                    'traveller_phone' => $data->traveller_info->user_info_traveller->mobile_number,
                    'bd_services_id' => $data->bd_services_id,
                    'country_code' => $data->country_code,
                    'weight' => $data->weight,
                    'product_type' => $data->product_type,
                    'product_name' => $data->product_name,
                    'product_description' => $data->product_description,
                    'product_buy_price' => $data->product_buy_price,
                    'pyment_type' => $data->pyment_type,
                    'qr_code' => $data->qr_code,
                    'delivery_cost' => $data->delivery_cost,
                    'active_status' => $data->active_status,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,

                );
            }


            if (count($Service_data) > 0) {

                return response()->json(['success' => 'true', 'user all Service Request' => $Service_data], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Found'], 400);
            }
        } elseif ($country_code == +91) {
            $ServiceRequest_info = INDRequestService::where('user_id', $user_id)->get();
            $Service_data = [];
            foreach ($ServiceRequest_info as $data) {
                $Service_data[] = array(
                    'id' => $data->id,
                    'user_id' => $data->user_id,
                    'traveller_id' => $data->traveller_id,
                    'traveller_phone' => $data->traveller_info->user_info_traveller->mobile_number,
                    'ind_services_id' => $data->bd_services_id,
                    'country_code' => $data->country_code,
                    'weight' => $data->weight,
                    'product_type' => $data->product_type,
                    'product_name' => $data->product_name,
                    'product_description' => $data->product_description,
                    'product_buy_price' => $data->product_buy_price,
                    'pyment_type' => $data->pyment_type,
                    'qr_code' => $data->qr_code,
                    'delivery_cost' => $data->delivery_cost,
                    'active_status' => $data->active_status,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,

                );
            }


            if (count($Service_data) > 0) {
                return response()->json(['success' => 'true', 'user all Service Request' => $ServiceRequest_info], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Found'], 400);
            }
        } elseif ($country_code == +92) {
            $ServiceRequest_info = PakRequestService::where('traveller_id', $user_id)->get();
            $Service_data = [];
            foreach ($ServiceRequest_info as $data) {
                $Service_data[] = array(
                    'id' => $data->id,
                    'user_id' => $data->user_id,
                    'traveller_id' => $data->traveller_id,
                    'traveller_phone' => $data->traveller_info->user_info_traveller->mobile_number,
                    'pak_services_id' => $data->bd_services_id,
                    'country_code' => $data->country_code,
                    'weight' => $data->weight,
                    'product_type' => $data->product_type,
                    'product_name' => $data->product_name,
                    'product_description' => $data->product_description,
                    'product_buy_price' => $data->product_buy_price,
                    'pyment_type' => $data->pyment_type,
                    'qr_code' => $data->qr_code,
                    'delivery_cost' => $data->delivery_cost,
                    'active_status' => $data->active_status,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,

                );
            }


            if (count($Service_data) > 0) {
                return response()->json(['success' => 'true', 'user all Service Request' => $ServiceRequest_info], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Found'], 400);
            }
        } elseif ($country_code == +65) {
            $ServiceRequest_info = SingaporeRequestService::where('user_id', $user_id)->get();
            $Service_data = [];
            foreach ($ServiceRequest_info as $data) {
                $Service_data[] = array(
                    'id' => $data->id,
                    'user_id' => $data->user_id,
                    'traveller_id' => $data->traveller_id,
                    'traveller_phone' => $data->traveller_info->user_info_traveller->mobile_number,
                    'sigapore_services_id' => $data->bd_services_id,
                    'country_code' => $data->country_code,
                    'weight' => $data->weight,
                    'product_type' => $data->product_type,
                    'product_name' => $data->product_name,
                    'product_description' => $data->product_description,
                    'product_buy_price' => $data->product_buy_price,
                    'pyment_type' => $data->pyment_type,
                    'qr_code' => $data->qr_code,
                    'delivery_cost' => $data->delivery_cost,
                    'active_status' => $data->active_status,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,

                );
            }


            if (count($Service_data) > 0) {
                return response()->json(['success' => 'true', 'user all Service Request' => $ServiceRequest_info], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Not Found'], 400);
            }
        } else {
            return response()->json(['success' => 'false', 'message' => 'Country Code did not match'], 400);
        }
    }

    public function ServiceRequestAccept($country_code, $service_id, $user_id)
    {



        if ($country_code == +880) {

            $Q_R = substr(str_shuffle('123456890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@#$%*'), 1, 15);
            $q_r = substr(str_shuffle('RIAZ'), 1, 1);
            $ServiceRequest_info = BDRequestService::where('bd_services_id', $service_id)->where('user_id', $user_id)->first();

            if ($ServiceRequest_info) {
                if ($ServiceRequest_info->pyment_type == 'Cash on Delevery') {

                    $travel_price = $ServiceRequest_info->delivery_cost;
                    $trevel_user_id = $ServiceRequest_info->traveller_info->user_id;
                    $traveller = BDUser::where('id', $trevel_user_id)->first();

                    $t_balance = $ServiceRequest_info->delivery_cost;
                    $treveller_commission = $t_balance * 20 / 100;

                    if ($traveller->drop_balance >= $treveller_commission) {
                        $t_balance = $ServiceRequest_info->delivery_cost;
                        $treveller_commission = $t_balance * 20 / 100;

                        $traveller->update([

                            $traveller->drop_balance = $traveller->drop_balance -  $treveller_commission,
                        ]);

                        $ServiceRequest_info->qr_code = $ServiceRequest_info->traveller_id . $q_r . $Q_R . $q_r . $service_id;
                        $ServiceRequest_info->save();
                        $all_info = BDRequestService::where('traveller_id', $ServiceRequest_info->traveller_id)->where('bd_services_id', $ServiceRequest_info->bd_services_id)->get();

                        foreach ($all_info as $check_delete) {
                            if ($check_delete->qr_code == NULL || $check_delete->qr_code == '') {
                                $single_info = BDRequestService::where('traveller_id', $check_delete->traveller_id)->where('bd_services_id', $check_delete->bd_services_id)->where('qr_code', NULL)->orWhere('qr_code', '')->where('active_status', 0)->first();
                                if ($single_info  != NULL ||  $single_info  != '') {
                                    $single_info->update([
                                        $single_info->active_status = 4,
                                    ]);
                                }
                            }
                        }
                        $service = BDService::Where('id', $ServiceRequest_info->bd_services_id)->first();
                        $service->status = 0;
                        $service->save();

                        return response()->json(['success' => 'true', 'message' => 'Successfully QR code generate'], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'No money'], 400);
                    }
                } elseif ($ServiceRequest_info->pyment_type == 'Balance') {


                    $ServiceRequest_info->qr_code = $ServiceRequest_info->traveller_id . $q_r . $Q_R . $q_r . $service_id;
                    $ServiceRequest_info->save();


                    $all_info = BDRequestService::where('traveller_id', $ServiceRequest_info->traveller_id)->where('bd_services_id', $ServiceRequest_info->bd_services_id)->get();

                    foreach ($all_info as $check_delete) {
                        if ($check_delete->qr_code == NULL || $check_delete->qr_code == '') {
                            $single_info = BDRequestService::where('traveller_id', $check_delete->traveller_id)->where('bd_services_id', $check_delete->bd_services_id)->where('qr_code', NULL)->orWhere('qr_code', '')->where('active_status', 0)->first();
                            if ($single_info  != NULL ||  $single_info  != '') {
                                $single_info->update([
                                    $single_info->active_status = 4,
                                ]);
                            }
                        }
                    }
                    $service = BDService::Where('id', $ServiceRequest_info->bd_services_id)->first();
                    $service->status = 0;
                    $service->save();

                    return response()->json(['success' => 'true', 'message' => 'Successfully QR code generate'], 200);
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or User id Invalied'], 400);
            }
        } elseif ($country_code == +91) {
            $Q_R = substr(str_shuffle('123456890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@#$%-*'), 1, 10);
            $q_r = substr(str_shuffle('RIAZ'), 1, 1);
            $ServiceRequest_info = INDRequestService::where('ind_services_id', $service_id)->where('user_id', $user_id)->first();


            if ($ServiceRequest_info) {

                if ($ServiceRequest_info->pyment_type == 'Cash on Delevery') {

                    $travel_price = $ServiceRequest_info->delivery_cost;
                    $user_id = $ServiceRequest_info->traveller_info->user_id;
                    $traveller = INDUser::where('id', $user_id)->first();
                    $t_balance = $ServiceRequest_info->delivery_cost;
                    $treveller_commission = $t_balance * 20 / 100;
                    if ($traveller->drop_balance >= $treveller_commission) {
                        $t_balance = $ServiceRequest_info->delivery_cost;
                        $treveller_commission = $t_balance * 20 / 100;
                        $traveller->update([
                            $traveller->drop_balance = $traveller->drop_balance - $treveller_commission,
                        ]);


                        $ServiceRequest_info->qr_code = $ServiceRequest_info->traveller_id . $q_r . $Q_R . $q_r . $service_id;
                        $ServiceRequest_info->save();


                        $all_info = INDRequestService::where('traveller_id', $ServiceRequest_info->traveller_id)->where('ind_services_id', $ServiceRequest_info->ind_services_id)->get();

                        foreach ($all_info as $check_delete) {
                            if ($check_delete->qr_code == NULL || $check_delete->qr_code == '') {
                                $single_info = INDRequestService::where('traveller_id', $check_delete->traveller_id)->where('bd_services_id', $check_delete->bd_services_id)->where('qr_code', NULL)->orWhere('qr_code', '')->where('active_status', 0)->first();
                                if ($single_info  != NULL ||  $single_info  != '') {
                                    $single_info->update([
                                        $single_info->active_status = 4,
                                    ]);
                                }
                            }
                        }


                        $service = INDService::Where('id', $ServiceRequest_info->ind_services_id)->first();
                        $service->status = 0;
                        $service->save();

                        return response()->json(['success' => 'true', 'message' => 'Successfully QR code generate'], 200);
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'No money'], 400);
                    }
                } elseif ($ServiceRequest_info->pyment_type == 'Balance') {

                    $ServiceRequest_info->qr_code = $ServiceRequest_info->traveller_id . $q_r . $Q_R . $q_r . $service_id;
                    $ServiceRequest_info->save();


                    $all_info = INDRequestService::where('traveller_id', $ServiceRequest_info->traveller_id)->where('ind_services_id', $ServiceRequest_info->ind_services_id)->get();

                    foreach ($all_info as $check_delete) {
                        if ($check_delete->qr_code == NULL || $check_delete->qr_code == '') {
                            $single_info = INDRequestService::where('traveller_id', $check_delete->traveller_id)->where('bd_services_id', $check_delete->bd_services_id)->where('qr_code', NULL)->orWhere('qr_code', '')->where('active_status', 0)->first();
                            if ($single_info  != NULL ||  $single_info  != '') {
                                $single_info->update([
                                    $single_info->active_status = 4,
                                ]);
                            }
                        }
                    }



                    $service = INDService::Where('id', $ServiceRequest_info->ind_services_id)->first();
                    $service->status = 0;
                    $service->save();

                    return response()->json(['success' => 'true', 'message' => 'Successfully QR code generate'], 200);
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or User id Invalied'], 400);
            }
        } elseif ($country_code == +92) {
            $Q_R = substr(str_shuffle('123456890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@#$%-*'), 1, 10);
            $q_r = substr(str_shuffle('RIAZ'), 1, 1);
            $ServiceRequest_info = PakRequestService::where('pak_services_id', $service_id)->where('user_id', $user_id)->first();

            if ($ServiceRequest_info) {
                if ($ServiceRequest_info->pyment_type == 'Cash on Delevery') {

                    $travel_price = $ServiceRequest_info->delivery_cost;
                    $user_id = $ServiceRequest_info->traveller_info->user_id;
                    $traveller = PakUser::where('id', $user_id)->first();
                    $t_balance = $ServiceRequest_info->delivery_cost;
                    $treveller_commission = $t_balance * 20 / 100;
                    if ($traveller->drop_balance >= $treveller_commission) {
                        $t_balance = $ServiceRequest_info->delivery_cost;
                        $treveller_commission = $t_balance * 20 / 100;
                        $traveller->update([
                            $traveller->drop_balance = $traveller->drop_balance - $treveller_commission,
                        ]);
                        //---------------------------
                        $ServiceRequest_info->qr_code = $ServiceRequest_info->traveller_id . $q_r . $Q_R . $q_r . $service_id;
                        $ServiceRequest_info->save();


                        $all_info = PakRequestService::where('traveller_id', $ServiceRequest_info->traveller_id)->where('pak_services_id', $ServiceRequest_info->pak_services_id)->get();

                        foreach ($all_info as $check_delete) {
                            if ($check_delete->qr_code == NULL || $check_delete->qr_code == '') {
                                $single_info = PakRequestService::where('traveller_id', $check_delete->traveller_id)->where('bd_services_id', $check_delete->bd_services_id)->where('qr_code', NULL)->orWhere('qr_code', '')->where('active_status', 0)->first();
                                if ($single_info  != NULL ||  $single_info  != '') {
                                    $single_info->update([
                                        $single_info->active_status = 4,
                                    ]);
                                }
                            }
                        }



                        $service = PakService::Where('id', $ServiceRequest_info->pak_services_id)->first();
                        $service->status = 0;
                        $service->save();

                        return response()->json(['success' => 'true', 'message' => 'Successfully QR code generate'], 200);

                        //-----------------------------------------
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'No money'], 400);
                    }
                } elseif ($ServiceRequest_info->pyment_type == 'Balance') {
                    //---------------------------
                    $ServiceRequest_info->qr_code = $ServiceRequest_info->traveller_id . $q_r . $Q_R . $q_r . $service_id;
                    $ServiceRequest_info->save();


                    $all_info = PakRequestService::where('traveller_id', $ServiceRequest_info->traveller_id)->where('pak_services_id', $ServiceRequest_info->pak_services_id)->get();

                    foreach ($all_info as $check_delete) {
                        if ($check_delete->qr_code == NULL || $check_delete->qr_code == '') {
                            $single_info = PakRequestService::where('traveller_id', $check_delete->traveller_id)->where('bd_services_id', $check_delete->bd_services_id)->where('qr_code', NULL)->orWhere('qr_code', '')->where('active_status', 0)->first();
                            if ($single_info  != NULL ||  $single_info  != '') {
                                $single_info->update([
                                    $single_info->active_status = 4,
                                ]);
                            }
                        }
                    }


                    $service = PakService::Where('id', $ServiceRequest_info->pak_services_id)->first();
                    $service->status = 0;
                    $service->save();

                    return response()->json(['success' => 'true', 'message' => 'Successfully QR code generate'], 200);

                    //----------------------------------------- 
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or User id Invalied'], 400);
            }
        } elseif ($country_code == +65) {
            $Q_R = substr(str_shuffle('123456890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@#$%-*'), 1, 10);
            $q_r = substr(str_shuffle('RIAZ'), 1, 1);
            $ServiceRequest_info = SingaporeRequestService::where('singapore_services_id', $service_id)->where('user_id', $user_id)->first();

            if ($ServiceRequest_info) {

                if ($ServiceRequest_info->pyment_type == 'Cash on Delevery') {

                    $travel_price = $ServiceRequest_info->delivery_cost;
                    $user_id = $ServiceRequest_info->traveller_info->user_id;
                    $traveller = SingaporeUser::where('id', $user_id)->first();
                    if ($traveller->drop_balance >= $travel_price) {
                        $t_balance = $ServiceRequest_info->delivery_cost;
                        $treveller_commission = $t_balance * 20 / 100;
                        $traveller->update([
                            $traveller->drop_balance = $traveller->drop_balance -   $treveller_commission,
                        ]);


                        //----------------------------------------
                        $ServiceRequest_info->qr_code = $ServiceRequest_info->traveller_id . $q_r . $Q_R . $q_r . $service_id;
                        $ServiceRequest_info->save();


                        $all_info = SingaporeRequestService::where('traveller_id', $ServiceRequest_info->traveller_id)->where('singapore_services_id', $ServiceRequest_info->singapore_services_id)->get();

                        foreach ($all_info as $check_delete) {
                            if ($check_delete->qr_code == NULL || $check_delete->qr_code == '') {
                                $single_info = SingaporeRequestService::where('traveller_id', $check_delete->traveller_id)->where('bd_services_id', $check_delete->bd_services_id)->where('qr_code', NULL)->orWhere('qr_code', '')->where('active_status', 0)->first();
                                if ($single_info  != NULL ||  $single_info  != '') {
                                    $single_info->update([
                                        $single_info->active_status = 4,
                                    ]);
                                }
                            }
                        }


                        $service = SingaporeService::Where('id', $ServiceRequest_info->singapore_services_id)->first();
                        $service->status = 0;
                        $service->save();
                        return response()->json(['success' => 'true', 'message' => 'Successfully QR code generate'], 200);
                        //-------------------------------------
                    } else {
                        return response()->json(['success' => 'false', 'message' => 'No money'], 400);
                    }
                } elseif ($ServiceRequest_info->pyment_type == 'Balance') {
                    //----------------------------------------
                    $ServiceRequest_info->qr_code = $ServiceRequest_info->traveller_id . $q_r . $Q_R . $q_r . $service_id;
                    $ServiceRequest_info->save();


                    $all_info = SingaporeRequestService::where('traveller_id', $ServiceRequest_info->traveller_id)->where('singapore_services_id', $ServiceRequest_info->singapore_services_id)->get();

                    foreach ($all_info as $check_delete) {
                        if ($check_delete->qr_code == NULL || $check_delete->qr_code == '') {
                            $single_info = SingaporeRequestService::where('traveller_id', $check_delete->traveller_id)->where('bd_services_id', $check_delete->bd_services_id)->where('qr_code', NULL)->orWhere('qr_code', '')->where('active_status', 0)->first();
                            if ($single_info  != NULL ||  $single_info  != '') {
                                $single_info->update([
                                    $single_info->active_status = 4,
                                ]);
                            }
                        }
                    }


                    $service = SingaporeService::Where('id', $ServiceRequest_info->singapore_services_id)->first();
                    $service->status = 0;
                    $service->save();
                    return response()->json(['success' => 'true', 'message' => 'Successfully QR code generate'], 200);
                    //-------------------------------------
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or User id Invalied'], 400);
            }
        } else {
            return response()->json(['success' => 'false', 'message' => 'Country Code did not match'], 400);
        }
    }
    public function ServiceRequestDecline($country_code, $service_id)
    {

        if ($country_code == +880) {


            $ServiceRequest_info = BDRequestService::where('bd_services_id', $service_id)->first();
            if ($ServiceRequest_info != NULL || $ServiceRequest_info != '') {
                $ServiceRequest_info->update([
                    $ServiceRequest_info->active_status = 3,
                ]);
                return response()->json(['success' => 'true', 'message' => 'Successfully Decline'], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Data Not Found'], 200);
            }
        } elseif ($country_code == +91) {

            $ServiceRequest_info = INDRequestService::where('ind_services_id', $service_id)->first();
            if ($ServiceRequest_info != NULL || $ServiceRequest_info != '') {
                $ServiceRequest_info->update([
                    $ServiceRequest_info->active_status = 3,
                ]);
                return response()->json(['success' => 'true', 'message' => 'Successfully Decline'], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Data Not Found'], 200);
            }
        } elseif ($country_code == +92) {

            $ServiceRequest_info = PakRequestService::where('pak_services_id', $service_id)->first();
            if ($ServiceRequest_info != NULL || $ServiceRequest_info != '') {
                $ServiceRequest_info->update([
                    $ServiceRequest_info->active_status = 3,
                ]);
                return response()->json(['success' => 'true', 'message' => 'Successfully Decline'], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Data Not Found'], 200);
            }
        } elseif ($country_code == +65) {

            $ServiceRequest_info = SingaporeRequestService::where('singapore_services_id', $service_id)->first();
            if ($ServiceRequest_info != NULL || $ServiceRequest_info != '') {
                $ServiceRequest_info->update([
                    $ServiceRequest_info->active_status = 3,
                ]);
                return response()->json(['success' => 'true', 'message' => 'Successfully Decline'], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Data Not Found'], 200);
            }
        } else {
            return response()->json(['success' => 'false', 'message' => 'Country Code did not match'], 400);
        }
    }

    public function ServiceRequestcencel($country_code, $requestservice_id)
    {

        if ($country_code == +880) {

            $ServiceRequest_info = BDRequestService::where('id', $requestservice_id)->first();
            $time = $ServiceRequest_info->created_at->diffInHours();
            $traveller_info = $ServiceRequest_info->traveller_info->user_info_traveller;
            $user_info = $ServiceRequest_info->user_info;

            if ($time == 1) {

                $penalty_balance = 50;
                $user_profite = $penalty_balance - 40;
                $company_commission = new PenaltyCharge();
                $company_commission->service_request_id = $ServiceRequest_info->id;
                $company_commission->user_id = $user_info->id;
                $company_commission->traveller_id = $traveller_info->id;
                $company_commission->user_commission = $user_profite;
                $company_commission->traveller_commission = 0;
                $company_commission->company_commission =  $penalty_balance - $user_profite;
                $company_commission->save();

                $user_info->update([
                    $user_info->drop_balance = $user_info->drop_balance + $user_profite,
                ]);
                $traveller_info->update([
                    $traveller_info->drop_balance = $traveller_info->drop_balance - $penalty_balance,
                ]);
                $ServiceRequest_info->active_status = 2;
                $ServiceRequest_info->save();
                $service = BDService::Where('id', $ServiceRequest_info->bd_services_id)->first();
                $service->status = 2;
                $service->save();
            } else {

                $penalty_balance = 100;

                $user_profite = $penalty_balance - 40;
                $company_commission = new PenaltyCharge();
                $company_commission->service_request_id = $ServiceRequest_info->id;
                $company_commission->user_id = $user_info->id;
                $company_commission->traveller_id = $traveller_info->id;
                $company_commission->user_commission = $user_profite;
                $company_commission->traveller_commission = 0;
                $company_commission->company_commission =  $penalty_balance - $user_profite;
                $company_commission->save();

                $user_info->update([
                    $user_info->drop_balance = $user_info->drop_balance + $user_profite,
                ]);
                $traveller_info->update([
                    $traveller_info->drop_balance = $traveller_info->drop_balance - $penalty_balance,
                ]);
                $ServiceRequest_info->active_status = 2;
                $ServiceRequest_info->save();
                $service = BDService::Where('id', $ServiceRequest_info->bd_services_id)->first();
                $service->status = 2;
                $service->save();
            }

            //charge amount pppp;




            return response()->json(['success' => 'true', 'message' => 'Successfully Cancel'], 200);
        } elseif ($country_code == +91) {

            $ServiceRequest_info = INDRequestService::where('id', $requestservice_id)->first();
            $time = $ServiceRequest_info->created_at->diffInHours();
            $traveller_info = $ServiceRequest_info->traveller_info->user_info_traveller;
            $user_info = $ServiceRequest_info->user_info;

            if ($time == 1) {

                $penalty_balance = 50;
                $user_profite = $penalty_balance - 40;
                $company_commission = new PenaltyCharge();
                $company_commission->service_request_id = $ServiceRequest_info->id;
                $company_commission->user_id = $user_info->id;
                $company_commission->traveller_id = $traveller_info->id;
                $company_commission->user_commission = $user_profite;
                $company_commission->traveller_commission = 0;
                $company_commission->company_commission =  $penalty_balance - $user_profite;
                $company_commission->save();

                $user_info->update([
                    $user_info->drop_balance = $user_info->drop_balance + $user_profite,
                ]);
                $traveller_info->update([
                    $traveller_info->drop_balance = $traveller_info->drop_balance - $penalty_balance,
                ]);
                $ServiceRequest_info->active_status = 2;
                $ServiceRequest_info->save();
                $service = BDService::Where('id', $ServiceRequest_info->bd_services_id)->first();
                $service->status = 2;
                $service->save();
            } else {

                $penalty_balance = 100;

                $user_profite = $penalty_balance - 40;
                $company_commission = new PenaltyCharge();
                $company_commission->service_request_id = $ServiceRequest_info->id;
                $company_commission->user_id = $user_info->id;
                $company_commission->traveller_id = $traveller_info->id;
                $company_commission->user_commission = $user_profite;
                $company_commission->traveller_commission = 0;
                $company_commission->company_commission =  $penalty_balance - $user_profite;
                $company_commission->save();

                $user_info->update([
                    $user_info->drop_balance = $user_info->drop_balance + $user_profite,
                ]);
                $traveller_info->update([
                    $traveller_info->drop_balance = $traveller_info->drop_balance - $penalty_balance,
                ]);
                $ServiceRequest_info->active_status = 2;
                $ServiceRequest_info->save();
                $service = INDService::Where('id', $ServiceRequest_info->ind_services_id)->first();
                $service->status = 2;
                $service->save();
            }
            return response()->json(['success' => 'true', 'message' => 'Successfully Cancel'], 200);
        } elseif ($country_code == +92) {

            $ServiceRequest_info = PakRequestService::where('id', $requestservice_id)->first();
            $time = $ServiceRequest_info->created_at->diffInHours();
            $traveller_info = $ServiceRequest_info->traveller_info->user_info_traveller;
            $user_info = $ServiceRequest_info->user_info;

            if ($time == 1) {

                $penalty_balance = 50;
                $user_profite = $penalty_balance - 40;
                $company_commission = new PenaltyCharge();
                $company_commission->service_request_id = $ServiceRequest_info->id;
                $company_commission->user_id = $user_info->id;
                $company_commission->traveller_id = $traveller_info->id;
                $company_commission->user_commission = $user_profite;
                $company_commission->traveller_commission = 0;
                $company_commission->company_commission =  $penalty_balance - $user_profite;
                $company_commission->save();

                $user_info->update([
                    $user_info->drop_balance = $user_info->drop_balance + $user_profite,
                ]);
                $traveller_info->update([
                    $traveller_info->drop_balance = $traveller_info->drop_balance - $penalty_balance,
                ]);
                $ServiceRequest_info->active_status = 2;
                $ServiceRequest_info->save();
                $service = BDService::Where('id', $ServiceRequest_info->bd_services_id)->first();
                $service->status = 2;
                $service->save();
            } else {

                $penalty_balance = 100;

                $user_profite = $penalty_balance - 40;
                $company_commission = new PenaltyCharge();
                $company_commission->service_request_id = $ServiceRequest_info->id;
                $company_commission->user_id = $user_info->id;
                $company_commission->traveller_id = $traveller_info->id;
                $company_commission->user_commission = $user_profite;
                $company_commission->traveller_commission = 0;
                $company_commission->company_commission =  $penalty_balance - $user_profite;
                $company_commission->save();

                $user_info->update([
                    $user_info->drop_balance = $user_info->drop_balance + $user_profite,
                ]);
                $traveller_info->update([
                    $traveller_info->drop_balance = $traveller_info->drop_balance - $penalty_balance,
                ]);
                $ServiceRequest_info->active_status = 2;
                $ServiceRequest_info->save();
                $service = PakService::Where('id', $ServiceRequest_info->pak_services_id)->first();
                $service->status = 2;
                $service->save();
            }
            return response()->json(['success' => 'true', 'message' => 'Successfully cancel'], 200);
        } elseif ($country_code == +65) {

            $ServiceRequest_info = SingaporeRequestService::where('id', $requestservice_id)->first();
            $time = $ServiceRequest_info->created_at->diffInHours();
            $traveller_info = $ServiceRequest_info->traveller_info->user_info_traveller;
            $user_info = $ServiceRequest_info->user_info;

            if ($time == 1) {

                $penalty_balance = 50;
                $user_profite = $penalty_balance - 40;
                $company_commission = new PenaltyCharge();
                $company_commission->service_request_id = $ServiceRequest_info->id;
                $company_commission->user_id = $user_info->id;
                $company_commission->traveller_id = $traveller_info->id;
                $company_commission->user_commission = $user_profite;
                $company_commission->traveller_commission = 0;
                $company_commission->company_commission =  $penalty_balance - $user_profite;
                $company_commission->save();

                $user_info->update([
                    $user_info->drop_balance = $user_info->drop_balance + $user_profite,
                ]);
                $traveller_info->update([
                    $traveller_info->drop_balance = $traveller_info->drop_balance - $penalty_balance,
                ]);
                $ServiceRequest_info->active_status = 2;
                $ServiceRequest_info->save();
                $service = BDService::Where('id', $ServiceRequest_info->bd_services_id)->first();
                $service->status = 2;
                $service->save();
            } else {

                $penalty_balance = 100;

                $user_profite = $penalty_balance - 40;
                $company_commission = new PenaltyCharge();
                $company_commission->service_request_id = $ServiceRequest_info->id;
                $company_commission->user_id = $user_info->id;
                $company_commission->traveller_id = $traveller_info->id;
                $company_commission->user_commission = $user_profite;
                $company_commission->traveller_commission = 0;
                $company_commission->company_commission =  $penalty_balance - $user_profite;
                $company_commission->save();

                $user_info->update([
                    $user_info->drop_balance = $user_info->drop_balance + $user_profite,
                ]);
                $traveller_info->update([
                    $traveller_info->drop_balance = $traveller_info->drop_balance - $penalty_balance,
                ]);
                $ServiceRequest_info->active_status = 2;
                $ServiceRequest_info->save();
                $service = SingaporeService::Where('id', $ServiceRequest_info->singapore_services_id)->first();
                $service->status = 2;
                $service->save();
            }
            return response()->json(['success' => 'true', 'message' => 'Successfully Cancel'], 200);
        } else {
            return response()->json(['success' => 'false', 'message' => 'Country Code did not match'], 400);
        }
    }

    public function ServiceRequestQRCode($country_code, $user_id)
    {

        if ($country_code == +880) {

            $ServiceRequest_info = BDRequestService::where('user_id', $user_id)->where('qr_code', '!=', NULL)->Where('qr_code', '!=', '')->get();




            if (count($ServiceRequest_info) > 0) {

                foreach ($ServiceRequest_info as $v_service) {

                    $QRCODE[] = array(
                        'qr_code' => $v_service->qr_code,
                        'traveller_name' => $v_service->traveller_info->user_info_traveller->name,
                        'traveller_id' => $v_service->traveller_id,
                        'service_id' => $v_service->bd_services_id,
                        'start_point' => $v_service->service_info->travel_start_point
                    );
                }



                return response()->json(['success' => 'true', 'QR Code' => $QRCODE], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or user id Invalied or empty'], 400);
            }
        } elseif ($country_code == +91) {

            $ServiceRequest_info = INDRequestService::where('user_id', $user_id)->where('qr_code', '!=', NULL)->Where('qr_code', '!=', '')->get();

            if (count($ServiceRequest_info) > 0) {

                foreach ($ServiceRequest_info as $v_service) {
                    $QRCODE[] = array(
                        'qr_code' => $v_service->qr_code,
                        'traveller_name' => $v_service->traveller_info->user_info_traveller->name,
                        'traveller_id' => $v_service->traveller_id,
                        'service_id' => $v_service->ind_services_id,
                        'start_point' => $v_service->service_info->travel_start_point
                    );
                }


                return response()->json(['success' => 'true', 'QR Code' => $QRCODE], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or user id Invalied or empty'], 200);
            }
        } elseif ($country_code == +92) {

            $ServiceRequest_info = PakRequestService::where('user_id', $user_id)->where('qr_code', '!=', NULL)->Where('qr_code', '!=', '')->get();


            if (count($ServiceRequest_info) > 0) {
                foreach ($ServiceRequest_info as $v_service) {
                    $QRCODE[] = array(
                        'qr_code' => $v_service->qr_code,
                        'traveller_name' => $v_service->traveller_info->user_info_traveller->name,
                        'traveller_id' => $v_service->traveller_id,
                        'service_id' => $v_service->pak_services_id,
                        'start_point' => $v_service->service_info->travel_start_point
                    );
                }
                return response()->json(['success' => 'true', 'QR Code' => $QRCODE], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or user id Invalied or empty'], 400);
            }
        } elseif ($country_code == +65) {

            $ServiceRequest_info = SingaporeRequestService::where('user_id', $user_id)->where('qr_code', '!=', NULL)->Where('qr_code', '!=', '')->get();


            if (count($ServiceRequest_info) > 0) {
                foreach ($ServiceRequest_info as $v_service) {
                    $QRCODE[] = array(
                        'qr_code' => $v_service->qr_code,
                        'traveller_name' => $v_service->traveller_info->user_info_traveller->name,
                        'traveller_id' => $v_service->traveller_id,
                        'service_id' => $v_service->singapore_services_id,
                        'start_point' => $v_service->service_info->travel_start_point
                    );
                }
                return response()->json(['success' => 'true', 'QR Code' => $QRCODE], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or user id Invalied or empty'], 400);
            }
        } else {
            return response()->json(['success' => 'false', 'message' => 'Country Code did not match'], 400);
        }
    }
    public function SingleQRCode($country_code, $service_id, $user_id)
    {

        if ($country_code == +880) {
            $ServiceRequest_info = BDRequestService::where('user_id', $user_id)->where('bd_services_id', $service_id)->where('qr_code', '!=', NULL)->Where('qr_code', '!=', '')->first();




            if ($ServiceRequest_info) {


                $qr_code = $ServiceRequest_info->qr_code;

                return response()->json(['success' => 'true', 'QR Code' => $qr_code], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or user id Invalied or empty'], 400);
            }
        } elseif ($country_code == +91) {

            $ServiceRequest_info = INDRequestService::where('user_id', $user_id)->where('ind_services_id', $service_id)->where('qr_code', '!=', NULL)->Where('qr_code', '!=', '')->first();

            if ($ServiceRequest_info) {

                $qr_code = $ServiceRequest_info->qr_code;

                return response()->json(['success' => 'true', 'QR Code' => $qr_code], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or user id Invalied or empty'], 200);
            }
        } elseif ($country_code == +92) {

            $ServiceRequest_info = PakRequestService::where('user_id', $user_id)->where('pak_services_id', $service_id)->where('qr_code', '!=', NULL)->Where('qr_code', '!=', '')->first();

            if ($ServiceRequest_info) {

                $qr_code = $ServiceRequest_info->qr_code;

                return response()->json(['success' => 'true', 'QR Code' => $qr_code], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or user id Invalied or empty'], 400);
            }
        } elseif ($country_code == +65) {

            $ServiceRequest_info = SingaporeRequestService::where('user_id', $user_id)->where('singapore_services_id', $service_id)->where('qr_code', '!=', NULL)->Where('qr_code', '!=', '')->first();
            if ($ServiceRequest_info) {
                $qr_code = $ServiceRequest_info->qr_code;

                return response()->json(['success' => 'true', 'QR Code' => $qr_code], 200);
            } else {
                return response()->json(['success' => 'false', 'message' => 'Service Request id or user id Invalied or empty'], 400);
            }
        } else {
            return response()->json(['success' => 'false', 'message' => 'Country Code did not match'], 400);
        }
    }

    public function DeliverySuccess($country_code, $qr_code, $traveller_id)
    {

        if ($country_code == +880) {

            $ServiceRequest_info = BDRequestService::where('traveller_id', $traveller_id)->where('qr_code', $qr_code)->first();
            $delivery_cost = $ServiceRequest_info->delivery_cost;





            if ($ServiceRequest_info->active_status == 0) {
                $ServiceRequest_info->active_status = 1;
                if ($ServiceRequest_info->save()) {

                    $delivery_cost = $ServiceRequest_info->delivery_cost;
                    $product_price = $ServiceRequest_info->product_buy_price;
                    $travell_user_id = $ServiceRequest_info->traveller_info->user_id;

                    $sponsor_user_id = $ServiceRequest_info->user_info->sponsor_id;
                    $sponsor_traveller_id = $ServiceRequest_info->traveller_info->user_info_traveller->sponsor_id;

                    $company_balance = new CompanyBalance();
                    $company_balance->delivery_id = $ServiceRequest_info->id;
                    $company_balance->country_code = $ServiceRequest_info->user_info->country_code;
                    $company_balance->c_id = $ServiceRequest_info->user_id;
                    $company_balance->t_id = $ServiceRequest_info->traveller_id;
                    $company_balance->pyment_type = $ServiceRequest_info->pyment_type;

                    if ($sponsor_user_id != null && $sponsor_traveller_id != null) {

                        $sponsor_user_balance = BDUser::where('id', $sponsor_user_id)->first();
                        $user_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_user_balance->update([
                            $sponsor_user_balance->drop_balance = $sponsor_user_balance->drop_balance + $user_sponsor,
                        ]);

                        $sponsor_traveller_balance = BDUser::where('id', $sponsor_traveller_id)->first();
                        $traveller_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_traveller_balance->update([
                            $sponsor_traveller_balance->drop_balance = $sponsor_traveller_balance->drop_balance + $traveller_sponsor,
                        ]);

                        $company_commission = $delivery_cost * (18 / 100);

                        $company_balance->c_sponsor_id = $sponsor_user_id;
                        $company_balance->c_sponsor_commission = $user_sponsor;
                        $company_balance->t_sponsor_id = $sponsor_traveller_id;
                        $company_balance->t_sponsor_commission = $traveller_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } elseif ($sponsor_user_id != null) {

                        $sponsor_user_balance = BDUser::where('id', $sponsor_user_id)->first();
                        $user_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_user_balance->update([
                            $sponsor_user_balance->drop_balance = $sponsor_user_balance->drop_balance + $user_sponsor,
                        ]);


                        $company_commission = $delivery_cost * (19 / 100);
                        $company_balance->t_sponsor_id = 0;
                        $company_balance->t_sponsor_commission = 0;
                        $company_balance->c_sponsor_id = $sponsor_user_id;
                        $company_balance->c_sponsor_commission = $user_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } elseif ($sponsor_traveller_id != null) {
                        $sponsor_traveller_balance = BDUser::where('id', $sponsor_traveller_id)->first();
                        $traveller_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_traveller_balance->update([
                            $sponsor_traveller_balance->drop_balance = $sponsor_traveller_balance->drop_balance + $traveller_sponsor,
                        ]);

                        $company_commission = $delivery_cost * (19 / 100);
                        $company_balance->c_sponsor_id = 0;
                        $company_balance->c_sponsor_commission = 0;

                        $company_balance->t_sponsor_id = $sponsor_traveller_id;
                        $company_balance->t_sponsor_commission = $traveller_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } else {
                        $company_commission = $delivery_cost * (20 / 100);
                        $company_balance->c_sponsor_id = 0;
                        $company_balance->c_sponsor_commission = 0;
                        $company_balance->t_sponsor_id = 0;
                        $company_balance->t_sponsor_commission = 0;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    }





                    $earn_price = $delivery_cost - $delivery_cost * (20 / 100);
                    $drop_balance = BDUser::where('id', $travell_user_id)->first();
                    $drop_balance->update([
                        $drop_balance->drop_balance = $drop_balance->drop_balance + $earn_price,
                        $drop_balance->product_balance = $drop_balance->product_balance + $product_price,
                    ]);


                    return response()->json(['success' => 'true', 'message' => 'Successfully Meatched'], 200);
                } else {
                    return response()->json(['success' => 'false', 'message' => 'QR-Code Invalied'], 400);
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'All ready delivery success'], 400);
            }
        } elseif ($country_code == +91) {

            $ServiceRequest_info = INDRequestService::where('traveller_id', $traveller_id)->where('qr_code', $qr_code)->first();

            if ($ServiceRequest_info->active_status == 0) {
                $ServiceRequest_info->active_status = 1;
                if ($ServiceRequest_info->save()) {



                    $delivery_cost = $ServiceRequest_info->delivery_cost;
                    $product_price = $ServiceRequest_info->product_buy_price;
                    $travell_user_id = $ServiceRequest_info->traveller_info->user_id;

                    $sponsor_user_id = $ServiceRequest_info->user_info->sponsor_id;
                    $sponsor_traveller_id = $ServiceRequest_info->traveller_info->user_info_traveller->sponsor_id;

                    $company_balance = new CompanyBalance();
                    $company_balance->delivery_id = $ServiceRequest_info->id;
                    $company_balance->country_code = $ServiceRequest_info->user_info->country_code;
                    $company_balance->c_id = $ServiceRequest_info->user_id;
                    $company_balance->t_id = $ServiceRequest_info->traveller_id;
                    $company_balance->pyment_type = $ServiceRequest_info->pyment_type;

                    if ($sponsor_user_id != null && $sponsor_traveller_id != null) {

                        $sponsor_user_balance = INDUser::where('id', $sponsor_user_id)->first();
                        $user_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_user_balance->update([
                            $sponsor_user_balance->drop_balance = $sponsor_user_balance->drop_balance + $user_sponsor,
                        ]);

                        $sponsor_traveller_balance = INDUser::where('id', $sponsor_traveller_id)->first();
                        $traveller_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_traveller_balance->update([
                            $sponsor_traveller_balance->drop_balance = $sponsor_traveller_balance->drop_balance + $traveller_sponsor,
                        ]);

                        $company_commission = $delivery_cost * (18 / 100);

                        $company_balance->c_sponsor_id = $sponsor_user_id;
                        $company_balance->c_sponsor_commission = $user_sponsor;
                        $company_balance->t_sponsor_id = $sponsor_traveller_id;
                        $company_balance->t_sponsor_commission = $traveller_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } elseif ($sponsor_user_id != null) {

                        $sponsor_user_balance = INDUser::where('id', $sponsor_user_id)->first();
                        $user_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_user_balance->update([
                            $sponsor_user_balance->drop_balance = $sponsor_user_balance->drop_balance + $user_sponsor,
                        ]);


                        $company_commission = $delivery_cost * (19 / 100);
                        $company_balance->t_sponsor_id = 0;
                        $company_balance->t_sponsor_commission = 0;
                        $company_balance->c_sponsor_id = $sponsor_user_id;
                        $company_balance->c_sponsor_commission = $user_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } elseif ($sponsor_traveller_id != null) {
                        $sponsor_traveller_balance = INDUser::where('id', $sponsor_traveller_id)->first();
                        $traveller_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_traveller_balance->update([
                            $sponsor_traveller_balance->drop_balance = $sponsor_traveller_balance->drop_balance + $traveller_sponsor,
                        ]);

                        $company_commission = $delivery_cost * (19 / 100);
                        $company_balance->c_sponsor_id = 0;
                        $company_balance->c_sponsor_commission = 0;

                        $company_balance->t_sponsor_id = $sponsor_traveller_id;
                        $company_balance->t_sponsor_commission = $traveller_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } else {
                        $company_commission = $delivery_cost * (20 / 100);
                        $company_balance->c_sponsor_id = 0;
                        $company_balance->c_sponsor_commission = 0;
                        $company_balance->t_sponsor_id = 0;
                        $company_balance->t_sponsor_commission = 0;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    }





                    $earn_price = $delivery_cost - $delivery_cost * (20 / 100);
                    $drop_balance = INDUser::where('id', $travell_user_id)->first();
                    $drop_balance->update([
                        $drop_balance->drop_balance = $drop_balance->drop_balance + $earn_price,
                        $drop_balance->product_balance = $drop_balance->product_balance + $product_price,
                    ]);



                    return response()->json(['success' => 'true', 'message' => 'Successfully Meatched'], 200);
                } else {
                    return response()->json(['success' => 'false', 'message' => 'QR-Code Invalied'], 400);
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'All ready delivery success'], 400);
            }
        } elseif ($country_code == +92) {

            $ServiceRequest_info = PakRequestService::where('traveller_id', $traveller_id)->where('qr_code', $qr_code)->first();
            if ($ServiceRequest_info->active_status == 0) {
                $ServiceRequest_info->active_status = 1;
                if ($ServiceRequest_info->save()) {


                    $delivery_cost = $ServiceRequest_info->delivery_cost;
                    $product_price = $ServiceRequest_info->product_buy_price;
                    $travell_user_id = $ServiceRequest_info->traveller_info->user_id;

                    $sponsor_user_id = $ServiceRequest_info->user_info->sponsor_id;
                    $sponsor_traveller_id = $ServiceRequest_info->traveller_info->user_info_traveller->sponsor_id;

                    $company_balance = new CompanyBalance();
                    $company_balance->delivery_id = $ServiceRequest_info->id;
                    $company_balance->country_code = $ServiceRequest_info->user_info->country_code;
                    $company_balance->c_id = $ServiceRequest_info->user_id;
                    $company_balance->t_id = $ServiceRequest_info->traveller_id;
                    $company_balance->pyment_type = $ServiceRequest_info->pyment_type;

                    if ($sponsor_user_id != null && $sponsor_traveller_id != null) {

                        $sponsor_user_balance = PakUser::where('id', $sponsor_user_id)->first();
                        $user_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_user_balance->update([
                            $sponsor_user_balance->drop_balance = $sponsor_user_balance->drop_balance + $user_sponsor,
                        ]);

                        $sponsor_traveller_balance = PakUser::where('id', $sponsor_traveller_id)->first();
                        $traveller_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_traveller_balance->update([
                            $sponsor_traveller_balance->drop_balance = $sponsor_traveller_balance->drop_balance + $traveller_sponsor,
                        ]);

                        $company_commission = $delivery_cost * (18 / 100);

                        $company_balance->c_sponsor_id = $sponsor_user_id;
                        $company_balance->c_sponsor_commission = $user_sponsor;
                        $company_balance->t_sponsor_id = $sponsor_traveller_id;
                        $company_balance->t_sponsor_commission = $traveller_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } elseif ($sponsor_user_id != null) {

                        $sponsor_user_balance = PakUser::where('id', $sponsor_user_id)->first();
                        $user_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_user_balance->update([
                            $sponsor_user_balance->drop_balance = $sponsor_user_balance->drop_balance + $user_sponsor,
                        ]);


                        $company_commission = $delivery_cost * (19 / 100);
                        $company_balance->t_sponsor_id = 0;
                        $company_balance->t_sponsor_commission = 0;
                        $company_balance->c_sponsor_id = $sponsor_user_id;
                        $company_balance->c_sponsor_commission = $user_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } elseif ($sponsor_traveller_id != null) {
                        $sponsor_traveller_balance = PakUser::where('id', $sponsor_traveller_id)->first();
                        $traveller_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_traveller_balance->update([
                            $sponsor_traveller_balance->drop_balance = $sponsor_traveller_balance->drop_balance + $traveller_sponsor,
                        ]);

                        $company_commission = $delivery_cost * (19 / 100);
                        $company_balance->c_sponsor_id = 0;
                        $company_balance->c_sponsor_commission = 0;

                        $company_balance->t_sponsor_id = $sponsor_traveller_id;
                        $company_balance->t_sponsor_commission = $traveller_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } else {
                        $company_commission = $delivery_cost * (20 / 100);
                        $company_balance->c_sponsor_id = 0;
                        $company_balance->c_sponsor_commission = 0;
                        $company_balance->t_sponsor_id = 0;
                        $company_balance->t_sponsor_commission = 0;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    }





                    $earn_price = $delivery_cost - $delivery_cost * (20 / 100);
                    $drop_balance = PakUser::where('id', $travell_user_id)->first();
                    $drop_balance->update([
                        $drop_balance->drop_balance = $drop_balance->drop_balance + $earn_price,
                        $drop_balance->product_balance = $drop_balance->product_balance + $product_price,
                    ]);



                    return response()->json(['success' => 'true', 'message' => 'Successfully Meatched'], 200);
                } else {
                    return response()->json(['success' => 'false', 'message' => 'QR-Code Invalied'], 400);
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'All ready delivery success'], 400);
            }
        } elseif ($country_code == +65) {

            $ServiceRequest_info = SingaporeRequestService::where('traveller_id', $traveller_id)->where('qr_code', $qr_code)->first();
            if ($ServiceRequest_info->active_status == 0) {
                $ServiceRequest_info->active_status = 1;
                if ($ServiceRequest_info->save()) {



                    $delivery_cost = $ServiceRequest_info->delivery_cost;
                    $product_price = $ServiceRequest_info->product_buy_price;
                    $travell_user_id = $ServiceRequest_info->traveller_info->user_id;

                    $sponsor_user_id = $ServiceRequest_info->user_info->sponsor_id;
                    $sponsor_traveller_id = $ServiceRequest_info->traveller_info->user_info_traveller->sponsor_id;

                    $company_balance = new CompanyBalance();
                    $company_balance->delivery_id = $ServiceRequest_info->id;
                    $company_balance->country_code = $ServiceRequest_info->user_info->country_code;
                    $company_balance->c_id = $ServiceRequest_info->user_id;
                    $company_balance->t_id = $ServiceRequest_info->traveller_id;
                    $company_balance->pyment_type = $ServiceRequest_info->pyment_type;

                    if ($sponsor_user_id != null && $sponsor_traveller_id != null) {

                        $sponsor_user_balance = SingaporeUser::where('id', $sponsor_user_id)->first();
                        $user_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_user_balance->update([
                            $sponsor_user_balance->drop_balance = $sponsor_user_balance->drop_balance + $user_sponsor,
                        ]);

                        $sponsor_traveller_balance = SingaporeUser::where('id', $sponsor_traveller_id)->first();
                        $traveller_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_traveller_balance->update([
                            $sponsor_traveller_balance->drop_balance = $sponsor_traveller_balance->drop_balance + $traveller_sponsor,
                        ]);

                        $company_commission = $delivery_cost * (18 / 100);

                        $company_balance->c_sponsor_id = $sponsor_user_id;
                        $company_balance->c_sponsor_commission = $user_sponsor;
                        $company_balance->t_sponsor_id = $sponsor_traveller_id;
                        $company_balance->t_sponsor_commission = $traveller_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } elseif ($sponsor_user_id != null) {

                        $sponsor_user_balance = SingaporeUser::where('id', $sponsor_user_id)->first();
                        $user_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_user_balance->update([
                            $sponsor_user_balance->drop_balance = $sponsor_user_balance->drop_balance + $user_sponsor,
                        ]);


                        $company_commission = $delivery_cost * (19 / 100);
                        $company_balance->t_sponsor_id = 0;
                        $company_balance->t_sponsor_commission = 0;
                        $company_balance->c_sponsor_id = $sponsor_user_id;
                        $company_balance->c_sponsor_commission = $user_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } elseif ($sponsor_traveller_id != null) {
                        $sponsor_traveller_balance = SingaporeUser::where('id', $sponsor_traveller_id)->first();
                        $traveller_sponsor = $delivery_cost * (1 / 100);
                        $sponsor_traveller_balance->update([
                            $sponsor_traveller_balance->drop_balance = $sponsor_traveller_balance->drop_balance + $traveller_sponsor,
                        ]);

                        $company_commission = $delivery_cost * (19 / 100);
                        $company_balance->c_sponsor_id = 0;
                        $company_balance->c_sponsor_commission = 0;

                        $company_balance->t_sponsor_id = $sponsor_traveller_id;
                        $company_balance->t_sponsor_commission = $traveller_sponsor;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    } else {
                        $company_commission = $delivery_cost * (20 / 100);
                        $company_balance->c_sponsor_id = 0;
                        $company_balance->c_sponsor_commission = 0;
                        $company_balance->t_sponsor_id = 0;
                        $company_balance->t_sponsor_commission = 0;
                        $company_balance->commission_price = $company_commission;
                        $company_balance->save();
                    }





                    $earn_price = $delivery_cost - $delivery_cost * (20 / 100);
                    $drop_balance = SingaporeUser::where('id', $travell_user_id)->first();
                    $drop_balance->update([
                        $drop_balance->drop_balance = $drop_balance->drop_balance + $earn_price,
                        $drop_balance->product_balance = $drop_balance->product_balance + $product_price,
                    ]);



                    return response()->json(['success' => 'true', 'message' => 'Successfully Meatched'], 200);
                } else {
                    return response()->json(['success' => 'false', 'message' => 'QR-Code Invalied'], 400);
                }
            } else {
                return response()->json(['success' => 'false', 'message' => 'All ready delivery success'], 400);
            }
        } else {
            return response()->json(['success' => 'false', 'message' => 'Country Code did not match'], 400);
        }
    }
}