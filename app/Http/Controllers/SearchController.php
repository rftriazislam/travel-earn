<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BDService;
use App\INDService;
use App\PakService;
use App\BDTraveller;
use App\SingaporeService;
use DB;

class SearchController extends Controller
 {


 public function getSearch( Request $request, $country_code) {

   

if($country_code==+880){

    $search = BDService::where( 'status', 1 )->get();
    $travel_start_point =[];
    $travel_end_point = [];
    $travel_all_point =[];
   
    foreach ( $search as $latitude ) {

        $lat1 = $request->travel_start_point_latitude;
        $lon1 = $request->travel_start_point_longitude;

if($lat1!=NULL&& $lon1!=NULL||$request->travel_end_point_latitude!=NULL&& $request->travel_end_point_longitude!=NULL){
        
        //------------------------------travel------start -----point----------------------------------------

        $lat2 = $latitude->travel_start_point_latitude ;
        $lon2 = $latitude->travel_start_point_longitude ;
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;
        $r = 6372.797;
        // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
        $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
        $km = $r * $c;
        // echo '<br/>'.$km;
        if ( $km <= 10 ) {
           if ( $request->starting_date != NULL ) {
               if( $request->starting_date ==$latitude->starting_date){
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
               }
               
            } else {
            //     $username = BDService::where( 'id', $latitude->id )->with('traveller')->with('user')
            //     ->OrderBy( 'id', 'Desc' )->get();
                
            //     $usernamee = BDService::where( 'id', $latitude->id )
            //     ->OrderBy( 'id', 'Desc' )->first();
              

            //    $results=  json_encode($username,JSON_FORCE_OBJECT);
               
            //    $r=str_replace(array('[', ']'), '', htmlspecialchars(json_encode($username), JSON_FORCE_OBJECT));
            //    $result=json_decode($r);

            //    $travel_start_point[] =$result;
            
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
                

               
            }

        }

        //------------------------------travel------end -----point----------------------------------------

        $lat1_end = $request->travel_end_point_latitude; //user request
        $lon1_end = $request->travel_end_point_longitude;
        $lat2_end = $latitude->travel_end_point_latitude; //database request
        $lon2_end = $latitude->travel_end_point_longitude ;
        $pi80_end = M_PI / 180;
        $lat1_end *= $pi80_end;
        $lon1_end  *= $pi80_end;
        $lat2_end = $lat2_end*$pi80_end;
        $lon2_end *= $pi80_end;
        $r_end = 6372.797;
        // mean radius of Earth in km
        $dlat_end = $lat2_end -$lat1_end;
        $dlon_end = $lon2_end -  $lon1_end ;
        $a_end = sin( $dlat_end / 2 ) * sin( $dlat_end / 2 ) + cos( $lat1_end ) * cos( $lat2_end ) * sin( $dlon_end / 2 ) * sin( $dlon_end / 2 );
        $c_end = 2 * atan2( sqrt( $a_end ), sqrt( 1 - $a_end ) );
        $km_end = $r_end * $c_end;

        if ( $km_end <= 10 ) {
           if ( $request->starting_date != NULL ) {
             
            if( $request->starting_date ==$latitude->starting_date){
                $travel_end_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km_end,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
               }
            } else {
              
                $travel_end_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km_end,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
            }

        }


        //-----------------------------------------4 data search----------------------------
        if ( $km <= 10 && $km_end <= 10 ) {

            if ( $request->starting_date != NULL ) {
                if( $request->starting_date ==$latitude->starting_date){
                    $travel_all_point[] =  array( 
                        'service_id' => $latitude->id,
                        'travel_start_point' => $latitude->travel_start_point,
                        'travel_end_point' => $latitude->travel_end_point,
                        'starting_date'=>$latitude->starting_date,
                        'ending_date'=>$latitude->ending_date,
                        'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                        'Distance'=>$km,
                        'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),
    
                    );
                   }
            } else {
                $travel_all_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
            }

        }

        //---------------------------starting date------------------------------------
    }
        elseif( $request->starting_date != NULL ){
            
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>null,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
             
        }


    }

    if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL && $request->travel_end_point_latitude != NULL && $request->travel_end_point_longitude != NULL ) {
        if ( $travel_all_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_all_point], 200 );
        }
    }  elseif ( $request->travel_end_point_latitude != NULL && $request->travel_end_point_longitude != NULL ) {

        if ( $travel_end_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_end_point], 200 );
        }
    }  elseif ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
        if ( $travel_start_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
          
           
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
        }
    } elseif($request->starting_date){
        if ( $travel_start_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
          
           
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
        }
    }
}elseif($country_code==+91){




    $search = INDService::all()->where( 'status', 1 );
    $travel_start_point =[];
    $travel_end_point = [];
    $travel_all_point =[];
   
    foreach ( $search as $latitude ) {

        $lat1 = $request->travel_start_point_latitude;
        $lon1 = $request->travel_start_point_longitude;

if($lat1!=NULL&& $lon1!=NULL||$request->travel_end_point_latitude!=NULL&& $request->travel_end_point_longitude!=NULL){
        
        //------------------------------travel------start -----point----------------------------------------

        $lat2 = $latitude->travel_start_point_latitude ;
        $lon2 = $latitude->travel_start_point_longitude ;
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;
        $r = 6372.797;
        // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
        $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
        $km = $r * $c;
        // echo '<br/>'.$km;
        if ( $km <= 10 ) {
           if ( $request->starting_date != NULL ) {
               if( $request->starting_date ==$latitude->starting_date){
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
               }
               
            } else {
            //     $username = BDService::where( 'id', $latitude->id )->with('traveller')->with('user')
            //     ->OrderBy( 'id', 'Desc' )->get();
                
            //     $usernamee = BDService::where( 'id', $latitude->id )
            //     ->OrderBy( 'id', 'Desc' )->first();
              

            //    $results=  json_encode($username,JSON_FORCE_OBJECT);
               
            //    $r=str_replace(array('[', ']'), '', htmlspecialchars(json_encode($username), JSON_FORCE_OBJECT));
            //    $result=json_decode($r);

            //    $travel_start_point[] =$result;
            
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
                

               
            }

        }

        //------------------------------travel------end -----point----------------------------------------

        $lat1_end = $request->travel_end_point_latitude; //user request
        $lon1_end = $request->travel_end_point_longitude;
        $lat2_end = $latitude->travel_end_point_latitude; //database request
        $lon2_end = $latitude->travel_end_point_longitude ;
        $pi80_end = M_PI / 180;
        $lat1_end *= $pi80_end;
        $lon1_end  *= $pi80_end;
        $lat2_end = $lat2_end*$pi80_end;
        $lon2_end *= $pi80_end;
        $r_end = 6372.797;
        // mean radius of Earth in km
        $dlat_end = $lat2_end -$lat1_end;
        $dlon_end = $lon2_end -  $lon1_end ;
        $a_end = sin( $dlat_end / 2 ) * sin( $dlat_end / 2 ) + cos( $lat1_end ) * cos( $lat2_end ) * sin( $dlon_end / 2 ) * sin( $dlon_end / 2 );
        $c_end = 2 * atan2( sqrt( $a_end ), sqrt( 1 - $a_end ) );
        $km_end = $r_end * $c_end;

        if ( $km_end <= 10 ) {
           if ( $request->starting_date != NULL ) {
             
            if( $request->starting_date ==$latitude->starting_date){
                $travel_end_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km_end,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
               }
            } else {
              
                $travel_end_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km_end,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
            }

        }


        //-----------------------------------------4 data search----------------------------
        if ( $km <= 10 && $km_end <= 10 ) {

            if ( $request->starting_date != NULL ) {
                if( $request->starting_date ==$latitude->starting_date){
                    $travel_all_point[] =  array( 
                        'service_id' => $latitude->id,
                        'travel_start_point' => $latitude->travel_start_point,
                        'travel_end_point' => $latitude->travel_end_point,
                        'starting_date'=>$latitude->starting_date,
                        'ending_date'=>$latitude->ending_date,
                        'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                        'Distance'=>$km,
                        'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),
    
                    );
                   }
            } else {
                $travel_all_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
            }

        }

        //---------------------------starting date------------------------------------
    }
        elseif( $request->starting_date != NULL ){
            
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>null,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
             
        }


    }

    if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL && $request->travel_end_point_latitude != NULL && $request->travel_end_point_longitude != NULL ) {
        if ( $travel_all_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_all_point], 200 );
        }
    }  elseif ( $request->travel_end_point_latitude != NULL && $request->travel_end_point_longitude != NULL ) {

        if ( $travel_end_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_end_point], 200 );
        }
    }  elseif ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
        if ( $travel_start_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
          
           
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
        }
    } elseif($request->starting_date){
        if ( $travel_start_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
          
           
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
        }
    }

}elseif($country_code==+92){
   


    $search = PakService::all()->where( 'status', 1 );
    $travel_start_point =[];
    $travel_end_point = [];
    $travel_all_point =[];
   
    foreach ( $search as $latitude ) {

        $lat1 = $request->travel_start_point_latitude;
        $lon1 = $request->travel_start_point_longitude;

if($lat1!=NULL&& $lon1!=NULL||$request->travel_end_point_latitude!=NULL&& $request->travel_end_point_longitude!=NULL){
        
        //------------------------------travel------start -----point----------------------------------------

        $lat2 = $latitude->travel_start_point_latitude ;
        $lon2 = $latitude->travel_start_point_longitude ;
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;
        $r = 6372.797;
        // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
        $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
        $km = $r * $c;
        // echo '<br/>'.$km;
        if ( $km <= 10 ) {
           if ( $request->starting_date != NULL ) {
               if( $request->starting_date ==$latitude->starting_date){
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
               }
               
            } else {
            //     $username = BDService::where( 'id', $latitude->id )->with('traveller')->with('user')
            //     ->OrderBy( 'id', 'Desc' )->get();
                
            //     $usernamee = BDService::where( 'id', $latitude->id )
            //     ->OrderBy( 'id', 'Desc' )->first();
              

            //    $results=  json_encode($username,JSON_FORCE_OBJECT);
               
            //    $r=str_replace(array('[', ']'), '', htmlspecialchars(json_encode($username), JSON_FORCE_OBJECT));
            //    $result=json_decode($r);

            //    $travel_start_point[] =$result;
            
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
                

               
            }

        }

        //------------------------------travel------end -----point----------------------------------------

        $lat1_end = $request->travel_end_point_latitude; //user request
        $lon1_end = $request->travel_end_point_longitude;
        $lat2_end = $latitude->travel_end_point_latitude; //database request
        $lon2_end = $latitude->travel_end_point_longitude ;
        $pi80_end = M_PI / 180;
        $lat1_end *= $pi80_end;
        $lon1_end  *= $pi80_end;
        $lat2_end = $lat2_end*$pi80_end;
        $lon2_end *= $pi80_end;
        $r_end = 6372.797;
        // mean radius of Earth in km
        $dlat_end = $lat2_end -$lat1_end;
        $dlon_end = $lon2_end -  $lon1_end ;
        $a_end = sin( $dlat_end / 2 ) * sin( $dlat_end / 2 ) + cos( $lat1_end ) * cos( $lat2_end ) * sin( $dlon_end / 2 ) * sin( $dlon_end / 2 );
        $c_end = 2 * atan2( sqrt( $a_end ), sqrt( 1 - $a_end ) );
        $km_end = $r_end * $c_end;

        if ( $km_end <= 10 ) {
           if ( $request->starting_date != NULL ) {
             
            if( $request->starting_date ==$latitude->starting_date){
                $travel_end_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km_end,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
               }
            } else {
              
                $travel_end_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km_end,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
            }

        }


        //-----------------------------------------4 data search----------------------------
        if ( $km <= 10 && $km_end <= 10 ) {

            if ( $request->starting_date != NULL ) {
                if( $request->starting_date ==$latitude->starting_date){
                    $travel_all_point[] =  array( 
                        'service_id' => $latitude->id,
                        'travel_start_point' => $latitude->travel_start_point,
                        'travel_end_point' => $latitude->travel_end_point,
                        'starting_date'=>$latitude->starting_date,
                        'ending_date'=>$latitude->ending_date,
                        'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                        'Distance'=>$km,
                        'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),
    
                    );
                   }
            } else {
                $travel_all_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
            }

        }

        //---------------------------starting date------------------------------------
    }
        elseif( $request->starting_date != NULL ){
            
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>null,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
             
        }


    }

    if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL && $request->travel_end_point_latitude != NULL && $request->travel_end_point_longitude != NULL ) {
        if ( $travel_all_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_all_point], 200 );
        }
    }  elseif ( $request->travel_end_point_latitude != NULL && $request->travel_end_point_longitude != NULL ) {

        if ( $travel_end_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_end_point], 200 );
        }
    }  elseif ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
        if ( $travel_start_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
          
           
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
        }
    } elseif($request->starting_date){
        if ( $travel_start_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
          
           
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
        }
    }
}elseif($country_code==+65){



    $search = SingaporeService::all()->where( 'status', 1 );
    $travel_start_point =[];
    $travel_end_point = [];
    $travel_all_point =[];
   
    foreach ( $search as $latitude ) {

        $lat1 = $request->travel_start_point_latitude;
        $lon1 = $request->travel_start_point_longitude;

if($lat1!=NULL&& $lon1!=NULL||$request->travel_end_point_latitude!=NULL&& $request->travel_end_point_longitude!=NULL){
        
        //------------------------------travel------start -----point----------------------------------------

        $lat2 = $latitude->travel_start_point_latitude ;
        $lon2 = $latitude->travel_start_point_longitude ;
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;
        $r = 6372.797;
        // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
        $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
        $km = $r * $c;
        // echo '<br/>'.$km;
        if ( $km <= 10 ) {
           if ( $request->starting_date != NULL ) {
               if( $request->starting_date ==$latitude->starting_date){
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
               }
               
            } else {
            //     $username = BDService::where( 'id', $latitude->id )->with('traveller')->with('user')
            //     ->OrderBy( 'id', 'Desc' )->get();
                
            //     $usernamee = BDService::where( 'id', $latitude->id )
            //     ->OrderBy( 'id', 'Desc' )->first();
              

            //    $results=  json_encode($username,JSON_FORCE_OBJECT);
               
            //    $r=str_replace(array('[', ']'), '', htmlspecialchars(json_encode($username), JSON_FORCE_OBJECT));
            //    $result=json_decode($r);

            //    $travel_start_point[] =$result;
            
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
                

               
            }

        }

        //------------------------------travel------end -----point----------------------------------------

        $lat1_end = $request->travel_end_point_latitude; //user request
        $lon1_end = $request->travel_end_point_longitude;
        $lat2_end = $latitude->travel_end_point_latitude; //database request
        $lon2_end = $latitude->travel_end_point_longitude ;
        $pi80_end = M_PI / 180;
        $lat1_end *= $pi80_end;
        $lon1_end  *= $pi80_end;
        $lat2_end = $lat2_end*$pi80_end;
        $lon2_end *= $pi80_end;
        $r_end = 6372.797;
        // mean radius of Earth in km
        $dlat_end = $lat2_end -$lat1_end;
        $dlon_end = $lon2_end -  $lon1_end ;
        $a_end = sin( $dlat_end / 2 ) * sin( $dlat_end / 2 ) + cos( $lat1_end ) * cos( $lat2_end ) * sin( $dlon_end / 2 ) * sin( $dlon_end / 2 );
        $c_end = 2 * atan2( sqrt( $a_end ), sqrt( 1 - $a_end ) );
        $km_end = $r_end * $c_end;

        if ( $km_end <= 10 ) {
           if ( $request->starting_date != NULL ) {
             
            if( $request->starting_date ==$latitude->starting_date){
                $travel_end_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km_end,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
               }
            } else {
              
                $travel_end_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km_end,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
            }

        }


        //-----------------------------------------4 data search----------------------------
        if ( $km <= 10 && $km_end <= 10 ) {

            if ( $request->starting_date != NULL ) {
                if( $request->starting_date ==$latitude->starting_date){
                    $travel_all_point[] =  array( 
                        'service_id' => $latitude->id,
                        'travel_start_point' => $latitude->travel_start_point,
                        'travel_end_point' => $latitude->travel_end_point,
                        'starting_date'=>$latitude->starting_date,
                        'ending_date'=>$latitude->ending_date,
                        'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                        'Distance'=>$km,
                        'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),
    
                    );
                   }
            } else {
                $travel_all_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>$km,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
            }

        }

        //---------------------------starting date------------------------------------
    }
        elseif( $request->starting_date != NULL ){
            
                $travel_start_point[] =  array( 
                    'service_id' => $latitude->id,
                    'travel_start_point' => $latitude->travel_start_point,
                    'travel_end_point' => $latitude->travel_end_point,
                    'starting_date'=>$latitude->starting_date,
                    'ending_date'=>$latitude->ending_date,
                    'profile_picture' => $latitude->singletraveller->user_info_traveller->profile_image,
                    'Distance'=>null,
                    'Avarage_rating'=>$latitude->rating_avg->avg('rating_point'),

                );
             
        }


    }

    if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL && $request->travel_end_point_latitude != NULL && $request->travel_end_point_longitude != NULL ) {
        if ( $travel_all_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_all_point], 200 );
        }
    }  elseif ( $request->travel_end_point_latitude != NULL && $request->travel_end_point_longitude != NULL ) {

        if ( $travel_end_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'],400 );
        } else {
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_end_point], 200 );
        }
    }  elseif ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
        if ( $travel_start_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
          
           
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
        }
    } elseif($request->starting_date){
        if ( $travel_start_point == NULL ) {
            return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
        } else {
          
           
            return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
        }
    }
}else{
    return response()->json( ['success'=>'flase', 'message'=>'Invalied country code'], 400 );
}
    }


    public function GetHomeSearch( Request $request, $country_code){

        if($country_code==+880){

            $search = BDService::where( 'status', 1 )->get();
            $travel_start_point =[];
           
            $i=0;
        
            foreach ( $search as $latitude ) {
        
                $lat1 = $request->travel_start_point_latitude;
                $lon1 = $request->travel_start_point_longitude;
                //------------------------------travel------start -----point----------------------------------------
                $lat2 = $latitude->travel_start_point_latitude ;
                $lon2 = $latitude->travel_start_point_longitude ;
                $pi80 = M_PI / 180;
                $lat1 *= $pi80;
                $lon1 *= $pi80;
                $lat2 *= $pi80;
                $lon2 *= $pi80;
                $r = 6372.797;
                // mean radius of Earth in km
                $dlat = $lat2 - $lat1;
                $dlon = $lon2 - $lon1;
                $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
                $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
                $km = $r * $c;
                // echo '<br/>'.$km;
                if ( $km <=5 ) {
                        $username = BDService::where( 'id', $latitude->id )
                        ->OrderBy( 'id', 'Desc' )->first();
                        $travel_start_point[] =  array( 
                            'service_id' => $latitude->id,
                            'travel_start_point_latitude'=>$latitude->travel_start_point_latitude,
                            'travel_start_point_longitude'=>$latitude->travel_start_point_longitude,
                            'travel_end_point' => $latitude->travel_end_point,
                        );
              
                  
                }
        
                
        
                
        
            }
        
          if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
                if ( $travel_start_point == NULL ) {
                    return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
                } else {
                    return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
                }
            }else{
                return response()->json( ['success'=>'false', 'message'=>'Invalied data ' ], 400 );
            }
        
        }elseif($country_code==+91){
        
        
        
            $search = INDService::where( 'status', 1 )->get();
            $travel_start_point =[];
           
            $i=0;
        
            foreach ( $search as $latitude ) {
        
                $lat1 = $request->travel_start_point_latitude;
                $lon1 = $request->travel_start_point_longitude;
                //------------------------------travel------start -----point----------------------------------------
                $lat2 = $latitude->travel_start_point_latitude ;
                $lon2 = $latitude->travel_start_point_longitude ;
                $pi80 = M_PI / 180;
                $lat1 *= $pi80;
                $lon1 *= $pi80;
                $lat2 *= $pi80;
                $lon2 *= $pi80;
                $r = 6372.797;
                // mean radius of Earth in km
                $dlat = $lat2 - $lat1;
                $dlon = $lon2 - $lon1;
                $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
                $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
                $km = $r * $c;
                // echo '<br/>'.$km;
                if ( $km <=5 ) {
                        $username = INDService::where( 'id', $latitude->id )
                        ->OrderBy( 'id', 'Desc' )->first();
                        $travel_start_point[] =  array( 
                            'service_id' => $latitude->id,
                            'travel_start_point_latitude'=>$latitude->travel_start_point_latitude,
                            'travel_start_point_longitude'=>$latitude->travel_start_point_longitude,
                            'travel_end_point' => $latitude->travel_end_point);
              
                  
                }
        
                
        
                
        
            }
        
          if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
                if ( $travel_start_point == NULL ) {
                    return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
                } else {
                    return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
                }
            }else{
                return response()->json( ['success'=>'false', 'message'=>'Invalied data ' ], 400 );
            }
                
        
        
        }elseif($country_code==+92){
            $search = PakService::where( 'status', 1 )->get();
            $travel_start_point =[];
           
            $i=0;
        
            foreach ( $search as $latitude ) {
        
                $lat1 = $request->travel_start_point_latitude;
                $lon1 = $request->travel_start_point_longitude;
                //------------------------------travel------start -----point----------------------------------------
                $lat2 = $latitude->travel_start_point_latitude ;
                $lon2 = $latitude->travel_start_point_longitude ;
                $pi80 = M_PI / 180;
                $lat1 *= $pi80;
                $lon1 *= $pi80;
                $lat2 *= $pi80;
                $lon2 *= $pi80;
                $r = 6372.797;
                // mean radius of Earth in km
                $dlat = $lat2 - $lat1;
                $dlon = $lon2 - $lon1;
                $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
                $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
                $km = $r * $c;
                // echo '<br/>'.$km;
                if ( $km <=5 ) {
                        $username = PakService::where( 'id', $latitude->id )
                        ->OrderBy( 'id', 'Desc' )->first();
                        $travel_start_point[] =  array(
                             'service_id' => $latitude->id,
                             'travel_start_point_latitude'=>$latitude->travel_start_point_latitude,
                             'travel_start_point_longitude'=>$latitude->travel_start_point_longitude,
                             'travel_end_point' => $latitude->travel_end_point);
              
                  
                }
        
                
        
                
        
            }
        
          if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
                if ( $travel_start_point == NULL ) {
                    return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
                } else {
                    return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
                }
            }else{
                return response()->json( ['success'=>'false', 'message'=>'Invalied data ' ], 400 );
            }
        }elseif($country_code==+65){
        
        
        
    
            $search = SingaporeService::where( 'status', 1 )->get();
            $travel_start_point =[];
           
            $i=0;
        
            foreach ( $search as $latitude ) {
        
                $lat1 = $request->travel_start_point_latitude;
                $lon1 = $request->travel_start_point_longitude;
                //------------------------------travel------start -----point----------------------------------------
                $lat2 = $latitude->travel_start_point_latitude ;
                $lon2 = $latitude->travel_start_point_longitude ;
                $pi80 = M_PI / 180;
                $lat1 *= $pi80;
                $lon1 *= $pi80;
                $lat2 *= $pi80;
                $lon2 *= $pi80;
                $r = 6372.797;
                // mean radius of Earth in km
                $dlat = $lat2 - $lat1;
                $dlon = $lon2 - $lon1;
                $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
                $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
                $km = $r * $c;
                // echo '<br/>'.$km;
                if ( $km <=5 ) {
                        $username = SingaporeService::where( 'id', $latitude->id )
                        ->OrderBy( 'id', 'Desc' )->first();
                        $travel_start_point[] =  array(
                             'service_id' => $latitude->id,
                             'travel_start_point_latitude'=>$latitude->travel_start_point_latitude,
                             'travel_start_point_longitude'=>$latitude->travel_start_point_longitude,
                             'travel_end_point' => $latitude->travel_end_point);
              
                  
                }
        
                
        
                
        
            }
        
          if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
                if ( $travel_start_point == NULL ) {
                    return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
                } else {
                    return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
                }
            }else{
                return response()->json( ['success'=>'false', 'message'=>'Invalied data ' ], 400 );
            }
    }else{
        return response()->json( ['success'=>'false', 'message'=>'Invalied country code ' ], 400 );
    }

    }

