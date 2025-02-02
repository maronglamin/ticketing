<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$instruction?></p>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header">
                    <?=flash('success')?>
                    <a href="<?= route('new/ticket') ?>" class="btn btn-sm btn-primary">New</a>
                </div>

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
                                    <th>Classified As</th>
                                    <th>From Department</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($data as $value): ?>
                                    <tr>
                                        <td><a href="<?= route('status/ticket?ticketing='. $value['ticketId']) ?>"><strong><?= $value['ticketId'] ?></strong></a></td>
                                        <td><?= human($value['make_at']) ?></td>
                                        <td><?= $value['department'] ?></td>
                                        <td><?= $value['summary'] ?></td>
                                        <td><?= $value['classification'] ?></td>
                                        <td><?= $value['user_department'] ?></td>
                                        <td><?= $value['priority'] ?></td>
                                        <td><a href="<?= route('status/ticket?ticketing='. $value['ticketId']) ?>"><strong><?= $value['status'] ?></strong></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        
                    </div>

                    <p class="text-secondary text-center">Showing <?= $page ?> of <?= $pages ?>. Total Records <?= $records ?></p>
                    <nav aria-label="Page navigation example p-2">
                        <ul class="pagination justify-content-end">
                            <!-- Previous Button -->
                            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page > 1 ? route('ticketing?page=' . ($page - 1)) : '#' ?>" tabindex="-1">Previous</a>
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
                                    <a class="page-link" href="<?= route('ticketing?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next Button -->
                            <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page < $pages ? route('callcenter/logs?page=' . ($page + 1)) : '#' ?>">Next</a>
                            </li>
                        </ul>
                    </nav>

                </div>
                
            </div>
        </div>
    </div>

</div>
