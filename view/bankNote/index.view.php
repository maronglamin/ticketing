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
                            <?php if ( isBankPlay() ):?>
                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-earmark file-icon"></i>
                                    <span class="ms-2"><?= $file['transaction_filename']?></span>
                                </div>
                                <div class="action-icons">
                                <strong><span class="<?= ($file['transaction_status'] === core\Response::PENDING)? 'text-danger' : 'text-primary'?> p-2"><?= $file['transaction_status']?></span></strong>
                                    <a href="<?= route('instrustions/view/print')?>?print=<?= $file['folder_id']?>" class="text-danger"><i class="bi bi-printer"></i> Print File</a>
                                    <a href="<?= route('instrustions/view/details')?>?view=<?= $file['folder_id']?>" class="text-success"><i class="bi bi-eye"></i> View</a>
                                </div>
                            <?php elseif (isAccountSignatory()):?>
                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-earmark file-icon"></i>
                                    <span class="ms-2"><?= $file['transaction_filename']?></span>
                                </div>
                                <div class="action-icons">
                                <strong><span class="text-primary p-2"><?= $file['transaction_status']?></span></strong>
                                    <a href="<?= route('instrustions/view/print')?>?print=<?= $file['folder_id']?>" class="text-danger"><i class="bi bi-printer"></i> Print File</a>
                                    <a href="<?= route('instrustions/view/details')?>?view=<?= $file['folder_id']?>" class="text-success"><i class="bi bi-eye"></i> View</a>
                                </div>
                            <?php else:?>
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-earmark file-icon"></i>
                                    <span class="ms-2"><?= $file['transaction_filename']?></span>
                                </div>
                                <div class="action-icons">
                                <strong><span class="<?= ($file['transaction_status'] === core\Response::PENDING)? 'text-danger' : 'text-primary'?> p-2"><?= $file['transaction_status']?></span></strong>
                                    <?php if ($file['transaction_status'] === 'PENDING'): ?>
                                        <?php if (!( userACL() === core\Response::REV ||  userACL() === core\Response::AUTH)):?> 
                                            <a href="<?= route('instrustions/new')?>?view=<?= $file['folder_id']?>" class="text-primary"><Strong>New Instruction</Strong></a>
                                        <?php endif; ?>
                                    <?php endif;?>
                                    <?php if ($file['transaction_status'] !== core\Response::APPROVE): ?>
                                        <?php if($file['debit_note_form_id'] !== null):?>
                                            <?php if (!( userACL() === core\Response::REV ||  userACL() === core\Response::AUTH)):?> 
                                                <a href="<?= route('instrustions/edit')?>?edit=<?= $file['folder_id']?>" class="text-success"><i class="bi bi-pencil"></i> Edit</a>
                                            <?php endif;?>
                                        <?php endif;?>
                                    <?php endif;?>
                                    <a href="<?= route('instrustions/view/print')?>?print=<?= $file['folder_id']?>" class="text-danger"><i class="bi bi-printer"></i> Print File</a>
                                    <a href="<?= route('instrustions/view/details')?>?view=<?= $file['folder_id']?>" class="text-success"><i class="bi bi-eye"></i> View</a>
                                </div>
                            </li>
                            <?php endif;?>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        <?php else:?>
                            <p><span class="text-center">No Bank Notes available</span></p>
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
