@extends('agent.dashboard')
@section('content')

 
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
  
          <div class="col-md-12">
            <h4 style="text-align:center; color:#4b1ac1" ><b> Verification</b></h4>
            <div class="card">
              <div class="card-header p-2">
               
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
          
                  <!-- /.tab-pane -->
                  <div class="tab-pane active" id="money">
                    <form class="form-horizontal" action="{{ route('AgentVerifiedUpdatesave') }}"  method="post"  enctype="multipart/form-data">
                    @csrf
                        <h4 style="text-align:center"><b>Traveller ID: {{ $agent_pdf->traveller_id }}</b></h4>
                      <hr>
                     
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Agent With User Selfie Image </label>
                        <div class="col-sm-10">
                          <input type="File"  id="inputName" name="agent_with_traveller_selfie" value="{{ $agent_pdf->agent_with_traveller_selfie }}" placeholder="Name">
                          <input type="hidden"  id="inputName" name="agent_id" value="{{ $agent_pdf->agent_id }}" placeholder="Name">
                          <input type="hidden"  id="inputName" name="traveller_id" value="{{ $agent_pdf->traveller_id }}" placeholder="Name">
                          <input type="hidden"  id="inputName" name="verified_id" value="{{ $agent_pdf->id }}" placeholder="Name">
                          <img src="{{asset('Admin_image/agent_verified_image/ind_image')}}/{{$agent_pdf->agent_with_traveller_selfie}}"
                          alt="Null" width="90" height="70" style="float:right"> 
                        </div>
                        
                      </div>

                      <div class="form-group row">
                        <label for="inputName"  class="col-sm-2 col-form-label">User Document PDF </label>
                        <div class="col-sm-10">
                          <input type="File"  id="inputName" name="document_pdf" value="{{ $agent_pdf->document_pdf }}"  placeholder="Name">
                        </div>
                      </div>
                             <hr>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button    type="submit" style="color:white  ;background-color:darkblue"
                          class="btn " class="btn btn-primery">Verified</button>
                        
                        </div>
                      </div>
                    </form>


                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 
  <!-- /.content-wrapper -->
  @endsection