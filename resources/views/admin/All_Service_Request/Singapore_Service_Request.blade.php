@extends('admin.dashboard')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <h5 class="mb-2">Singapore Service Request Information</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Service Request </span>
                        <span class="info-box-number">{{$total_service_request->count()}}</span>
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
                        <span class="info-box-text">Total Service Accept</span>
                        <span class="info-box-number">{{$total_service_request->where('status',1)->count()}}</span>
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
                        <span class="info-box-text">Total Service Decline</span>
                        <span class="info-box-number">{{$total_service_request->where('status',0)->count()}}</span>
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
                        <span class="info-box-number">453</span>
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
                        <h3 class="card-title">Singapore Service  Request Information </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User Name</th>
                                    <th>Traveller Name</th>
                                    <th>Weight</th>
                                    <th>Delivery Cost</th>
                                    <th>Product Type</th>
                                    <th>Travel Start Point </th>
                                    <th>Travel End Point </th>
                                    <th>Start Date & Time</th>
                                    <th>End Date & Time</th>
                                    <th>Request</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @forelse($total_service_request as $v_service_request)
                                <tr>
                                    <td>{{$v_service_request->id}}</td>
                                    <td>
                                  <a href="{{url('/admin-singapore-user-info')}}/{{$v_service_request->user_info->id}}">        {{ $v_service_request->user_info->name }}   </a> 
                                    </td>
                                    <td>
                                     <a href="{{url('/admin-singapore-user-info')}}/{{$v_service_request->traveller_info->user_info_traveller->id}}">   {{ $v_service_request->traveller_info->user_info_traveller->name }} </a> 
                                    </td>
                                    <td> {{$v_service_request->weight}}</td>
                                    <td> {{$v_service_request->delivery_cost}}</td>
                                    <td> {{$v_service_request->product_type}}</td>

                                    <td>{{$v_service_request->service_info->travel_start_point}}</td>
                                    <td>{{$v_service_request->service_info->travel_end_point}}</td>

                                    <td>{{ $v_service_request->service_info->starting_date}} {{ $v_service_request->service_info->starting_time }}</td>

                                    <td>{{$v_service_request->service_info->ending_date}} {{ $v_service_request->service_info->ending_time }}</td>
                                    <td>      
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                        @if($v_service_request->status==1)
                                           <button type="button" style=" color:white ;background-color:#17a2b8"
                                                   class="btn ">
                                                   <a style="color:white"
                                                      >Accept</a>
                                               </button>
                                         @else
                                               <button type="button" style=" color:white ;background-color:#8b60ed"
                                                   class="btn ">
                                                   <a style="color:white"
                                                     >Decline</a>
                                               </button>
                                               @endif
                                            </div>
                                        </td>

                                    <td>


                                        <div class="btn-group" role="group" aria-label="Basic example">
                                    
                                            <!-- <button type="button" style=" color:white ;background-color:aqua"
                                                class="btn "><a style="color:white"
                                                    href="">
                                                    Updated</a></button> -->
                                            <button type="button" style="color:white  ;background-color:red"
                                                class="btn "><a style="color:white"
                                                    href="{{url('/admin-bd-Service-Request-delete')}}/{{$v_service_request->id}}">
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