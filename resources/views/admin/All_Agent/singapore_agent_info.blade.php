@extends('admin.dashboard')
@section('content')

 
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
  
          <div class="col-md-12">
            <h4 style="text-align:center; color:#4b1ac1" ><b> Agent Information</b></h4>
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Agent Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#Nid" data-toggle="tab">NID Check</a></li>
                  <li class="nav-item"><a class="nav-link " href="#timable" data-toggle="tab">Trade License</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Office Location</a></li>
                 

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
                                   src="{{asset('profile_image/bd_profile/profile_image')}}/{{$agent_info->id}}"
                                   alt="User profile picture">
                            </div>
            
                            <h3 class="profile-username text-center">{{$agent_info->name}} </h3>
            
                            <p class="text-mufted text-center" style="color:#273cfa">User ID : <b style="color:black">{{$agent_info->id}}  </b></p>

            
                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                <b>Mobile Number</b> <a class="float-right">
                                  
                              {{   $agent_info->phone}}
                                      
                                </a>
                              </li>
                              <li class="list-group-item">
                                <b>Email Verification</b> <a class="float-right"> 
                                    {{ $agent_info->email }}</a>
                              </li>
                            
                              <li class="list-group-item">
                                <b>Country </b> <a class="float-right">
                                  
                            
                                      
                                </a>
                              </li>
                              
                         
                            
                              <li class="list-group-item">
                                <b>Division </b> <a class="float-right">
                                  
                            
                                      
                                </a>
                              </li>
                             
                              <li class="list-group-item">
                                <b>District </b> <a class="float-right">
                                  
                            
                                      
                                </a>
                              </li>
                              
                            

                            </ul>
                          
                         
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
                          
      
                              
      
                                
                             
                              </div>
                            </div>
                           
                            
                            <div>
                              
      
                              <div class="timeline-item">
                              
      
                                <h3 class="timeline-header"><a href="#">NID Front Image</a></h3>
      
                                <div class="timeline-body">
                                  <img src="{{asset('NID_image/bd_NID_image')}}/{{$agent_info->nid_front_image}}" style="height:300px;width: 400px;" alt="...">
                                  <img src="{{asset('profile_image/bd_profile/profile_image')}}/{{$agent_info->id}}" style="height:300px;width: 400px;" alt="...">
                               
                                </div>
                              </div>
                              <div class="timeline-item">
                              
      
                                  <h3 class="timeline-header"><a href="#">NID Back Image</a></h3>
        
                                  <div class="timeline-body">
                                      <img src="{{asset('NID_image/bd_NID_image/NID_back_image')}}/{{$agent_info->nid_back_image}}" style="height:300px;width: 400px;" alt="...">
      
                                    
                                  </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                           
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
                              
      
                                <h3 class="timeline-header"><a href="#">Trade License Picture</a></h3>
      
                                <div class="timeline-body">
                                  <img src="{{asset('profile_image/bd_profile/profile_image')}}/{{$agent_info->trade_license_image}}" style="height:300px;width: 400px;" alt="...">
                               
                                </div>
                              </div>
                            
                            </div>
                            <!-- END timeline item -->
                            
                            
                          </div>
                    </div>
                    <!-- /.post -->

                   

                    
                    <!-- /.post -->
                  </div>
                
                  <div class="tab-pane" id="settings">
                    <div class="post">
                      <div class="timeline timeline-inverse">
               
                    
                          
                        <div class="timeline-item">
                          
      
                          <h4 class="timeline-header" style="margin-left:58px;">Office Location :{{ $agent_info->office_location }}</h4>

                          
                       
                        </div>
                            
    
                            <div class="timeline-item">
                            
    
                            
    
                              <div class="timeline-body">
                                <img src="{{asset('NID_image/bd_NID_image')}}/{{$agent_info->office_image}}" style="height:300px;width: 400px;" alt="...">
                             
                              </div>
                            </div>
                         
                          <!-- END timeline item -->
                        
                        </div>
                        @if($agent_info->status==1)
                        <a   href="{{url('/admin-singapore-agent-status')}}/{{$agent_info->status}}/{{$agent_info->id}}"
                            class="btn btn-primfary btn-block"
                            style=" color:white ;background-color:#8b60ed"><b>Active</b></a>
                        @else
                        <a   href="{{url('/admin-singapore-agent-status')}}/{{$agent_info->status}}/{{$agent_info->id}}"
                            class="btn btn-primfary btn-block"
                            style=" color:white ;background-color:red"><b>Inactive</b></a>
                        @endif
                  </div>
                  <!-- /.post -->

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