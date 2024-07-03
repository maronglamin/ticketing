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

    <?php if(Http\model\User\Users::hasRole('Manager') || Http\model\User\Users::hasRole('Supervisor')) :?>
        <li class="nav-item active">
        <a class="nav-link" href="<?= route('ticketing')?>">
            <span>APSW Ticketing</span>
        </a>
        </li>
        
        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a 
                class="nav-link collapsed" 
                href="#" 
                data-toggle="collapse" 
                data-target="#collapseTicketing" 
                aria-expanded="true" 
                aria-controls="collapseTicketing">
                <span>APS Wallet Ticketing</span>
            </a>

            <div 
                id="collapseTicketing" 
                class="collapse" 
                aria-labelledby="headingTicketing" 
                data-parent="#accordionSidebar">
                
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Staff Ticketing</h6>
                    <a class="collapse-item" href="<?= route('ticketing')?>">APSW Ticketing</a>
                    <a class="collapse-item" href="<?= route('new/ticket')?>">New Ticket</a>
                </div>
            </div>
        </li>
    <?php endif;?>

    <!-- Heading -->
    <div class="sidebar-heading">
        MobiFin Report
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <?php if(Http\model\User\Users::hasDepartment('Compliance')) :?>
        <li class="nav-item">
            <a 
                class="nav-link collapsed" 
                href="#" 
                data-toggle="collapse" 
                data-target="#collapseCompliance" 
                aria-expanded="true" 
                aria-controls="collapseCompliance">
                <span>Compliance</span>
            </a>

            <div 
                id="collapseCompliance" 
                class="collapse" 
                aria-labelledby="headingCompliance" 
                data-parent="#accordionSidebar">
                
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Compliance Folders</h6>
                        <a class="collapse-item" href="<?= route('transaction/journal')?>">Transation Journal</a>
                        <a class="collapse-item" href="#">Customer Account History</a>

                    <?php if(Http\model\User\Users::hasRole('Manager')):?>
                        <a class="collapse-item" href="#">Customer Onboardings</a>
                        <a class="collapse-item" href="#">SMS Report</a>
                    <?php endif;?>

                </div>
            </div>
        </li>
    <?php endif;?>


    <!-- Nav Item - Pages Collapse Menu -->
    <?php if(Http\model\User\Users::hasDepartment('HR')) :?>
        <li class="nav-item">
            <a 
                class="nav-link collapsed" 
                href="#" 
                data-toggle="collapse" 
                data-target="#collapseHR" 
                aria-expanded="true" 
                aria-controls="collapseHR">
                <span>Human Resources</span>
            </a>

            <div 
                id="collapseHR" 
                class="collapse" 
                aria-labelledby="headingHR" 
                data-parent="#accordionSidebar">
                
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">HR folders</h6>
                        <a class="collapse-item" href="<?= route('clock-ins/in')?>">Clock in</a>
                        <a class="collapse-item" href="<?= route('clock-ins/out')?>">Clock out</a>
                        <a class="collapse-item" href="<?= route('clock-ins/track')?>">Clockins Tracks</a>
                    <h6 class="collapse-header">Other Conditions</h6>
                        <a class="collapse-item" href="<?= route('clock-ins/track/previous')?>">Previous Day</a>
                        <a class="collapse-item" href="<?= route('clock-ins/bydate')?>">Clockins by Date</a>

                </div>
            </div>
        </li>
    <?php endif;?>


    <!-- Nav Item - Pages Collapse Menu -->
    <?php if(Http\model\User\Users::hasDepartment('Operations')) :?>
        <li class="nav-item">
            <a 
                class="nav-link collapsed" 
                href="#" 
                data-toggle="collapse" 
                data-target="#collapseOperation" 
                aria-expanded="true" 
                aria-controls="collapseOperation">
                <span>Operations</span>
            </a>

            <div 
                id="collapseOperation" 
                class="collapse" 
                aria-labelledby="headingOperation" 
                data-parent="#accordionSidebar">
                
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Compliance Folders</h6>
                    <a class="collapse-item" href="<?= route('transaction/journal')?>">Transation Journal</a>
                    <a class="collapse-item" href="<?= route('#')?>">Customer Account History</a>
                    <a class="collapse-item" href="<?= route('#')?>">Daily Commissions</a>
                    <a class="collapse-item" href="<?= route('#')?>">Customer Onboardings</a>
                    <a class="collapse-item" href="<?= route('#')?>">SMS Report</a>
                    
                </div>
            </div>
        </li>
    <?php endif;?>

    <?php if(Http\model\User\Users::hasDepartment('IT')) :?>
        <li class="nav-item">
            <a 
                class="nav-link collapsed" 
                href="#" 
                data-toggle="collapse" 
                data-target="#collapseITdirectives" 
                aria-expanded="true" 
                aria-controls="collapseITdirectives">
                <span>IT TEAM</span>
            </a>

            <div 
                id="collapseITdirectives" 
                class="collapse" 
                aria-labelledby="headingITdirectives" 
                data-parent="#accordionSidebar">
                
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">IT unit Operation</h6>
                    <a class="collapse-item" href="<?= route('admin/ticketing')?>">APSW Ticketing</a>
                </div>
            </div>
        </li>

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