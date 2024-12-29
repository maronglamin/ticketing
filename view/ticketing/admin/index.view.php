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
                    <h4 class="text-uppercase">Staff Request</h4>
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
                                    <th>Classified As</th>
                                    <th>Category</th>
                                    <th>Department</th>
                                    <th>Requested_By</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($data as $value): ?>
                                    <tr>
                                        <td><a href="<?= route('admin/status/ticket?ticketing='. $value['id']) ?>"><strong><?= $value['ticketId'] ?></strong></a></td>
                                        <td><?= human($value['make_at']) ?></td>
                                        <td><?= $value['classification'] ?></td>
                                        <td><?= $value['category'] ?></td>
                                        <td><?= $value['department'] ?></td>
                                        <td><?= text2cap($value['maker_id']) ?></td>
                                        <td><a href="<?= route('admin/status/ticket?ticketing='. $value['id']) ?>"><strong><?= $value['status'] ?></strong></a></td>
                                        <td>
                                        <form method="post" action="<?= route('admin/delete/ticket')?>" role="button">
                                            <?php if (deptPermission('APSW Operations')) :?>
                                                <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                                <button disabled class="session-button"><strong>Delete</strong></button>
                                            <?php else:?>
                                                <input 
                                                    type="hidden"
                                                    name="_method"
                                                    value="DELETE">

                                                <input 
                                                    type="hidden"
                                                    name="ticket_id"
                                                    disabled
                                                    value="<?=$value['ticketId']?>">

                                                <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                                <button class="session-button">Delete</button>
                                            <?php endif;?>
                                        </form>
                                    </td>
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
                                    <a class="page-link" href="<?= $page > 1 ? route('admin/ticketing?page=' . ($page - 1)) : '#' ?>" tabindex="-1">Previous</a>
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
                                        <a class="page-link" href="<?= route('admin/ticketing?page=' . $i) ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <!-- Next Button -->
                                <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= $page < $pages ? route('admin/ticketing?page=' . ($page + 1)) : '#' ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                </div>
                
            </div>
        </div>
    </div>

</div>
