<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'Web\FrontendController@index')->name('home');
Route::post('/register', 'Web\FrontendController@register')->name('adminregister');
Route::get('/logout-logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/contact', 'Web\FrontendController@contact')->name('contact');
Route::post('/contact-save', 'Web\FrontendController@ContactInfo')->name('contact_info');


Route::get('/service', 'Web\FrontendController@service')->name('service');
Route::get('/product', 'Web\FrontendController@product')->name('product');
Route::get('/terms-condition', 'Web\FrontendController@TermsCondition')->name('terms_condition');
Route::get('/privacy-policy', 'Web\FrontendController@PrivacyPolicy')->name('privacy_policy');



//------------------------------------------admin----------------------------------
Route::group(['middleware' => ['auth', 'admin']], function () {


    Route::get('/profile-setting', 'Web\AdminController@profilesetting')->name('my_profile');

    Route::post('/profile-update', 'Web\AdminController@profileUpdate')->name('profileUpdate');


    Route::get('/admin', 'Web\AdminController@index')->name('admin');
    Route::get('/admin-slider', 'Web\AdminController@slider')->name('slider');
    Route::post('/admin-slider-save', 'Web\AdminController@slidersave')->name('slidersave');
    Route::get('/admin-slider-status/{status}/{id}', 'Web\AdminController@sliderstatus')->name('sliderstatus');
    Route::get('/admin-slider-delete/{id}', 'Web\AdminController@sliderdelete')->name('sliderdelete');
    Route::get('/admin-slider-edit/{id}', 'Web\AdminController@slideredit')->name('slideredit');
    Route::post('/admin-slider-update', 'Web\AdminController@sliderupdate')->name('sliderupdate');


    //-------------------------------------------------------------------------------bd-------------------------------------



    Route::get('/admin-bd-user', 'Web\AdminController@BDUser')->name('BDUser');
    Route::get('/admin-bd-user-delete/{user_id}', 'Web\AdminController@BDUserDelete')->name('BDUserDelete');
    Route::get('/admin-bd-user-status/{status}/{user_id}', 'Web\AdminController@BDUserStatus')->name('BDUserStatus');
    Route::get('/admin-bd-user-info/{user_id}', 'Web\AdminController@userinfo')->name('userinfo');


    Route::get('/admin-BD-Traveller', 'Web\AdminController@BDTraveller')->name('BDTraveller');
    Route::get('/admin-bd-traveller-delete/{traveller_id}', 'Web\AdminController@BDTravellerDelete')->name('BDTravellerDelete');
    Route::get('/admin-bd-traveller-status/{status}/{traveller_id}', 'Web\AdminController@BDTravellerStatus')->name('BDTravellerStatus');
    Route::get('/admin-bd-traveller-verification/{traveller_id}', 'Web\AdminController@TravellerVerification')->name('travellerverification');
    Route::get('/admin-NID-verified/{traveller_id}', 'Web\AdminController@BDNIDverified')->name('BDNIDverified');
    Route::get('/admin-video-verified/{traveller_id}', 'Web\AdminController@BDvideoverified')->name('BDvideoverified');
    Route::get('/admin-Resident-verified/{traveller_id}', 'Web\AdminController@BDResidentverified')->name('BDResidentverified');



    Route::get('/admin-travel-pdf-views/{country_code}/{verified_id}', 'Web\AdminController@AgentVerified_traveller');

    Route::get('/admin-agent-verified/{country_code}/{traveller_id}', 'Web\AdminController@AgentVerified');



    Route::get('/admin-BD-Service', 'Web\AdminServiceController@BDService')->name('BDService');
    Route::get('/admin-bd-Service-delete/{service_id}', 'Web\AdminServiceController@BDServiceDelete')->name('BDServiceDelete');
    Route::get('/admin-bd-Service-info/{service_id}', 'Web\AdminServiceController@BDServiceinfo');

    Route::get('/admin-BD-Service-Request', 'Web\AdminServiceRequestController@BDServiceRequest')->name('BDServiceRequest');
    Route::get('/admin-bd-Service-Request-delete/{service_id}', 'Web\AdminServiceRequestController@BDServiceRequestDelete');



    Route::get('/admin-BD-Agent', 'Web\AdminController@BDAgent')->name('BDAgent');
    Route::get('/admin-bd-agent-delete/{user_id}', 'Web\AdminController@BDAgentDelete')->name('BDagentDelete');
    Route::get('/admin-bd-agent-status/{status}/{user_id}', 'Web\AdminController@BDAgentStatus')->name('BDagentStatus');
    Route::get('/admin-bd-agent-info/{user_id}', 'Web\AdminController@BDAgentinfo');

    Route::get('/admin-BD-merchant', 'Web\AdminMerchentController@BDMerchant')->name('BDMerchant');
    Route::get('/admin-BD-merchant-delete/{user_id}', 'Web\AdminMerchentController@BDMerchantDelete');
    Route::get('/admin-bd-merchant-status/{status}/{user_id}', 'Web\AdminMerchentController@BDMerchantStatus');
    Route::get('/admin-bd-merchant-info/{user_id}', 'Web\AdminMerchentController@BDMerchantinfo');
    //--------------------------merchant-----------------------------------------------------bd-------------------------------------

    //-------------------------------------------------------------------ind------------------------------------------
    Route::get('/admin-IND-User', 'Web\AdminController@INDUser')->name('INDUser');
    Route::get('/admin-ind-user-delete/{user_id}', 'Web\AdminController@IndUserDelete')->name('induserDelete');
    Route::get('/admin-ind-user-status/{status}/{user_id}', 'Web\AdminController@IndUserStatus')->name('induserStatus');
    Route::get('/admin-ind-user-info/{user_id}', 'Web\AdminController@Induserinfo')->name('induserinfo');

    Route::get('/admin-IND-Traveller', 'Web\AdminController@INDTraveller')->name('INDTraveller');
    Route::get('/admin-IND-traveller-delete/{traveller_id}', 'Web\AdminController@INDTravellerDelete')->name('INDTravellerDelete');
    Route::get('/admin-IND-traveller-status/{status}/{traveller_id}', 'Web\AdminController@INDTravellerStatus')->name('INDTravellerStatus');
    Route::get('/admin-IND-traveller-verification/{traveller_id}', 'Web\AdminController@INDTravellerVerification')->name('INDtravellerverification');
    Route::get('/admin-NID-verified/{traveller_id}', 'Web\AdminController@INDNIDverified')->name('INDNIDverified');

    // Route::get('/admin-video-verified/{traveller_id}','Web\AdminController@INDvideoverified')->name('INDvideoverified');
    // Route::get('/admin-Resident-verified/{traveller_id}','Web\AdminController@INDResidentverified')->name('INDResidentverified');

    Route::get('/admin-IND-Service', 'Web\AdminServiceController@INDService')->name('INDService');
    Route::get('/admin-IND-Service-delete/{service_id}', 'Web\AdminServiceController@INDServiceDelete');
    Route::get('/admin-IND-Service-info/{service_id}', 'Web\AdminServiceController@INDServiceinfo');

    Route::get('/admin-IND-Service-Request', 'Web\AdminServiceRequestController@INDServiceRequest')->name('INDServiceRequest');
    Route::get('/admin-IND-Service-Request-delete/{service_id}', 'Web\AdminServiceRequestController@INDServiceRequestDelete');


    Route::get('/admin-IND-Agent', 'Web\AdminController@INDAgent')->name('INDAgent');
    Route::get('/admin-IND-agent-delete/{user_id}', 'Web\AdminController@INDAgentDelete')->name('INDagentDelete');
    Route::get('/admin-IND-agent-status/{status}/{user_id}', 'Web\AdminController@INDAgentStatus')->name('INDagentStatus');
    Route::get('/admin-IND-agent-info/{user_id}', 'Web\AdminController@INDAgentinfo');

    Route::get('/admin-IND-merchant', 'Web\AdminMerchentController@INDMerchant')->name('INDMerchant');
    Route::get('/admin-IND-merchant-delete/{user_id}', 'Web\AdminMerchentController@INDMerchantDelete');
    Route::get('/admin-IND-merchant-status/{status}/{user_id}', 'Web\AdminMerchentController@INDMerchantStatus');
    Route::get('/admin-IND-merchant-info/{user_id}', 'Web\AdminMerchentController@INDMerchantinfo');

    //-------------------------------------------------------------------------------ind-------------------------------------
    //-------------------------------------------------------------------------------pak-------------------------------------

    Route::get('/admin-PAK-User', 'Web\AdminController@PAKUser')->name('PAKUser');
    Route::get('/admin-pak-user-delete/{user_id}', 'Web\AdminController@PakUserDelete')->name('pakuserDelete');
    Route::get('/admin-pak-user-status/{status}/{user_id}', 'Web\AdminController@PakUserStatus')->name('pakuserStatus');
    Route::get('/admin-pak-user-info/{user_id}', 'Web\AdminController@Pakuserinfo')->name('pakuserinfo');

    Route::get('/admin-PAK-Traveller', 'Web\AdminController@PAKTraveller')->name('PAKTraveller');
    Route::get('/admin-Pak-traveller-delete/{traveller_id}', 'Web\AdminController@PakTravellerDelete')->name('PakTravellerDelete');
    Route::get('/admin-Pak-traveller-status/{status}/{traveller_id}', 'Web\AdminController@PakTravellerStatus')->name('PakTravellerStatus');
    Route::get('/admin-Pak-traveller-verification/{traveller_id}', 'Web\AdminController@PakTravellerVerification')->name('Paktravellerverification');
    Route::get('/admin-Pak-verified/{traveller_id}', 'Web\AdminController@PakNIDverified')->name('PakNIDverified');
    // Route::get('/admin-video-verified/{traveller_id}','Web\AdminController@Pakvideoverified')->name('Pakvideoverified');
    // Route::get('/admin-Resident-verified/{traveller_id}','Web\AdminController@PakResidentverified')->name('PakResidentverified');

    Route::get('/admin-Pak-Service', 'Web\AdminServiceController@PAKService')->name('PAKService');
    Route::get('/admin-Pak-Service-delete/{service_id}', 'Web\AdminServiceController@PAKServiceDelete');
    Route::get('/admin-Pak-Service-info/{service_id}', 'Web\AdminServiceController@PAkServiceinfo');

    Route::get('/admin-Pak-Service-Request', 'Web\AdminServiceRequestController@PAKServiceRequest')->name('PAKServiceRequest');
    Route::get('/admin-pak-Service-Request-delete/{service_id}', 'Web\AdminServiceRequestController@PAKServiceRequestDelete');


    Route::get('/admin-PAK-Agent', 'Web\AdminController@PAKAgent')->name('PAKAgent');
    Route::get('/admin-PAK-agent-delete/{user_id}', 'Web\AdminController@PAKAgentDelete')->name('PAKagentDelete');
    Route::get('/admin-PAK-agent-status/{status}/{user_id}', 'Web\AdminController@PAKAgentStatus')->name('PAKagentStatus');
    Route::get('/admin-PAK-agent-info/{user_id}', 'Web\AdminController@PAKAgentinfo');

    Route::get('/admin-PAK-merchant', 'Web\AdminMerchentController@PAKMerchant')->name('PAKMerchant');
    Route::get('/admin-PAK-merchant-delete/{user_id}', 'Web\AdminMerchentController@PAKMerchantDelete');
    Route::get('/admin-PAK-merchant-status/{status}/{user_id}', 'Web\AdminMerchentController@PAKMerchantStatus');
    Route::get('/admin-PAK-merchant-info/{user_id}', 'Web\AdminMerchentController@PAKMerchantinfo');

    //-------------------------------------------------------------------------------pak-------------------------------------

    //--------------------------------------------------------------------------------Singapore----------------------------

    Route::get('/admin-singapore-User', 'Web\AdminController@SingaporeUser')->name('SingaporeUser');
    Route::get('/admin-singapore-user-delete/{user_id}', 'Web\AdminController@SingaporeUserDelete')->name('singaporeuserDelete');
    Route::get('/admin-singapore-user-status/{status}/{user_id}', 'Web\AdminController@SingaporeUserStatus')->name('singaporeuserStatus');
    Route::get('/admin-singapore-user-info/{user_id}', 'Web\AdminController@Singaporeuserinfo')->name('singaporeuserinfo');

    Route::get('/admin-singapore-Traveller', 'Web\AdminController@SingaporeTraveller')->name('singaporeTraveller');
    Route::get('/admin-Singapore-traveller-delete/{traveller_id}', 'Web\AdminController@SingaporeTravellerDelete')->name('SingaporeTravellerDelete');
    Route::get('/admin-Singapore-traveller-status/{status}/{traveller_id}', 'Web\AdminController@SingaporeTravellerStatus')->name('SingaporeTravellerStatus');
    Route::get('/admin-Singapore-traveller-verification/{traveller_id}', 'Web\AdminController@SingaporeTravellerVerification')->name('Singaporetravellerverification');
    Route::get('/admin-Singapore-verified/{traveller_id}', 'Web\AdminController@SingaporeNIDverified')->name('SingaporeNIDverified');
    // Route::get('/admin-video-verified/{traveller_id}','Web\AdminController@Singaporevideoverified')->name('Singaporevideoverified');
    // Route::get('/admin-Resident-verified/{traveller_id}','Web\AdminController@SingaporeResidentverified')->name('SingaporeResidentverified');

    Route::get('/admin-Singapore-Service', 'Web\AdminServiceController@SingaporeService')->name('SingaporeService');
    Route::get('/admin-Singapore-Service-delete/{service_id}', 'Web\AdminServiceController@SingaporeServiceDelete');
    Route::get('/admin-Singapore-Service-info/{service_id}', 'Web\AdminServiceController@SingaporeServiceinfo');

    Route::get('/admin-Singapore-Service-Request', 'Web\AdminServiceRequestController@SingaporeServiceRequest')->name('SingaporeServiceRequest');
    Route::get('/admin-Singapore-Service-Request-delete/{service_id}', 'Web\AdminServiceRequestController@SingaporeServiceRequestDelete');


    Route::get('/admin-singapore-Agent', 'Web\AdminController@SingaporeAgent')->name('SingaporeAgent');
    Route::get('/admin-singapore-agent-delete/{user_id}', 'Web\AdminController@SingaporeAgentDelete')->name('SingaporeagentDelete');
    Route::get('/admin-singapore-agent-status/{status}/{user_id}', 'Web\AdminController@SingaporeAgentStatus')->name('SingaporeagentStatus');
    Route::get('/admin-singapore-agent-info/{user_id}', 'Web\AdminController@SingaporeAgentinfo');


    Route::get('/admin-singapore-merchant', 'Web\AdminMerchentController@SingaporeMerchant')->name('SingaporeMerchant');
    Route::get('/admin-singapore-merchant-delete/{user_id}', 'Web\AdminMerchentController@SingaporeMerchantDelete');
    Route::get('/admin-singapore-merchant-status/{status}/{user_id}', 'Web\AdminMerchentController@SingaporeMerchantStatus');
    Route::get('/admin-singapore-merchant-info/{user_id}', 'Web\AdminMerchentController@SingaporeMerchantinfo');

    //--------------------------------------------------------------------------------Singapore----------------------------
    //balance 
    Route::post('/admin-save-balance', 'Web\AdminController@SaveBalance')->name('SaveBalance');

    Route::post('/admin-save-delivery-charge', 'Web\AdminController@DeliveryChargeSave')->name('deliverychargesave');
    Route::get('/admin-edit-delivery-charge/{id}', 'Web\AdminController@EditDeliveryCharge');
    Route::post('/admin-update-delivery-charge', 'Web\AdminController@DeliveryChargeUpdate')->name('deliverychargeupdate');


    Route::get('/admin-delivery-charge', 'Web\AdminController@DeliveryCharge')->name('deliverycharge');
    Route::get('/admin-delivery-charge-delete/{id}', 'Web\AdminController@DeliveryChargeDelete');
    Route::get('/admin-delivery-charge-status/{status}/{id}', 'Web\AdminController@DeliveryChargeStatus');

    Route::get('/admin-profite', 'Web\AdminController@Profite')->name('profite');
    Route::get('/admin-total-balance', 'Web\AdminController@total_balance')->name('total_balance');
});
//----------------------------------------admin--------------------------------------------------------------------------

