<div class="container mt-4">
        <div class="row">
            <!-- Left Column: Summary Section -->
            <div class="col-md-3">
                <div class="summary-card">
                    <h5>Balance</h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach($monthBalance as $balance): ?>
                            <li class="list-group-item fw-bold">
                                <span>
                                <i class="bi bi-plus-circle"></i> <?= $balance['transaction_type']?>
                                </span> <?= number_format($balance['total_amount'])?>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="summary-card">
                    <h5>Recent Transactions</h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($transactions as $transaction):?>
                            <li class="list-group-item"><?= $transaction['trxDate']?> - GMD <?= number_format($transaction['transaction_amount'])?> </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Explorer Section -->
            <div class="col-md-9">
                <div class="explorer-container">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                    <div><h5>Recorded Transactions</h5></div>
                        <div>
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Transactions">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-dark" type="submit">
                                            <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div>
                        <?=flash('success')?>
                    </div>
                    <ul class="list-group">
                        <!-- Folder Example -->

                        <?php if (!empty($folderData)): ?>
                        <?php foreach ($folderData as $folderName => $files):?>
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                        <div>
                            <i class="bi bi-folder folder-icon"></i>
                            <span class="ms-2"><strong><?= $folderName ?></strong></span>
                        </div>
                        <!-- <div>
                            <span>ADD MONEY: <strong>100</strong>, CREATE MONEY: <strong>59</strong>, KILL MONEY: <strong>58</strong></span>
                        </div>     -->
                        </li>
                        <ul class="list-group">
                            <!-- File Example -->
                             <?php foreach ($files as $file):?>
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-earmark file-icon"></i>
                                    <span class="ms-2"><?= $file['transaction_filename']?></span>
                                </div>
                                <div >

                                <div class="action-icons">
                                <strong><span class="<?= ($file['transaction_status'] === core\Response::PENDING)? 'text-danger' : 'text-primary'?> p-2"><?= $file['transaction_status']?></span></strong>
                                    <a href="<?= route('view/transaction/data')?>?view=<?= $file['folder_id']?>" class="text-primary"><i class="bi bi-eye"></i> View</a>
                                    
                                    <!-- is data approved? if yes, hide the edit -->
                                    <?php if ($file['transaction_status'] !== core\Response::APPROVE):?>

                                        <!-- is the user an inputter, if yes? show edit  -->
                                        <?php if (!( userACL() === core\Response::REV ||  userACL() === core\Response::AUTH)):?> 
                                            <a href="<?= route('edit/transaction/data')?>?edit=<?= $file['folder_id']?>" class="text-success"><i class="bi bi-pencil"></i> Edit</a>
                                        <?php endif;?>

                                    <?php endif;?>
                                    <a href="<?= route('transaction/data')?>?print=<?= $file['folder_id']?>" class="text-danger"><i class="bi bi-printer"></i> Print File</a>
                                </div>
                            </li>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                    <p class="text-secondary text-center">Showing <?= $page ?> of <?= $pages ?>. Total Records <?= $records ?></p>
                    <nav aria-label="Page navigation example p-2">
                        <ul class="pagination justify-content-end">
                            <!-- Previous Button -->
                            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page > 1 ? route('transaction/history?page=' . ($page - 1)) : '#' ?>" tabindex="-1">Previous</a>
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
                                    <a class="page-link" href="<?= route('transaction/history?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next Button -->
                            <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page < $pages ? route('transaction/history?page=' . ($page + 1)) : '#' ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
