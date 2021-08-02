@extends('agent.dashboard')
@section('content')



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('Admin_image/agent_image/bd_profile_image') }}/{{{ Auth::user()->image}}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{{ Auth::user()->name}}}</h3>

                <p class="text-muted text-center">Agent ID <b>{{{ Auth::user()->id}}}  </b> </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Country Code:</b> <a class="float-right">{{{ Auth::user()->country_code}}} </a>
                  </li>
                  <li class="list-group-item">
                    <b>Email:</b> <a class="float-right">{{{ Auth::user()->email}}} </a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone Number:</b> <a class="float-right">{{{ Auth::user()->phone}}} </a>
                  </li>
                  <li class="list-group-item">
                    <b>Father's Name</b> <a class="float-right">{{{ Auth::user()->father_name}}} </a>
                  </li>
                  <li class="list-group-item">
                    <b>Mother's Name</b> <a class="float-right">{{{ Auth::user()->mother_name}}}</a>
                  </li>
                 
                
                </ul>

              

                <a href="{{route('logout')}}" class="btn btn-primary btn-block"><b>Logout</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                 Null
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i>Present Location</strong>

                <p class="text-muted">{{{ Auth::user()->present_address}}}</p>

                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i>Permanent Location</strong>

                <p class="text-muted">{{{ Auth::user()->permanent_address}}}</p>

                <hr>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  {{-- <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> --}}
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Profile Update</a></li>
                  <li class="nav-item"><a class="nav-link" href="#balance" data-toggle="tab">Balance</a></li>
                  <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">Varified Balance</a></li>
                  <li class="nav-item"><a class="nav-link" href="#withdraw" data-toggle="tab">Withdraw Histroy</a></li>

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
               
                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal" action="{{ route('agentprofileupdate') }}"  method="post"  enctype="multipart/form-data">
                      @csrf
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="name" value="{{{ Auth::user()->name}}}" id="inputName" placeholder="{{{ Auth::user()->name}}}">
                              <input type="hidden" class="form-control" name="admin_id" value="{{{ Auth::user()->id}}}" id="inputName" >
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Father's Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="father_name" value="{{{ Auth::user()->father_name}}}" id="inputName" placeholder="{{{ Auth::user()->father_name}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Mother's Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="mother_name" value="{{{ Auth::user()->mother_name}}}" id="inputName" placeholder="{{{ Auth::user()->mother_name}}}">
    
                            </div>
                          </div>

                  
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Present Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="present_address" value="{{{ Auth::user()->present_address}}}" id="inputName" placeholder="{{{ Auth::user()->present_address}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Permanent Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="permanent_address" value="{{{ Auth::user()->permanent_address}}}" id="inputName" placeholder="{{{ Auth::user()->permanent_address}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="password" id="inputSkills" placeholder="Create New Or Old Password">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="image" value="{{{ Auth::user()->name}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_profile_image') }}/{{{ Auth::user()->image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">NID Front Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="nid_front_image" value="{{{ Auth::user()->nid_front_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_nid_front') }}/{{{ Auth::user()->nid_front_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">NID Back Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="nid_back_image" value="{{{ Auth::user()->nid_back_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_nid_back') }}/{{{ Auth::user()->nid_back_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Trade License Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="trade_license_image" value="{{{ Auth::user()->trade_license_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_trade_license') }}/{{{ Auth::user()->trade_license_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Office Location</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="office_location" value="{{{ Auth::user()->office_location}}}" id="inputName" placeholder="{{{ Auth::user()->office_location}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Office Picture</label>
                            <div class="col-sm-10">
                              <input type="file" name="office_picture" value="{{{ Auth::user()->office_picture}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_office') }}/{{{ Auth::user()->office_picture}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">updated</button>
                            </div>
                          </div>
                        </form>
                  </div>
                  <div class="tab-pane " id="balance">
                    <form class="form-horizontal" action="{{ route('agentprofileupdate') }}"  method="post"  enctype="multipart/form-data">
                      @csrf
                          
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Father's Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="father_name" value="{{{ Auth::user()->father_name}}}" id="inputName" placeholder="{{{ Auth::user()->father_name}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Mother's Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="mother_name" value="{{{ Auth::user()->mother_name}}}" id="inputName" placeholder="{{{ Auth::user()->mother_name}}}">
    
                            </div>
                          </div>

                  
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Present Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="present_address" value="{{{ Auth::user()->present_address}}}" id="inputName" placeholder="{{{ Auth::user()->present_address}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Permanent Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="permanent_address" value="{{{ Auth::user()->permanent_address}}}" id="inputName" placeholder="{{{ Auth::user()->permanent_address}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="password" id="inputSkills" placeholder="Create New Or Old Password">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="image" value="{{{ Auth::user()->name}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_profile_image') }}/{{{ Auth::user()->image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">NID Front Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="nid_front_image" value="{{{ Auth::user()->nid_front_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_nid_front') }}/{{{ Auth::user()->nid_front_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">NID Back Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="nid_back_image" value="{{{ Auth::user()->nid_back_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_nid_back') }}/{{{ Auth::user()->nid_back_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Trade License Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="trade_license_image" value="{{{ Auth::user()->trade_license_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_trade_license') }}/{{{ Auth::user()->trade_license_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Office Location</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="office_location" value="{{{ Auth::user()->office_location}}}" id="inputName" placeholder="{{{ Auth::user()->office_location}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Office Picture</label>
                            <div class="col-sm-10">
                              <input type="file" name="office_picture" value="{{{ Auth::user()->office_picture}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_office') }}/{{{ Auth::user()->office_picture}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">updated</button>
                            </div>
                          </div>
                        </form>
                  </div>
                  <div class="tab-pane " id="history">
                    <form class="form-horizontal" action="{{ route('agentprofileupdate') }}"  method="post"  enctype="multipart/form-data">
                      @csrf
                          
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Father's Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="father_name" value="{{{ Auth::user()->father_name}}}" id="inputName" placeholder="{{{ Auth::user()->father_name}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Mother's Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="mother_name" value="{{{ Auth::user()->mother_name}}}" id="inputName" placeholder="{{{ Auth::user()->mother_name}}}">
    
                            </div>
                          </div>

                  
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Present Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="present_address" value="{{{ Auth::user()->present_address}}}" id="inputName" placeholder="{{{ Auth::user()->present_address}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Permanent Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="permanent_address" value="{{{ Auth::user()->permanent_address}}}" id="inputName" placeholder="{{{ Auth::user()->permanent_address}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="password" id="inputSkills" placeholder="Create New Or Old Password">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="image" value="{{{ Auth::user()->name}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_profile_image') }}/{{{ Auth::user()->image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">NID Front Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="nid_front_image" value="{{{ Auth::user()->nid_front_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_nid_front') }}/{{{ Auth::user()->nid_front_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">NID Back Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="nid_back_image" value="{{{ Auth::user()->nid_back_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_nid_back') }}/{{{ Auth::user()->nid_back_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Trade License Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="trade_license_image" value="{{{ Auth::user()->trade_license_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_trade_license') }}/{{{ Auth::user()->trade_license_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Office Location</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="office_location" value="{{{ Auth::user()->office_location}}}" id="inputName" placeholder="{{{ Auth::user()->office_location}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Office Picture</label>
                            <div class="col-sm-10">
                              <input type="file" name="office_picture" value="{{{ Auth::user()->office_picture}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_office') }}/{{{ Auth::user()->office_picture}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">updated</button>
                            </div>
                          </div>
                        </form>
                  </div>
                  <div class="tab-pane " id="withdraw">
                    <form class="form-horizontal" action="{{ route('agentprofileupdate') }}"  method="post"  enctype="multipart/form-data">
                      @csrf
                          
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Father's Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="father_name" value="{{{ Auth::user()->father_name}}}" id="inputName" placeholder="{{{ Auth::user()->father_name}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Mother's Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="mother_name" value="{{{ Auth::user()->mother_name}}}" id="inputName" placeholder="{{{ Auth::user()->mother_name}}}">
    
                            </div>
                          </div>

                  
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Present Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="present_address" value="{{{ Auth::user()->present_address}}}" id="inputName" placeholder="{{{ Auth::user()->present_address}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Permanent Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="permanent_address" value="{{{ Auth::user()->permanent_address}}}" id="inputName" placeholder="{{{ Auth::user()->permanent_address}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputSkills" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="password" id="inputSkills" placeholder="Create New Or Old Password">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="image" value="{{{ Auth::user()->name}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_profile_image') }}/{{{ Auth::user()->image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">NID Front Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="nid_front_image" value="{{{ Auth::user()->nid_front_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_nid_front') }}/{{{ Auth::user()->nid_front_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">NID Back Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="nid_back_image" value="{{{ Auth::user()->nid_back_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_nid_back') }}/{{{ Auth::user()->nid_back_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Trade License Image</label>
                            <div class="col-sm-10">
                              <input type="file" name="trade_license_image" value="{{{ Auth::user()->trade_license_image}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_trade_license') }}/{{{ Auth::user()->trade_license_image}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Office Location</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="office_location" value="{{{ Auth::user()->office_location}}}" id="inputName" placeholder="{{{ Auth::user()->office_location}}}">
    
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Office Picture</label>
                            <div class="col-sm-10">
                              <input type="file" name="office_picture" value="{{{ Auth::user()->office_picture}}}"  placeholder="file">
                              <img 
                              src="{{ asset('Admin_image/agent_image/bd_office') }}/{{{ Auth::user()->office_picture}}}"
                              alt="" style="width:60px;height:50px ;float:right">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">updated</button>
                            </div>
                          </div>
                        </form>
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

@endsection