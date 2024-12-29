 <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Header with Company Logo and Back Button -->
                <div class="details-header mt-5 pt-2 d-flex align-items-center justify-content-center">
                    <img src="/public/img/saved.png" alt="Company Logo" class="logo">
                </div>
                <?php foreach($transactions as $transaction): ?>
                <div class="details-container">
                    <?php if($transaction['review_by'] === NULL && userACL() === core\Response::REV):?>
                        <div class="d-flex align-items-center justify-content-end mb-2">
                            <div>
                                <form action="<?= route('transaction/review')?>" method="post" class="nav-link" role="button">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="id" value="<?=$transaction['id']?>">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reviewModal">Review</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="reviewModalLabel">Review Transaction Details</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="comment" class="form-label"><strong>Review Comment</strong></label>
                                                <textarea type="text" style="height: 90px;" class="form-control <?php if(isset($errors['comment'])):?>is-invalid<?php endif;?>" name="comment" id="comment" placeholder="Make a comment"></textarea>
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </form>                    
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div><h3>Review/Reject Transaction</h3></div>
                            <div>
                                <form action="<?= route('transaction/reject')?>" method="post" class="nav-link" role="button">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="id" value="<?=$transaction['id']?>">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="erejectModalLabel">Reject Transaction</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Note:</strong> Inform the user to correct the details for review proccess to take effect</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                </form>                    
                            </div>
                        </div>
                    <?php elseif (userACL() === core\Response::AUTH && $transaction['review_by'] !== NULL && $transaction['Approved_by'] === NULL && $transaction['transaction_status'] !== 'REJECTED'):?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div><h3>Approve Transaction</h3></div>
                            <div>
                                <form action="<?= route('transaction/approval')?>" method="post" class="nav-link" role="button">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="id" value="<?=$transaction['id']?>">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Approve</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Approved Transaction</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="approve_comment" class="form-label"><strong>Approve Comment</strong></label>
                                                <textarea type="text" style="height: 90px;" class="form-control <?php if(isset($errors['approve_comment'])):?>is-invalid<?php endif;?>" name="approve_comment" id="approve_comment" placeholder="Make a comment"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                </form>                    
                            </div>
                        </div>
                    <?php endif;?>
                    <hr class="mb-3">
                    <!-- Header with Back Button -->
                    <div class="details-header">
                        <h5>Transaction Details</h5>
                        <a href="<?= route('transaction/history')?>" class="back-btn">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Reason/Purpose:</div>
                        <div class="details-value"><?= $transaction['transaction_reason']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Type:</div>
                        <div class="details-value"><?= $transaction['Transaction_type']?></div>
                    </div>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Amount:</div>
                        <div class="details-value">GMD <?= number_format($transaction['Transaction_amount'])?></div>
                    </div>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Status:</div>
                        <div class="details-value text-success"><?= $transaction['transaction_status']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Transaction File:</div>
                        <div class="details-value text-success"><?= $transaction['transaction_filename']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Date:</div>
                        <div class="details-value"><?= $transaction['created_at']?></div>
                    </div>

                    <?php if(! empty($transaction['agent_name'])):?>
                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Agent Name:</div>
                            <div class="details-value"><?= $transaction['agent_name']?></div>
                        </div>
                    <?php endif;?>

                    <?php if(! empty($transaction['kill_money_trxnid'])):?>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Withdraw To TRUST TransactionId:</div>
                        <div class="details-value"><?= $transaction['kill_money_trxnid']?></div>
                    </div>
                    <?php endif;?>

                    <?php if(! empty($transaction['agent_acc_number'])):?>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Agent Wallet Number:</div>
                        <div class="details-value"><?= $transaction['agent_acc_number']?></div>
                    </div>
                    <?php endif;?>
                    
                    <?php if(! empty($transaction['bank_name'])):?>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Bank Name:</div>
                        <div class="details-value"><?= $transaction['bank_name']?></div>
                    </div>
                    <?php endif;?>

                    <?php if(! empty($transaction['bank_trxn_ref'])):?>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Bank Transaction Reference:</div>
                        <div class="details-value"><?= $transaction['bank_trxn_ref']?></div>
                    </div>
                    <?php endif;?>

                    <?php if(! empty($transaction['bank_trxn_ref'])):?>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Bank Transaction Narration:</div>
                        <div class="details-value"><?= $transaction['bank_trxn_narration']?></div>
                    </div>
                    <?php endif;?>

                    <hr class="p-2">
                    <!-- Details Section -->
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Form ID:</div>
                        <div class="details-value"><strong><?= $transaction['transaction_id']?></strong></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Requested By username:</div>
                        <div class="details-value"><?= $transaction['maker_id']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Reviewed By:</div>
                        <div class="details-value"><?= $transaction['review_by']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Approved By:</div>
                        <div class="details-value"><?= $transaction['Approved_by']?></div>
                    </div>
                    <hr>

                    <!-- The supporting document section -->
                    <h4 class="text-center">Attached Fils</h4>
                    <?php if(! empty($transaction['upload_file'])):?>
                        <img src="<?= root() . $transaction['upload_file']?>" alt="The uploaded file" style="margin: 0;padding: 0;width: 100%;height: auto;">
                    <?php endif;?>
                </div>
            <?php endforeach;?>
            </div> <!-- end-->
        </div>
    </div>
