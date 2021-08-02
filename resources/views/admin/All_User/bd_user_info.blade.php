@extends('admin.dashboard')
@section('title')
    Admin || User Info
@endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 style="text-align:center">Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">

                        @if(session('message'))
                        <p style="color:rgb(255, 0, 0);" class="text-center">
                            {{session('message')}}
                        </p>
                        @endif
                    </li>
                  
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

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
                                src="{{asset('profile_image/bd_profile/profile_image')}}/{{$bd_user_info->profile_image}}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{$bd_user_info->name}}</h3>

                        <p class="text-muted text-center">User ID:<b style="color:black"> {{$bd_user_info->id}} </b></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Country Code:</b> <a class="float-right">{{$bd_user_info->country_code}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Contact Number:</b> <a class="float-right">{{$bd_user_info->mobile_number}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Email:</b> <a class="float-right">{{$bd_user_info->email}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Father's Name</b> <a class="float-right">{{$bd_user_info->father_name}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Mother's Name</b> <a class="float-right">{{$bd_user_info->mother_name}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Drop Balance:</b> <a class="float-right">{{$bd_user_info->drop_balance}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Product Balance:</b> <a class="float-right">{{$bd_user_info->product_balance}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Total Earn</b> <a class="float-right">{{$bd_user_info->total_earn}}</a>
                            </li>
                            <!-- <li class="list-group-item">
                                <b>Present Address:</b> <a class="float-right">{{$bd_user_info->present_address}}</a>
                            </li> -->
                            <!-- <li class="list-group-item">
                                <b>Permanent Address:</b> <a
                                    class="float-right">{{$bd_user_info->permanent_address}}</a>
                            </li> -->

                            <li class="list-group-item">
                                <b>Mac Id</b> <a class="float-right">{{$bd_user_info->mac_id}}</a>
                            </li>
                        </ul>
                        @if($bd_user_info->status==1)
                        <a href="{{url('/admin-bd-user-status')}}/{{$bd_user_info->status}}/{{$bd_user_info->id}}"
                            class="btn btn-primfary btn-block"
                            style=" color:white ;background-color:#8b60ed"><b>Active</b></a>
                        @else
                        <a href="{{url('/admin-bd-user-status')}}/{{$bd_user_info->status}}/{{$bd_user_info->id}}"
                            class="btn btn-primfary btn-block"
                            style=" color:white ;background-color:red"><b>Inactive</b></a>
                        @endif
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
                          NULL
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Present Location</strong>

                        <p class="text-muted">{{$bd_user_info->present_address}}</p>

                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Permanent Location</strong>

                        <p class="text-muted">{{$bd_user_info->permanent_address}}</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                     
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
                            <li class="nav-item"><a class="nav-link active" href="#serviceaccept"
                                    data-toggle="tab">Request Service
                                    Accept</a></li>
                            <li class="nav-item"><a class="nav-link" href="#serviceadd" data-toggle="tab">Request
                                    Service  Create</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#services" data-toggle="tab">Service
                                    Add</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"> Traveller</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#balance" data-toggle="tab">Add Balance</a>
                            <li class="nav-item"><a class="nav-link" href="#historybalance" data-toggle="tab">History Balance</a>

                            </li>
                            
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="serviceaccept">
                                <!-- Post -->
                                @foreach($bd_user_info->traveller_info->request_service_info as $request_service_info)
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="{{asset('profile_image/bd_profile/profile_image')}}/{{$request_service_info->user_info->profile_image}}"
                                            alt="user image">
                                        <span class="username">
                                            <a href="{{url('/admin-bd-user-info')}}/{{$request_service_info->user_info->id}}">{{$request_service_info->user_info->name}}</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description"><b style="color:#8b60ed">Service Create</b><b>
                                                {{$request_service_info->created_at->format('l m Y H:i:s')}}</b></span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p><b>Product Weight :</b><b style="color:#17a2b8">{{$request_service_info->weight}}
                                            Kg</b></p>
                                    <p><b>Product Type : </b><b style="color:#17a2b8">
                                            {{$request_service_info->product_type}}</b></p>
                                    <p><b>Delivery Cost :</b><b
                                            style="color:#17a2b8">{{$request_service_info->delivery_cost}}</b></p>
                                    <p><b>Start Point :</b><b style="color:#17a2b8">
                                            {{$request_service_info->service_info->travel_start_point}}</b></p>
                                    <p><b>End Point : </b><b style="color:#17a2b8">
                                            {{$request_service_info->service_info->travel_end_point}}</b></p>


                                    @if($request_service_info->service_info->status==1)
                                    <a class=" btn btn-block"
                                        style="color:white ;background-color:#28a745;text-transform:uppercase;"><b>Success
                                        </b></a>
                                    @else
                                    <a  class=" btn btn-block"
                                        style="color:white ;background-color:#e20016;text-transform:uppercase;"><b>Unsuccess
                                        </b></a>
                                    @endif
                                </div>
                                @endforeach
                                <!-- /.post -->

                            </div>
                            <div class=" tab-pane" id="services">

                                <div class="post">

                                    <div class="user-block">
                                        @foreach($bd_service as $service_info)
                                        <div class="col-md-5" style="float:left;background:#e3e9ef;margin:5px;">
                                            <div class="user-block">
                                                <h6><b style="color:#8b60ed">Service Create</b><b>
                                                        {{$service_info->created_at->format('l m Y H:i')}}</b></h4>
                                            </div>
                                            <p><b>Traveller Start Point :</b><b style="color:#17a2b8">
                                                    {{$service_info->travel_start_point}}</b></p>
                                            <p><b>Traveller End Point : </b><b
                                                    style="color:#17a2b8">{{$service_info->travel_end_point}}
                                                </b></p>
                                            <p><b>Start Date :</b><b
                                                    style="color:#17a2b8">{{$service_info->starting_date}}</b>
                                            </p>
                                            <p><b>End Date :</b><b style="color:#17a2b8">{{$service_info->ending_date}}
                                                </b></p>
                                            <p><b>Traveller Type : </b><b
                                                    style="color:#17a2b8">{{$service_info->traveling_type}}
                                                </b></p>
                                        </div>
                                        @endforeach
                                    </div>





                                </div>


                            </div>

                            <div class=" tab-pane" id="serviceadd">

                                @foreach($bd_user_info->request_service_info as $request_service_info)
                                <div class="post">
                                    <div class="user-block">
                                        <h6><b style="color:#8b60ed">Service Create</b><b>
                                                {{$request_service_info->created_at->format('l m Y H:i')}}</b></h4>
                                    </div>
                                    <div class="user-block">

                                        <div class="col-md-6" style="float:left;">

                                            <p><b>Product Weight :</b><b
                                                    style="color:#17a2b8">{{$request_service_info->weight}} Kg</b></p>
                                            <p><b>Product Type : </b><b style="color:#17a2b8">
                                                    {{$request_service_info->product_type}}</b></p>
                                            <p><b>Delivery Cost :</b><b
                                                    style="color:#17a2b8">{{$request_service_info->delivery_cost}}</b>
                                            </p>
                                            <p><b>Start Point :</b><b style="color:#17a2b8">
                                                    {{$request_service_info->service_info->travel_start_point}}</b></p>
                                            <p><b>End Point : </b><b style="color:#17a2b8">
                                                    {{$request_service_info->service_info->travel_end_point}}</b></p>
                                        </div>
                                        <div class="col-md-6" style="float:left">
                                            <img class="img-circle img-bordered-sm"
                                                src="{{asset('profile_image/bd_profile/profile_image')}}/{{$request_service_info->traveller_info->user_info_traveller->profile_image}}"
                                                alt="">
                                            <a
                                                href="{{url('/admin-bd-user-info')}}/{{$request_service_info->traveller_info->user_info_traveller->id}}">
                                                <p class="description"><b
                                                        style="color:#17a2b8">{{$request_service_info->traveller_info->user_info_traveller->name}}</b>
                                                </p>
                                            </a>
                                            <br>
                                            <p><b>Mobile Number :</b><b
                                                    style="color:#17a2b8">{{$request_service_info->traveller_info->user_info_traveller->mobile_number}}</b>
                                            </p>
                                            <p><b>User ID :</b><b
                                                    style="color:#17a2b8">{{$request_service_info->traveller_info->user_info_traveller->id}}</b>
                                            </p>

                                        </div>
                                    </div>



                                    @if($request_service_info)
                                    <a href="" class=" btn "
                                        style="color:white ;background-color:#28a745;text-transform:uppercase;"><b>Success
                                        </b></a>
                                    @else
                                    <a href="" class=" btn "
                                        style="color:white ;background-color:#e20016;text-transform:uppercase;"><b>Unsuccess
                                        </b></a>
                                    @endif


                                </div>
                                @endforeach
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-danger">
                                            {{$bd_user_info->traveller_info->created_at}}
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-envelope bg-primary"></i>

                                        <div class="timeline-item">


                                            <h3 class="timeline-header"><a href="#">Mobile Verification
                                                </a></h3>

                                            <div class="timeline-body">
                                                {{$bd_user_info->traveller_info->mobile_verification}}
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="#">Email Verification
                                                </a></h3>

                                            <div class="timeline-body">
                                                {{$bd_user_info->traveller_info->email_verification}}
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="#">NID Verification
                                                </a></h3>

                                            <div class="timeline-body">
                                                {{$bd_user_info->traveller_info->NID_verification}}
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="#">NID Number
                                                </a></h3>

                                            <div class="timeline-body">
                                                {{$bd_user_info->traveller_info->NID_number}}
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="#">Security Money
                                                </a></h3>

                                            <div class="timeline-body">
                                                {{$bd_user_info->traveller_info->security_money}}
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="#">Resident Verification
                                                </a></h3>

                                            <div class="timeline-body">
                                                {{$bd_user_info->traveller_info->resident_verification}}
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="#">Agent Verification
                                                </a></h3>

                                            <div class="timeline-body">
                                                {{$bd_user_info->traveller_info->agent_verification}}
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="#">Sucessfull Delivery Count </a>
                                                {{$bd_user_info->traveller_info->sucessfull_delivery_count}}</h3>
                                            <h3 class="timeline-header"><a href="#">Sucessfull Delivery Count</a>
                                                {{$bd_user_info->traveller_info->sucessfull_delivery_count}}</h3>

                                        </div>
                                    </div>

                                    <div>


                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="#"> NID Images </a>
                                            </h3>

                                            <div class="timeline-body">
                                                <img src="{{asset('NID_image/bd_NID_image')}}/{{$bd_user_info->traveller_info->NID_image}}"
                                                    alt="...">
                                            </div>
                                        </div>

                                        <div class="timeline-item">
                                            <h3 class="timeline-header"><a href="#"> Self Video </a>
                                            </h3>

                                            <div class="timeline-body">
                                                <video width="320" height="240" controls>
                                                    <source
                                                        src="{{asset('self_video/bd_self_video')}}/{{$bd_user_info->traveller_info->self_video}}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="balance">
                                <form class="form-horizontal" action="{{ route('SaveBalance') }}" method="post">
                                   @csrf
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">User ID</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"  required id="inputName2" name="user_id" value="{{$bd_user_info->id}}" placeholder="User ID">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Amount</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" required id="inputName2" name="amount" placeholder="Amount">
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">TrxID</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" required id="inputName2" name="trxid" placeholder="BKash Trex Id">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Account Number</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" required id="inputName2" name="account_number" placeholder="Cash In Number">
                                        </div>
                                    </div>
                                    
                                  
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Balance Type</label>

                                        <div class="form-check">
                                          <label class="form-check-label"> <input class="form-check-input" name="balance_type" required  type="radio" value="drop balance" >Drop Balance</label>
                                        </div>
                                        &nbsp;
                                        <div class="form-check">
                                          <label class="form-check-label"> <input class="form-check-input" name="balance_type" required  type="radio" value="product balance"  >Product Balance</label>
                                        </div>
                                       
                                        
                                      </div>
                                  
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-6">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                            <!-- /.tab-pane -->
                            <div class=" tab-pane" id="historybalance">

                                <div class="post">

                                    <div class="user-block">
                                        @foreach($balance_history as $balance_info)
                                        <div class="col-md-5" style="float:left;background:#e3e9ef;margin:5px;">
                                            <div class="user-block">
                                                <h6><b style="color:#8b60ed">Payment Date</b><b>
                                                        {{$balance_info->created_at->format('l m Y H:i')}}</b></h4>
                                            </div>
                                            <p><b>User Id :</b><b style="color:#17a2b8">
                                                    {{$balance_info->user_id}}</b></p>
                                            <p><b>Pyment Amount : </b><b
                                                    style="color:#17a2b8">{{$balance_info->amount}}
                                                </b></p>
                                            <p><b>TrxID :</b><b
                                                    style="color:#17a2b8">{{$balance_info->trxid}}</b>
                                            </p>
                                            <p><b>Account Number :</b><b style="color:#17a2b8">{{$balance_info->account_number}}
                                                </b></p>
                                            <p><b>Pyment Type : </b><b
                                                    style="color:#17a2b8">{{$balance_info->balance_type}}
                                                </b></p>
                                        </div>
                                        @endforeach
                                
                                    </div>



                                    

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

@endsection