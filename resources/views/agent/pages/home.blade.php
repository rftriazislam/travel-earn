 
 @extends('agent.dashboard')
 @section('content')
 
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0 text-dark">Dashboard</h1>
             </div>
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Dashboard</li>
                 </ol>
             </div>
         </div>
     </div>
 </div>

 <section class="content">
     <div class="container-fluid">
      
         <div class="row">
             <div class="col-12 col-sm-6 col-md-2">
                 <div class="info-box">
                     <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                     <div class="info-box-content">
                         <span class="info-box-text">Total Panding Traveller</span>
                         <span class="info-box-number">
                         {{ $panding_verified->count() }}
                         </span>
                     </div>
                
                 </div>
               
             </div>
           
             <div class="col-12 col-sm-6 col-md-3">
                 <div class="info-box mb-3">
                     <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                     <div class="info-box-content">
                         <span class="info-box-text">Total Pending Verified Account</span>
                         <span class="info-box-number"> {{ $verified_account->where('status',0)->count() }}</span>
                     </div>
                  
                 </div>
              
             </div>
      
             <div class="clearfix hidden-md-up"></div>

             <div class="col-12 col-sm-6 col-md-2">
                 <div class="info-box mb-3">
                     <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                     <div class="info-box-content">
                         <span class="info-box-text">Total Verified Account</span>
                         <span class="info-box-number">{{ $verified_account->where('status',1)->count() }}</span>
                     </div>
                 
                 </div>
              
             </div>
       
             <div class="col-12 col-sm-6 col-md-2">
                 <div class="info-box mb-3">
                     <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-money"></i></span>

                     <div class="info-box-content">
                         <span class="info-box-text">Current Balance</span>
                         <span class="info-box-number">{{ $user->total_balance }}</span>
                     </div>
                 
                 </div>
               
             </div>
             
             <div class="col-12 col-sm-6 col-md-2">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-us"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Withdraw</span>
                        <span class="info-box-number">00</span>
                    </div>
                
                </div>
              
            </div>
      
         </div>
     

     
     </div>
    
 </section>



 @endsection