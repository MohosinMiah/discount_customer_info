 
@extends('dashboard.index')

@section('title') Admin @stop


@section('main_body')
 
 <!-- Main Content -->
 <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
       
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
          

          

       

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                    <img class="img-profile rounded-circle"
                        src="img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                  
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">



         {{-- Display Error Message  --}}
         <div class="row">
            <div class="col-md-12">
        
               {{-- Display Error Message  --}}
              @include('admin.error.error')
            
            </div>
          </div>
          

        <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-8">
                  <!-- Content Row -->
            <div class="card">
                <div class="card-body">
                   
            <form method="POST" action="{{ route('admin.seller_create_storeadmin_seller_create_store')}}">
                @csrf
                <div class="form-group">
                    <label for="name">Seller Name *</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Seller Name" required>
                  </div>

                  <div class="form-group">
                    <label for="name">Area Code *</label>
                    <input type="text" class="form-control" id="area_code" name="area_code" placeholder="Seller Area Code" required>
                  </div>

                  <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Seller Phone Number" required>
                  </div>

                  <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Seller Email" >
                  </div>

                <div class="form-group">
                  <label for="password">Password *</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Seller Password" required>
                </div>

                <div class="form-group">
                    <label for="address">Address *</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Seller Address" required>
                </div>


                <button type="submit" class="btn btn-primary">ADD SELLER</button>
              </form>

       
            </div>
        </div>
    </div>
        </div>
  
        <div class="col-md-2">

        </div>

    

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



 @stop
 