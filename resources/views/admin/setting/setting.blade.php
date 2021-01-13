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

        <div class="col-md-2">
        </div>
        <div class="col-md-8" >
                  <!-- Content Row -->
            <div class="card">
                <div class="card-body">
                   
            <form method="POST" action="{{ route('admin.admin_infoadmin_settings_info')}}">
                @csrf
                <div class="form-group">
                    <label for="name"> Name *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $data['admin']->name}}" required>
                </div>


                  <div class="form-group">
                    <label for="email">Email  </label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $data['admin']->email}}" >
                  </div>


                  <div class="form-group">
                    <label for="address">Address * </label>
                    <textarea name="address"  class="form-control"  id="address" cols="40" rows="5"> {{ $data['admin']->address}} </textarea>
                </div>

            


                <button type="submit" class="btn btn-warning">UPDATE INFO</button>
              </form>

       
            </div>
        </div>
    </div>
       

  
        <div class="col-md-2">

        </div>

    </div>



   {{-- Change Phone Number  ************************     --}}

   <br>

   <div class="row">

    <div class="col-md-2">
    </div>
    <div class="col-md-8" >
              <!-- Content Row -->
        <div class="card">
            <div class="card-body">
               
        <form method="POST" action="{{ route('admin.admin_change_phoneadmin_change_phone')}}">
            @csrf
         
            <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="text" pattern=".{11}" class="form-control" id="phone" name="phone" value="{{ $data['admin']->phone}}" oninput="check(this)"  required>
            </div>

            <button type="submit" class="btn btn-success">CHANGE PHONE NUMBER</button>
          </form>

   
        </div>
    </div>
</div>
   

    <div class="col-md-2">

    </div>

</div>

   <br>

   {{-- Password Setting  ************************     --}}

   <br>

   <div class="row">

    <div class="col-md-2">
    </div>
    <div class="col-md-8" >
              <!-- Content Row -->
        <div class="card">
            <div class="card-body">
               
        <form method="POST" action="{{ route('admin.admin_change_passadmin_change_pass')}}">
            @csrf
            <div class="form-group">
                <label for="old_password"> Old Password *</label>
                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" required >
            </div>

              <div class="form-group">
                <label for="password">New Password *</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>
              </div>    

            <button type="submit" class="btn btn-info">UPDATE PASSWORD</button>
          </form>

   
        </div>
    </div>
</div>
   

    <div class="col-md-2">

    </div>

</div>

   <br>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



 @stop
 