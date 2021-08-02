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
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->


 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     {{-- <a href="{{url('admin')}}" class="brand-link">
         <img src="{{asset('logo/Design1.png')}}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">Dashboard</span>

     </a> --}}
     <a class="brand-link" href="{{url('admin')}}" style="font-family: Arial, sans-;"><span style="font-family: cursive;color:#ffc107">THIRD</span> HAN<i>D</i></a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('Admin_image/admin')}}/{{{ Auth::user()->image}}}" class="img-circle elevation-2" alt="User Image">
             </div>

             <div class="info">
             <a href="{{ route('my_profile') }}" class="d-block">{{{ Auth::user()->name}}}</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             Website set
                             <i class="fas fa-angle-left right"></i>
                             <span class="badge badge-info right">6</span>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('slider')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>slider</p>
                             </a>
                         </li>

                     </ul>
                 </li>
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             All Users
                             <i class="fas fa-angle-left right"></i>
                             <span class="badge badge-info right">6</span>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('BDUser')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>BD User</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('INDUser')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>IND User</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('PAKUser')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>PAK User</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('SingaporeUser')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Singapore User</p>
                             </a>
                         </li>
                         
                     </ul>
                 </li>
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             All Travellers
                             <i class="fas fa-angle-left right"></i>
                             <span class="badge badge-info right">6</span>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('BDTraveller')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>BD Traveller</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('INDTraveller')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>IND Traveller</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('PAKTraveller')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>PAK Traveller</p>
                             </a>
                         </li>
                         <li class="nav-item">
                            <a href="{{route('singaporeTraveller')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Singapore Traveller</p>
                            </a>
                        </li>

                     </ul>
                 </li>
                 <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            All Services
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('BDService')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>BD Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('INDService')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>IND Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('PAKService')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PAK Services</p>
                            </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{route('SingaporeService')}}" class="nav-link">
                               <i class="far fa-circle nav-icon"></i>
                               <p>Singapore Services</p>
                           </a>
                       </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            All Service Request
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('BDServiceRequest')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>BD Services Request</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('INDServiceRequest')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>IND Services Request</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('PAKServiceRequest')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PAK Services Request</p>
                            </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{route('SingaporeServiceRequest')}}" class="nav-link">
                               <i class="far fa-circle nav-icon"></i>
                               <p>Singapore Services Request</p>
                           </a>
                       </li>

                    </ul>
                </li>
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             All Agents
                             <i class="fas fa-angle-left right"></i>
                             <span class="badge badge-info right">6</span>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{route('BDAgent')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>BD Agent</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('INDAgent')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>IND Agent</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('PAKAgent')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>PAK Agent</p>
                             </a>
                         </li>
                         <li class="nav-item">
                            <a href="{{route('SingaporeAgent')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Singapore Agent</p>
                            </a>
                        </li>

                     </ul>
                 </li>
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-copy"></i>
                         <p>
                             All Merchents
                             <i class="fas fa-angle-left right"></i>
                             <span class="badge badge-info right">6</span>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('BDMerchant') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>BD Merchant</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('INDMerchant')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>IND Merchant</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{route('PAKMerchant')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>PAK Merchant</p>
                             </a>
                         </li>
                         <li class="nav-item">
                            <a href="{{route('SingaporeMerchant')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Singapore Merchant</p>
                            </a>
                        </li>

                     </ul>
                 </li>
                 <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Agent Merchant Set   
                            <i class="fas fa-angle-left right"></i>
                          
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('BDMerchant') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>BD Agent Merchant Set</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('INDMerchant')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>IND Agent Merchant Set</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('PAKMerchant')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PAK Agent Merchant Set</p>
                            </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{route('SingaporeMerchant')}}" class="nav-link">
                               <i class="far fa-circle nav-icon"></i>
                               <p>Singapore Agent Merchant Set</p>
                           </a>
                       </li>

                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('deliverycharge') }}" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Delivery Charge Set 
                            
                          
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('profite') }}" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                        Profite 
                            
                          
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('total_balance') }}" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                      Total Balance
                        </p>
                    </a>
                </li>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>