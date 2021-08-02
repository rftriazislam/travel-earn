@extends('admin.dashboard')
@section('content')

 
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
  
          <div class="col-md-12">
            <h4 style="text-align:center; color:#4b1ac1" ><b> Verification</b></h4>
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Verification Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Nid" data-toggle="tab">NID Verification</a></li>
                  <li class="nav-item"><a class="nav-link " href="#timable" data-toggle="tab">Video verification</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Resident verification</a></li>
                  <li class="nav-item"><a class="nav-link" href="#money" data-toggle="tab">Security Money verification</a></li>

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
                                   src="{{asset('profile_image/bd_profile/profile_image')}}/{{$traveller_info->user_info_traveller->profile_image}}"
                                   alt="User profile picture">
                            </div>
            
                            <h3 class="profile-username text-center">{{$traveller_info->user_info_traveller->name}} </h3>
            
                            <p class="text-mufted text-center" style="color:#273cfa">User ID : <b style="color:black">{{$traveller_info->user_id}}  </b> &nbsp;Traveller ID : <b style="color:black">{{$traveller_info->id}}</b></p>

            
                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                <b>Mobile Verification</b> <a class="float-right">
                                  
                                  @if($traveller_info->mobile_verification)
                                      <b style="color:green">Verified</b>  
                                        @else
                                        <b style="color:red">Unverified</b>
                                        @endif
                                </a>
                              </li>
                              <li class="list-group-item">
                                <b>Email Verification</b> <a class="float-right"> 
                                    @if($traveller_info->email_verification)
                                  <b style="color:green">Verified</b>  
                                    @else
                                    <b style="color:red">Unverified</b>
                                    @endif</a>
                              </li>
                              <li class="list-group-item">
                                <b>NID Verification</b> <a class="float-right">

                                  @if($traveller_info->NID_verification)
                                  <b style="color:green">Verified</b>  
                                  @else
                                  @if($traveller_info->NID_number&&$traveller_info->NID_image&&$traveller_info->NID_back_image)
                                  <b style="color:Blue">Verified Checking </b> 
                                @else
                                <b style="color:red">Unverified</b>

                                @endif
                                  @endif
                                </a>
                              </li>
                              <li class="list-group-item">
                                <b>NID Number</b> <a class="float-right">{{ $traveller_info->NID_number }}</a>
                              </li>
                              <li class="list-group-item">
                                <b>NID Image</b> <a class="float-right">
                                  <img class=""
                                  src="{{asset('NID_image/bd_NID_image')}}/{{$traveller_info->NID_image}}"
                                  alt="Image Not Found" style="height:210px;width:387px;">
                                </a>
                              </li>
                              <li class="list-group-item">
                                <b>NID Back Image</b> <a class="float-right">
                                  <img class=""
                                  src="{{asset('NID_image/bd_NID_image/NID_back_image')}}/{{$traveller_info->NID_back_image}}"
                                  alt="Image Not Found" style="height:210px;width:387px;">
                                </a>
                              </li>
                              <li class="list-group-item">
                                <b>Video Verification</b> <a class="float-right">
                                  @if($traveller_info->video_verification)
                                  <b style="color:green">Verified</b>  
                                  @else
                                  @if($traveller_info->self_video)
                                  <b style="color:Blue">Verified Checking </b> 
                                @else
                                <b style="color:red">Unverified</b>

                                @endif
                                  @endif
                                </a>
                              </li>
                              <li class="list-group-item">
                                <b>Self Video</b> <a class="float-right">
                                 @if($traveller_info->self_video)
                                  <video width="387" height="210" controls>
                                    <source
                                        src="{{asset('self_video/bd_self_video')}}/{{$traveller_info->self_video}}"
                                        type="video/mp4">
                                  Not found
                                </video> 
                                @else
                                <b style="color:red">Video Not Found</b>
                                @endif
                                </a>
                              </li>
                              <li class="list-group-item">
                                <b>Security Money verification</b> <a class="float-right">
                                  @if($traveller_info->security_money_verification)
                                  <b style="color:green">Verified</b>  
                                  @else
                                  @if($traveller_info->security_money<500)
                                <b style="color:Blue">Verified Checking </b> 
                                @else
                                <b style="color:red">Unverified</b>

                                @endif
                                  @endif
                                </a>
                              </li>
                              <li class="list-group-item">
                                <b>Security Money</b> <a class="float-right">{{$traveller_info->security_money}}</a>
                              </li>
                              <li class="list-group-item">
                                <b>Resident Verification</b> <a class="float-right">
                                  @if($traveller_info->resident_verification)
                                  <b style="color:green">Verified</b>  
                                  @else

                                  {{-- @if($traveller_info->NID_number&&$traveller_info->NID_image&&$traveller_info->NID_back_image)
                                  <b style="colorblue"><a href="{{url('/admin-bd-traveller-verification')}}/{{$traveller_info->id}}"> Verified Checking</a></b>
                                @else
                                <b style="color:red">Unverified</b>

                                @endif --}}
                                <b style="color:red">Unverified</b>

                                  @endif
                                </a>
                              </li>
                              <li class="list-group-item">
                                <b>Agent Verification</b> <a class="float-right">
                                  @if($traveller_info->NID_verification)
                                  <b style="color:green">Verified</b>  
                                  @else
                                  
                                <b style="color:red">Unverified</b>

                               
                                  @endif
                                </a>
                              </li>
                              <li class="list-group-item">
                              <b>Successfully Delivery</b> <a class="float-right">{{ $traveller_info->sucessfull_delivery_count }}</a>
                              </li>
                              <li class="list-group-item">
                                <b>UnSuccessfully Delivery</b> <a class="float-right">{{ $traveller_info->unsucessfull_delivery }}</a>
                              </li>

                            </ul>
                            @if($traveller_info->status==1)
                            <a 
                                class="btn btn-primfary btn-block"
                                style=" color:white ;background-color:#8b60ed"><b>Active</b></a>
                            @else
                            <a 
                                class="btn btn-primfary btn-block"
                                style=" color:white ;background-color:red"><b>Inactive</b></a>
                            @endif
                         
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
             </div>
                  
                  <!-- /.tab-pane -->
                  <div class=" tab-pane" id="Nid">
                    <!-- Post -->
                    <div class="post">
                        <div class="timeline timeline-inverse">
                 
                            <div>
                           
      
                              <div class="timeline-item">
                          
      
                                <h3 class="timeline-header"><a href="#">NID Number  :</a> <b>{{ $traveller_info->NID_number }} </b></h3>
      
                                
                             
                              </div>
                            </div>
                           
                            
                            <div>
                              
      
                              <div class="timeline-item">
                              
      
                                <h3 class="timeline-header"><a href="#">NID Font Image</a></h3>
      
                                <div class="timeline-body">
                                  <img src="{{asset('NID_image/bd_NID_image')}}/{{$traveller_info->NID_image}}" style="height:300px;width: 400px;" alt="...">
                                  <img src="{{asset('profile_image/bd_profile/profile_image')}}/{{$traveller_info->user_info_traveller->profile_image}}" style="height:300px;width: 400px;" alt="...">
                               
                                </div>
                              </div>
                              <div class="timeline-item">
                              
      
                                  <h3 class="timeline-header"><a href="#">NID Back Image</a></h3>
        
                                  <div class="timeline-body">
                                      <img src="{{asset('NID_image/bd_NID_image/NID_back_image')}}/{{$traveller_info->NID_back_image}}" style="height:300px;width: 400px;" alt="...">
      
                                    
                                  </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            
                            <button type="button" style="color:white;background-color:green;float:right;margin-right:131px;"
                                                      class="btn "><a style="color:white"
                                                          href="{{ url('admin-NID-verified') }}/{{$traveller_info->id}}">
                                                          Verified</a></button>
                            <button type="button" style="color:white;background-color:rgb(233, 79, 18);float:right;margin-right:10px;"
                                                          class="btn "><a style="color:white"
                                                              href="">
                                                              Unverified</a></button>
                          </div>
                    </div>
                    <!-- /.post -->

                   

                    
                    <!-- /.post -->
                  </div>
                  <div class=" tab-pane" id="timable">
                    <!-- Post -->
                    <div class="post">
                        <div class="timeline timeline-inverse">
                 
                         
                            
                            <div>
                              
      
                              <div class="timeline-item">
                              
      
                                <h3 class="timeline-header"><a href="#">Profile Picture</a></h3>
      
                                <div class="timeline-body">
                                  <img src="{{asset('profile_image/bd_profile/profile_image')}}/{{$traveller_info->user_info_traveller->profile_image}}" style="height:300px;width: 400px;" alt="...">
                               
                                </div>
                              </div>
                              <div class="timeline-item">
                              
      
                                  <h3 class="timeline-header"><a href="#">Video </a></h3>
        
                                  <div class="timeline-body">
                                    <video width="500" height="300" controls>
                                        <source
                                            src="{{asset('self_video/bd_self_video')}}/{{$traveller_info->self_video}}"
                                            type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>      
                                    
                                  </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            
                            <button type="button" style="color:white;background-color:green;float:right;margin-right:131px;"
                                                      class="btn "><a style="color:white"
                                                          href="{{ url('admin-video-verified') }}/{{$traveller_info->id}}">
                                                          Verified</a></button>
                            <button type="button" style="color:white;background-color:rgb(233, 79, 18);float:right;margin-right:10px;"
                                                          class="btn "><a style="color:white"
                                                              href="">
                                                              Unverified</a></button>
                          </div>
                    </div>
                    <!-- /.post -->

                   

                    
                    <!-- /.post -->
                  </div>
                
                  <div class="tab-pane" id="settings">
                    <div class="post">
                      <div class="timeline timeline-inverse">
               
                    
                          
                        <div class="timeline-item">
                          
      
                          <h4 class="timeline-header" style="margin-left:58px;">Resident File </h4>

                          
                       
                        </div>
                            
    
                            <div class="timeline-item">
                            
    
                            
    
                              <div class="timeline-body">
                                <img src="{{asset('NID_image/bd_NID_image')}}/{{$traveller_info->NID_image}}" style="height:300px;width: 400px;" alt="...">
                                <img src="{{asset('profile_image/bd_profile/profile_image')}}/{{$traveller_info->user_info_traveller->profile_image}}" style="height:300px;width: 400px;" alt="...">
                             
                              </div>
                            </div>
                           
                          <!-- END timeline item -->
                          
                          <button type="button" style="color:white;background-color:green;float:right;margin-right:131px;"
                                                    class="btn "><a style="color:white"
                                                        href="{{ url('admin-Resident-verified') }}/{{$traveller_info->id}}">
                                                        Verified</a></button>
                          <button type="button" style="color:white;background-color:rgb(233, 79, 18);float:right;margin-right:10px;"
                                                        class="btn "><a style="color:white"
                                                            href="">
                                                            Unverified</a></button>
                        </div>
                  </div>
                  <!-- /.post -->

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="money">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Add Money</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="money">
                        </div>
                      </div>
                     
                     
                     
                    
                     
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primery">Verified</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
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