<div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Header with Company Logo and Back Button -->
                <div class="details-header mt-5 pt-2 d-flex align-items-center justify-content-center">
                    <img src="/public/img/saved.png" alt="Company Logo" class="logo">
                </div>
                <?php foreach($transactions as $transaction): ?>
                <div class="details-container">
                <div class="details-row d-flex align-items-center">
                        <div class="details-key">Form ID:</div>
                        <div class="details-value"><strong><?= $transaction['debit_note_form_id']?></strong></div>
                    </div>
                    <?php if($transaction['reviewed_by'] === NULL && userACL() === core\Response::REV):?>
                        <div class="d-flex align-items-center justify-content-end mb-2">
                            <div>
                                <form action="<?= route('instruction/review')?>" method="post" class="nav-link" role="button">
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
                                <form action="<?= route('instruction/reject')?>" method="post" class="nav-link" role="button">
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
                    <?php elseif (userACL() === core\Response::AUTH && $transaction['reviewed_by'] !== NULL && $transaction['approved_by'] === NULL && $transaction['transaction_status'] !== 'REJECTED'):?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div><h3>Approve Transaction</h3></div>
                            <div>
                                <form action="<?= route('instruction/approve')?>" method="post" class="nav-link" role="button">
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
                                                <label for="approved_comment" class="form-label"><strong>Approve Comment</strong></label>
                                                <textarea type="text" style="height: 90px;" class="form-control <?php if(isset($errors['approved_comment'])):?>is-invalid<?php endif;?>" name="approved_comment" id="approved_comment" placeholder="Make a comment"></textarea>
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
                    <?php elseif ((isOtherBankUser() || isBankPlay()) && $transaction['transaction_status'] !== Core\Response::STATUS_CLOSED):?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div><h5>Bank Player</h5></div>
                            <div>
                                <form action="<?= route('instruction/bank/officer')?>" method="post" class="nav-link" role="button">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="id" value="<?=$transaction['id']?>">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Close Note</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Bank Officer: Close Note</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="bank_comment" class="form-label"><strong>Bank Officer Comment</strong></label>
                                                <textarea type="text" style="height: 90px;" class="form-control <?php if(isset($errors['bank_comment'])):?>is-invalid<?php endif;?>" name="bank_comment" id="bank_comment" placeholder="Make a comment"></textarea>
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
                    <?php elseif (isAccountSignatory() && empty($transaction['sign_1']) && $transaction['transaction_status'] === Core\Response::SENT_FOR_SIGNATURE && userACL() === core\Response::REV):?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div><h5>User 1 Account Signatory</h5></div>
                            <div>
                                <form action="<?= route('reviewer/sign/authority')?>" method="post" class="nav-link" role="button">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="id" value="<?=$transaction['id']?>">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#signModal">Sign Documentt</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="signModal" tabindex="-1" aria-labelledby="signModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="signModalLabel">Account Signatory's Comment</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <textarea type="text" style="height: 90px;" class="form-control <?php if(isset($errors['sign_1_comment'])):?>is-invalid<?php endif;?>" name="sign_1_comment" id="sign_1_comment" placeholder="Make a comment"></textarea>
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
                    <?php elseif (isAccountSignatory() && !empty($transaction['sign_1']) && empty($transaction['sign_2']) && $transaction['transaction_status'] === Core\Response::SENT_FOR_SIGNATURE && userACL() === core\Response::AUTH):?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div><h5>User 2 Account Signatory</h5></div>
                            <div>
                                <form action="<?= route('approver/sign/authority')?>" method="post" class="nav-link" role="button">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="id" value="<?=$transaction['id']?>">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal">Sign Documentt</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="approveModalLabel">Account Signatory's Comment</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <textarea type="text" style="height: 90px;" class="form-control <?php if(isset($errors['sign_2_comment'])):?>is-invalid<?php endif;?>" name="sign_2_comment" id="sign_2_comment" placeholder="Make a comment"></textarea>
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
                        <?php if (isAccountSignatory()):?>
                            <a href="<?= route('signatures/bank/note')?>" class="back-btn">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <?php elseif (isOtherBankUser() || isBankPlay()):?>
                            <a href="<?= route('user/bank/note')?>" class="back-btn">
                            <i class="bi bi-arrow-left"></i> Back
                            </a>
                        <?php else:?>
                        <a href="<?= route('instrustions/bank/note')?>" class="back-btn">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <?php endif;?>
                    </div>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Date:</div>
                        <div class="details-value"><?= $transaction['created_at']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Withdraw To TRUST TransactionId:</div>
                        <div class="details-value"><?= $transaction['Kill_money_trxn_id']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Kill Money Form ID:</div>
                        <div class="details-value"><?= $transaction['kill_money_form_id']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Reason/Purpose:</div>
                        <div class="details-value"><?= $transaction['transaction_reason']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Type:</div>
                        <div class="details-value">APS WALLET Bank Debit Note</div>
                    </div>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Amount:</div>
                        <div class="details-value">GMD <?= number_format($transaction['debit_amount'])?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">wallet Name:</div>
                        <div class="details-value"><?= $transaction['wallet_name']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Wallet Number:</div>
                        <div class="details-value"><?= $transaction['wallet_number']?></div>
                    </div>


                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Agent's Bank Name:</div>
                        <div class="details-value"><?= $transaction['Agent_bank_nane']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Agent Account Number:</div>
                        <div class="details-value"><?= $transaction['agent_bank_acc_num']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Status:</div>
                        <div class="details-value text-success"><?= $transaction['transaction_status']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Debit Note Filename:</div>
                        <div class="details-value text-success"><?= $transaction['transaction_filename']?></div>
                    </div><br><hr>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Bank Instruction Narration:</div>
                        <div class="details-value"><p><?= $transaction['debit_instruction']?></p></div>
                    </div>

                    <hr class="p-2">
                    <!-- Details Section -->
                    <div class="row">
                        <div class="col-md-6">
                        <div class="details-row d-flex align-items-center">
                        <div class="details-key">Requested By username:</div>
                        <div class="details-value"><?= $transaction['maker_id']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Requested At:</div>
                        <div class="details-value"><?= $transaction['created_at']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Reviewed By:</div>
                        <div class="details-value"><?= $transaction['reviewed_by']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Reviewed At:</div>
                        <div class="details-value"><?= $transaction['reviewed_at']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Reviewed Comment:</div>
                        <div class="details-value"><?= $transaction['reviewed_comment']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Approved By:</div>
                        <div class="details-value"><?= $transaction['approved_by']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Approved At:</div>
                        <div class="details-value"><?= $transaction['approved_at']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Approved Comment:</div>
                        <div class="details-value"><?= $transaction['approved_comment']?></div>
                    </div>
                        </div>

                        <div class="col-md-6">
                            <div class="details-row d-flex align-items-center">
                            <div class="details-key">Account Signatory 1 Name:</div>
                            <div class="details-value"><?= $transaction['sign_1']?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Signed At</div>
                            <div class="details-value"><?= $transaction['sign_at_1']?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Signed by Comment:</div>
                            <div class="details-value"><?= $transaction['sign_1_comment']?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Account Signatory 2 Name:</div>
                            <div class="details-value"><?= $transaction['sign_2']?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Signed At</div>
                            <div class="details-value"><?= $transaction['sign_at_2']?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Signed by Comment:</div>
                            <div class="details-value"><?= $transaction['sign_2_comment']?></div>
                        </div>
                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Closed By</div>
                            <div class="details-value"><?= $transaction['closed_by']?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Closed At:</div>
                            <div class="details-value"><?= $transaction['closed_at']?></div>
                        </div>
                        </div>
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
