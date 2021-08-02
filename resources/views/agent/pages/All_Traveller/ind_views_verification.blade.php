@extends('agent.dashboard')
@section('content')

 
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 style="text-align:center; color:#4b1ac1" ><b> Verification</b></h4>
                <div class="12">
                    <div class="btn-group" role="group" aria-label="Basic example">
                    
                        <button type="button" style="color:white;background-color:darkblue;width:147px;height:53px;margin-bottom:10px"
                            class="btn "><a style="color:white;text-align:center"
                                href="{{url('/agent-travel-verified-update')}}/{{$agent_pdf->id}}">
                               Update</a></button>
                             
                    </div> 
                </div>
                <div class="card">

                    <img src="{{asset('Admin_image/agent_verified_image/ind_image')}}/{{$agent_pdf->agent_with_traveller_selfie}}" style="height:566px;width:61%;margin-left:20%;margin-bottom:20px;margin-top:20px;margin-right:20%;">
                                    
                                         
                                  </div>
                <div class="card">

                    <iframe src="{{ asset('Admin_image/agent_document/ind_document') }}/{{ $agent_pdf->document_pdf  }}" style="height:800px;width:95%;margin-right:2%;margin-left:2%;margin-top:1.2%;margin-bottom:1.2%;"> </iframe>
                   
                  </div>
              
               
                </div>
            </div>
               
        </div>
          
    </section>
   
 
  
  @endsection