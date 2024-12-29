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
                        <a href="<?= route('instrustions/bank/note')?>" class="back-btn">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Date:</div>
                        <div class="details-value"><?= $transaction['created_at']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Kill Money TransactionId:</div>
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
                    <hr>

                    <!-- The supporting document section -->
                    <h4 class="text-center">Attached Fils</h4>
                    <?php if(! $transaction['upload_file'] === NULL || !($transaction['upload_file']) === '/'):?>
                        <img src="<?= root() . $transaction['upload_file']?>" alt="The uploaded file" style="margin: 0;padding: 0;width: 100%;height: auto;">
                    <?php elseif (($transaction['upload_file']) === '/'):?>
                        <p>No Supporting Documents/Files uploaded</p>
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
