@extends('agent.dashboard')
@section('content')


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" >Traveller Information </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                 
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
                                        <b> {{$v_traveller->user_info_traveller->email}} </b> 
                                       </td>
                                       <td>
                                        <b> {{$v_traveller->user_info_traveller->mobile_number}} </b> 
                                       </td>
                                  
                                
                                    <td>
                                        @if($v_traveller->agentverified)

                                        <b style="color:green">Verfied Processing</b>  

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