//----------------------------------------Agent-------------------------------------------------------------------------------
Route::group(['middleware' => ['auth', 'agent']], function () {

    Route::get('/agent', 'Web\AgentController@agent')->name('agent');

    Route::get('/agent-profile', 'Web\AgentController@AgentProfile')->name('agentprofile');
    Route::post('/agent-profile-update', 'Web\AgentController@AgentProfileUpdate')->name('agentprofileupdate');

    Route::get('/agent-verified', 'Web\AgentController@AgentVerified')->name('agentverified');
    Route::get('/agent-travel-verifing/{travel_id}', 'Web\AgentController@AgentTravelVerifing');

    Route::post('/agent-verified-user', 'Web\AgentController@AgentVerifiedUser')->name('agentverifieduser');


    Route::get('/agent-all-verification-views', 'Web\AgentController@ViewsUserVerification')->name('views_user_verification');

    Route::get('/agent-travel-pdf-views/{verified_id}', 'Web\AgentController@AgentVerified_user');

    Route::get('/agent-travel-verified-update/{verified_id}', 'Web\AgentController@AgentVerifiedUpdate');
    Route::post('/agent-verified-update', 'Web\AgentController@AgentVerifiedUpdatesave')->name('AgentVerifiedUpdatesave');
});

//----------------------------------------Agent--------------------------------------------------------


//----------------------------------------merchant--------------------------------------------------------------------------
Route::group(['middleware' => ['auth', 'merchant']], function () {

    Route::get('/merchant', 'Web\MerchantController@merchant')->name('merchant');
});

//----------------------------------------merchant----------------------------