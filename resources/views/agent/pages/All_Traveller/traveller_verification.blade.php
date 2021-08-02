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
                <ul class="nav nav-pills">
               
                  <li class="nav-item"><a class="nav-link active" href="#money" data-toggle="tab">Agent verification</a></li>

                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
          
                  <!-- /.tab-pane -->
                  <div class="tab-pane active" id="money">
                    <form class="form-horizontal" action="{{ route('agentverifieduser') }}"  method="post"  enctype="multipart/form-data">
                    @csrf
                        <h4 style="text-align:center"><b>Traveller ID: {{ $traveller_info->id }}</b></h4>
                      <hr>
                     
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Agent With User Selfie Image </label>
                        <div class="col-sm-10">
                          <input type="File" required id="inputName" name="agent_with_traveller_selfie" placeholder="Name">
                          <input type="hidden"  id="inputName" name="agent_id" value="{{ Auth::user()->id }}" placeholder="Name">
                          <input type="hidden"  id="inputName" name="traveller_id" value="{{ $traveller_info->id }}" placeholder="Name">

                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" required class="col-sm-2 col-form-label">User Document PDF </label>
                        <div class="col-sm-10">
                          <input type="File"  id="inputName" name="document_pdf" placeholder="Name">
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

                    {{-- <iframe src="{{ asset('Admin_image/agent_document/bd_document') }}/{{ $agent_pdf->agent_with_traveller_selfie  }}" style="height:700px;width:500px;"> </iframe> --}}

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