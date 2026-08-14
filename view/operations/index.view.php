<div class="container mt-4">
        <div class="row">
            <!-- Left Column: Summary Section -->
            <div class="col-md-3">
                <div class="summary-card">
                    <h5>Balance</h5>
                    <p><a href="<?= route('dashboard/reports')?>">Reports</a></p>
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
                        <div class="accordion" id="folderAccordion">
                            <?php foreach ($folderData as $folderName => $subfolders):?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed folder-header" type="button" data-bs-toggle="collapse" data-bs-target="#folder-<?= md5($folderName) ?>" aria-expanded="false">
                                            <i class="bi bi-folder folder-icon me-2"></i>
                                            <span class="folder-text"><?= $folderName ?></span>
                                        </button>
                                    </h2>
                                    <div id="folder-<?= md5($folderName) ?>" class="accordion-collapse collapse">
                                        <div class="accordion-body p-2">
                                            <ul class="list-group">
                                                <!-- Iterate over each subfolder (day) -->
                                                <?php foreach ($subfolders as $day => $files): ?>
                                                    <div class="accordion subfolder-accordion" id="subfolderAccordion-<?= md5($folderName) ?>">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed subfolder-header" type="button" data-bs-toggle="collapse" data-bs-target="#subfolder-<?= md5($folderName . $day) ?>" aria-expanded="false">
                                                                    <i class="bi bi-folder2-open me-2"></i>
                                                                    <span class="subfolder-text"><?= $day . ', File Count: ' . count($files) ?></span>
                                                                </button>
                                                            </h2>
                                                            <div id="subfolder-<?= md5($folderName . $day) ?>" class="accordion-collapse collapse">
                                                                <div class="accordion-body p-2">
                                                                    <!-- Iterate over each file within the subfolder -->
                                                                    <?php foreach ($files as $file): ?>
                                                                        <li class="list-group-item d-flex align-items-center justify-content-between file-item">
                                                                            <div class="d-flex align-items-center">
                                                                                <i class="bi bi-file-earmark me-2"></i>
                                                                                <span class="file-text"><?= $file['transaction_filename'] ?></span>
                                                                            </div>
                                                                            <div>
                                                                                <span class="<?= ($file['transaction_status'] === core\Response::PENDING) ? 'text-danger' : 'text-primary' ?> me-2">
                                                                                <a href="<?= route('view/transaction/data') ?>?view=<?= $file['folder_id'] ?>" class="text-primary me-2">
                                                                                <i class="bi bi-eye"></i> <?= $file['transaction_status'] ?>
                                                                                </a>
                                                                                
                                                                                </span>
                                                                                <a href="<?= route('view/transaction/data') ?>?view=<?= $file['folder_id'] ?>" class="text-primary me-2">
                                                                                    <i class="bi bi-eye"></i> View
                                                                                </a>
                                                                                <?php if ($file['transaction_status'] !== core\Response::REVIEW && $file['maker_id'] === core\Session::user()): ?>
                                                                                    <?php if (!(userACL() === core\Response::REV || userACL() === core\Response::AUTH)): ?> 
                                                                                        <a href="<?= route('edit/transaction/data') ?>?edit=<?= $file['folder_id'] ?>" class="text-success me-2">
                                                                                            <i class="bi bi-pencil"></i> Edit
                                                                                        </a>
                                                                                    <?php endif; ?>
                                                                                <?php endif; ?>
                                                                                <a href="<?= route('transaction/data') ?>?print=<?= $file['folder_id'] ?>" class="text-danger">
                                                                                    <i class="bi bi-printer"></i> Print
                                                                                </a>
                                                                            </div>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>




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
