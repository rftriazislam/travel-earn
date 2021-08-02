@extends('admin.dashboard')
@section('content')

 
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
  
          <div class="col-md-12">
            <h4 style="text-align:center; color:#4b1ac1" ><b> Service Information</b></h4>
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Service Info</a></li>
          
                  <li class="nav-item"><a class="nav-link " href="#timable" data-toggle="tab">Service Accept</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Service Decline</a></li>
                 

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                      <!-- /.tab-pane -->
                      <div class="active tab-pane"  id="profile">       <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                          <div class="card-body box-profile">
                            <div class="text-center">
                              <img class="profile-user-img img-fluid img-circle"
                                   src="{{asset('profile_image/ind_profile/profile_image')}}/{{$service_info->service_user_info->profile_image}}"
                                   alt="User profile picture">
                            </div>
            
                            <h3 class="profile-username text-center"><a href="{{url('/admin-ind-user-info')}}/{{$service_info->user_id}}" style="color:chocolate">{{$service_info->service_user_info->name}} </a> </h3>
            
                            <p class="text-mufted text-center" style="color:#273cfa">User ID : <b style="color:black">{{$service_info->user_id}}  </b>Traveller ID : <b style="color:black">{{$service_info->travel_id}}  </b> Service ID : <b style="color:black">{{$service_info->id}}  </b></p>

            
                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                <b>Travel Start Point</b> <a class="float-right">
                                  
                              {{$service_info->travel_start_point}}
                                      
                                </a>
                              </li>
                              <li class="list-group-item">
                                <b>Travel Start Time</b> <a class="float-right"> 
                                  {{ $service_info->starting_date }} {{ $service_info->starting_time }}</a>
                              </li>
                              <li class="list-group-item">
                                <b>Travel End Point</b> <a class="float-right">
                                  
                              {{$service_info->travel_end_point}}
                                      
                                </a>
                              </li>
                              <li class="list-group-item">
                                <b>Travel Ending Time </b> <a class="float-right">
                                  
                                  {{ $service_info->ending_date }} {{ $service_info->ending_time }}
                                      
                                </a>
                              </li>
                              
                         
                            
                              <li class="list-group-item">
                                <b>Travel Type</b> <a class="float-right">
                                  {{ $service_info->traveling_type }} 
                            
                                      
                                </a>
                              </li>
                             
                            
                              
                            

                            </ul>
                        
                         
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
             </div>
                  
             
                  <div class=" tab-pane" id="timable">
                    <div class="post">

                      <div class="user-block">
                          @foreach($all_service->where('user_id',$service_info->user_id)->where('status',1) as $v_service_info)
                          <div class="col-md-5" style="float:left;background:#e3e9ef;margin:5px;">
                              <div class="user-block">
                                <h5 style="color:black;text-align:center;">Service ID:{{$v_service_info->id}}</h5>
                                <hr>
                                <h6><b style="color:#8b60ed">Service Create</b><b>
                                          {{$v_service_info->created_at->format('l m Y H:i')}}</b></h4>
                              </div>
                              <p><b>Traveller Start Point :</b><b style="color:#17a2b8">
                                      {{$v_service_info->travel_start_point}}</b></p>
                              <p><b>Traveller End Point : </b><b
                                      style="color:#17a2b8">{{$v_service_info->travel_end_point}}
                                  </b></p>
                              <p><b>Start Date :</b><b
                                      style="color:#17a2b8">{{$v_service_info->starting_date}}</b>
                              </p>
                              <p><b>End Date :</b><b style="color:#17a2b8">{{$v_service_info->ending_date}}
                                  </b></p>
                              <p><b>Traveller Type : </b><b
                                      style="color:#17a2b8">{{$v_service_info->traveling_type}}
                                  </b></p>
                          </div>
                          @endforeach
                      </div>





                  </div>
                   

                    
                    <!-- /.post -->
                  </div>
                
                  <div class="tab-pane" id="settings">
                    <div class="post">

                      <div class="user-block">
                          @foreach($all_service->where('user_id',$service_info->user_id)->where('status',0) as $v_service_info)
                          <div class="col-md-5" style="float:left;background:#e3e9ef;margin:5px;">
                              <div class="user-block">
                                <h5 style="color:black;text-align:center;">Service ID:{{$v_service_info->id}}</h5>
                                <hr>
                                  <h6><b style="color:#8b60ed">Service Create</b><b>
                                          {{$v_service_info->created_at->format('l m Y H:i')}}</b></h4>
                              </div>
                              <p><b>Traveller Start Point :</b><b style="color:#17a2b8">
                                      {{$v_service_info->travel_start_point}}</b></p>
                              <p><b>Traveller End Point : </b><b
                                      style="color:#17a2b8">{{$v_service_info->travel_end_point}}
                                  </b></p>
                              <p><b>Start Date :</b><b
                                      style="color:#17a2b8">{{$v_service_info->starting_date}}</b>
                              </p>
                              <p><b>End Date :</b><b style="color:#17a2b8">{{$v_service_info->ending_date}}
                                  </b></p>
                              <p><b>Traveller Type : </b><b
                                      style="color:#17a2b8">{{$v_service_info->traveling_type}}
                                  </b></p>
                          </div>
                          @endforeach
                      </div>
                  </div>
               
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 
  <!-- /.content-wrapper -->
  @endsection