@extends('admin.dashboard')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <h5 class="mb-2">Inadian User Information</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total User</span>
                        <span class="info-box-number">{{$total_user->count()}}</span>
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
                        <span class="info-box-number">{{$total_user->where('status',1)->count()}}</span>
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
                        <span class="info-box-number">{{$total_user->where('status',0)->count()}}</span>
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
                        <h3 class="card-title">IND User Information </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Blance Add </th>
                                    <th>Blance</th>
                                    <th>Total Earn</th>
                                    <th>Profile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @forelse($total_user as $v_user)
                                <tr>
                                    <td>{{$v_user->id}}</td>
                                    <td>
                                        <a href="{{url('/admin-ind-user-info')}}/{{$v_user->id}}">{{$v_user->name}}</a>
                                    </td>
                                    <td>{{$v_user->mobile_number}}</td>
                                    <td><a href="ss">Add Money</a></td>
                                    <td>{{$v_user->balance}}</td>
                                    <td>{{$v_user->total_earn}}</td>
                                    <td>
                                    <img src="{{asset('profile_image/ind_profile/profile_image')}}/{{$v_user->profile_image}}"
                                                alt="Null" width="60" height="60">
                                    </td>
                                    <td>


                                        <div class="btn-group" role="group" aria-label="Basic example">
                                     @if($v_user->status==1)
                                        <button type="button" style=" color:white ;background-color:green"
                                                class="btn ">
                                                <a style="color:white"
                                                    href="{{url('/admin-ind-user-status')}}/{{$v_user->status}}/{{$v_user->id}}">Active</a>
                                            </button>
                                      @else
                                            <button type="button" style=" color:white ;background-color:#8b60ed"
                                                class="btn ">
                                                <a style="color:white"
                                                    href="{{url('/admin-ind-user-status')}}/{{$v_user->status}}/{{$v_user->id}}">Inactive</a>
                                            </button>
                                            @endif
                                            <!-- <button type="button" style=" color:white ;background-color:aqua"
                                                class="btn "><a style="color:white"
                                                    href="">
                                                    Updated</a></button> -->
                                            <button type="button" style="color:white  ;background-color:red"
                                                class="btn "><a style="color:white"
                                                    href="{{url('/admin-ind-user-delete')}}/{{$v_user->id}}">
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