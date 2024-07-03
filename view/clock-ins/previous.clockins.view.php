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
                    <div class="pb-2">
                        Clocked in Staff
                    </div>
                    <?=flash('success')?>
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
                                    <th>Username</th>
                                    <th>Date</th>
                                    <th>Clockin at</th>
                                    <th>Clockout at</th>
                                    <th>PC Used at CI</th>
                                    <th>PC Used at CO</th>
                                    <th>Clockin Status</th>
                                    <th>Expected Diff</th>
                                    <th>Clockin Status</th>
                                    <th>Clocked out Diff</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($previousListing as $value): ?>
                                    <tr>
                                        <td><a href="<?= route('clock-ins/previousDayReactions?tracking='. $value['username']) ?>"><strong><?= text2cap($value['username']) ?></strong></a></td>
                                        <td><?= human($value['month_year']) ?></td>
                                        <td><?= readTime($value['clock_in_at']) ?></td>
                                        <td><?= ((!empty($value['clock_out_at']) && $value['clock_in_at'] !== NULL)? readTime($value['clock_out_at']) : '__:__') ?></td>
                                        <td><strong><?= $value['host_name'] ?></strong></td>
                                        <td><strong><?= $value['clock_out_host'] ?></strong></td>
                                        <td><?= $value['clock_in_status'] ?></td>
                                        <td><?= $value['expected_diff'] ?></td>
                                        <td><?= $value['clock_out_status'] ?></td>
                                        <td><?= $value['expected_clockout_diff'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        
                    </div>

                    <p class="text-secondary text-center">Showing <?= $page ?> of <?= $pages ?>.</p>
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