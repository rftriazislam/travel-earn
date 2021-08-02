@extends('admin.dashboard')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <h5 class="mb-2">Indian Merchant Information</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total IND Merchant</span>
                        <span class="info-box-number">{{ $total_ind_merchant->count() }}</span>
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
                        <span class="info-box-number">{{ $total_ind_merchant->where('status',1)->count() }}</span>
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
                        <span class="info-box-number">{{ $total_ind_merchant->where('status',0)->count() }}</span>
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
                        <h3 class="card-title">IND Merchant Information </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Merchant Name</th>
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
                                @forelse($total_ind_merchant as $v_merchant)
                                <tr>
                                    <td>{{$v_merchant->id}}</td>
                                    <td>
                                        <a href="{{url('/admin-IND-merchant-info')}}/{{$v_merchant->id}}">{{$v_merchant->name}}</a>
                                    </td>                                
                                    <td></td>
                                   
                                    <td>
                                    <img src="{{asset('profile_image/ind_profile/profile_image')}}/{{$v_merchant->id}}"
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
                                     @if($v_merchant->status==1)
                                        <button type="button" style=" color:white ;background-color:green"
                                                class="btn ">
                                                <a style="color:white"
                                                    href="{{url('/admin-IND-merchant-status')}}/{{$v_merchant->status}}/{{$v_merchant->id}}">Active</a>
                                            </button>
                                      @else
                                            <button type="button" style=" color:white ;background-color:#8b60ed"
                                                class="btn ">
                                                <a style="color:white"
                                                    href="{{url('/admin-IND-merchant-status')}}/{{$v_merchant->status}}/{{$v_merchant->id}}">Inactive</a>
                                            </button>
                                            @endif
                                            <!-- <button type="button" style=" color:white ;background-color:aqua"
                                                class="btn "><a style="color:white"
                                                    href="">
                                                    Updated</a></button> -->
                                            <button type="button" style="color:white  ;background-color:red"
                                                class="btn "><a style="color:white"
                                                    href="{{url('/admin-IND-merchant-delete')}}/{{$v_merchant->id}}">
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