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
                            <li class="list-group-item"><?= $transaction['trxDate']?> - GMD <?= number_format($transaction['transaction_amount'])?> </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Operations Form -->
            <div class="col-md-9">
                <div class="transaction-table">
                    <ul class="nav nav-tabs">
                    <?php if (isInputter()):?>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#killMoney">Kill Money</a>
                        </li>
                    <?php endif;?>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" data-bs-toggle="tab" href="#killMoneyTrxnDetail">Kill Money Transactions</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">   
                        <!-- Kill Money Tab -->
                        <?php if (isInputter()):?>
                        <div id="killMoney" class="tab-pane fade show active">
                        <h1 class="fw-bold text-center">Kill Money</h1>
                        <form action="<?= route('kill/money/new')?>" method="post" enctype="multipart/form-data">
                            <?php foreach($ticketing_id as $id): 
                                    $tid = $id['ticket_id'];?>
                                <?php endforeach;?>

                                <input type="hidden" name="transaction_id" value="<?= "APSW_". stringTime() . ($tid + 1) ?>">
                                <input type="hidden" name="transaction_filename" value="Kill_Money_Transaction_<?= underlineDate() ?>">
                                <input type="hidden" name="Transaction_type" value="Kill_Money">

                                <div class="mb-3">
                                    <label for="Transaction_amount" class="form-label">Transaction Amount</label>
                                    <input type="number" class="form-control <?php if(isset($errors['Transaction_amount'])):?>is-invalid<?php endif;?>" min="0" name="Transaction_amount" id="Transaction_amount" placeholder="Enter amount">

                                    <?php if(isset($errors['Transaction_amount'])):?>
                                        <div id="Transaction_amount" class="invalid-feedback"><?=$errors['Transaction_amount']?></div>
                                    <?php endif;?>
                                </div>

                                <div class="mb-3">
                                    <label for="transaction_reason" class="form-label">Reason</label>
                                    <select class="form-select <?php if(isset($errors['transaction_reason'])):?>is-invalid<?php endif;?>" id="addReason" name="transaction_reason">
                                        <option selected disabled>Select reason</option>
                                        <option>Agent Settlement Fund</option>
                                    </select>

                                    <?php if(isset($errors['transaction_reason'])):?>
                                        <div id="transaction_reason" class="invalid-feedback"><?=$errors['transaction_reason']?></div>
                                    <?php endif;?>
                                </div>

                                <div class="mb-3">
                                    <label for="agent_name" class="form-label">Agent Name</label>
                                    <input type="text" class="form-control <?php if(isset($errors['agent_name'])):?>is-invalid<?php endif;?>" id="agent_name" name="agent_name">
                                        
                                    <?php if(isset($errors['agent_name'])):?>
                                        <div id="wallet_number" class="invalid-feedback"><?=$errors['agent_name']?></div>
                                    <?php endif;?>
                                </div>

                                <div class="mb-3">
                                    <label for="agent_acc_number" class="form-label">Agent Wallet Number</label>
                                    <input type="text" maxlength="7" class="form-control <?php if(isset($errors['agent_acc_number'])):?>is-invalid<?php endif;?>" id="agent_acc_number" name="agent_acc_number">
                                        
                                    <?php if(isset($errors['agent_acc_number'])):?>
                                        <div id="wallet_number" class="invalid-feedback"><?=$errors['agent_acc_number']?></div>
                                    <?php endif;?>
                                </div>

                                <div class="mb-3">
                                    <!-- Kill Money TransactionId -->
                                    <label for="kill_money_trxnid" class="form-label">Withdraw To TRUST TransactionId</label>
                                    <input type="number" class="form-control <?php if(isset($errors['kill_money_trxnid'])):?>is-invalid<?php endif;?>" id="kill_money_trxnid" name="kill_money_trxnid">
                                        
                                    <?php if(isset($errors['kill_money_trxnid'])):?>
                                        <div id="wallet_number" class="invalid-feedback"><?=$errors['kill_money_trxnid']?></div>
                                    <?php endif;?>
                                </div>

                                <div class="mb-3">
                                    <label for="upload_file" class="form-label">Attached A Support Document</label>
                                    <input class="form-control" type="file" id="upload_file" name="upload_file">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <?php endif;?>

                        <!-- kill Money Tab -->
                        <div id="killMoneyTrxnDetail" class="tab-pane fade <?php if(isApprover() || isReviewer()):?> show active <?php endif;?>">
                            <h2 class="fw-bold text-center">Kill Money Recent Transactions</h2>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
