<div class="container mt-4">
        <div class="row">
            <!-- Right Column: Explorer Section -->
            <div class="col-md-12">
                <div class="explorer-container">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                    <div><h5>Recorded Transactions</h5></div>
                        <div>
                            <form action="">
                                
                            </form>
                        </div>
                    </div>
                    <div>
                        <?=flash('success')?>
                    </div>
                    <ul class="list-group">
                        <!-- Folder Example -->

                        <?php
// Debugging: Check the structure of $folderData
// echo '<pre>';
// print_r($folderData);
// echo '</pre>';
// exit;

if (!empty($folderData)): ?>
    <div class="accordion" id="folderAccordion">
        <?php $firstFolder = true; ?>
        <?php foreach ($folderData as $folderName => $subfolders): ?>
            <?php if (is_array($subfolders)): // Ensure $subfolders is an array ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= htmlspecialchars($folderName) ?>">
                        <button class="accordion-button <?= $firstFolder ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= htmlspecialchars($folderName) ?>" aria-expanded="<?= $firstFolder ? 'true' : 'false' ?>" aria-controls="collapse<?= htmlspecialchars($folderName) ?>">
                            <i class="bi bi-folder folder-icon"></i>
                            <span class="ms-2"><strong><?= htmlspecialchars($folderName) ?></strong></span>
                        </button>
                    </h2>
                    <div id="collapse<?= htmlspecialchars($folderName) ?>" class="accordion-collapse collapse <?= $firstFolder ? 'show' : '' ?>" aria-labelledby="heading<?= htmlspecialchars($folderName) ?>" data-bs-parent="#folderAccordion">
                        <div class="accordion-body">
                            <ul class="list-group">
                                <?php foreach ($subfolders as $subfolderName => $files):dnd($subfolders) ?>
                                    <?php if (is_array($files)): // Ensure $files is an array ?>
                                        <li class="list-group-item d-flex align-items-center justify-content-between">
                                            <div>
                                                <i class="bi bi-folder2 folder-icon"></i>
                                                <span class="ms-2"><strong><?= htmlspecialchars($subfolderName) ?></strong></span>
                                            </div>
                                        </li>
                                        <ul class="list-group">
                                            <?php foreach ($files as $file): ?>
                                                <?php if (is_array($file)): // Ensure $file is an array ?>
                                                    <li class="list-group-item d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-file-earmark file-icon"></i>
                                                            <span class="ms-2"><?= htmlspecialchars($file['transaction_filename']) ?></span>
                                                        </div>
                                                        <div class="action-icons">
                                                            <strong><span class="text-primary p-2"><?= htmlspecialchars($file['transaction_status']) ?></span></strong>
                                                            <a href="<?= route('instrustions/view/print') ?>?print=<?= htmlspecialchars($file['folder_id']) ?>" class="text-danger"><i class="bi bi-printer"></i> Print File</a>
                                                            <a href="<?= route('instrustions/view/details') ?>?view=<?= htmlspecialchars($file['folder_id']) ?>" class="text-success"><i class="bi bi-eye"></i> View</a>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php $firstFolder = false; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p><span class="text-center">No Bank Notes available</span></p>
<?php endif; ?>
                    <p class="text-secondary text-center">Showing <?= $page ?> of <?= $pages ?>. Total Records <?= $records ?></p>
                    <nav aria-label="Page navigation example p-2">
                        <ul class="pagination justify-content-end">
                            <!-- Previous Button -->
                            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page > 1 ? route('signatures/bank/note?page=' . ($page - 1)) : '#' ?>" tabindex="-1">Previous</a>
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
                                    <a class="page-link" href="<?= route('signatures/bank/note?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next Button -->
                            <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page < $pages ? route('signatures/bank/note?page=' . ($page + 1)) : '#' ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
