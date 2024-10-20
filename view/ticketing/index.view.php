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
                                <li class="page-item">
                                    <?php if ($page >= 2) : ?>
                                        <a class="page-link" href="<?=route('ticketing?page='.($page - 1)) ?>" tabindex="-1">Previous</a>
                                    <?php endif; ?>
                                </li>
                                <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                        <li class="page-item"><a class="page-link" href="<?=route('ticketing?page='. $i )?>"><?= $i ?></a></li>
                                <?php endfor; ?>

                                <li class="page-item">
                                    <?php if ($page < $pages) : ?>
                                        <a class="page-link" href="<?=route('ticketing?page='.($page + 1)) ?>">Next</a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </nav>

                </div>
                
            </div>
        </div>
    </div>

</div>
