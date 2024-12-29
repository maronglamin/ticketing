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

                 <div class="details-row d-flex align-items-center">
                    <div class="details-key"><h4>Form ID:</h4></div>
                    <div class="details-value"><?= $transaction['transaction_id']?></div>
                </div>

                <div class="declaration">
                <h1 class="mt-2">Declaration</h1>
                <div class="declaration">
                    I, the undersigned, hereby decare that I have reviewed the documentation and confirm the transaction in the Trust Account
                    and the details provided above are accurateto the best of my knowlegde. I understand that any inaccuracies or errors in this
                    information could lead to discrepancies in APS Wallet's financial records and may result in disciplinary action.
                </div> 
                </div>

                <!-- Header with Back Button -->
                <div class="details-header">
                        <h5>Transaction Details</h5>
                        <a href="<?= route('transaction/history')?>" class="back-btn">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>

                    <!-- Details Section -->
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Reason/Purpose:</div>
                        <div class="details-value"><?= $transaction['transaction_reason']?></div>
                    </div>

                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Transaction Type:</div>
                        <div class="details-value"><?= $transaction['Transaction_type']?></div>
                    </div>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Transaction Amount:</div>
                        <div class="details-value">GMD <?= number_format($transaction['Transaction_amount'])?></div>
                    </div>
                    <div class="details-row d-flex align-items-center">
                        <div class="details-key">Transaction Status:</div>
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
                        <div class="details-key">Withdraw TO TRUST TransactionId:</div>
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
