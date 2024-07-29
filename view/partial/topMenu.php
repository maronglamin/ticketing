<!-- Content Wrapper -->
<div 
    id="content-wrapper" 
    class="d-flex flex-column">
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button 
                id="sidebarToggleTop" 
                class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <a 
                class="sidebar-brand d-flex align-items-center justify-content-center" 
                href="#">
                <div class="sidebar-brand-text mx-3"><?= core\Response::COMPANY_NAME ?></div>
            </a>         

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <!-- here  -->
                    
                <li class="nav-item no-arrow mx-1">
                    <form 
                        action="<?= route('session')?>" 
                        method="post" 
                        class="nav-link" 
                        role="button">

                        <input 
                            type="hidden"
                            name="_method"
                            value="DELETE"
                        >
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        <button class="session-button">Logout</button>
                    </form>
                </li>


                <!-- here. notification dropdown makeup  -->


                <!-- Nav Item - Messages -->


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a 
                        class="nav-link dropdown-toggle" 
                        href="#" id="userDropdown" 
                        role="button" 
                        data-toggle="dropdown" 
                        aria-haspopup="true" 
                        aria-expanded="false">

                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= text2cap(core\Session::user())?></span>
                        <img 
                            class="img-profile rounded-circle" 
                            src="<?= root() ?>/public/img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div 
                        class="dropdown-menu dropdown-menu-right shadow animated--grow-in" 
                        aria-labelledby="userDropdown">
                        <a 
                            class="dropdown-item" 
                            href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a 
                            class="dropdown-item" 
                            href="<?= route('session/user/password?user='. core\Session::user())?>">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->