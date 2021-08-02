@extends('agent.dashboard')
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
                                 
                                    <th>Agent Varification</th>
                              

                                    <th>Verifing</th>
                                </tr>
                            </thead>
                            <tbody>
                             @forelse($total_traveller as $v_traveller)
                                <tr>
                                    <td>{{$v_traveller->id}}</td>
                                    <td>
                                     <b> {{$v_traveller->user_info_traveller->name}} </b> 
                                    </td>
                           
                                
                                  
                                
                                    <td>
                                        @if($v_traveller->agentverified)
                                        <b style="color:green">Verified processing</b>  
                                        @else
                                        <b style="color:red">Unverified</b>
                                      
                                        @endif</a></td>
                                  
                                  
                                   
                                 
                                    <td>
                                     
                                   
                                        <div class="btn-group" role="group" aria-label="Basic example">
        
                                              @if($v_traveller->agentverified)

                                          
                                            <button type="button" style="color:white ;background-color:#CDDC39"
                                            class="btn ">Verfied Processing</button>
                                            

                                               @else
                                               
                                                  <button type="button" style="color:white  ;background-color:darkblue"
                                                  class="btn "><a style="color:white"
                                                    href="{{url('/agent-travel-verifing')}}/{{$v_traveller->id}}">
                                                   Verifing</a></button>
                                                   @endif
                                                
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