@extends('admin.dashboard')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <h5 class="mb-2">Bangladeshi Agent Information</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total BD Agent</span>
                        <span class="info-box-number">{{ $total_bd_agent->count() }}</span>
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
                        <span class="info-box-number">{{ $total_bd_agent->where('status',1)->count() }}</span>
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
                        <span class="info-box-number">{{ $total_bd_agent->where('status',0)->count() }}</span>
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
                        <span class="info-box-text">Total Verification User</span>
                        <span class="info-box-number">93,139</span>
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
                        <h3 class="card-title">BD Agent Information </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Agent Name</th>
                                    <th>Image</th>
                                    <th>Phone</th>
                                    <th>Country</th>
                                    <th>Division</th>
                                    <th>District</th>
                                    <th>Office Location</th>
                                    <th>Office Picture</th>
                                    <th>Trade License Picture</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($total_bd_agent as $v_agent)
                                <tr>
                                    <td>{{$v_agent->id}}</td>
                                    <td>
                                        <a href="{{url('/admin-bd-agent-info')}}/{{$v_agent->id}}">{{$v_agent->name}}</a>
                                    </td>                                
                                    <td></td>
                                   
                                    <td>
                                    <img src="{{asset('profile_image/bd_profile/profile_image')}}/{{$v_agent->id}}"
                                                alt="Null" width="60" height="60">
                                    </td>
                                    <td>f</td>
                                    <td>f</td>
                                    <td>f</td>
                                    <td>f</td>
                                    <td>f</td>
                                    <td>f</td>

                                    <td>


                                        <div class="btn-group" role="group" aria-label="Basic example">
                                     @if($v_agent->status==1)
                                        <button type="button" style=" color:white ;background-color:green"
                                                class="btn ">
                                                <a style="color:white"
                                                    href="{{url('/admin-bd-agent-status')}}/{{$v_agent->status}}/{{$v_agent->id}}">Active</a>
                                            </button>
                                      @else
                                            <button type="button" style=" color:white ;background-color:#8b60ed"
                                                class="btn ">
                                                <a style="color:white"
                                                    href="{{url('/admin-bd-agent-status')}}/{{$v_agent->status}}/{{$v_agent->id}}">Inactive</a>
                                            </button>
                                            @endif
                                            <!-- <button type="button" style=" color:white ;background-color:aqua"
                                                class="btn "><a style="color:white"
                                                    href="">
                                                    Updated</a></button> -->
                                            <button type="button" style="color:white  ;background-color:red"
                                                class="btn "><a style="color:white"
                                                    href="{{url('/admin-bd-agent-delete')}}/{{$v_agent->id}}">
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