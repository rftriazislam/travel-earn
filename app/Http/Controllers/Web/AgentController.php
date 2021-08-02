<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Image;
use App\BDService;
use App\BdAgentVerified;
use App\IndAgentVerified;
use App\PakAgentVerified;
use App\SingaporeAgentVerified;

use App\BDTraveller;
use App\INDTraveller;
use App\PakTraveller;
use App\SingaporeTraveller;
use App\BDUser;
use App\INDUser;
use App\INDService;
use App\PakUser;
use App\PakService;
use App\SingaporeUser;
use App\SingaporeService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class AgentController extends Controller
{
    public function __construct()
{
   
    $this->middleware('agent');
}
   public function agent(){

    if(Auth::user()->country_code==+880){
   $verified_account=BdAgentVerified::where('agent_id',Auth::user()->id)->get();
   $panding_verified=BDTraveller::Where('agent_verification',NULL)->orWhere('agent_verification','')->get();
    $user=User::where('id',Auth::user()->id)->first();
   return view('agent.pages.home',compact('verified_account','panding_verified','user'));

    }elseif(Auth::user()->country_code==+91){
      
            $verified_account=INDAgentVerified::where('agent_id',Auth::user()->id)->get();
            $panding_verified=INDTraveller::Where('agent_verification',NULL)->orWhere('agent_verification','')->get();
             $user=User::where('id',Auth::user()->id)->first();
            return view('agent.pages.home',compact('verified_account','panding_verified','user'));
            
    }elseif(Auth::user()->country_code==+92){
        $verified_account=PakAgentVerified::where('agent_id',Auth::user()->id)->get();
        $panding_verified=PakTraveller::Where('agent_verification',NULL)->orWhere('agent_verification','')->get();
         $user=User::where('id',Auth::user()->id)->first();
        return view('agent.pages.home',compact('verified_account','panding_verified','user'));
    }elseif(Auth::user()->country_code==+65){
        $verified_account=SingaporeAgentVerified::where('agent_id',Auth::user()->id)->get();
            $panding_verified=SingaporeTraveller::Where('agent_verification',NULL)->orWhere('agent_verification','')->get();
             $user=User::where('id',Auth::user()->id)->first();
            return view('agent.pages.home',compact('verified_account','panding_verified','user'));
    }
    
       
    }




    public function agentprofile(){

        return view('agent.pages.userinfo');
        
    }
    
public function AgentProfileUpdate( Request $request ) {

    if(Auth::user()->country_code==+880){

        $id = Auth::user()->id;
        $user = User::find( $id );
        //    echo $request->password;
        if ( $request->password == NULL ) {
            $user->name = $request->input( 'name' );
            
            $user->father_name = $request->input( 'father_name' );
            $user->mother_name = $request->input( 'mother_name' );
            $user->present_address = $request->input( 'present_address' );
            $user->permanent_address = $request->input( 'permanent_address' );
            // $user->nid_front_image = $request->input( 'nid_front_image' );
            // $user->nid_back_image = $request->input( 'nid_back_image' );
            // $user->trade_license_image = $request->input( 'trade_license_image' );
            $user->office_location = $request->input( 'office_location' );
            
            if ( $request->hasFile( 'image') ) {
                //image
                $image = $request->file( 'image' );
                $filename =$request->admin_id. '.' . $image->getClientOriginalExtension();
                Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_profile_image/' . $filename ) );
                $user->image = $filename;
            }
            if($request->hasFile( 'office_picture')){
                 //office image
                 $office_image = $request->file( 'office_picture' );
                 $filename_office ='bd'.$request->admin_id. '.' . $office_image->getClientOriginalExtension();
                 Image::make( $office_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_office/' . $filename_office ) );
                 $user->office_picture = $filename_office;
            }
            if($request->hasFile( 'nid_front_image')){
                //office image
                $nid_image = $request->file( 'nid_front_image' );
                $filename_nid_front ='bd'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
                Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_front/' . $filename_nid_front ) );
                $user->nid_front_image = $filename_nid_front;
           }
             if($request->hasFile( 'nid_back_image')){
            //office image
            $nid_image = $request->file( 'nid_back_image' );
            $filename_nid_back ='bd'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
            Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_back/' . $filename_nid_back ) );
            $user->nid_back_image = $filename_nid_back;
            }
             if($request->hasFile( 'trade_license_image')){
                //office image
                $trade_image = $request->file( 'trade_license_image' );
                $filename_nid_back ='bd'.$request->admin_id. '.' . $trade_image->getClientOriginalExtension();
                Image::make( $trade_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_trade_license/' . $filename_nid_back ) );
                $user->trade_license_image = $filename_nid_back;
                }
                
      
            $user->save();
        } else {
            $user->name = $request->input( 'name' );
            
            $user->father_name = $request->input( 'father_name' );
            $user->mother_name = $request->input( 'mother_name' );
            $user->present_address = $request->input( 'present_address' );
            $user->permanent_address = $request->input( 'permanent_address' );
            // $user->nid_front_image = $request->input( 'nid_front_image' );
            // $user->nid_back_image = $request->input( 'nid_back_image' );
            // $user->trade_license_image = $request->input( 'trade_license_image' );
            $user->office_location = $request->input( 'office_location' );
            
            if ( $request->hasFile( 'image') ) {
                //image
                $image = $request->file( 'image' );
                $filename =$request->admin_id. '.' . $image->getClientOriginalExtension();
                Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_profile_image/' . $filename ) );
                $user->image = $filename;
              
            }
            if($request->hasFile( 'office_picture')){
                //office image
                $office_image = $request->file( 'office_picture' );
                $filename_office ='bd'.$request->admin_id. '.' . $office_image->getClientOriginalExtension();
                Image::make( $office_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_office/' . $filename_office ) );
                $user->office_picture = $filename_office;
           }
           if($request->hasFile( 'nid_front_image')){
            //office image
            $nid_image = $request->file( 'nid_front_image' );
            $filename_nid_front ='bd'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
            Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_front/' . $filename_nid_front ) );
            $user->nid_front_image = $filename_nid_front;
       }
         if($request->hasFile( 'nid_back_image')){
        //office image
        $nid_image = $request->file( 'nid_back_image' );
        $filename_nid_back ='bd'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
        Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_back/' . $filename_nid_back ) );
        $user->nid_back_image = $filename_nid_back;
        }
         if($request->hasFile( 'trade_license_image')){
            //office image
            $trade_image = $request->file( 'trade_license_image' );
            $filename_nid_back ='bd'.$request->admin_id. '.' . $trade_image->getClientOriginalExtension();
            Image::make( $trade_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_trade_license/' . $filename_nid_back ) );
            $user->trade_license_image = $filename_nid_back;
            }
            
            $user->password = Hash::make( $request['password'] );
            $user->save();
        }
    
        return back();
    }else if(Auth::user()->country_code==+91){
        $id = Auth::user()->id;
        $user = User::find( $id );
        //    echo $request->password;
        if ( $request->password == NULL ) {
            $user->name = $request->input( 'name' );
            
            $user->father_name = $request->input( 'father_name' );
            $user->mother_name = $request->input( 'mother_name' );
            $user->present_address = $request->input( 'present_address' );
            $user->permanent_address = $request->input( 'permanent_address' );
            // $user->nid_front_image = $request->input( 'nid_front_image' );
            // $user->nid_back_image = $request->input( 'nid_back_image' );
            // $user->trade_license_image = $request->input( 'trade_license_image' );
            $user->office_location = $request->input( 'office_location' );
            
            if ( $request->hasFile( 'image') ) {
                //image
                $image = $request->file( 'image' );
                $filename ='ind'.$request->admin_id. '.' . $image->getClientOriginalExtension();
                Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_profile_image/' . $filename ) );
                $user->image = $filename;
            }
            if($request->hasFile( 'office_picture')){
                 //office image
                 $office_image = $request->file( 'office_picture' );
                 $filename_office ='ind'.$request->admin_id. '.' . $office_image->getClientOriginalExtension();
                 Image::make( $office_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_office/' . $filename_office ) );
                 $user->office_picture = $filename_office;
            }
            if($request->hasFile( 'nid_front_image')){
                //office image
                $nid_image = $request->file( 'nid_front_image' );
                $filename_nid_front ='ind'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
                Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_front/' . $filename_nid_front ) );
                $user->nid_front_image = $filename_nid_front;
           }
             if($request->hasFile( 'nid_back_image')){
            //office image
            $nid_image = $request->file( 'nid_back_image' );
            $filename_nid_back ='ind'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
            Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_back/' . $filename_nid_back ) );
            $user->nid_back_image = $filename_nid_back;
            }
             if($request->hasFile( 'trade_license_image')){
                //office image
                $trade_image = $request->file( 'trade_license_image' );
                $filename_nid_back ='ind'.$request->admin_id. '.' . $trade_image->getClientOriginalExtension();
                Image::make( $trade_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_trade_license/' . $filename_nid_back ) );
                $user->trade_license_image = $filename_nid_back;
                }
                
      
            $user->save();
        } else {
            $user->name = $request->input( 'name' );
            
            $user->father_name = $request->input( 'father_name' );
            $user->mother_name = $request->input( 'mother_name' );
            $user->present_address = $request->input( 'present_address' );
            $user->permanent_address = $request->input( 'permanent_address' );
            // $user->nid_front_image = $request->input( 'nid_front_image' );
            // $user->nid_back_image = $request->input( 'nid_back_image' );
            // $user->trade_license_image = $request->input( 'trade_license_image' );
            $user->office_location = $request->input( 'office_location' );
            
            if ( $request->hasFile( 'image') ) {
                //image
                $image = $request->file( 'image' );
                $filename ='ind'.$request->admin_id. '.' . $image->getClientOriginalExtension();
                Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_profile_image/' . $filename ) );
                $user->image = $filename;
              
            }
            if($request->hasFile( 'office_picture')){
                //office image
                $office_image = $request->file( 'office_picture' );
                $filename_office ='ind'.$request->admin_id. '.' . $office_image->getClientOriginalExtension();
                Image::make( $office_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_office/' . $filename_office ) );
                $user->office_picture = $filename_office;
           }
           if($request->hasFile( 'nid_front_image')){
            //office image
            $nid_image = $request->file( 'nid_front_image' );
            $filename_nid_front ='ind'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
            Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_front/' . $filename_nid_front ) );
            $user->nid_front_image = $filename_nid_front;
       }
         if($request->hasFile( 'nid_back_image')){
        //office image
        $nid_image = $request->file( 'nid_back_image' );
        $filename_nid_back ='ind'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
        Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_back/' . $filename_nid_back ) );
        $user->nid_back_image = $filename_nid_back;
        }
         if($request->hasFile( 'trade_license_image')){
            //office image
            $trade_image = $request->file( 'trade_license_image' );
            $filename_nid_back ='ind'.$request->admin_id. '.' . $trade_image->getClientOriginalExtension();
            Image::make( $trade_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_trade_license/' . $filename_nid_back ) );
            $user->trade_license_image = $filename_nid_back;
            }
            
            $user->password = Hash::make( $request['password'] );
            $user->save();
        }
    
        return back();
    }else if(Auth::user()->country_code==+92){

        $id = Auth::user()->id;
        $user = User::find( $id );
        //    echo $request->password;
        if ( $request->password == NULL ) {
            $user->name = $request->input( 'name' );
            
            $user->father_name = $request->input( 'father_name' );
            $user->mother_name = $request->input( 'mother_name' );
            $user->present_address = $request->input( 'present_address' );
            $user->permanent_address = $request->input( 'permanent_address' );
            // $user->nid_front_image = $request->input( 'nid_front_image' );
            // $user->nid_back_image = $request->input( 'nid_back_image' );
            // $user->trade_license_image = $request->input( 'trade_license_image' );
            $user->office_location = $request->input( 'office_location' );
            
            if ( $request->hasFile( 'image') ) {
                //image
                $image = $request->file( 'image' );
                $filename ='pak'.$request->admin_id. '.' . $image->getClientOriginalExtension();
                Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_profile_image/' . $filename ) );
                $user->image = $filename;
            }
            if($request->hasFile( 'office_picture')){
                 //office image
                 $office_image = $request->file( 'office_picture' );
                 $filename_office ='pak'.$request->admin_id. '.' . $office_image->getClientOriginalExtension();
                 Image::make( $office_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_office/' . $filename_office ) );
                 $user->office_picture = $filename_office;
            }
            if($request->hasFile( 'nid_front_image')){
                //office image
                $nid_image = $request->file( 'nid_front_image' );
                $filename_nid_front ='pak'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
                Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_front/' . $filename_nid_front ) );
                $user->nid_front_image = $filename_nid_front;
           }
             if($request->hasFile( 'nid_back_image')){
            //office image
            $nid_image = $request->file( 'nid_back_image' );
            $filename_nid_back ='pak'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
            Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_back/' . $filename_nid_back ) );
            $user->nid_back_image = $filename_nid_back;
            }
             if($request->hasFile( 'trade_license_image')){
                //office image
                $trade_image = $request->file( 'trade_license_image' );
                $filename_nid_back ='pak'.$request->admin_id. '.' . $trade_image->getClientOriginalExtension();
                Image::make( $trade_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_trade_license/' . $filename_nid_back ) );
                $user->trade_license_image = $filename_nid_back;
                }
                
      
            $user->save();
        } else {
            $user->name = $request->input( 'name' );
            
            $user->father_name = $request->input( 'father_name' );
            $user->mother_name = $request->input( 'mother_name' );
            $user->present_address = $request->input( 'present_address' );
            $user->permanent_address = $request->input( 'permanent_address' );
            // $user->nid_front_image = $request->input( 'nid_front_image' );
            // $user->nid_back_image = $request->input( 'nid_back_image' );
            // $user->trade_license_image = $request->input( 'trade_license_image' );
            $user->office_location = $request->input( 'office_location' );
            
            if ( $request->hasFile( 'image') ) {
                //image
                $image = $request->file( 'image' );
                $filename ='pak'.$request->admin_id. '.' . $image->getClientOriginalExtension();
                Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_profile_image/' . $filename ) );
                $user->image = $filename;
              
            }
            if($request->hasFile( 'office_picture')){
                //office image
                $office_image = $request->file( 'office_picture' );
                $filename_office ='pak'.$request->admin_id. '.' . $office_image->getClientOriginalExtension();
                Image::make( $office_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_office/' . $filename_office ) );
                $user->office_picture = $filename_office;
           }
           if($request->hasFile( 'nid_front_image')){
            //office image
            $nid_image = $request->file( 'nid_front_image' );
            $filename_nid_front ='pak'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
            Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_front/' . $filename_nid_front ) );
            $user->nid_front_image = $filename_nid_front;
       }
         if($request->hasFile( 'nid_back_image')){
        //office image
        $nid_image = $request->file( 'nid_back_image' );
        $filename_nid_back ='pak'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
        Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_back/' . $filename_nid_back ) );
        $user->nid_back_image = $filename_nid_back;
        }
         if($request->hasFile( 'trade_license_image')){
            //office image
            $trade_image = $request->file( 'trade_license_image' );
            $filename_nid_back ='pak'.$request->admin_id. '.' . $trade_image->getClientOriginalExtension();
            Image::make( $trade_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_trade_license/' . $filename_nid_back ) );
            $user->trade_license_image = $filename_nid_back;
            }
            
            $user->password = Hash::make( $request['password'] );
            $user->save();
        }
    
        return back();
    }
    else if(Auth::user()->country_code==+65){

        $id = Auth::user()->id;
        $user = User::find( $id );
        //    echo $request->password;
        if ( $request->password == NULL ) {
            $user->name = $request->input( 'name' );
            
            $user->father_name = $request->input( 'father_name' );
            $user->mother_name = $request->input( 'mother_name' );
            $user->present_address = $request->input( 'present_address' );
            $user->permanent_address = $request->input( 'permanent_address' );
            // $user->nid_front_image = $request->input( 'nid_front_image' );
            // $user->nid_back_image = $request->input( 'nid_back_image' );
            // $user->trade_license_image = $request->input( 'trade_license_image' );
            $user->office_location = $request->input( 'office_location' );
            
            if ( $request->hasFile( 'image') ) {
                //image
                $image = $request->file( 'image' );
                $filename ='singapore'.$request->admin_id. '.' . $image->getClientOriginalExtension();
                Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_profile_image/' . $filename ) );
                $user->image = $filename;
            }
            if($request->hasFile( 'office_picture')){
                 //office image
                 $office_image = $request->file( 'office_picture' );
                 $filename_office ='singapore'.$request->admin_id. '.' . $office_image->getClientOriginalExtension();
                 Image::make( $office_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_office/' . $filename_office ) );
                 $user->office_picture = $filename_office;
            }
            if($request->hasFile( 'nid_front_image')){
                //office image
                $nid_image = $request->file( 'nid_front_image' );
                $filename_nid_front ='singapore'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
                Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_front/' . $filename_nid_front ) );
                $user->nid_front_image = $filename_nid_front;
           }
             if($request->hasFile( 'nid_back_image')){
            //office image
            $nid_image = $request->file( 'nid_back_image' );
            $filename_nid_back ='singapore'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
            Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_back/' . $filename_nid_back ) );
            $user->nid_back_image = $filename_nid_back;
            }
             if($request->hasFile( 'trade_license_image')){
                //office image
                $trade_image = $request->file( 'trade_license_image' );
                $filename_nid_back ='singapore'.$request->admin_id. '.' . $trade_image->getClientOriginalExtension();
                Image::make( $trade_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_trade_license/' . $filename_nid_back ) );
                $user->trade_license_image = $filename_nid_back;
                }
                
      
            $user->save();
        } else {
            $user->name = $request->input( 'name' );
            
            $user->father_name = $request->input( 'father_name' );
            $user->mother_name = $request->input( 'mother_name' );
            $user->present_address = $request->input( 'present_address' );
            $user->permanent_address = $request->input( 'permanent_address' );
            // $user->nid_front_image = $request->input( 'nid_front_image' );
            // $user->nid_back_image = $request->input( 'nid_back_image' );
            // $user->trade_license_image = $request->input( 'trade_license_image' );
            $user->office_location = $request->input( 'office_location' );
            
            if ( $request->hasFile( 'image') ) {
                //image
                $image = $request->file( 'image' );
                $filename ='singapore'.$request->admin_id. '.' . $image->getClientOriginalExtension();
                Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_profile_image/' . $filename ) );
                $user->image = $filename;
              
            }
            if($request->hasFile( 'office_picture')){
                //office image
                $office_image = $request->file( 'office_picture' );
                $filename_office ='singapore'.$request->admin_id. '.' . $office_image->getClientOriginalExtension();
                Image::make( $office_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_office/' . $filename_office ) );
                $user->office_picture = $filename_office;
           }
           if($request->hasFile( 'nid_front_image')){
            //office image
            $nid_image = $request->file( 'nid_front_image' );
            $filename_nid_front ='singapore'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
            Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_front/' . $filename_nid_front ) );
            $user->nid_front_image = $filename_nid_front;
       }
         if($request->hasFile( 'nid_back_image')){
        //office image
        $nid_image = $request->file( 'nid_back_image' );
        $filename_nid_back ='singapore'.$request->admin_id. '.' . $nid_image->getClientOriginalExtension();
        Image::make( $nid_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_nid_back/' . $filename_nid_back ) );
        $user->nid_back_image = $filename_nid_back;
        }
         if($request->hasFile( 'trade_license_image')){
            //office image
            $trade_image = $request->file( 'trade_license_image' );
            $filename_nid_back ='singapore'.$request->admin_id. '.' . $trade_image->getClientOriginalExtension();
            Image::make( $trade_image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_image/bd_trade_license/' . $filename_nid_back ) );
            $user->trade_license_image = $filename_nid_back;
            }
            
            $user->password = Hash::make( $request['password'] );
            $user->save();
        }
    
        return back();
    }else{

    }
}
public function AgentVerified(){

    if(Auth::user()->country_code==+880){
        $total_traveller=BDTraveller::Where('agent_verification',NULL)->orWhere('agent_verification','')->get();
        $total_service=BDService::all();
        
         return view('agent.pages.All_Traveller.BD_Traveller',compact('total_traveller','total_service'));


    }elseif(Auth::user()->country_code==+91){
       
        $total_traveller=INDTraveller::Where('agent_verification',NULL)->orWhere('agent_verification','')->get();
        $total_service=INDService::all();
        
         return view('agent.pages.All_Traveller.BD_Traveller',compact('total_traveller','total_service'));
        
    }elseif(Auth::user()->country_code==+92){
        $total_traveller=PakTraveller::Where('agent_verification',NULL)->orWhere('agent_verification','')->get();
        $total_service=PakService::all();
        
         return view('agent.pages.All_Traveller.BD_Traveller',compact('total_traveller','total_service'));
        
    }elseif(Auth::user()->country_code==+65){
        $total_traveller=SingaporeTraveller::Where('agent_verification',NULL)->orWhere('agent_verification','')->get();
        $total_service=SingaporeService::all();
        
         return view('agent.pages.All_Traveller.BD_Traveller',compact('total_traveller','total_service'));
        
    }

}
public function AgentTravelVerifing($traveller_id){

    if(Auth::user()->country_code==+880){

        $traveller_info = BDTraveller::find( $traveller_id );
        return view('agent.pages.All_Traveller.traveller_verification',compact('traveller_info'));


    }elseif(Auth::user()->country_code==+91){
     
        $traveller_info = INDTraveller::find( $traveller_id );
        return view('agent.pages.All_Traveller.traveller_verification',compact('traveller_info'));

    }elseif(Auth::user()->country_code==+92){
        
        $traveller_info = PakTraveller::find( $traveller_id );
        return view('agent.pages.All_Traveller.traveller_verification',compact('traveller_info'));

    }elseif(Auth::user()->country_code==+65){

        $traveller_info = SingaporeTraveller::find( $traveller_id );
        return view('agent.pages.All_Traveller.traveller_verification',compact('traveller_info'));

    }
   

}

public function AgentVerifiedUser(Request $request){
    if(Auth::user()->country_code==+880){
     


        $request->validate([
            'document_pdf' => 'required|mimes:pdf,jpeg,bmp,png,doc,docx,csv,xlsx|max:20000',
        ]);
    
       $verified=New BdAgentVerified();

            $verified->agent_id=$request->input( 'agent_id' );
            $verified->traveller_id=$request->input( 'traveller_id' );


        if($request->hasFile( 'agent_with_traveller_selfie')){
            //office image
            $image = $request->file( 'agent_with_traveller_selfie' );
            $filename =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_verified_image/bd_image/' . $filename ) );
            $verified->agent_with_traveller_selfie = $filename;
            }
            
          if($request->hasFile( 'document_pdf')){
               //office image
               $image = $request->file( 'document_pdf' );
               $fileName =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            //    Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_document/bd_document/' . $filename ) );
               $request->document_pdf->move(public_path('Admin_image/agent_document/bd_document/'), $fileName);
               $verified->document_pdf = $fileName;
            }
       $verified->save();
       return redirect()->route('agentverified');
       

    }elseif(Auth::user()->country_code==+91){
     


        $request->validate([
            'document_pdf' => 'required|mimes:pdf,jpeg,bmp,png,doc,docx,csv,xlsx|max:20000',
        ]);
    
       $verified=New IndAgentVerified();

            $verified->agent_id=$request->input( 'agent_id' );
              $verified->traveller_id=$request->input( 'traveller_id' );
      
    
    
        if($request->hasFile( 'agent_with_traveller_selfie')){
            //office image
            $image = $request->file( 'agent_with_traveller_selfie' );
            $filename =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_verified_image/ind_image/' . $filename ) );
            $verified->agent_with_traveller_selfie = $filename;
            }
            
          if($request->hasFile( 'document_pdf')){
    
               //office image
               $image = $request->file( 'document_pdf' );
               $fileName =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            //    Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_document/bd_document/' . $filename ) );
               $request->document_pdf->move(public_path('Admin_image/agent_document/ind_document/'), $fileName);
               $verified->document_pdf = $fileName;
    
            }
       $verified->save();
       return redirect()->route('agentverified');
       
        
    }elseif(Auth::user()->country_code==+92){



        $request->validate([
            'document_pdf' => 'required|mimes:pdf,jpeg,bmp,png,doc,docx,csv,xlsx|max:20000',
        ]);
    
       $verified=New PakAgentVerified();

            $verified->agent_id=$request->input( 'agent_id' );
              $verified->traveller_id=$request->input( 'traveller_id' );
      
    
    
        if($request->hasFile( 'agent_with_traveller_selfie')){
            //office image
            $image = $request->file( 'agent_with_traveller_selfie' );
            $filename =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_verified_image/pak_image/' . $filename ) );
            $verified->agent_with_traveller_selfie = $filename;
            }
            
          if($request->hasFile( 'document_pdf')){
    
               //office image
               $image = $request->file( 'document_pdf' );
               $fileName =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            //    Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_document/bd_document/' . $filename ) );
               $request->document_pdf->move(public_path('Admin_image/agent_document/pak_document/'), $fileName);
               $verified->document_pdf = $fileName;
    
            }
       $verified->save();
       return redirect()->route('agentverified');
       
    }elseif(Auth::user()->country_code==+65){



        $request->validate([
            'document_pdf' => 'required|mimes:pdf,jpeg,bmp,png,doc,docx,csv,xlsx|max:20000',
        ]);
    
       $verified=New SingaporeAgentVerified();

            $verified->agent_id=$request->input( 'agent_id' );
              $verified->traveller_id=$request->input( 'traveller_id' );
      
    
    
        if($request->hasFile( 'agent_with_traveller_selfie')){
            //office image
            $image = $request->file( 'agent_with_traveller_selfie' );
            $filename =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_verified_image/singapore_image/' . $filename ) );
            $verified->agent_with_traveller_selfie = $filename;
            }
            
          if($request->hasFile( 'document_pdf')){
    
               //office image
               $image = $request->file( 'document_pdf' );
               $fileName =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            //    Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_document/bd_document/' . $filename ) );
               $request->document_pdf->move(public_path('Admin_image/agent_document/singapore_document/'), $fileName);
               $verified->document_pdf = $fileName;
    
            }
       $verified->save();
       return redirect()->route('agentverified');
       
    }
   

}

public function ViewsUserVerification(){
if(Auth::user()->country_code==+880){
    $verification_info=BdAgentVerified::where('agent_id',Auth::user()->id)->get();
    return view('agent.pages.All_Traveller.all_views_verification',compact('verification_info'));
}elseif(Auth::user()->country_code==+91){
    $verification_info=IndAgentVerified::where('agent_id',Auth::user()->id)->get();
    return view('agent.pages.All_Traveller.all_views_verification',compact('verification_info'));
}elseif(Auth::user()->country_code==+92){
    $verification_info=PakAgentVerified::where('agent_id',Auth::user()->id)->get();
    return view('agent.pages.All_Traveller.all_views_verification',compact('verification_info'));
}elseif(Auth::user()->country_code==+65){
    $verification_info=SingaporeAgentVerified::where('agent_id',Auth::user()->id)->get();
    return view('agent.pages.All_Traveller.all_views_verification',compact('verification_info'));
}
  
    
}


public function AgentVerified_user($verified_id){
    if(Auth::user()->country_code==+880){
        $agent_pdf=BdAgentVerified::find($verified_id);
    
        return view('agent.pages.All_Traveller.views_verification',compact('agent_pdf'));
    }elseif(Auth::user()->country_code==+91){
        $agent_pdf=IndAgentVerified::find($verified_id);
    
        return view('agent.pages.All_Traveller.ind_views_verification',compact('agent_pdf'));
    }elseif(Auth::user()->country_code==+92){
        $agent_pdf=PakAgentVerified::find($verified_id);
    
        return view('agent.pages.All_Traveller.pak_views_verification',compact('agent_pdf'));
    }elseif(Auth::user()->country_code==+65){
        $agent_pdf=SingaporeAgentVerified::find($verified_id);
    
        return view('agent.pages.All_Traveller.singapore_views_verification',compact('agent_pdf'));
    }

}

public function AgentVerifiedUpdate($verified_id){
    if(Auth::user()->country_code==+880){
        $agent_pdf=BdAgentVerified::find($verified_id);
    
        return view('agent.pages.All_Traveller.edit_verification',compact('agent_pdf'));
    }elseif(Auth::user()->country_code==+91){
        $agent_pdf=IndAgentVerified::find($verified_id);
    
        return view('agent.pages.All_Traveller.ind_edit_verification',compact('agent_pdf'));
    }elseif(Auth::user()->country_code==+92){
        $agent_pdf=PakAgentVerified::find($verified_id);
    
        return view('agent.pages.All_Traveller.pak_edit_verification',compact('agent_pdf'));
    }elseif(Auth::user()->country_code==+65){
        $agent_pdf=SingaporeAgentVerified::find($verified_id);
    
        return view('agent.pages.All_Traveller.singapore_edit_verification',compact('agent_pdf'));
    }
  
}


public function AgentVerifiedUpdatesave(Request $request){
    if(Auth::user()->country_code==+880){
     


        $request->validate([
            'document_pdf' => 'required|mimes:pdf,jpeg,bmp,png,doc,docx,csv,xlsx|max:20000',
        ]);
    
       $verified=BdAgentVerified::find($request->verified_id);

              $verified->agent_id=$request->input( 'agent_id' );
              $verified->traveller_id=$request->input( 'traveller_id' );
      
    
    
        if($request->hasFile( 'agent_with_traveller_selfie')){
            //office image
            $image = $request->file( 'agent_with_traveller_selfie' );
            $filename =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_verified_image/bd_image/' . $filename ) );
            $verified->agent_with_traveller_selfie = $filename;
            }
            
          if($request->hasFile( 'document_pdf')){
    
               //office image
               $image = $request->file( 'document_pdf' );
               $fileName =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            //    Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_document/bd_document/' . $filename ) );
               $request->document_pdf->move(public_path('Admin_image/agent_document/bd_document/'), $fileName);
               $verified->document_pdf = $fileName;
    
            }
       $verified->save();
       return redirect()->route('views_user_verification');
       

    }elseif(Auth::user()->country_code==+91){
     

        $request->validate([
            'document_pdf' => 'required|mimes:pdf,jpeg,bmp,png,doc,docx,csv,xlsx|max:20000',
        ]);
    
       $verified=IndAgentVerified::find($request->verified_id);

              $verified->agent_id=$request->input( 'agent_id' );
              $verified->traveller_id=$request->input( 'traveller_id' );
      
    
    
        if($request->hasFile( 'agent_with_traveller_selfie')){
            //office image
            $image = $request->file( 'agent_with_traveller_selfie' );
            $filename =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_verified_image/ind_image/' . $filename ) );
            $verified->agent_with_traveller_selfie = $filename;
            }
            
          if($request->hasFile( 'document_pdf')){
    
               //office image
               $image = $request->file( 'document_pdf' );
               $fileName =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            //    Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_document/bd_document/' . $filename ) );
               $request->document_pdf->move(public_path('Admin_image/agent_document/ind_document/'), $fileName);
               $verified->document_pdf = $fileName;
    
            }
       $verified->save();
       return redirect()->route('views_user_verification');
        
    }elseif(Auth::user()->country_code==+92){


        $request->validate([
            'document_pdf' => 'required|mimes:pdf,jpeg,bmp,png,doc,docx,csv,xlsx|max:20000',
        ]);
    
       $verified=PakAgentVerified::find($request->verified_id);

              $verified->agent_id=$request->input( 'agent_id' );
              $verified->traveller_id=$request->input( 'traveller_id' );
      
    
    
        if($request->hasFile( 'agent_with_traveller_selfie')){
            //office image
            $image = $request->file( 'agent_with_traveller_selfie' );
            $filename =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_verified_image/pak_image/' . $filename ) );
            $verified->agent_with_traveller_selfie = $filename;
            }
            
          if($request->hasFile( 'document_pdf')){
    
               //office image
               $image = $request->file( 'document_pdf' );
               $fileName =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            //    Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_document/bd_document/' . $filename ) );
               $request->document_pdf->move(public_path('Admin_image/agent_document/pak_document/'), $fileName);
               $verified->document_pdf = $fileName;
    
            }
       $verified->save();
       return redirect()->route('views_user_verification');
    }elseif(Auth::user()->country_code==+65){


        $request->validate([
            'document_pdf' => 'required|mimes:pdf,jpeg,bmp,png,doc,docx,csv,xlsx|max:20000',
        ]);
    
       $verified=SingaporeAgentVerified::find($request->verified_id);

              $verified->agent_id=$request->input( 'agent_id' );
              $verified->traveller_id=$request->input( 'traveller_id' );
      
    
    
        if($request->hasFile( 'agent_with_traveller_selfie')){
            //office image
            $image = $request->file( 'agent_with_traveller_selfie' );
            $filename =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_verified_image/singapore_image/' . $filename ) );
            $verified->agent_with_traveller_selfie = $filename;
            }
            
          if($request->hasFile( 'document_pdf')){
    
               //office image
               $image = $request->file( 'document_pdf' );
               $fileName =$request->traveller_id. '.' . $image->getClientOriginalExtension();
            //    Image::make( $image )->resize( 400, 500 )->save( public_path( 'Admin_image/agent_document/bd_document/' . $filename ) );
               $request->document_pdf->move(public_path('Admin_image/agent_document/singapore_document/'), $fileName);
               $verified->document_pdf = $fileName;
    
            }
       $verified->save();
       return redirect()->route('views_user_verification');
    }
   

}
 
}