public function GetSearchRecommend(Request $request, $country_code){
    if($country_code==+880){

        $search = BDService::where( 'status', 1 )->get();
        $travel_start_point =[];
       
        $i=0;
    
        foreach ( $search as $latitude ) {
    
            $lat1 = $request->travel_start_point_latitude;
            $lon1 = $request->travel_start_point_longitude;
            //------------------------------travel------start -----point----------------------------------------
            $lat2 = $latitude->travel_start_point_latitude ;
            $lon2 = $latitude->travel_start_point_longitude ;
            $pi80 = M_PI / 180;
            $lat1 *= $pi80;
            $lon1 *= $pi80;
            $lat2 *= $pi80;
            $lon2 *= $pi80;
            $r = 6372.797;
            // mean radius of Earth in km
            $dlat = $lat2 - $lat1;
            $dlon = $lon2 - $lon1;
            $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
            $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
            $km = $r * $c;
            // echo '<br/>'.$km;
            $lat1_end = $request->travel_start_point_latitude;
            $lon1_end = $request->travel_start_point_longitude;
            $lat2_end = $latitude->travel_end_point_latitude; //database request
            $lon2_end = $latitude->travel_end_point_longitude ;
            $pi80_end = M_PI / 180;
            $lat1_end *= $pi80_end;
            $lon1_end  *= $pi80_end;
            $lat2_end = $lat2_end*$pi80_end;
            $lon2_end *= $pi80_end;
            $r_end = 6372.797;
            // mean radius of Earth in km
            $dlat_end = $lat2_end -$lat1_end;
            $dlon_end = $lon2_end -  $lon1_end ;
            $a_end = sin( $dlat_end / 2 ) * sin( $dlat_end / 2 ) + cos( $lat1_end ) * cos( $lat2_end ) * sin( $dlon_end / 2 ) * sin( $dlon_end / 2 );
            $c_end = 2 * atan2( sqrt( $a_end ), sqrt( 1 - $a_end ) );
            $km_end = $r_end * $c_end;
    
            if ( $km <=5 ||$km_end<=5) {
                    $username = BDService::where( 'id', $latitude->id )
                    ->OrderBy( 'id', 'Desc' )->first();
                    $travel_start_point[] =  array( 
                        'service_id' => $latitude->id,
                        'travel_start_point'=>$latitude->travel_start_point,
                        'start_date'=>$latitude->starting_date,
                        'travel_end_point' => $latitude->travel_end_point,
                        'end_date'=>$latitude->ending_date,
                    );
          
              
            }
    
            
    
            
    
        }
    
      if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
            if ( $travel_start_point == NULL ) {
                return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
            } else {
                return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
            }
        }else{
            return response()->json( ['success'=>'false', 'message'=>'Invalied data ' ], 400 );
        }
    
    }elseif($country_code==+91){
    
    
    
        $search = INDService::where( 'status', 1 )->get();
        $travel_start_point =[];
       
        $i=0;
    
        foreach ( $search as $latitude ) {
    
            $lat1 = $request->travel_start_point_latitude;
            $lon1 = $request->travel_start_point_longitude;
            //------------------------------travel------start -----point----------------------------------------
            $lat2 = $latitude->travel_start_point_latitude ;
            $lon2 = $latitude->travel_start_point_longitude ;
            $pi80 = M_PI / 180;
            $lat1 *= $pi80;
            $lon1 *= $pi80;
            $lat2 *= $pi80;
            $lon2 *= $pi80;
            $r = 6372.797;
            // mean radius of Earth in km
            $dlat = $lat2 - $lat1;
            $dlon = $lon2 - $lon1;
            $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
            $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
            $km = $r * $c;
            // echo '<br/>'.$km;
            $lat1_end = $request->travel_start_point_latitude;
            $lon1_end = $request->travel_start_point_longitude;
            $lat2_end = $latitude->travel_end_point_latitude; //database request
            $lon2_end = $latitude->travel_end_point_longitude ;
            $pi80_end = M_PI / 180;
            $lat1_end *= $pi80_end;
            $lon1_end  *= $pi80_end;
            $lat2_end = $lat2_end*$pi80_end;
            $lon2_end *= $pi80_end;
            $r_end = 6372.797;
            // mean radius of Earth in km
            $dlat_end = $lat2_end -$lat1_end;
            $dlon_end = $lon2_end -  $lon1_end ;
            $a_end = sin( $dlat_end / 2 ) * sin( $dlat_end / 2 ) + cos( $lat1_end ) * cos( $lat2_end ) * sin( $dlon_end / 2 ) * sin( $dlon_end / 2 );
            $c_end = 2 * atan2( sqrt( $a_end ), sqrt( 1 - $a_end ) );
            $km_end = $r_end * $c_end;
    
            if ( $km <=5 ||$km_end<=5) {
                    $username = INDService::where( 'id', $latitude->id )
                    ->OrderBy( 'id', 'Desc' )->first();
                    $travel_start_point[] =  array( 
                        'service_id' => $latitude->id,
                        'travel_start_point'=>$latitude->travel_start_point,
                        'start_date'=>$latitude->starting_date,
                        'travel_end_point' => $latitude->travel_end_point,
                        'end_date'=>$latitude->ending_date,
                    );
          
              
            }
    
            
    
            
    
        }
    
      if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
            if ( $travel_start_point == NULL ) {
                return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
            } else {
                return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
            }
        }else{
            return response()->json( ['success'=>'false', 'message'=>'Invalied data ' ], 400 );
        }
            
    
    
    }elseif($country_code==+92){
        $search = PakService::where( 'status', 1 )->get();
        $travel_start_point =[];
       
        $i=0;
    
        foreach ( $search as $latitude ) {
    
            $lat1 = $request->travel_start_point_latitude;
            $lon1 = $request->travel_start_point_longitude;
            //------------------------------travel------start -----point----------------------------------------
            $lat2 = $latitude->travel_start_point_latitude ;
            $lon2 = $latitude->travel_start_point_longitude ;
            $pi80 = M_PI / 180;
            $lat1 *= $pi80;
            $lon1 *= $pi80;
            $lat2 *= $pi80;
            $lon2 *= $pi80;
            $r = 6372.797;
            // mean radius of Earth in km
            $dlat = $lat2 - $lat1;
            $dlon = $lon2 - $lon1;
            $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
            $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
            $km = $r * $c;
            // echo '<br/>'.$km;
            $lat1_end = $request->travel_start_point_latitude;
            $lon1_end = $request->travel_start_point_longitude;
            $lat2_end = $latitude->travel_end_point_latitude; //database request
            $lon2_end = $latitude->travel_end_point_longitude ;
            $pi80_end = M_PI / 180;
            $lat1_end *= $pi80_end;
            $lon1_end  *= $pi80_end;
            $lat2_end = $lat2_end*$pi80_end;
            $lon2_end *= $pi80_end;
            $r_end = 6372.797;
            // mean radius of Earth in km
            $dlat_end = $lat2_end -$lat1_end;
            $dlon_end = $lon2_end -  $lon1_end ;
            $a_end = sin( $dlat_end / 2 ) * sin( $dlat_end / 2 ) + cos( $lat1_end ) * cos( $lat2_end ) * sin( $dlon_end / 2 ) * sin( $dlon_end / 2 );
            $c_end = 2 * atan2( sqrt( $a_end ), sqrt( 1 - $a_end ) );
            $km_end = $r_end * $c_end;
    
            if ( $km <=5 ||$km_end<=5) {
                    $username = PakService::where( 'id', $latitude->id )
                    ->OrderBy( 'id', 'Desc' )->first();
                    $travel_start_point[] =  array( 
                        'service_id' => $latitude->id,
                        'travel_start_point'=>$latitude->travel_start_point,
                        'start_date'=>$latitude->starting_date,
                        'travel_end_point' => $latitude->travel_end_point,
                        'end_date'=>$latitude->ending_date,
                    );
              
            }
    
            
    
            
    
        }
    
      if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
            if ( $travel_start_point == NULL ) {
                return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
            } else {
                return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
            }
        }else{
            return response()->json( ['success'=>'false', 'message'=>'Invalied data ' ], 400 );
        }
    }elseif($country_code==+65){
    
    
    

        $search = SingaporeService::where( 'status', 1 )->get();
        $travel_start_point =[];
       
        $i=0;
    
        foreach ( $search as $latitude ) {
    
            $lat1 = $request->travel_start_point_latitude;
            $lon1 = $request->travel_start_point_longitude;
            //------------------------------travel------start -----point----------------------------------------
            $lat2 = $latitude->travel_start_point_latitude ;
            $lon2 = $latitude->travel_start_point_longitude ;
            $pi80 = M_PI / 180;
            $lat1 *= $pi80;
            $lon1 *= $pi80;
            $lat2 *= $pi80;
            $lon2 *= $pi80;
            $r = 6372.797;
            // mean radius of Earth in km
            $dlat = $lat2 - $lat1;
            $dlon = $lon2 - $lon1;
            $a = sin( $dlat / 2 ) * sin( $dlat / 2 ) + cos( $lat1 ) * cos( $lat2 ) * sin( $dlon / 2 ) * sin( $dlon / 2 ); //area calculation
            $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) ); //circule circular
            $km = $r * $c;
            // echo '<br/>'.$km;
             $lat1_end = $request->travel_start_point_latitude;
            $lon1_end = $request->travel_start_point_longitude;
            $lat2_end = $latitude->travel_end_point_latitude; //database request
            $lon2_end = $latitude->travel_end_point_longitude ;
            $pi80_end = M_PI / 180;
            $lat1_end *= $pi80_end;
            $lon1_end  *= $pi80_end;
            $lat2_end = $lat2_end*$pi80_end;
            $lon2_end *= $pi80_end;
            $r_end = 6372.797;
            // mean radius of Earth in km
            $dlat_end = $lat2_end -$lat1_end;
            $dlon_end = $lon2_end -  $lon1_end ;
            $a_end = sin( $dlat_end / 2 ) * sin( $dlat_end / 2 ) + cos( $lat1_end ) * cos( $lat2_end ) * sin( $dlon_end / 2 ) * sin( $dlon_end / 2 );
            $c_end = 2 * atan2( sqrt( $a_end ), sqrt( 1 - $a_end ) );
            $km_end = $r_end * $c_end;
    
            if ( $km <=5 ||$km_end<=5) {
                    $username = SingaporeService::where( 'id', $latitude->id )
                    ->OrderBy( 'id', 'Desc' )->first();
                    $travel_start_point[] =  array( 
                        'service_id' => $latitude->id,
                        'travel_start_point'=>$latitude->travel_start_point,
                        'start_date'=>$latitude->starting_date,
                        'travel_end_point' => $latitude->travel_end_point,
                        'end_date'=>$latitude->ending_date,
                    );
            }
    
            
    
            
    
        }
    
      if ( $request->travel_start_point_latitude != NULL && $request->travel_start_point_longitude != NULL ) {
            if ( $travel_start_point == NULL ) {
                return response()->json( ['success'=>'false', 'message'=>'Did not Found!'], 400 );
            } else {
                return response()->json( ['success'=>'true', 'Search For Information'=>$travel_start_point ], 200 );
            }
        }else{
            return response()->json( ['success'=>'false', 'message'=>'Invalied data ' ], 400 );
        }
}else{
    return response()->json( ['success'=>'false', 'message'=>'Invalied country code ' ], 400 );
}
}


  
}