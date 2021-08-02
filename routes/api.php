<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/Country_Add','CountryController@createCountry');
// Route::post('/SignUp/{country_code}','AuthController@createsignup');
// Route::post('/Login/{country_code}','AuthController@login');



Route::group(
    [
        'prefix' => 'AllCountry'
    ],
    function () {
        Route::post('/Country_Add', 'CountryController@createCountry');
        Route::post('/SignUp/{country_code}', 'AuthController@createsignup');
        Route::post('/Login/{country_code}', 'AuthController@login');


        Route::middleware('auth:india,bangladesh,pakistan,singapore')->group(function () {

            //All Post Request
            Route::post('/Travellers-Create', 'TravellerController@inserttraveller');

            //---------------------------------------service------------------------------------------

            Route::post('/Service-Create', 'ServiceController@insertservice');

            Route::get('/Available-Service/{country_code}/{traveller_id}', 'ServiceController@GetAllSingleService');

            //---------------------------------------service------------------------------------------

            //-------------------------------------Request service-------------------------------------------------------------------------------------------

            Route::post('/ServiceRequest-Calculation', 'PriceCalculationController@ServiceRequestCalculation');
            Route::post('/ServiceRequest-Create', 'ServiceRequestController@insertservicerequest');

            Route::get('/all-single-ServiceRequest-get/{country_code}/{traveller_id}/{service_id}', 'ServiceRequestController@GetServiceRequest');

            Route::get('/user-all-ServiceRequest-get/{country_code}/{user_id}', 'ServiceRequestController@GetUserAllServiceRequest');

            Route::get('/ServiceRequest-decline/{country_id}/{Service_id}', 'ServiceRequestController@ServiceRequestDecline');
            Route::get('/ServiceRequest-cencel/{country_id}/{ServiceRequest_id}', 'ServiceRequestController@ServiceRequestcencel');
            Route::get('/ServiceRequest-Accept/{country_id}/{Service_id}/{user_id}', 'ServiceRequestController@ServiceRequestAccept');

            Route::get('/ServiceRequest-qr-code-get/{country_id}/{user_id}', 'ServiceRequestController@ServiceRequestQRCode');

            Route::get('/single-qr-code-get/{country_id}/{service_id}/{user_id}', 'ServiceRequestController@SingleQRCode');

            Route::get('/delivery-sucess/{country_id}/{qr_code}/{traveller_id}', 'ServiceRequestController@DeliverySuccess');

            //-------------------------------------Request service----------------------------------------------------------------------------------

            //-----------------------------------------rating---------------------------------------------------------------------------------------

            Route::post('/Rating-Create', 'RatingController@insertrating');
            Route::get('/AllRating/{country_id}', 'GetAllRatingController@GetAllRating');
            Route::get('/AllRatingUser/{country_id}/{travel_id}', 'GetAllRatingController@GetAllRatingTravel');

            // Route::get('/AllRatingSingleUser/{country_id}/{user_id}', 'GetAllRatingController@GetAllRatingSingleUser');

            //-----------------------------------------rating---------------------------------------------------------------------------------------


            Route::post('/TagService-Create', 'TagServiceRequestController@inserttagservice');
            Route::post('/Agent-Create', 'AgentController@insertagent');

            //All Get Request

            //----------------------------------feed--------------------------------------------------------
            Route::get('/AllService/{country_code}', 'GetAllServiceController@AllCountryServiceController');

            Route::get('/Successfull_delivery/{country_code}', 'SuccessfullDeliveryController@getSucessfullDelivery');
            //----------------------------------feed--------------------------------------------------------
            Route::get('/Service-single-info/{country_id}/{service_id}', 'GetServiceController@GetServiceSingle');

            Route::get('/PersonalService/{user_id}/{country_code}', 'GetAllServiceController@personalservice');




            //All Get Sucessfull Delivery

            Route::post('/Traveller-accept-request/{request_tag_service_id}', 'TagServiceRequestController@TravellerAcceptRequest');


            Route::get('/AllTraveller/{country_code}', 'GetAllTravelleController@GetAlltraveller');

            //All Get Sucessfull Delivery
            // Route::get('/Successfull_delivery/{country_code}','SuccessfullDeliveryController@getSucessfullDelivery');
            // Route::post('/Traveller-accept-request/{request_tag_service_id}','TagServiceRequestController@TravellerAcceptRequest');
            //All Update Request
            Route::get('/User-single-info/{country_id}/{user_id}', 'GetUserController@GetUserSingleinfo');

            Route::post('/profile-update/{country_code}/{user_id}', 'AuthController@profileupdate');
            Route::post('/Travellers-update/{country_code}/{traveller_id}', 'TravellerController@travellerUpdate');
            Route::get('/AllTraveller/{country_code}/{user_id}', 'GetAllTravelleController@getalltraveller_user');


            Route::get('/Search/{country_code}', 'SearchController@getSearch');

            //home page search 
            Route::get('/Home-Search/{country_code}', 'SearchController@GetHomeSearch');
            Route::get('/recommend-service/{country_code}', 'SearchController@GetSearchRecommend');

            Route::get('/Service-Search/{country_code}', 'SearchController@GetServiceSearch');

            Route::get('/get-affiliate/{country_code}/{user_id}', 'AffiliateController@GetAffiliateLink');

            Route::get('/sponsor-id/{country_code}/{user_id}', 'AffiliateController@GetSponsor');
        });
        // Route::get('/Searchtest/{latravel_start_point_latitude}/{travel_start_point_longitude}','SearchController@getSearchtest');

        Route::get('/User-top-earn', 'UserController@getUserTopEarn');
        Route::get('/LandingPageTotalUsersDeliverysTravellers', 'TotalUserDeliveryTravellerController@landingpagetotaluserdeliverytraveller');

        Route::post('/Foreign-Services', 'ForeignServiceController@insertforeignservice');
        Route::post('/Foreign-Request_Services', 'ForeignServiceController@insertforeignrequestservices');
    }
);