        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboardadmin_dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"> ADMIN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboardadmin_dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

          


            <!-- Nav Item - Seller Settings  Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSellers"
                    aria-expanded="true" aria-controls="collapseSellers">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Seller Settings</span>
                </a>
                <div id="collapseSellers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.seller_createadmin_seller_create') }}">Add New</a>
                        <a class="collapse-item" href="{{ route('admin.seller_alladmin_seller_all') }}">All Seller</a>
                    </div>
                </div>
            </li>


            <!-- Nav Item - Admin Settings  Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomers"
                    aria-expanded="true" aria-controls="collapseCustomers">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Admin Settings</span>
                </a>
                <div id="collapseCustomers" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.seller_createadmin_seller_create') }}">Add New</a>
                        <a class="collapse-item" href="{{ route('admin.seller_alladmin_seller_all') }}">All Customer</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.admin_settingsadmin_settings') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Settings</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->