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
                            <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#createMoney">Create Money</a>
                        </li>
                    <?php endif;?>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" data-bs-toggle="tab" href="#createMoneyTrxnDetail">Create Money Transaction Detail</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">   
                         <!-- Create Money Tab -->
                         <?php if (isInputter()):?>

                         <div id="createMoney" class="tab-pane fade show active">
                        <h1 class="fw-bold text-center">Create Money</h1>
                        <form action="<?= route('create/money/new')?>" method="post" enctype="multipart/form-data">
                                <?php foreach($ticketing_id as $id): 
                                    $tid = $id['ticket_id'];?>
                                <?php endforeach;?>

                                <input type="hidden" name="transaction_id" value="<?= "APSW_". stringTime() . ($tid + 1) ?>">
                                <input type="hidden" name="transaction_filename" value="Create_Money_Transaction_<?= underlineDate() ?>">
                                <input type="hidden" name="Transaction_type" value="Create_Money">

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
                                        <option>Internal Fund Transfer</option>
                                        <option>Replenishment</option>
                                        <option>Salary Disbursement</option>
                                        <option>Other</option>
                                    </select>

                                    <?php if(isset($errors['transaction_reason'])):?>
                                        <div id="transaction_reason" class="invalid-feedback"><?=$errors['transaction_reason']?></div>
                                    <?php endif;?>
                                </div>

                                <div class="mb-3">
                                    <label for="bank_trxn_ref" class="form-label">Bank Transaction Reference</label>
                                    <input type="text" class="form-control <?php if(isset($errors['bank_trxn_ref'])):?>is-invalid<?php endif;?>" min="0" name="bank_trxn_ref" id="bank_trxn_ref" placeholder="Enter the Bank reference id">

                                    <?php if(isset($errors['bank_trxn_ref'])):?>
                                        <div id="Transaction_amount" class="invalid-feedback"><?=$errors['bank_trxn_ref']?></div>
                                    <?php endif;?>
                                </div>

                                <div class="mb-3">
                                    <label for="bank_name" class="form-label">Bank Name</label>
                                    <select class="form-select <?php if(isset($errors['bank_name'])):?>is-invalid<?php endif;?>" id="bank_name" name="bank_name">
                                        <option selected disabled>Select Bank Name</option>
                                        <option>APS IMF</option>
                                        <option>Access Bank</option>
                                        <option>EcoBank</option>
                                        <option>Trust Bank</option>
                                    </select>

                                    <?php if(isset($errors['bank_name'])):?>
                                        <div id="wallet_name" class="invalid-feedback"><?=$errors['bank_name']?></div>
                                    <?php endif;?>
                                </div>

                                <div class="mb-3">
                                    <label for="bank_trxn_narration" class="form-label">Bank Transaction Narration</label>
                                    <textarea type="text" style="height: 90px;" class="form-control <?php if(isset($errors['bank_trxn_narration'])):?>is-invalid<?php endif;?>" name="bank_trxn_narration" id="bank_trxn_narration" placeholder="Enter the Bank reference narration of the transaction"></textarea>

                                    <?php if(isset($errors['bank_trxn_narration'])):?>
                                        <div id="Transaction_amount" class="invalid-feedback"><?=$errors['bank_trxn_narration']?></div>
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

                        <!-- create Money trxn detail Tab -->
                        <div id="createMoneyTrxnDetail" class="tab-pane fade <?php if(isApprover() || isReviewer()):?> show active <?php endif;?>">
                            <h2 class="fw-bold text-center">Create Money Recent Transactions</h2>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
