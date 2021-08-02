<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SingaporeService;
use App\BDService;
use App\INDService;
use App\PakService;
class AdminServiceController extends Controller
{
     //-------------------------------------------------BD-----------------------------------
     public function BDService(){
        $total_service=BDService::all();
        return view('admin.All_Service.BD_Service',compact('total_service'));
    }
    public function BDServiceDelete($service_id){
        BDService::where('id',$service_id)->delete();
        return back();
    }
    public function BDServiceinfo($service_id){
        $service_info =BDService::find( $service_id );
        $all_service=BDService::all();
        return view('admin.All_Service.bd_service_info',compact('service_info','all_service'));
     }
    //-------------------------------------------------BD-----------------------------------
    //-------------------------------------------------IND-----------------------------------

    public function INDService(){
        $total_service=INDService::all();
        return view('admin.All_Service.IND_Service',compact('total_service'));
    }
    public function INDServiceDelete($service_id){
        INDService::where('id',$service_id)->delete();
        return back();
    }
    public function INDServiceinfo($service_id){
        $service_info =INDService::find( $service_id );
        $all_service=INDService::all();
        return view('admin.All_Service.ind_service_info',compact('service_info','all_service'));
     }
    //-------------------------------------------------IND-----------------------------------
    //-------------------------------------------------PAK-----------------------------------

    public function PAKService(){
        $total_service=PakService::all();
        return view('admin.All_Service.PAK_Service',compact('total_service'));
    }
    public function PAKServiceDelete($service_id){
        PakService::where('id',$service_id)->delete();
        return back();
    }
    public function PAkServiceinfo($service_id){
        $service_info =PakService::find( $service_id );
        $all_service=PakService::all();
        return view('admin.All_Service.pak_service_info',compact('service_info','all_service'));
     }
    //-------------------------------------------------PAK-----------------------------------
    //-------------------------------------------------Singapore-----------------------------------

    public function SingaporeService(){
        $total_service=SingaporeService::all();
        return view('admin.All_Service.Singapore_Service',compact('total_service'));
    }
    public function SingaporeServiceDelete($service_id){
        SingaporeService::where('id',$service_id)->delete();
        return back();
    }
    public function SingaporeServiceinfo($service_id){
        $service_info =SingaporeService::find( $service_id );
        $all_service=SingaporeService::all();
        return view('admin.All_Service.singapore_service_info',compact('service_info','all_service'));
     }
    //-------------------------------------------------Singapore-----------------------------------

}
