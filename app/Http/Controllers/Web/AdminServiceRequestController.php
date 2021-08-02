<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BDRequestService;
use App\PakRequestService;
use App\INDRequestService;
use App\SingaporeRequestService;

class AdminServiceRequestController extends Controller
{
    //------------------------------------------bd-------------------------------------
    public function BDServiceRequest(){
      $total_service_request=BDRequestService::all();
      return view('admin.All_Service_Request.BD_Service_Request',compact('total_service_request'));
    }
    public function BDServiceRequestDelete($service_id){
        BDRequestService::where('id',$service_id)->delete();
        return back();
    }
//--------------------------------------------------------------------BD------------------------------------
//------------------------------------------IND-------------------------------------
public function INDServiceRequest(){
    $total_service_request=INDRequestService::all();
    return view('admin.All_Service_Request.IND_Service_Request',compact('total_service_request'));
  }
  public function INDServiceRequestDelete($service_id){
      INDRequestService::where('id',$service_id)->delete();
      return back();
  }
//--------------------------------------------------------------------IND------------------------------------

//------------------------------------------PAK-------------------------------------
public function PAKServiceRequest(){
    $total_service_request=PakRequestService::all();
    return view('admin.All_Service_Request.PAK_Service_Request',compact('total_service_request'));
  }
  public function PAKServiceRequestDelete($service_id){
      PakRequestService::where('id',$service_id)->delete();
      return back();
  }
//--------------------------------------------------------------------PAK------------------------------------

//------------------------------------------Singapore-------------------------------------
public function SingaporeServiceRequest(){
    $total_service_request=SingaporeRequestService::all();
    return view('admin.All_Service_Request.Singapore_Service_Request',compact('total_service_request'));
  }
  public function SingaporeServiceRequestDelete($service_id){
    SingaporeRequestService::where('id',$service_id)->delete();
      return back();
  }
//--------------------------------------------------------------------Singapore------------------------------------

}
