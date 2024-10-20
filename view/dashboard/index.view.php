<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Department:  <?= department(); ?></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                            <?= department(); ?> Raised</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-900"><?=$departmentCount['ticketCount']?> Log Tickets</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                User <?= core\Session::user()?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $userCount['username']?> Log Tickets</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-info text-uppercase mb-1">Resolved Tickets
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$deptResolved['ticketStatus']?></div>
                                </div>
                                <!-- <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="admin/publisher/components/add_cat.php"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                New Tickets</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$deptNew['ticketStatus']?> Newly Log Tickets</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-upload fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <hr class="sidebar-divider">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Recent Top 10 Tickets</h1>
        <a href="<?= route('new/ticket') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> New Ticket</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table 
                            class="table 
                            table-borderless"
                            width="100%" 
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Request_id</th>
                                    <th>Request_Date</th>
                                    <th>Intended department</th>
                                    <th>Request Summary</th>
                                    <th>Username</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($data as $value): ?>
                                    <tr>
                                        <td><a href="<?= route('status/ticket?ticketing='. $value['ticketId']) ?>"><strong><?= $value['ticketId'] ?></strong></a></td>
                                        <td><?= human($value['make_at']) ?></td>
                                        <td><?= $value['department'] ?></td>
                                        <td><?= $value['summary'] ?></td>
                                        <td><?= $value['maker_id'] ?></td>
                                        <td><?= $value['priority'] ?></td>
                                        <td><a href="<?= route('status/ticket?ticketing='. $value['ticketId']) ?>"><strong><?= $value['status'] ?></strong></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</div>
