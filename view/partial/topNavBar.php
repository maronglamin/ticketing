    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><?= core\Response::COMPANY_NAME ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <!-- Dashboard -->
                 <?php if (! (isBankPlay() || isOtherBankUser() || isAccountSignatory())):?>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= route('dashboard')?>">Dashboard</a>
                </li>
                <?php endif;?>

                <!-- My Tickets Dropdown -->
                <!-- <li class="nav-item  dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="myTicketsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        My Tickets
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="myTicketsDropdown">
                        <li><a class="dropdown-item" href="#">Open Tickets</a></li>
                        <li><a class="dropdown-item" href="#">Closed Tickets</a></li>
                        <li><a class="dropdown-item" href="#">Pending Tickets</a></li>
                    </ul>
                </li> -->

                <!-- My Tickets Dropdown -->
                <!-- <li class="nav-item  dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="MyTestDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        MyTest Tickets
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="MyTestDropdown">
                        <li><a class="dropdown-item" href="#">Ticket list</a></li>
                        <li><a class="dropdown-item" href="#">Tickets escalated</a></li>
                    </ul>
                </li> -->

                <!-- Operations -->
                <?php if(deptPermission('APSW Operations') || (deptPermission('APSW IT'))) :?>
                <li class="nav-item  dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Operations
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                        <li><a class="dropdown-item" href="<?= route('transaction/history')?>">Transaction History</a></li>
                        <li><a class="dropdown-item" href="<?= route('create/money/new')?>">Create Money Form</a></li>
                        <li><a class="dropdown-item" href="<?= route('add/money/new')?>">Add Money Form</a></li>
                        <li><a class="dropdown-item" href="<?= route('kill/money/new')?>">Kill Money Form</a></li>
                    </ul>
                </li>
            <?php endif;?>

            <?php if(isOtherBankUser() || isBankPlay() || deptPermission('APSW IT')) :?>
                <li class="nav-item  dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="FinDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Bank Authority
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="FinDropdown">
                        <li><a class="dropdown-item" href="<?= route('user/bank/note')?>">Debit Note History</a></li>
                    </ul>
                </li>
            <?php endif;?>

            <?php if(isAccountSignatory() || deptPermission('APSW IT')) :?>
                <li class="nav-item  dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="signDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Signatures
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="signDropdown">
                        <li><a class="dropdown-item" href="<?= route('signatures/bank/note')?>">Debit Note History</a></li>
                    </ul>
                </li>
            <?php endif;?>

            <?php if(deptPermission('APSW Finance') || deptPermission('APSW IT')) :?>
                <li class="nav-item  dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="FinDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Bank Notes
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="FinDropdown">
                        <li><a class="dropdown-item" href="<?= route('instrustions/bank/note')?>">Debit Note History</a></li>
                    </ul>
                </li>
            <?php endif;?>

                <!--Call center Dropdown -->
                <?php if(deptPermission('APSW IT') || deptPermission('APSW Call Center')) :?>
                <li class="nav-item  dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="callcenterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Customer Service
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="callcenterDropdown">
                        <li><a class="dropdown-item" href="<?= route('callcenter/logs')?>">Call Logs</a></li>
                    </ul>
                </li>
                <?php endif;?>

                <!-- Escalated Tickets Dropdown -->
                <?php if (! (isBankPlay() || isOtherBankUser() || isAccountSignatory())):?>
                <li class="nav-item  dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="escalatedTicketsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Escalated Tickets
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="escalatedTicketsDropdown">
                        <li><a class="dropdown-item" href="#">Coming Soon</a></li>
                        <!-- <li><a class="dropdown-item" href="#">Medium Priority</a></li>
                        <li><a class="dropdown-item" href="#">Low Priority</a></li> -->
                    </ul>
                </li>
                <?php endif;?>

                <!-- admin -->
                <?php if(isSuperAdmin() || isIntAdmin() || isIMFAdmin() || iswalletAdmin()) :?>
                <li class="nav-item  dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Config
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                        <li><a class="dropdown-item" href="<?= route('mobifin/category/ticket')?>">Ticket  Categories</a></li>
                        <li><a class="dropdown-item" href="<?= route('department/list')?>">APS Department</a></li>
                        <li><a class="dropdown-item" href="<?= route('session/users')?>">Users</a></li>
                        <li><a class="dropdown-item" href="<?= route('session/maintenance')?>">New User</a></li>
                        <?php if (isSuperAdmin()):?>
                            <li><a class="dropdown-item" href="<?= route('email/queued')?>">Email Queue</a></li>
                            <li><a class="dropdown-item" href="<?= route('settlement/bank/list')?>">Settlement Banks</a></li>
                        <?php endif;?>
                    </ul>
                </li>
            <?php endif;?>
            </ul>

            <!-- User Dropdown -->
            <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/public/img/undraw_profile.svg" class="rounded-circle" alt="Profile" width="30"> <?= text2cap(core\Session::user())?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <!-- <li><a class="dropdown-item" href="#">Profile</a></li> -->
                        <li><a class="dropdown-item" href="<?= route('session/user/password?user='. core\Session::user())?>">Change Password</a></li>
                        <li>
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
                            <button class="dropdown-item session-button">Logout</button>
                        </form>
                        </li>
                    </ul>
                </div>
        </div>
    </div>
</nav>

