<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\BDUser;

class PriceCalculationController extends Controller
{

    public function ServiceRequestCalculation(Request $request)
    {
        $country_code = $request->country_code;
        $delivary_weight = $request->weight;

        $product_buy_price =  $request->product_buy_price;
        // where('product_buy_price',$request->product_buy_price)


        $price_calculate = DB::table('price_calculations')->where('country_code', $country_code)->get();



        if (count($price_calculate) > 0) {
            $product_price = BDUser::where('id', $request->user_id)->where('country_code', $country_code)->first();


            if ($product_price->product_balance >= $product_buy_price) {

                foreach ($price_calculate as $price_weght) {

                    $set_price = $price_weght->set_price;
                    $default_price = $price_weght->default_price;

                    $weight = $price_weght->max_weight;
                    if ($price_weght->min_weight <= $delivary_weight && $weight >= $delivary_weight) {

                        if (1 >= $delivary_weight && $weight >= $delivary_weight) {
                            if ('NULL' == $delivary_weight || 0 == $delivary_weight && $weight >= $delivary_weight) {

                                return response()->json(['Success' => 'false', 'sufficient balance' => true, 'Weight' => 'Invalied weight Please give a valied wieight', 'price' => null], 400);
                            } else {
                                $price_def = $price_weght->default_price;
                                return response()->json(['Success' => 'true', 'sufficient balance' => true, 'Weight' => $delivary_weight, 'price' => $price_weght->default_price], 200);
                            }
                        } else {
                            $price_cal = $set_price + ($default_price * $delivary_weight);



                            $price_def = $default_price;
                            return response()->json(['Success' => 'true',  'sufficient balance' => true, 'Weight' => $delivary_weight, 'price' => $price_def], 200);
                        }
                    } else if ($delivary_weight > 15) {
                        return response()->json(['Success' => 'false', 'sufficient balance' => true, 'Weight' => 'Invalied weight Please give a valied wieight', 'price' => null], 400);
                    }
                }
            } else {



                foreach ($price_calculate as $price_weght) {

                    $set_price = $price_weght->set_price;
                    $default_price = $price_weght->default_price;

                    $weight = $price_weght->max_weight;
                    if ($price_weght->min_weight <= $delivary_weight && $weight >= $delivary_weight) {

                        if (1 >= $delivary_weight && $weight >= $delivary_weight) {
                            if ('NULL' == $delivary_weight || 0 == $delivary_weight && $weight >= $delivary_weight) {


                                return response()->json(['Success' => 'false', 'sufficient balance' => true, 'Weight' => 'Invalied weight Please give a valied wieight', 'price' => null], 400);
                            } else {

                                $price_def = $price_weght->default_price;
                                return response()->json(['Success' => 'true', 'sufficient balance' => true, 'Weight' => $delivary_weight, 'price' => $price_def], 200);
                            }
                        } else {
                            $price_cal = $set_price + ($default_price * $delivary_weight);

                            $price_def = $default_price;
                            return response()->json(['Success' => 'true', 'sufficient balance' => true, 'Weight' => $delivary_weight, 'price' => $price_def], 200);
                        }
                    } else if ($delivary_weight > 15) {


                        return response()->json(['Success' => 'false',  'message' => 'Invalied weight', 'Weight' => 'Invalied weight Please give a valied wieight', 'price' => null], 400);
                    }
                }



                // return response()->json(['Success' => 'false', 'sufficient balance' => false, 'Weight' => $delivary_weight, 'price' => $price_def], 200);
            }
        } else {
            return response()->json(['Success' => 'false',  'message' => 'Invalied country code!'], 400);
        }
    }
}