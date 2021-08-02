 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
   
    </ul>
  </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          
            <a href="{{url('agent')}}" class="brand-link">
                <img src="{{ asset('logo/4.png') }}" alt="" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Agent</span>
            </a>

     
            <div class="sidebar">
          
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('Admin_image/agent_image/bd_profile_image') }}/{{{ Auth::user()->image}}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('agentprofile') }}" class="d-block">{{{ Auth::user()->name}}}</a>
                    </div>
                </div>

             
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                 
                        
                          
                      
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-star-of-david"></i>
                                <p>
                                   Agent
                                    <i class="fas fa-angle-left right"></i>
                         
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('agentverified')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User Verification</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                  <a href="{{route('views_user_verification')}}" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      
                                      <p>Account Verified</p>
                                  </a>
                              </li>
                              
                              
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('agentprofile') }}" class="nav-link">
                                <i class="fas fa-star-of-david"></i>
                                <p>
                                   Profile
                                </p>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
         
            </div>
   
        </aside>