@extends('admin.dashboard')
@section('content')

 
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 style="text-align:center; color:#4b1ac1" ><b> Verification</b></h4>
                <div class="12">
                    <div class="btn-group" role="group" aria-label="Basic example">
                    @if($agent_pdf->status==0)

                                <button type="button" style="color:white;background-color:darkblue;width:147px;height:53px;margin-bottom:10px"
                                class="btn "><a style="color:white;text-align:center"
                                href="{{url('/admin-agent-verified')}}/{{$agent_pdf->traveller_info->country_code}}/{{$agent_pdf->traveller_id}}">
                                 UnVerified
                            
                            </a></button>

              @else
                               <button type="button" style="color:white;background-color:rgb(171, 30, 226);width:147px;height:53px;margin-bottom:10px"
                               class="btn "><a style="color:white;text-align:center"
                                   href="{{url('/admin-agent-Unverified')}}/{{$agent_pdf->traveller_info->country_code}}/{{$agent_pdf->id}}">
                                  Verified</a></button>
              @endif

                             
                    </div> 
                </div>
                <div class="card">

                    <img src="{{asset('Admin_image/agent_verified_image/bd_image')}}/{{$agent_pdf->agent_with_traveller_selfie}}" style="height:566px;width:61%;margin-left:20%;margin-bottom:20px;margin-top:20px;margin-right:20%;">
                                    
                                         
                                  </div>
                <div class="card">

                    <iframe src="{{ asset('Admin_image/agent_document/bd_document') }}/{{ $agent_pdf->document_pdf  }}" style="height:800px;width:95%;margin-right:2%;margin-left:2%;margin-top:1.2%;margin-bottom:1.2%;"> </iframe>
                   
                  </div>
              
               
                </div>
            </div>
               
        </div>
          
    </section>
   
 
  
  @endsection