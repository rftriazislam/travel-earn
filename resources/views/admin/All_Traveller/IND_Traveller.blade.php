@extends('admin.dashboard')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <h5 class="mb-2">Inadian Traveller Information</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Traveller</span>
                        <span class="info-box-number">{{$total_traveller->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Active</span>
                        <span class="info-box-number">{{$total_traveller->where('status',1)->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Inactive</span>
                        <span class="info-box-number">{{$total_traveller->where('status',0)->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Services</span>
                        <span class="info-box-number">{{$total_service->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" >IND Traveller Information </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Mobile Varification</th>
                                    <th>Email Varification </th>
                                    <th>NID Varification</th>
                                    <th>Video Varification</th>
                                    <th>Agent Varification</th>
                                    <th>Resident Varification</th>
                                    <th>Money Varification</th>
                                    <th>Total Percentage</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @forelse($total_traveller as $v_traveller)
                                <tr>
                                    <td>{{$v_traveller->id}}</td>
                                    <td>
                                        <a href="{{url('/admin-IND-traveller-verification')}}/{{$v_traveller->id}}">{{$v_traveller->user_info_traveller->name}}</a>
                                    </td>
                                    <td >@if($v_traveller->mobile_verification)
                                      <b style="color:green">Verified</b>  
                                        @else
                                        <b style="color:red">Unverified</b>
                                        @endif
                                       </td>
                                    <td >
                                        @if($v_traveller->email_verification)
                                        <b style="color:green">Verified</b>  
                                        @else
                                        <b style="color:red">Unverified</b>
                                      
                                        @endif
                                    </td>
                                    <td>  
                                        @if($v_traveller->NID_verification)
                                        <b style="color:green">Verified</b>  
                                        @else
                                        @if($v_traveller->NID_number&&$v_traveller->NID_image&&$v_traveller->NID_back_image)
                                        <b style="colorblue"><a href="{{url('/admin-IND-traveller-verification')}}/{{$v_traveller->id}}"> Verified Checking</a></b>
                                      @else
                                      <b style="color:red">Unverified</b>

                                      @endif
                                        @endif
                                    </td>
                                    <td> @if($v_traveller->video_verification)
                                        <b style="color:green">Verified</b>  
                                        @else
                                        @if($v_traveller->self_video)
                                        <b style="color:#a839d6"><a href="{{url('/admin-IND-traveller-verification')}}/{{$v_traveller->id}}"> Verified Checking</a></b>
                                      @else
                                      <b style="color:red">Unverified</b>

                                      @endif
                                        @endif</td>
                                    <td>@if($v_traveller->agent_verification)
                                        <b style="color:green">Verified</b>  
                                        @else
                                        @if($v_traveller->agentverified)
                                        <b style="color:#a839d6"><a href="{{url('/admin-travel-pdf-views')}}/{{$v_traveller->country_code}}/{{$v_traveller->agentverified->id}}"> Verified Checking</a></b>
                                      @else
                                      <b style="color:red">Unverified</b>

                                      @endif
                                      
                                        @endif</a></td>
                                    <td>@if($v_traveller->resident_verification)
                                        <b style="color:green">Verified</b>  
                                        @else
                                        @if($v_traveller->self_video)
                                        <b style="color:#a839d6"><a href="{{url('/admin-IND-traveller-verification')}}/{{$v_traveller->id}}"> Verified Checking</a></b>
                                      @else
                                      <b style="color:red">Unverified</b>

                                      @endif
                                        @endif</a></td>
                                    <td>
                                        @if($v_traveller->security_money_verification)
                                        <b style="color:green">Verified</b>  
                                        @else
                                        @if($v_traveller->security_money)
                                        <b style="colorblue"><a href="{{url('/admin-IND-traveller-verification')}}/{{$v_traveller->id}}"> Verified Checking</a></b>
                                      @else
                                      <b style="color:red">Unverified</b>

                                      @endif
                                        @endif</td>
                                    <td><b> {{ $v_traveller->total_verification_persentage }}</b><b style="color:red">%</b></td>
                                 
                                    <td>


                                        <div class="btn-group" role="group" aria-label="Basic example">
                                     @if($v_traveller->status==1)
                                        <button type="button" style=" color:white ;background-color:green"
                                                class="btn ">
                                                <a style="color:white"
                                                    href="{{url('/admin-IND-traveller-status')}}/{{$v_traveller->status}}/{{$v_traveller->id}}">Active</a>
                                            </button>
                                      @else
                                            <button type="button" style=" color:white ;background-color:#8b60ed"
                                                class="btn ">
                                                <a style="color:white"
                                                    href="{{url('/admin-IND-traveller-status')}}/{{$v_traveller->status}}/{{$v_traveller->id}}">Inactive</a>
                                            </button>
                                            @endif
                                            <!-- <button type="button" style=" color:white ;background-color:aqua"
                                                class="btn "><a style="color:white"
                                                    href="">
                                                    Updated</a></button> -->
                                            <button type="button" style="color:white  ;background-color:red"
                                                class="btn "><a style="color:white"
                                                    href="{{url('/admin-IND-traveller-delete')}}/{{$v_traveller->id}}">
                                                    Delete</a></button>
                                        </div> 
                                    </td>
                                </tr>


                                  @empty
                                    <tr class='text-center' style="color:red">
                                        <td colspan="12">No available data</td>
                                    </tr>
                                    @endforelse

                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->




@endsection