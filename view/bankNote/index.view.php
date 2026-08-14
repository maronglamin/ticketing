<div class="container mt-4">
        <div class="row">
            <!-- Right Column: Explorer Section -->
            <div class="col-md-12">
                <div class="explorer-container">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                    <div>
                        <h5>Recorded Transactions</h5>
                    </div>
                    <div>
                        <form action="">
                            
                        </form>
                    </div>
                    </div>
                    <div>
                        <?= flash('success') ?>
                    </div>
                    <ul class="list-group">
                        <!-- Folder Example -->

                        <?php if (!empty($folderData)): ?>
    <div class="accordion" id="folderAccordion">
        <?php foreach ($folderData as $folderName => $files): ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#folder-<?= md5($folderName) ?>" aria-expanded="false">
                        <i class="bi bi-folder folder-icon"></i>
                        <span class="ms-2"><strong><?= $folderName ?></strong></span>
                    </button>
                </h2>
                <div id="folder-<?= md5($folderName) ?>" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <?php foreach ($files as $day => $dayFiles): ?>
                            <div class="accordion" id="subfolderAccordion-<?= md5($day) ?>">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#subfolder-<?= md5($day) ?>" aria-expanded="false">
                                            <i class="bi bi-folder2-open"></i>
                                            <span class="ms-2"><strong><?= $day ?></strong></span>
                                        </button>
                                    </h2>
                                    <div id="subfolder-<?= md5($day) ?>" class="accordion-collapse collapse">
                                        <div class="accordion-body p-2">
                                            <ul class="list-group">
                                                <?php foreach ($dayFiles as $file): ?>
                                                    <li class="list-group-item d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-file-earmark file-icon"></i>
                                                            <span class="ms-2"><?= $file['transaction_filename'] ?></span>
                                                        </div>
                                                        <div class="action-icons">
                                                            <strong>
                                                                <span class="<?= ($file['transaction_status'] === core\Response::PENDING) ? 'text-danger' : 'text-primary' ?> p-2">
                                                                    <?= $file['transaction_status'] ?>
                                                                </span>
                                                            </strong>
                                                            <?php if (isBankPlay()): ?>
                                                                <a href="<?= route('instrustions/view/print') ?>?print=<?= $file['folder_id'] ?>" class="text-danger">
                                                                    <i class="bi bi-printer"></i> Print
                                                                </a>
                                                            <?php endif; ?>
                                                            <?php if (isAccountSignatory()): ?>
                                                                <a href="<?= route('instrustions/view/details') ?>?view=<?= $file['folder_id'] ?>" class="text-success">
                                                                    <i class="bi bi-eye"></i> View
                                                                </a>
                                                            <?php endif; ?>
                                                            <?php if (!in_array($file['transaction_status'], [core\Response::APPROVE, core\Response::STATUS_CLOSED])): ?>
                                                                <?php if ($file['debit_note_form_id'] !== null && ($file['transaction_status'] === 'NOTE_CREATED' || $file['transaction_status'] === 'PENDING')): ?>
                                                                    <a href="<?= route('instrustions/edit') ?>?edit=<?= $file['folder_id'] ?>" class="text-success">
                                                                        <i class="bi bi-pencil"></i> Edit
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="text-center">No Bank Notes available</p>
<?php endif; ?>

                        </ul>
                        <p class="text-secondary text-center">
                            Showing <?= $page ?> of <?= $pages ?>. Total Records <?= $records ?>
                        </p>
                        <nav aria-label="Page navigation example p-2">
                            <ul class="pagination justify-content-end">
                                <!-- Previous Button -->
                                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= $page > 1 ? route('instrustions/bank/note?page=' . ($page - 1)) : '#' ?>" tabindex="-1">Previous</a>
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
                                        <a class="page-link" href="<?= route('instrustions/bank/note?page=' . $i) ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <!-- Next Button -->
                                <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="<?= $page < $pages ? route('instrustions/bank/note?page=' . ($page + 1)) : '#' ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                </div>
            </div>
        </div>
    </div>
