    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5><?= department(); ?> Raised</h5>
                        <h3><?=$departmentCount['ticketCount']?></h3>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5>My Tickets</h5>
                        <h3><?= $userCount['username']?></h3>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5>Pending Tickets</h5>
                        <h3><?= $pendingCount['username']?></h3>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5>Escalated Tickets</h5>
                        <h3><?= $escalateCount['username']?></h3>
                    </div>
                </div>
                <a href="<?= route('new/ticket')?>" class="btn btn-primary w-100 mb-2">Raise a Concern</a>
                <a href="<?= route('reports')?>" class="btn btn-info w-100 mb-2">Reports</a>
            </div>

            <!-- Right Column -->
            <div class="col-md-9">
            <?=flash('success')?>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>All Tickets</h4>
                        <!-- <a href="?export=all" class="btn btn-secondary btn-sm">Export All</a> -->
                    </div>
                <table class="table table-borderless table-hover" id="ticketTable">
                    <thead class="table-dark">
                        <tr>
                            <th>Request_id</th>
                            <th>Subject</th>
                            <th>Indented Dept</th>
                            <th>Priority</th>
                            <th>Created at</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $value): ?>
                        <tr>
                            <td><a href="<?= route('status/ticket?ticketing='. $value['ticketId']) ?>"><strong><?= $value['ticketId'] ?></strong></a></td>
                            <td><?= shortText($value['summary'], '35', '...')?></td>
                            <td><?= $value['department'] ?></td>
                            <td><strong><?= $value['priority'] ?></strong></td>
                            <td><?= human($value['make_at']) ?></td>
                            <td><span class="btn btn-<?= $value['status'] === 'NEW'? 'secondary' : 'primary'?> btn-sm text-light"><?= $value['status'] ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
                
                <p class="text-secondary text-center">Showing <?= $page ?> of <?= $pages ?>. Total Records <?= $records ?></p>
                    <nav aria-label="Page navigation example p-2">
                        <ul class="pagination justify-content-end">
                            <!-- Previous Button -->
                            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page > 1 ? route('dashboard?page=' . ($page - 1)) : '#' ?>" tabindex="-1">Previous</a>
                            </li>

                            <?php
                            $maxVisiblePages = 5; // Maximum number of visible pages
                            $startPage = max(1, $page - 2); // Start 2 pages before the current page
                            $endPage = min($pages, $startPage + $maxVisiblePages - 1); // Ensure no overflow

                            // Adjust startPage if close to the last page
                            if ($endPage - $startPage + 1 < $maxVisiblePages) {
                                $startPage = max(1, $endPage - $maxVisiblePages + 1);
                            }

                            // Generate visible page links
                            for ($i = $startPage; $i <= $endPage; $i++) : ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= route('dashboard?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next Button -->
                            <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page < $pages ? route('dashboard?page=' . ($page + 1)) : '#' ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
            </div>
        </div>
    </div>

</body>

</html>
