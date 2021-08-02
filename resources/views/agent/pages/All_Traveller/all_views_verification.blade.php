@extends('agent.dashboard')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" >Views Verification  Information </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Agent Name</th>
                                    
                                    <th>Travel ID</th>
                                    <th>User Name</th>
                                    <th>selfie With Agent</th>
                                 
                                    <th>Document pdf</th>

                                    <th>Check Stage</th>
                              

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @forelse($verification_info as $v_verification)
                                <tr>
                                    <td>{{$v_verification->id}}</td>
                                    <td>
                                     <b> {{$v_verification->agent_info->name}} </b> 
                                    </td>
                                  
                                       <td>
                                        <b>{{$v_verification->traveller_info->id}} </b> 
                                       </td>
                                       <td>
                                        <b> {{$v_verification->traveller_info->user_info_traveller->name}} </b> 
                                       </td>
                                       <td>
                                        <img src="
@if(Auth::user()->country_code==+880)
{{asset('Admin_image/agent_verified_image/bd_image')}}/{{$v_verification->agent_with_traveller_selfie}}
@elseif(Auth::user()->country_code==+91)
{{asset('Admin_image/agent_verified_image/ind_image')}}/{{$v_verification->agent_with_traveller_selfie}}
@elseif(Auth::user()->country_code==+92)
{{asset('Admin_image/agent_verified_image/pak_image')}}/{{$v_verification->agent_with_traveller_selfie}}
@elseif(Auth::user()->country_code==+65)
{{asset('Admin_image/agent_verified_image/singapore_image')}}/{{$v_verification->agent_with_traveller_selfie}}
@endif
                                        "
                                                alt="Null" width="60" height="60"> 
                                       </td>
                                  
                                
                                    <td>
                                       
                                        <b> {{$v_verification->document_pdf}} </b> 
                                    </td>
                                  
                                  
                                    <td>
                                        @if($v_verification->status==0)

                                        <b style="color:rgb(228, 88, 24)">Verfied Processing</b>  

                                        @else

                                        <b style="color:rgb(0, 255, 128)">Verified</b>
                                      
                                        @endif</a></td>
                                  
                                   
                                 
                                    <td>


                                        <div class="btn-group" role="group" aria-label="Basic example">
                        
                                            <button type="button" style="color:white  ;background-color:darkblue"
                                                class="btn "><a style="color:white"
                                                    href="{{url('/agent-travel-pdf-views')}}/{{$v_verification->id}}">
                                                   Edit</a></button>
                                                 
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