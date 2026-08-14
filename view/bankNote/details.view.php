<div class="mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <?php foreach($transactions as $transaction):?>
            <div class="details-container" id="printableArea">
            <!-- Custom Header -->
            <div class="header">APSW, OPERATIONS - eTicketing Report</div>
                <!-- Header with Company Logo and Back Button -->
                <div class="details-header mt-5 pt-2 d-flex align-items-center justify-content-center">
                    <img src="/public/img/saved.png" alt="Company Logo" class="logo">
                </div>

                <!-- Declaration Message -->
                 <div class="d-flex align-items-center justify-content-between">
                    <div><h3>Transactions Details</h3></div>
                    <div>Dated: <?= human($transaction['created_at'])?></div>
                 </div>

                <!-- Header with Back Button -->
                <!-- Header with Back Button -->
                <div class="details-header">
                        
                    </div>
                    <hr class="mb-3">
                    <!-- Header with Back Button -->
                    <div class="details-header">
                        <h5>Transaction Details</h5>
                        <?php if(isAccountSignatory()):?>
                            <a href="<?= route('signatures/bank/note') ?>" class="back-btn">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <?php elseif  (isOtherBankUser() || isBankPlay()):?>
                            <a href="<?= route('user/bank/note') ?>" class="back-btn">
                            <i class="bi bi-arrow-left"></i> Back
                            </a>
                        <?php else:?>
                        <a href="<?= route('instrustions/bank/note') ?>" class="back-btn">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <?php endif;?>
                    </div>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Date:</div>
                        <div class="details-value"><?= $transaction['created_at'] ?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Withdraw To TRUST TransactionId:</div>
                        <div class="details-value"><?= $transaction['Kill_money_trxn_id'] ?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Kill Money Form ID:</div>
                        <div class="details-value"><?= $transaction['kill_money_form_id'] ?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Reason/Purpose:</div>
                        <div class="details-value"><?= $transaction['transaction_reason'] ?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Type:</div>
                        <div class="details-value">APS WALLET Bank Debit Note</div>
                    </div>

                    <h5 class="mt-3 mb-3">Debit Account Details</h5>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">APSW Account Name:</div>
                        <div class="details-value"><?= $transaction['Agent_paid_acc_name'] ?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">APSW Account Number:</div>
                        <div class="details-value"><?= $transaction['agent_paid_bank_acc_num'] ?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Debit Amount:</div>
                        <div class="details-value">GMD <?= format_number($transaction['debit_amount']) ?></div>
                    </div>

                    <h5 class="mt-3 mb-3">Credit Beneficiary Account Details</h5>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">wallet Name:</div>
                        <div class="details-value"><?= $transaction['agent_name'] ?></div>
                    </div>
                    

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Wallet Number:</div>
                        <div class="details-value"><?= $transaction['agent_wallet_number'] ?></div>
                    </div>


                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Agent's Bank Name:</div>
                        <div class="details-value"><?= $transaction['Agent_bank_nane'] ?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Agent Account Name:</div>
                        <div class="details-value"><?= $transaction['agent_bank_acc_name'] ?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Agent Account Number:</div>
                        <div class="details-value"><?= $transaction['agent_bank_acc_num'] ?></div>
                    </div>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Credit Amount:</div>
                        <div class="details-value">GMD <?= format_number($transaction['debit_amount']) ?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Status:</div>
                        <div class="details-value text-success"><?= $transaction['transaction_status'] ?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Debit Note Filename:</div>
                        <div class="details-value text-success"><?= $transaction['transaction_filename'] ?></div>
                    </div><br><hr>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Bank Instruction Narration:</div>
                        <div class="details-value"><p><?= $transaction['debit_instruction'] ?></p></div>
                    </div>

                    <hr class="p-2">
                    <!-- Details Section -->
                    <div class="row">
                        <div class="col-md-6">
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Requested By username:</div>
                        <div class="details-value"><?= $transaction['maker_id'] ?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Requested at:</div>
                        <div class="details-value"><?=  $transaction['created_at']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Reviewed By:</div>
                        <div class="details-value">
                            <?= ($transaction['reviewed_by'] !== NULL) ? $transaction['reviewed_by'] : 'N/A' ?>
                        </div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Reviewed at:</div>
                        <div class="details-value">
                            <?= ($transaction['reviewed_at'] !== NULL) ? $transaction['reviewed_at'] : 'N/A' ?>
                        </div>
                    </div>  

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Reviewed Comment:</div>
                        <div class="details-value"><?= $transaction['reviewed_comment'] ?></div>
                    </div>

                    
                    </div>

                        <div class="col-md-6">
                            <div class="details-row d-flex align-items-center">
                            <div class="details-key">Account Signatory 1 Name:</div>
                            <div class="details-value"><?= $transaction['sign_1'] ?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Signed At</div>
                            <div class="details-value"><?= $transaction['sign_at_1'] ?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Signed by Comment:</div>
                            <div class="details-value"><?= $transaction['sign_1_comment'] ?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Account Signatory 2 Name:</div>
                            <div class="details-value"><?= $transaction['sign_2'] ?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Signed At</div>
                            <div class="details-value"><?= $transaction['sign_at_2'] ?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Signed by Comment:</div>
                            <div class="details-value"><?= $transaction['sign_2_comment'] ?></div>
                        </div>
                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Closed By</div>
                            <div class="details-value"><?= $transaction['closed_by'] ?></div>
                        </div>

                        <div class="details-row d-flex align-items-center">
                            <div class="details-key">Closed At:</div>
                            <div class="details-value"><?= $transaction['closed_at'] ?></div>
                        </div>
                        </div>
                    </div>
                    <hr>

                     <!-- The supporting document section -->
                     <h4 class="text-center">Attached Fils</h4>
                    <?php if (! empty($transaction['upload_file'])):?>
                        <img src="<?= $transaction['upload_file'] ?>" alt="The uploaded file" style="margin: 0;padding: 0;width: 100%;height: auto;">
                    <?php endif;?>
                </div>

                <!-- Print Button -->
                <button onclick="printDiv('printableArea')" class="btn btn-success btn-sm mt-4">
                    <i class="bi bi-printer"></i> Print
                </button>

            <?php endforeach;?>
            </div> <!-- end-->

            </div> <!-- End of details-container -->
        </div> <!-- End of col-md-8 -->
    </div> <!-- End of row -->
</div> <!-- End of container -->
