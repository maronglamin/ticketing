<div class="container mt-4">
        <div class="row">
            <!-- Left Column: Summary Section -->
            <div class="col-md-3">
                <div class="summary-card">
                    <h5>Monthly Balance</h5>
                    <!-- <p class="text-success fw-bold">$9,944.87</p> -->
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
                            <li class="list-group-item"><?= $transaction['trxDate']?> - GMD <?= number_format($transaction['debit_amount'])?> </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Operations Form -->
            <div class="col-md-9">
                <div class="transaction-table">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#addMoney">Bank Note</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" data-bs-toggle="tab" href="#addMoneyTrxnDetails">Recent Bank Note</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">   

                        <!-- Add Money Tab -->
                        <div id="addMoney" class="tab-pane fade show active">
                            <h2 class="fw-bold text-center">Edit Instruction</h2>
                            <!-- Header with Back Button -->
                            <div class="details-header">
                                <h5>Transaction Details</h5>
                                <a href="<?= route('instrustions/bank/note')?>" class="back-btn">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                            </div>
                                <form action="<?= route('instruct/update/banknote')?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= sanitize($_GET['edit'])?>">

                                    <div class="mb-3">
                                        <label for="Transaction_amount" class="form-label">Debit Amount</label>
                                        <input type="number" class="form-control <?php if(isset($errors['Transaction_amount'])):?>is-invalid<?php endif;?>" min="0" disabled name="Transaction_amount" id="Transaction_amount" value="<?=$editTrxns['debit_amount']?>">

                                        <?php if(isset($errors['Transaction_amount'])):?>
                                            <div id="Transaction_amount" class="invalid-feedback"><?=$errors['Transaction_amount']?></div>
                                        <?php endif;?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="transaction_reason" class="form-label">Reason</label>
                                        <select class="form-select <?php if(isset($errors['transaction_reason'])):?>is-invalid<?php endif;?>" id="transaction_reason" name="transaction_reason">
                                            <option><?=$editTrxns['transaction_reason']?></option>
                                            <option>Other</option>
                                        </select>

                                        <?php if(isset($errors['transaction_reason'])):?>
                                            <div id="transaction_reason" class="invalid-feedback"><?=$errors['transaction_reason']?></div>
                                        <?php endif;?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="Agent_bank_nane" class="form-label">Agent's Bank</label>
                                        <select class="form-select <?php if(isset($errors['Agent_bank_nane'])):?>is-invalid<?php endif;?>" id="Agent_bank_nane" name="Agent_bank_nane">
                                            <option value="<?=$editTrxns['Agent_bank_nane']?>"><?=$editTrxns['Agent_bank_nane']?></option>
                                            <?php foreach($bankList as $bank):?>
                                            <option value="<?=$bank['bank_name']?>"><?=$bank['bank_name']?></option>
                                            <?php endforeach;?>
                                        </select>

                                        <?php if(isset($errors['Agent_bank_nane'])):?>
                                            <div id="wallet_number" class="invalid-feedback"><?=$errors['Agent_bank_nane']?></div>
                                        <?php endif;?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="wallet_number" class="form-label">Wallet Number (IMF)</label>
                                        <input type="text" value="<?=$editTrxns['wallet_number']?>" maxlength="7" class="form-control <?php if(isset($errors['wallet_number'])):?>is-invalid<?php endif;?>" name="wallet_number" id="wallet_number" value="<?=$editTrxns['wallet_number']?>">

                                        <?php if(isset($errors['wallet_number'])):?>
                                            <div id="wallet_number" class="invalid-feedback"><?=$errors['wallet_number']?></div>
                                        <?php endif;?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="wallet_name" class="form-label">Wallet Name</label>
                                        <input type="text" value="<?=$editTrxns['wallet_name']?>" class="form-control <?php if(isset($errors['wallet_name'])):?>is-invalid<?php endif;?>" min="0" name="wallet_name" id="wallet_name" value="<?=$editTrxns['wallet_name']?>">

                                        <?php if(isset($errors['wallet_name'])):?>
                                            <div id="wallet_name" class="invalid-feedback"><?=$errors['wallet_name']?></div>
                                        <?php endif;?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="agent_bank_acc_num" class="form-label">Agent Bank Account Number</label>
                                        <input type="text" value="<?=$editTrxns['agent_bank_acc_num']?>" class="form-control <?php if(isset($errors['agent_bank_acc_num'])):?>is-invalid<?php endif;?>" min="0" name="agent_bank_acc_num" id="agent_bank_acc_num">

                                        <?php if(isset($errors['agent_bank_acc_num'])):?>
                                            <div id="bank_name" class="invalid-feedback"><?=$errors['agent_bank_acc_num']?></div>
                                        <?php endif;?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="agent_paid_bank_name" class="form-label">APS Bank Name</label>
                                        <select class="form-select <?php if(isset($errors['agent_paid_bank_name'])):?>is-invalid<?php endif;?>" id="agent_paid_bank_name" name="agent_paid_bank_name">
                                            <option value="<?=$editTrxns['agent_paid_bank_name']?>"><?=$editTrxns['agent_paid_bank_name']?></option>
                                            <?php foreach($bankList as $bank):?>
                                            <option value="<?=$bank['bank_name']?>"><?=$bank['bank_name']?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <?php if(isset($errors['agent_paid_bank_name'])):?>
                                            <div id="agent_paid_bank_name" class="invalid-feedback"><?=$errors['agent_paid_bank_name']?></div>
                                        <?php endif;?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="agent_paid_bank_acc_num" class="form-label">APS Bank Account Number</label>
                                        <select class="form-select <?php if(isset($errors['agent_paid_bank_acc_num'])):?>is-invalid<?php endif;?>" id="agent_paid_bank_acc_num" name="agent_paid_bank_acc_num">
                                            <option value="<?=$editTrxns['agent_paid_bank_acc_num']?>"><?=$editTrxns['agent_paid_bank_acc_num']?></option>
                                            <?php foreach($bankList as $bank):?>
                                            <option value="<?=$bank['bank_acc_num']?>"><?=$bank['bank_acc_num']?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <?php if(isset($errors['agent_paid_bank_acc_num'])):?>
                                            <div id="agent_paid_bank_acc_num" class="invalid-feedback"><?=$errors['agent_paid_bank_acc_num']?></div>
                                        <?php endif;?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Agent_paid_acc_name" class="form-label">APS Bank Account Name</label>
                                        <select class="form-select <?php if(isset($errors['Agent_paid_acc_name'])):?>is-invalid<?php endif;?>" id="Agent_paid_acc_name" name="Agent_paid_acc_name">
                                            <option value="<?=$editTrxns['Agent_paid_acc_name']?>"><?=$editTrxns['Agent_paid_acc_name']?></option>
                                            <?php foreach($bankList as $bank):?>
                                            <option value="<?=$bank['acc_name']?>"><?=$bank['acc_name']?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <?php if(isset($errors['Agent_paid_acc_name'])):?>
                                            <div id="Agent_paid_acc_name" class="invalid-feedback"><?=$errors['Agent_paid_acc_name']?></div>
                                        <?php endif;?>
                                    </div>

                                    <div class="mb-3">
                                        <label for="debit_instruction" class="form-label">Instruct Message</label>
                                        <textarea style="height: 90px;" class="form-control" name="debit_instruction" id="debit_instruction" placeholder="Narration here..."><?=$editTrxns['debit_instruction']?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                        </div>

                        <!-- Kill Money Tab -->
                        <div id="addMoneyTrxnDetails" class="tab-pane fade">
                        <!-- content -->
                        <h2 class="fw-bold text-center">Add Money Recent Transactions</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
