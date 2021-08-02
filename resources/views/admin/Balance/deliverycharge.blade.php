@extends('admin.dashboard')
@section('title')
    Admin || Delivery Charge
@endsection
@section('content')


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Delivery Charge Information </h3>
                        <button class="btn" type="button" style="float:right;background-color:rgb(18, 184, 18)">
                            <a style="color:white"
                            href="{{url('/admin-add-delivery-charge')}}">Add Delivery Charge</a>
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Country Code</th>
                                    <th>Min Weight</th>
                                    <th>Max Weight</th>
                                    <th>Set Price</th>
                                    <th>Default Price</th>
                                    <th>Currency</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @forelse($total_price as $v_price)
                                <tr>
                                    <td>{{$v_price->id}}</td>
                                    <td>
                                        {{$v_price->country_code}}
                                    </td>
                                    <td>{{$v_price->min_weight}}</td>
                                    <td>{{$v_price->max_weight}} </td>
                                    <td>{{$v_price->set_price}} </td>
                                    <td><a href="{{ url('/admin-edit-delivery-charge') }}/{{$v_price->id}}"> {{$v_price->default_price}}</a></td>
                                    <td>
                                    {{$v_price->currency}}
                                    </td>
                                    <td>


                                        <div class="btn-group" role="group" aria-label="Basic example">
                                     @if($v_price->status==1)
                                        <button type="button" style=" color:white ;background-color:green"
                                                class="btn ">
                                                <a style="color:white"
                                                    href="{{url('/admin-delivery-charge-status')}}/{{$v_price->status}}/{{$v_price->id}}">Active</a>
                                            </button>
                                      @else
                                            <button type="button" style=" color:white ;background-color:#8b60ed"
                                                class="btn ">
                                                <a style="color:white"
                                                    href="{{url('/admin-delivery-charge-status')}}/{{$v_price->status}}/{{$v_price->id}}">Inactive</a>
                                            </button>
                                            @endif
                                            <!-- <button type="button" style=" color:white ;background-color:aqua"
                                                class="btn "><a style="color:white"
                                                    href="">
                                                    Updated</a></button> -->
                                            <button type="button" style="color:white  ;background-color:red"
                                                class="btn "><a style="color:white"
                                                    href="{{url('/admin-delivery-charge-delete')}}/{{$v_price->id}}">
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