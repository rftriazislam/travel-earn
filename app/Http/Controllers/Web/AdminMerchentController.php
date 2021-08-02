<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class AdminMerchentController extends Controller
{
    
//----------------------------------------------------------------------------BD Agent------------------------------------------

public function BDMerchant(){
    $total_bd_merchant=User::where('country_code',+880)->where('register_type','merchant')->orderBy('id','DESC')->get();
    return view('admin.All_Merchant.BD_Merchant',compact('total_bd_merchant'));
}

public function BDMerchantDelete($user_id){
    User::where('id',$user_id)->delete();
    return back();
}


public function BDMerchantStatus( $status, $user_id ) {
    $BDMerchantStatus =User::find( $user_id );
    if ( $status == '0' ) {
        $BDMerchantStatus->status = '1';
    } else {
        $BDMerchantStatus->status = '0';
    }
    $BDMerchantStatus->save();

    return redirect()->route('BDMerchant');
}


public function BDMerchantinfo($user_id){
    $merchant_info =User::find( $user_id );
    return view('admin.All_Merchant.bd_merchant_info',compact('merchant_info'));
 }
//----------------------------------------------------------------------------BD Agent------------------------------------------
  //----------------------------------------------------------------------------BD Ind------------------------------------------

  public function INDMerchant(){
    $total_ind_merchant=User::where('country_code',+91)->where('register_type','merchant')->orderBy('id','DESC')->get();
    return view('admin.All_Merchant.IND_Merchant',compact('total_ind_merchant'));
}

public function INDMerchantDelete($user_id){
    User::where('id',$user_id)->delete();
    return back();
}


public function INDMerchantStatus( $status, $user_id ) {
    $INDMerchantStatus =User::find( $user_id );
    if ( $status == '0' ) {
        $INDMerchantStatus->status = '1';
    } else {
        $INDMerchantStatus->status = '0';
    }
    $INDMerchantStatus->save();

    return redirect()->route('INDMerchant');
}


public function INDMerchantinfo($user_id){
    $merchant_info =User::find( $user_id );
    return view('admin.All_Merchant.ind_merchant_info',compact('merchant_info'));
 }
//----------------------------------------------------------------------------BD Ind------------------------------------------
   
//----------------------------------------------------------------------------BD pak------------------------------------------

public function PAKMerchant(){
    $total_pak_merchant=User::where('country_code',+92)->where('register_type','merchant')->orderBy('id','DESC')->get();
    return view('admin.All_Merchant.PAK_Merchant',compact('total_pak_merchant'));
}

public function PAKMerchantDelete($user_id){
    User::where('id',$user_id)->delete();
    return back();
}


public function PAKMerchantStatus( $status, $user_id ) {
    $pakMerchantStatus =User::find( $user_id );
    if ( $status == '0' ) {
        $pakMerchantStatus->status = '1';
    } else {
        $pakMerchantStatus->status = '0';
    }
    $pakMerchantStatus->save();

    return redirect()->route('PAKMerchant');
}


public function PAKMerchantinfo($user_id){
    $merchant_info =User::find( $user_id );
    return view('admin.All_Merchant.pak_merchant_info',compact('merchant_info'));
 }
//----------------------------------------------------------------------------BD Pak------------------------------------------

//----------------------------------------------------------------------------BD Singapore------------------------------------------

public function SingaporeMerchant(){
    $total_singapore_merchant=User::where('country_code',+65)->where('register_type','merchant')->orderBy('id','DESC')->get();
    return view('admin.All_Merchant.Singapore_Merchant',compact('total_singapore_merchant'));
}

public function SingaporeMerchantDelete($user_id){
    User::where('id',$user_id)->delete();
    return back();
}


public function SingaporeMerchantStatus( $status, $user_id ) {
    $SingaporeMerchantStatus =User::find( $user_id );
    if ( $status == '0' ) {
        $SingaporeMerchantStatus->status = '1';
    } else {
        $SingaporeMerchantStatus->status = '0';
    }
    $SingaporeMerchantStatus->save();

    return redirect()->route('SingaporeMerchant');
}


public function SingaporeMerchantinfo($user_id){
    $merchant_info =User::find( $user_id );
    return view('admin.All_Merchant.singapore_merchant_info',compact('merchant_info'));
 }
//----------------------------------------------------------------------------BD Singapore------------------------------------------

}
