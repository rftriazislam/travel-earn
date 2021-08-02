<?php

namespace App\Http\Controllers\Web;

use App\BDService;
use App\BDTraveller;
use App\INDTraveller;
use App\PakTraveller;
use App\SingaporeTraveller;
use App\User;
use App\BDUser;
use App\INDUser;
use App\INDService;
use App\PakUser;
use App\PakService;
use App\SingaporeUser;
use App\SingaporeService;
use App\BdAgentVerified;
use App\IndAgentVerified;
use App\PakAgentVerified;
use App\SingaporeAgentVerified;
use App\Balance;
use App\CompanyBalance;
use App\Http\Controllers\Controller;
use App\PenaltyCharge;
use Illuminate\Http\Request;
use App\Slider;
use Image;
use Auth;
use DB;
use Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $totol_bangladesh_User = BDUser::count('id');
        $total_india_User = INDUser::count('id');
        $total_pakistan_User = PakUser::count('id');
        $total_signgapur_User = SingaporeUser::count('id');
        $TotalUser = $totol_bangladesh_User + $total_india_User + $total_pakistan_User + $total_signgapur_User;

        $total_bangladesh_Traveller = BDTraveller::count('id');
        $total_india_Traveller = INDTraveller::count('id');
        $total_pakistan_Traveller = PakTraveller::count('id');
        $total_singapur_Traveller = SingaporeTraveller::count('id');
        $TotalTraveller = $total_bangladesh_Traveller + $total_india_Traveller + $total_pakistan_Traveller + $total_singapur_Traveller;


        return view('admin.pages.home', compact('TotalUser', 'TotalTraveller'));
    }

    //-------------------------------------------------------profile setting------------------------------------

    public function profilesetting()
    {
        return view('admin.pages.my_profile');
    }


    public function profileUpdate(Request $request)
    {


        $id = Auth::user()->id;
        $user = User::find($id);
        //    echo $request->password;
        if ($request->password == NULL) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $image_path = public_path() . '/Admin_image/admin/' . $request->admin_id . $image->getClientOriginalExtension();
                $filename = $request->admin_id . '.' . $image->getClientOriginalExtension();
                if ($image_path == $filename) {
                    unlink($image_path);
                    Image::make($image)->resize(400, 500)->save(public_path('Admin_image/admin/' . $filename));
                } else {
                    $image = $request->file('image');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    Image::make($image)->resize(400, 500)->save(public_path('Admin_image/admin/' . $filename));
                    $user->image = $filename;
                };

                $user->password = Hash::make($request['password']);
                $user->save();
            }

            return back();
        }
    }
    //--------------------------------------------------------proflie setting----------------------------------------


    //--------------------------------------------slider-------------------------------------

    public function slider()
    {

        $slider_info = Slider::all();
        return view('admin.pages.slider', compact('slider_info'));
    }
    public function slidersave(Request $request)
    {

        $request->validate([
            'slider_name' => 'required',
            'slider_title' => 'required',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2500',

        ]);

        $slider_add = new Slider();
        $slider_add->slider_name = $request->slider_name;
        $slider_add->slider_title = $request->slider_title;

        if ($file = $request->file("slider_image")) {
            $images = Image::canvas(2100, 1300);
            $image  = Image::make($file->getRealPath())->resize(2100, 1300, function ($constraint) {
                $constraint->aspectRatio();
            });

            $images->insert($image, 'center');
            $nameReplacer = time() . '.' . $file->getClientOriginalExtension();


            $images->save(public_path() . '/back_end/slider_image/' . $nameReplacer);

            $slider_add->slider_image = $nameReplacer;
        }


        $slider_add->save();

        return back()->with('message', 'Successfully save information.');
    }

    public function sliderstatus($status, $id)
    {
        $slider_info = Slider::find($id);
        if ($status == '0') {
            $slider_info->status = '1';
        } else {
            $slider_info->status = '0';
        }
        $slider_info->save();
        return back();
    }

    public function sliderdelete($id)
    {
        Slider::find($id)->delete();
        return back()->with('delete_message', 'Successfully delete information.');
    }
    public function slideredit($id)
    {
        $slideredit = Slider::find($id);
        $slider_info = Slider::all();
        return view('admin.pages.slideredit', compact('slider_info', 'slideredit'));
    }
    public function sliderupdate(Request $request)
    {
        $slider_update = Slider::find($request->slider_id);
        $slider_update->slider_name = $request->slider_name;
        $slider_update->slider_title = $request->slider_title;
        if ($file = $request->file("slider_image")) {
            $images = Image::canvas(2100, 1300);
            $image  = Image::make($file->getRealPath())->resize(2100, 1300, function ($constraint) {
                $constraint->aspectRatio();
            });

            $images->insert($image, 'center');
            $nameReplacer = $request->slider_id . '.' . $file->getClientOriginalExtension();

            $image_path = public_path() . '/back_end/slider_image/' . $request->slider_id . '.' . $file->getClientOriginalExtension();
            if ($nameReplacer == $image_path) {
                unlink($image_path);
            } else {
                $images->save(public_path() . '/back_end/slider_image/' . $nameReplacer);
            }
            $slider_update->slider_image = $nameReplacer;
        }

        $slider_update->save();

        return redirect('/admin-slider')->with('message', 'Successfully Update information.');
    }

    //--------------------------------------------------------------slider------------------------------------------------------------

    //----------------------------------------------------------------------------BD user------------------------------------------
    public function BDUser()
    {

        $total_user = BDUser::all();
        $total_service = BDService::all();
        return view('admin.All_User.BDUser', compact('total_user', 'total_service'));
    }


    public function BDUserDelete($user_id)
    {
        BDUser::where('id', $user_id)->delete();
        return back();
    }


    public function BDUserStatus($status, $user_id)
    {
        $BDUser_status = BDUser::find($user_id);
        if ($status == '0') {
            $BDUser_status->status = '1';
        } else {
            $BDUser_status->status = '0';
        }
        $BDUser_status->save();
        return back();
    }
    public function userinfo($user_id)
    {
        $bd_user_info = BDUser::find($user_id);
        $bd_service = BDService::where('user_id', $user_id)->get();
        $balance_history = Balance::where('user_id', $user_id)->get();
        return view('admin.All_User.bd_user_info', compact('bd_user_info', 'bd_service', 'balance_history'));
    }


    //----------------------------------------------------------------------------BD user------------------------------------------

    //----------------------------------------------------------------------------BD traveller------------------------------------------

    public function BDTraveller()
    {
        $total_traveller = BDTraveller::all();
        $total_service = BDService::all();

        return view('admin.All_Traveller.BD_Traveller', compact('total_traveller', 'total_service'));
    }

    public function BDTravellerDelete($traveller_id)
    {
        BDTraveller::where('id', $traveller_id)->delete();
        return back();
    }


    public function BDTravellerStatus($status, $traveller_id)
    {
        $BDTraveller_status = BDTraveller::find($traveller_id);
        if ($status == '0') {
            $BDTraveller_status->status = '1';
        } else {
            $BDTraveller_status->status = '0';
        }
        $BDTraveller_status->save();
        return back();
    }


    public function TravellerVerification($traveller_id)
    {

        $traveller_info = BDTraveller::find($traveller_id);

        return view('admin.All_Traveller.traveller_verification', compact('traveller_info'));
    }

    public function  BDNIDverified($traveller_id)
    {
        $NID_verified = BDTraveller::find($traveller_id);

        if ($NID_verified->NID_verification == NULL) {
            $NID_verified->NID_verification = 10;
            $total_percentage =  $NID_verified->total_verification_persentage + 10;

            $NID_verified->total_verification_persentage = $total_percentage;
        } else {
        }


        $NID_verified->save();
        return redirect()->route('BDTraveller');
    }

    public function  BDvideoverified($traveller_id)
    {
        $NID_verified = BDTraveller::find($traveller_id);

        if ($NID_verified->video_verification == NULL) {
            $NID_verified->video_verification = 10;
            $total_percentage = $NID_verified->total_verification_persentage + 10;

            $NID_verified->total_verification_persentage = $total_percentage;
        } else {
        }

        $NID_verified->save();
        return redirect()->route('BDTraveller');
    }

    public function  BDResidentverified($traveller_id)
    {
        $Resident_verified = BDTraveller::find($traveller_id);

        if ($Resident_verified->resident_verification == NULL) {
            $Resident_verified->resident_verification = 10;
            $total_percentage =  $Resident_verified->total_verification_persentage + 10;

            $Resident_verified->total_verification_persentage = $total_percentage;
        } else {
        }

        $Resident_verified->save();

        return redirect()->route('BDTraveller');
    }



    public function AgentVerified_traveller($country_code, $verified_id)
    {

        if ($country_code == +880) {
            $agent_pdf = BdAgentVerified::find($verified_id);

            return view('admin.All_Traveller.agent_verification', compact('agent_pdf'));
        } elseif ($country_code == +91) {
            $agent_pdf = IndAgentVerified::find($verified_id);

            return view('admin.All_Traveller.agent_verification', compact('agent_pdf'));
        } elseif ($country_code == +92) {
            $agent_pdf = PakAgentVerified::find($verified_id);

            return view('admin.All_Traveller.agent_verification', compact('agent_pdf'));
        } elseif ($country_code == +65) {
            $agent_pdf = SingaporeAgentVerified::find($verified_id);

            return view('admin.All_Traveller.agent_verification', compact('agent_pdf'));
        }
    }


    public function AgentVerified($country_code, $traveller_id)
    {
        if ($country_code == +880) {



            $agent_pdf = BdAgentVerified::where('traveller_id', $traveller_id)->first();
            $agent_pdf->status = 1;
            $agent_pdf->save();

            $traveller_info = BDTraveller::where('id', $traveller_id)->first();
            $traveller_info->agent_verification = 30;
            $traveller_info->total_verification_persentage = $traveller_info->total_verification_persentage + 30;
            $traveller_info->save();


            return redirect()->route('BDTraveller');
        } elseif ($country_code == +91) {

            $agent_pdf = IndAgentVerified::where('traveller_id', $traveller_id)->first();
            $agent_pdf->status = 1;
            $agent_pdf->save();

            $traveller_info = BDTraveller::where('id', $traveller_id)->first();
            $traveller_info->agent_verification = 30;
            $traveller_info->total_verification_persentage = $traveller_info->total_verification_persentage + 30;
            $traveller_info->save();
            return redirect()->route('BDTraveller');
        } elseif ($country_code == +92) {

            $agent_pdf = PakAgentVerified::where('traveller_id', $traveller_id)->first();
            $agent_pdf->status = 1;
            $agent_pdf->save();

            $traveller_info = BDTraveller::where('id', $traveller_id)->first();
            $traveller_info->agent_verification = 30;
            $traveller_info->total_verification_persentage = $traveller_info->total_verification_persentage + 30;
            $traveller_info->save();
            return view('admin.All_Traveller.agent_verification', compact('agent_pdf'));
        } elseif ($country_code == +65) {

            $agent_pdf = SingaporeAgentVerified::where('traveller_id', $traveller_id)->first();
            $agent_pdf->status = 1;
            $agent_pdf->save();

            $traveller_info = BDTraveller::where('id', $traveller_id)->first();
            $traveller_info->agent_verification = 30;
            $traveller_info->total_verification_persentage = $traveller_info->total_verification_persentage + 30;
            $traveller_info->save();
            return view('admin.All_Traveller.agent_verification', compact('agent_pdf'));
        }
    }




    //function
    //----------------------------------------------------------------------------BD Traveller------------------------------------------
    //----------------------------------------------------------------------------BD Agent------------------------------------------

    public function BDAgent()
    {
        $total_bd_agent = User::where('country_code', +880)->where('register_type', 'agent')->orderBy('id', 'DESC')->get();
        return view('admin.All_Agent.BD_Agent', compact('total_bd_agent'));
    }

    public function BDAgentDelete($user_id)
    {
        User::where('id', $user_id)->delete();
        return back();
    }


    public function BDAgentStatus($status, $user_id)
    {
        $BDAgentStatus = User::find($user_id);
        if ($status == '0') {
            $BDAgentStatus->status = '1';
        } else {
            $BDAgentStatus->status = '0';
        }
        $BDAgentStatus->save();

        return redirect()->route('BDAgent');
    }


    public function BDAgentinfo($user_id)
    {
        $agent_info = User::find($user_id);
        return view('admin.All_Agent.bd_agent_info', compact('agent_info'));
    }
    //----------------------------------------------------------------------------BD Agent------------------------------------------

    //------------------------------------------------------------------------------IND user------------------------------------------------------
    public function INDUser()
    {
        $total_user = INDUser::all();
        $total_service = INDService::all();
        return view('admin.All_User.INDUser', compact('total_user', 'total_service'));
    }

    public function IndUserDelete($user_id)
    {
        INDUser::where('id', $user_id)->delete();
        return back();
    }


    public function IndUserStatus($status, $user_id)
    {
        $INDUser_status = INDUser::find($user_id);
        if ($status == '0') {
            $INDUser_status->status = '1';
        } else {
            $INDUser_status->status = '0';
        }
        $INDUser_status->save();
        return back();
    }
    public function Induserinfo($user_id)
    {
        $ind_user_info = INDUser::find($user_id);
        $ind_service = INDService::where('user_id', $user_id)->get();
        return view('admin.All_User.ind_user_info', compact('ind_user_info', 'ind_service'));
    }

    //------------------------------------------------------------------------------IND user------------------------------------------------------

    //----------------------------------------------------------------------------IND traveller------------------------------------------

    public function INDTraveller()
    {
        $total_traveller = INDTraveller::all();
        $total_service = INDService::all();

        return view('admin.All_Traveller.IND_Traveller', compact('total_traveller', 'total_service'));
    }

    public function INDTravellerDelete($traveller_id)
    {
        INDTraveller::where('id', $traveller_id)->delete();
        return back();
    }


    public function INDTravellerStatus($status, $traveller_id)
    {
        $INDTraveller_status = INDTraveller::find($traveller_id);
        if ($status == '0') {
            $INDTraveller_status->status = '1';
        } else {
            $INDTraveller_status->status = '0';
        }
        $INDTraveller_status->save();
        return back();
    }


    public function INDTravellerVerification($traveller_id)
    {
        $traveller_info = INDTraveller::find($traveller_id);

        return view('admin.All_Traveller.traveller_verification', compact('traveller_info'));
    }

    public function  INDNIDverified($traveller_id)
    {
        $NID_verified = INDTraveller::find($traveller_id);

        if ($NID_verified->NID_verification == NULL) {
            $NID_verified->NID_verification = 10;
            $total_percentage =  $NID_verified->total_verification_persentage + 10;

            $NID_verified->total_verification_persentage = $total_percentage;
        } else {
        }


        $NID_verified->save();
        return redirect()->route('INDTraveller');
    }

    public function  INDvideoverified($traveller_id)
    {
        $NID_verified = INDTraveller::find($traveller_id);

        if ($NID_verified->video_verification == NULL) {
            $NID_verified->video_verification = 10;
            $total_percentage =  $NID_verified->total_verification_persentage + 10;

            $NID_verified->total_verification_persentage = $total_percentage;
        } else {
        }

        $NID_verified->save();
        return redirect()->route('INDTraveller');
    }

    public function  INDResidentverified($traveller_id)
    {
        $Resident_verified = INDTraveller::find($traveller_id);

        if ($Resident_verified->resident_verification == NULL) {
            $Resident_verified->resident_verification = 10;
            $total_percentage =  $Resident_verified->total_verification_persentage + 10;

            $Resident_verified->total_verification_persentage = $total_percentage;
        } else {
        }

        $Resident_verified->save();

        return redirect()->route('INDTraveller');
    }

    //----------------------------------------------------------------------------IND Traveller------------------------------------------
    //----------------------------------------------------------------------------IND Agent------------------------------------------

    public function INDAgent()
    {
        $total_ind_agent = User::where('country_code', +91)->where('register_type', 'agent')->orderBy('id', 'DESC')->get();
        return view('admin.All_Agent.IND_Agent', compact('total_ind_agent'));
    }

    public function INDAgentDelete($user_id)
    {
        User::where('id', $user_id)->delete();
        return back();
    }


    public function INDAgentStatus($status, $user_id)
    {
        $INDAgentStatus = User::find($user_id);
        if ($status == '0') {
            $INDAgentStatus->status = '1';
        } else {
            $INDAgentStatus->status = '0';
        }
        $INDAgentStatus->save();

        return redirect()->route('INDAgent');
    }


    public function INDAgentinfo($user_id)
    {
        $agent_info = User::find($user_id);
        return view('admin.All_Agent.ind_agent_info', compact('agent_info'));
    }
    //----------------------------------------------------------------------------IND Agent------------------------------------------

    //---------------------------------------------------------------------------------PAK-User-----------------------------------------------------------



    public function PAKUser()
    {
        $total_user = PakUser::all();
        $total_service = PakService::all();
        return view('admin.All_User.PAKUser', compact('total_user', 'total_service'));
    }

    public function PakUserDelete($user_id)
    {
        PakUser::where('id', $user_id)->delete();
        return back();
    }


    public function PakUserStatus($status, $user_id)
    {
        $pakUser_status = PakUser::find($user_id);
        if ($status == '0') {
            $pakUser_status->status = '1';
        } else {
            $pakUser_status->status = '0';
        }
        $pakUser_status->save();
        return back();
    }
    public function Pakuserinfo($user_id)
    {
        $pak_user_info = PakUser::find($user_id);
        $pak_service = PakService::where('user_id', $user_id)->get();
        return view('admin.All_User.pak_user_info', compact('pak_user_info', 'pak_service'));
    }

    //-----------------------------------------------------------------------------------------pak--User-------------------------------------------------

    //----------------------------------------------------------------------------Pak traveller------------------------------------------

    public function PakTraveller()
    {
        $total_traveller = PakTraveller::all();
        $total_service = PakService::all();

        return view('admin.All_Traveller.PAK_Traveller', compact('total_traveller', 'total_service'));
    }

    public function PakTravellerDelete($traveller_id)
    {
        PakTraveller::where('id', $traveller_id)->delete();
        return back();
    }


    public function PakTravellerStatus($status, $traveller_id)
    {
        $PakTraveller_status = PakTraveller::find($traveller_id);
        if ($status == '0') {
            $PakTraveller_status->status = '1';
        } else {
            $PakTraveller_status->status = '0';
        }
        $PakTraveller_status->save();
        return back();
    }


    public function PakTravellerVerification($traveller_id)
    {
        $traveller_info = PakTraveller::find($traveller_id);

        return view('admin.All_Traveller.traveller_verification', compact('traveller_info'));
    }

    public function  PakNIDverified($traveller_id)
    {
        $NID_verified = PakTraveller::find($traveller_id);

        if ($NID_verified->NID_verification == NULL) {
            $NID_verified->NID_verification = 10;
            $total_percentage =  $NID_verified->total_verification_persentage + 10;

            $NID_verified->total_verification_persentage = $total_percentage;
        } else {
        }


        $NID_verified->save();
        return redirect()->route('PAKTraveller');
    }

    public function  Pakvideoverified($traveller_id)
    {
        $NID_verified = PakTraveller::find($traveller_id);

        if ($NID_verified->video_verification == NULL) {
            $NID_verified->video_verification = 10;
            $total_percentage =  $NID_verified->total_verification_persentage + 10;

            $NID_verified->total_verification_persentage = $total_percentage;
        } else {
        }

        $NID_verified->save();
        return redirect()->route('PAKTraveller');
    }

    public function  PakResidentverified($traveller_id)
    {
        $Resident_verified = PakTraveller::find($traveller_id);

        if ($Resident_verified->resident_verification == NULL) {
            $Resident_verified->resident_verification = 10;
            $total_percentage =  $Resident_verified->total_verification_persentage + 10;

            $Resident_verified->total_verification_persentage = $total_percentage;
        } else {
        }

        $Resident_verified->save();

        return redirect()->route('PAKTraveller');
    }

    //----------------------------------------------------------------------------Pak raveller------------------------------------------
    //----------------------------------------------------------------------------PAK Agent------------------------------------------

    public function PAKAgent()
    {
        $total_pak_agent = User::where('country_code', +92)->where('register_type', 'agent')->orderBy('id', 'DESC')->get();
        return view('admin.All_Agent.PAK_Agent', compact('total_pak_agent'));
    }

    public function PAKAgentDelete($user_id)
    {
        User::where('id', $user_id)->delete();
        return back();
    }


    public function PAKAgentStatus($status, $user_id)
    {
        $PAKAgentStatus = User::find($user_id);
        if ($status == '0') {
            $PAKAgentStatus->status = '1';
        } else {
            $PAKAgentStatus->status = '0';
        }
        $PAKAgentStatus->save();

        return redirect()->route('PAKAgent');
    }


    public function PAKAgentinfo($user_id)
    {
        $agent_info = User::find($user_id);
        return view('admin.All_Agent.pak_agent_info', compact('agent_info'));
    }
    //----------------------------------------------------------------------------PAK Agent------------------------------------------

    //-------------------------------------------------------------------------------------------------------Singapore----------------------------------

    public function SingaporeUser()
    {
        $total_user = SingaporeUser::all();
        $total_service = SingaporeService::all();
        return view('admin.All_User.SingaporeUser', compact('total_user', 'total_service'));
    }

    public function SingaporeUserDelete($user_id)
    {
        SingaporeUser::where('id', $user_id)->delete();
        return back();
    }


    public function SingaporeUserStatus($status, $user_id)
    {
        $SingaporeUser_status = SingaporeUser::find($user_id);
        if ($status == '0') {
            $SingaporeUser_status->status = '1';
        } else {
            $SingaporeUser_status->status = '0';
        }
        $SingaporeUser_status->save();
        return back();
    }
    public function Singaporeuserinfo($user_id)
    {
        $singapore_user_info = SingaporeUser::find($user_id);
        $singapore_service = SingaporeService::where('user_id', $user_id)->get();
        return view('admin.All_User.singapore_user_info', compact('singapore_user_info', 'singapore_service'));
    }

    //-------------------------------------------------------------------------------------------------------Singapore----------------------------------



    //----------------------------------------------------------------------------Singapore traveller------------------------------------------

    public function SingaporeTraveller()
    {
        $total_traveller = SingaporeTraveller::all();
        $total_service = SingaporeService::all();

        return view('admin.All_Traveller.Singapore_Traveller', compact('total_traveller', 'total_service'));
    }

    public function SingaporeTravellerDelete($traveller_id)
    {
        SingaporeTraveller::where('id', $traveller_id)->delete();
        return back();
    }


    public function SingaporeTravellerStatus($status, $traveller_id)
    {
        $SingaporeTraveller_status = SingaporeTraveller::find($traveller_id);
        if ($status == '0') {
            $SingaporeTraveller_status->status = '1';
        } else {
            $SingaporeTraveller_status->status = '0';
        }
        $SingaporeTraveller_status->save();
        return back();
    }


    public function SingaporeTravellerVerification($traveller_id)
    {
        $traveller_info = SingaporeTraveller::find($traveller_id);

        return view('admin.All_Traveller.traveller_verification', compact('traveller_info'));
    }

    public function  SingaporeNIDverified($traveller_id)
    {
        $NID_verified = SingaporeTraveller::find($traveller_id);

        if ($NID_verified->NID_verification == NULL) {
            $NID_verified->NID_verification = 10;
            $total_percentage =  $NID_verified->total_verification_persentage + 10;

            $NID_verified->total_verification_persentage = $total_percentage;
        } else {
        }


        $NID_verified->save();
        return redirect()->route('singaporeTraveller');
    }

    public function  Singaporevideoverified($traveller_id)
    {
        $NID_verified = SingaporeTraveller::find($traveller_id);

        if ($NID_verified->video_verification == NULL) {
            $NID_verified->video_verification = 10;
            $total_percentage =  $NID_verified->total_verification_persentage + 10;

            $NID_verified->total_verification_persentage = $total_percentage;
        } else {
        }

        $NID_verified->save();
        return redirect()->route('singaporeTraveller');
    }

    public function  SingaporeResidentverified($traveller_id)
    {
        $Resident_verified = SingaporeTraveller::find($traveller_id);

        if ($Resident_verified->resident_verification == NULL) {
            $Resident_verified->resident_verification = 10;
            $total_percentage =  $Resident_verified->total_verification_persentage + 10;

            $Resident_verified->total_verification_persentage = $total_percentage;
        } else {
        }

        $Resident_verified->save();

        return redirect()->route('singaporeTraveller');
    }

    //----------------------------------------------------------------------------Singapore raveller------------------------------------------

    //----------------------------------------------------------------------------Singapore Agent------------------------------------------

    public function SingaporeAgent()
    {
        $total_singapore_agent = User::where('country_code', +65)->where('register_type', 'agent')->orderBy('id', 'DESC')->get();
        return view('admin.All_Agent.Singapore_Agent', compact('total_singapore_agent'));
    }

    public function SingaporeAgentDelete($user_id)
    {
        User::where('id', $user_id)->delete();
        return back();
    }


    public function SingaporeAgentStatus($status, $user_id)
    {
        $SingaporeAgentStatus = User::find($user_id);
        if ($status == '0') {
            $SingaporeAgentStatus->status = '1';
        } else {
            $SingaporeAgentStatus->status = '0';
        }
        $SingaporeAgentStatus->save();

        return redirect()->route('SingaporeAgent');
    }


    public function SingaporeAgentinfo($user_id)
    {
        $agent_info = User::find($user_id);
        return view('admin.All_Agent.singapore_agent_info', compact('agent_info'));
    }
    //----------------------------------------------------------------------------Singapore Agent------------------------------------------

    //----------------------------------------------------------------------------Balance ----------------------------------------


    public function SaveBalance(Request $request)
    {

        $save_balance = new Balance();
        $save_balance->user_id = $request->user_id;
        $save_balance->amount = $request->amount;
        $save_balance->trxid = $request->trxid;
        $save_balance->account_number = $request->account_number;
        $save_balance->balance_type = $request->balance_type;
        if ($save_balance->save()) {
            $user_info = BDUser::where('id', $request->user_id)->first();
            if ($request->balance_type == 'drop balance') {
                $user_info->update([
                    $user_info->drop_balance = $user_info->drop_balance + $request->amount,
                ]);
            } else if ($request->balance_type == 'product balance') {
                $user_info->update([
                    $user_info->product_balance = $user_info->product_balance + $request->amount,
                ]);
            }
            $url = '/admin-bd-user-info/' . $request->user_id;
            return redirect($url)->with('message', 'Successful add Balance');
        } else {
            $url = '/admin-bd-user-info/' . $request->user_id;

            return redirect($url)->with('message', 'somthing wrong');
        }
    }
    //----------------------------------------------------------------------------Banalnce--------------------------------------

    //----------------------------------------------------------------DeliveryCharge----------------------------------------------
    public function adddelivery()
    {

        return view('admin.Balance.add_delivery_charge');
    }
    public function DeliveryChargeSave(Request $request)
    {
        if ($request->country_code == +880) {
            $currency = 'Taka';
        } elseif ($request->country_code == +91) {
            $currency = 'Rupee';
        } elseif ($request->country_code == +92) {
            $currency = 'Rupee';
        } elseif ($request->country_code == +65) {
            $currency = 'SGD';
        }
        DB::table('price_calculations')->insert([

            'country_code' => $request->country_code,
            'min_weight' => $request->min_weight,
            'max_weight' => $request->max_weight,
            'set_price' => $request->set_price,
            'default_price' => $request->default_price,
            'currency' => $currency,

        ]);
        return redirect()->route('deliverycharge');
    }
    public function DeliveryCharge()
    {
        $total_price = DB::table('price_calculations')->get();
        return view('admin.Balance.deliverycharge', compact('total_price'));
    }


    public function EditDeliveryCharge($id)
    {
        $edit_price = DB::table('price_calculations')->where('id', $id)->first();
        return view('admin.Balance.edit_delivery_charge', compact('edit_price'));
    }

    public function DeliveryChargeUpdate(Request $request)
    {
        if ($request->country_code == +880) {
            $currency = 'Taka';
        } elseif ($request->country_code == +91) {
            $currency = 'Rupee';
        } elseif ($request->country_code == +92) {
            $currency = 'Rupee';
        } elseif ($request->country_code == +65) {
            $currency = 'SGD';
        }

        DB::table('price_calculations')->where('id', $request->price_id)->update([

            'country_code' => $request->country_code,
            'min_weight' => $request->min_weight,
            'max_weight' => $request->max_weight,
            'set_price' => $request->set_price,
            'default_price' => $request->default_price,
            'currency' => $currency,

        ]);
        return redirect()->route('deliverycharge');
    }
    public function DeliveryChargeDelete($id)
    {
        DB::table('price_calculations')->where('id', $id)->delete();
        return back();
    }


    public function DeliveryChargeStatus($status, $id)
    {
        $Status = DB::table('price_calculations')->where('id', $id);
        if ($status == '0') {
            $Status->update(array('status' => 1));
        } else {
            $Status->update(array('status' => 0));
        }
        return redirect()->route('deliverycharge');
    }


    //----------------------------------------------------------------DeliveryCharge----------------------------------------------
    //-----------------------------------------------------------------Profite----------------------------------------------------
    public function Profite()
    {
        return view('admin.profite.profite');
    }



    public function total_balance()
    {
        $company_commission = CompanyBalance::sum('commission_price');
        $penalty_commission = PenaltyCharge::sum('company_commission');
        $total_commission = $company_commission + $penalty_commission;
        return view('admin.profite.totalbalance', compact('company_commission', 'penalty_commission', 'total_commission'));
    }
    //----------------------------------------------------------------Profite-----------------------------------------------------
}