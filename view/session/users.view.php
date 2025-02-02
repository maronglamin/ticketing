    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">

    <div class="row">
    <div class="col-lg-12">
        <div class="card m-2 p-5">
        <?=flash('success')?>               
            <div class="table-responsive">
                    <table 
                        class="table table-borderless"
                        cellspacing="0">

                        <thead>
                            <tr>
                                <th>Confirmed Status</th>
                                <th>Registered at</th>
                                <th>Username</th>
                                <th>Department</th>
                                <th>Name</th>
                                <th>User status</th>
                                <th>Registered By</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($users as $user):?>
                                <tr>
                                    <td>
                                        <a href="<?= route('session/summary?id='. $user['id']) ?>">
                                            <?=($user['confirmed'] === core\Response::AUTHORISD)? 'Authorized':'Unauthorized'?>
                                        </a>
                                    </td>
                                    <td>
                                        <?=(human($user['created_at']))?>
                                    </td>
                                    <td>
                                        <?=$user['username'] ?>
                                    </td>
                                    <td>
                                        <?=$user['department'] ?>
                                    </td>
                                    <td>
                                        <a href="<?= route('session/summary?id='. $user['id']) ?>">    
                                            <?= text2cap($user['name'])?>
                                        </a>
                                    </td>
                                    <td>
                                        <?=($user['user_status'] === core\Response::STATUS_ENABLED)? 'ENABLED' :''?>
                                        <?=($user['user_status'] === core\Response::STATUS_HOLD)? 'HOLD' :''?>
                                        <?=($user['user_status'] === core\Response::STATUS_DISABLED)? 'DISABLED' :''?>
                                        <?=($user['user_status'] === core\Response::STATUS_LOCKED)? 'LOCKED' :''?>                                       
                                    </td>
                                    <td>
                                        <?= text2cap($user['maker'])?>
                                    </td>
                                    <td>
                                        <form method="post" action="<?= route('session/users/delete')?>" role="button">
                                            <input 
                                                type="hidden"
                                                name="_method"
                                                value="DELETE">

                                            <input 
                                                type="hidden"
                                                name="username"
                                                value="<?=$user['username']?>">

                                            <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                            <button class="session-button">Delete</button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>

                    <p class="text-secondary text-center">Showing <?= $page ?> of <?= $pages ?>. Total Records <?= $records ?></p>
                    <nav aria-label="Page navigation example p-2">
                        <ul class="pagination justify-content-end">
                            <!-- Previous Button -->
                            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page > 1 ? route('session/users?page=' . ($page - 1)) : '#' ?>" tabindex="-1">Previous</a>
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
                                    <a class="page-link" href="<?= route('session/users?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next Button -->
                            <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page < $pages ? route('session/users?page=' . ($page + 1)) : '#' ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div> 
        </div>
    </div>
    </div>
</div>
</div>