<!-- Sidebar -->
<ul 
    class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" 
    id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a 
        class="sidebar-brand d-flex align-items-center justify-content-center" 
        href="#">
        <div class="sidebar-brand-text mx-3"><?=core\Response::COMPANY_NAME?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item active">
    <a class="nav-link" href="<?= route('dashboard')?>">
        <span>Dashboard</span>
    </a>
    </li>

    <!-- // if(http\model\User\Users::hasRole('Manager') || http\model\User\Users::hasRole('Supervisor')) :?> -->
        <li class="nav-item active">
        <a class="nav-link" href="<?= route('aps-request')?>">
            <span>Ticketing</span>
        </a>
        </li>
        
        <!-- Divider -->
        <hr class="sidebar-divider">

    <!--  // endif;?> -->

    <?php if(http\model\User\Users::hasDepartment('IT')) :?>
        <li class="nav-item">
            <a 
                class="nav-link collapsed" 
                href="#" 
                data-toggle="collapse" 
                data-target="#collapseITdirectives" 
                aria-expanded="true" 
                aria-controls="collapseITdirectives">
                <span>Request</span>
            </a>

            <div 
                id="collapseITdirectives" 
                class="collapse" 
                aria-labelledby="headingITdirectives" 
                data-parent="#accordionSidebar">
                
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Ticketing</h6>
                    <a class="collapse-item" href="<?= route('admin/ticketing')?>">APSW Ticketing</a>

                    <h6 class="collapse-header">Maintenance</h6>
                    <a class="collapse-item" href="<?= route('mobifin/category/ticket')?>">Request Category</a>
                </div>
            </div>
        </li>

        
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Heading -->
        <div class="sidebar-heading">
            User Management
        </div>

        <li class="nav-item">
        <a 
            class="nav-link collapsed" 
            href="#" 
            data-toggle="collapse" 
            data-target="#collapseUtilities" 
            aria-expanded="true" 
            aria-controls="collapseUtilities">
            <span>Security Maintenance</span>
        </a>
        <div 
            id="collapseUtilities" 
            class="collapse" 
            aria-labelledby="headingUtilities" 
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User maintenace</h6>
                <a class="collapse-item" href="<?= route('session/users')?>">User</a>
                <a class="collapse-item" href="<?= route('session/maintenance')?>">Security operation</a>
            </div>
        </div>
    </li> 
    <?php endif;?>


    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button 
            class="rounded-circle border-0" 
            id="sidebarToggle">
        </button>
    </div>

</ul>
