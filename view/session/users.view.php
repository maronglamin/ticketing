<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$instruction?></p>

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
                                <li class="page-item">
                                    <?php if ($page >= 2) : ?>
                                        <a class="page-link" href="<?=route('session/users?page='.($page - 1)) ?>" tabindex="-1">Previous</a>
                                    <?php endif; ?>
                                </li>
                                <?php for ($i = 1; $i <= $pages; $i++) : ?>
                                        <li class="page-item"><a class="page-link" href="<?=route('session/users?page='. $i )?>"><?= $i ?></a></li>
                                <?php endfor; ?>

                                <li class="page-item">
                                    <?php if ($page < $pages) : ?>
                                        <a class="page-link" href="<?=route('session/users?page='.($page + 1)) ?>">Next</a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </nav>
                </div> 
        </div>
    </div>
    </div>
</div>