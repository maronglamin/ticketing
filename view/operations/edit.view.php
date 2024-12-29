<div class="container mt-5">
        <div class="row">
        <?php foreach($transactions as $transaction):?>
            <div class="col-md-10 offset-md-1">
                <div class="form-card">
                    <div class="form-header">Edit <?= $transaction['Transaction_type']?> Transaction</div>
                    <form method="post" action="<?= route('edit/transaction/details') ?>">
                        <input type="hidden" name="id" id="id" value="<?= sanitize($_GET['edit'])?>">
                        <input type="hidden" class="form-control" name="Transaction_type" id="Transaction_type" value="<?= $transaction['Transaction_type']?>">

                        <?php if(! empty($transaction['wallet_name'])):?>
                        <div class="mb-3">
                            <label for="wallet_name" class="form-label">Wallet Name</label>
                            <input type="text" class="form-control" id="wallet_name" name="wallet_name" value="<?= $transaction['wallet_name']?>">
                            <?php if(isset($errors['wallet_name'])):?>
                                <div id="wallet_name" class="invalid-feedback"><?=$errors['wallet_name']?></div>
                            <?php endif;?>
                        </div>
                        <?php endif;?>
                        
                        <?php if(! empty($transaction['wallet_number'])):?>
                        <div class="mb-3">
                            <label for="wallet_number" class="form-label">Wallet Number</label>
                            <input type="text" class="form-control" id="wallet_number" name="wallet_number" value="<?= $transaction['wallet_number']?>">
                            <?php if(isset($errors['wallet_number'])):?>
                                <div id="wallet_number" class="invalid-feedback"><?=$errors['wallet_number']?></div>
                            <?php endif;?>
                        </div>
                        <?php endif;?>

                        <div class="mb-3">
                            <label for="Transaction_amount" class="form-label">Transaction Amount</label>
                            <input type="text" class="form-control" name="Transaction_amount" id="Transaction_amount" value="<?= $transaction['Transaction_amount']?>">
                            <?php if(isset($errors['Transaction_amount'])):?>
                                <div id="Transaction_amount" class="invalid-feedback"><?=$errors['Transaction_amount']?></div>
                            <?php endif;?>
                        </div>

                        <div class="mb-3">
                            <label for="transaction_reason" class="form-label">Reason</label>
                            <select class="form-select <?php if(isset($errors['transaction_reason'])):?>is-invalid<?php endif;?>" id="transaction_reason" name="transaction_reason">
                                <option value="<?= $transaction['transaction_reason']?>"><?= $transaction['transaction_reason']?></option>
                                <option>Internal Fund Transfer</option>
                                <option>Replenishment</option>
                                <option>Salary Disbursement</option>
                                <option>Other</option>
                            </select>

                            <?php if(isset($errors['transaction_reason'])):?>
                                <div id="transaction_reason" class="invalid-feedback"><?=$errors['transaction_reason']?></div>
                            <?php endif;?>
                        </div>

                        <?php if(! empty($transaction['cm_serial'])):?>
                            <div class="mb-3">
                                <label for="cm_serial" class="form-label">Create Money Form id</label>
                                <input type="text" class="form-control" id="cm_serial" name="cm_serial" placeholder="Enter amount" value="<?= $transaction['cm_serial']?>">
                                <?php if(isset($errors['cm_serial'])):?>
                                <div id="cm_serial" class="invalid-feedback"><?=$errors['cm_serial']?></div>
                            <?php endif;?>
                            </div>
                        <?php endif;?>

                        <?php if(! empty($transaction['bank_trxn_ref'])):?>
                        <div class="mb-3">
                            <label for="bank_trxn_ref" class="form-label">Bank Reference</label>
                            <input type="text" class="form-control" id="bank_trxn_ref" name="bank_trxn_ref" value="<?= $transaction['bank_trxn_ref']?>">
                            <?php if(isset($errors['bank_trxn_ref'])):?>
                                <div id="bank_trxn_ref" class="invalid-feedback"><?=$errors['bank_trxn_ref']?></div>
                            <?php endif;?>
                        </div>
                        <?php endif;?>

                        <?php if(! empty($transaction['bank_name'])):?>
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Bank Reference</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?= $transaction['bank_name']?>">
                            <?php if(isset($errors['bank_name'])):?>
                                <div id="bank_name" class="invalid-feedback"><?=$errors['bank_name']?></div>
                            <?php endif;?>
                        </div>
                        <?php endif;?>

                        <?php if(! empty($transaction['bank_trxn_narration'])):?>
                        <div class="mb-3">
                            <label for="bank_trxn_narration" class="form-label">Bank Narration</label>
                            <textarea class="form-control" id="bank_trxn_narration" name="bank_trxn_narration" rows="3"><?=$transaction['bank_trxn_narration']?></textarea>
                        </div>
                        <?php endif;?>
                        
                        <?php if(! empty($transaction['agent_name'])):?>
                        <div class="mb-3">
                            <label for="agent_name" class="form-label">Agent Name</label>
                            <input type="text" class="form-control" id="agent_name" name="agent_name" value="<?= $transaction['agent_name']?>">
                            <?php if(isset($errors['agent_name'])):?>
                                <div id="agent_name" class="invalid-feedback"><?=$errors['agent_name']?></div>
                            <?php endif;?>
                        </div>
                        <?php endif;?>

                        <?php if(! empty($transaction['agent_acc_number'])):?>
                        <div class="mb-3">
                            <label for="agent_acc_number" class="form-label">Agent Wallet Number</label>
                            <input type="text" class="form-control" id="agent_acc_number" name="agent_acc_number" value="<?= $transaction['agent_acc_number']?>">
                            <?php if(isset($errors['agent_acc_number'])):?>
                                <div id="agent_acc_number" class="invalid-feedback"><?=$errors['agent_acc_number']?></div>
                            <?php endif;?>
                        </div>
                        <?php endif;?>

                        <!-- kill_money_trxnid (edited to the below name)-->
                        <?php if(! empty($transaction['kill_money_trxnid'])):?>
                        <div class="mb-3">
                            <label for="kill_money_trxnid" class="form-label">Withdraw To TRUST TransactionId</label>
                            <input type="text" class="form-control" id="kill_money_trxnid" name="kill_money_trxnid" placeholder="Enter KillMoney Transaction id" value="<?= $transaction['kill_money_trxnid']?>">
                            <?php if(isset($errors['kill_money_trxnid'])):?>
                                <div id="kill_money_trxnid" class="invalid-feedback"><?=$errors['kill_money_trxnid']?></div>
                            <?php endif;?>
                        </div>
                        <?php endif;?>

                        <div class="mb-3">
                            <label for="maker_id" class="form-label">Maker username</label>
                            <input type="text" class="form-control" id="maker_id" name="maker_id" value="<?= $transaction['maker_id']?>">
                        </div>
                        <hr>

                        <?php if(! empty($transaction['review_by'])):?>
                        <div class="mb-3">
                            <label for="review_by" class="form-label">Form Review By</label>
                            <input type="text" class="form-control" id="review_by" name="review_by" disabled value="<?= $transaction['review_by']?>">
                        </div>
                        <?php endif;?>

                        <?php if(! empty($transaction['Approved_by'])):?>
                        <div class="mb-3">
                            <label for="Approved_by" class="form-label">Form Approved By</label>
                            <input type="text" class="form-control" id="Approved_by" name="Approved_by" disabled value="<?= $transaction['Approved_by']?>">
                        </div>
                        <?php endif;?>

                        <div class="btn-section">
                            <a href="<?= route('transaction/history')?>" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php endforeach;?> 
        </div>
    </div>
