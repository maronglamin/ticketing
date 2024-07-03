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
                                    <th>Description</th>
                                    <th>Department</th>
                                    <th>Host</th>
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
                                        <td><strong><?= $value['host'] ?></strong></td>
                                        <td><?= $value['classification'] ?></td>
                                        <td><?= $value['category'] ?></td>
                                        <td><?= shortText($value['discription'], 25, "...") ?></td>
                                        <td><?= $value['department'] ?></td>
                                        <td><?= $value['maker_id'] ?></td>
                                        <td><a href="<?= route('admin/status/ticket?ticketing='. $value['id']) ?>"><strong><?= $value['status'] ?></strong></a></td>
                                        <td>
                                        <form method="post" action="<?= route('admin/delete/ticket')?>" role="button">
                                            <input 
                                                type="hidden"
                                                name="_method"
                                                value="DELETE">

                                            <input 
                                                type="hidden"
                                                name="ticket_id"
                                                value="<?=$value['ticketId']?>">

                                            <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                            <button class="session-button">Delete</button>
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
                                <li class="page-item">
                                    <?php if ($page >= 2) : ?>
                                        <a class="page-link" href="<?=route('admin/ticketing?page='.($page - 1)) ?>" tabindex="-1">Previous</a>
                                    <?php endif; ?>
                                </li>
                                <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                        <li class="page-item"><a class="page-link" href="<?=route('admin/ticketing?page='. $i )?>"><?= $i ?></a></li>
                                <?php endfor; ?>

                                <li class="page-item">
                                    <?php if ($page < $pages) : ?>
                                        <a class="page-link" href="<?=route('admin/ticketing?page='.($page + 1)) ?>">Next</a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </nav>

                </div>
                
            </div>
        </div>
    </div>

</div>