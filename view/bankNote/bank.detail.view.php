<div class="container mt-4">
        <div class="row">
            <!-- Left Column (25%) -->
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">Add Bank Details</div>
                    <div class="card-body">
                        <form action="<?= route('settlement/bank/save')?>" method="post">
                            <div class="mb-3">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text" class="form-control <?php if(isset($errors['bank_name'])):?>is-invalid<?php endif;?>" id="bank_name" name="bank_name" placeholder="Enter bank name">

                                <?php if(isset($errors['bank_name'])):?>
                                    <div id="bank_name" class="invalid-feedback"><?=$errors['bank_name']?></div>
                                <?php endif;?>
                            </div>
                            <div class="mb-3">
                                <label for="bank_acc_num" class="form-label">Account Number</label>
                                <input type="number" class="form-control <?php if(isset($errors['bank_acc_num'])):?>is-invalid<?php endif;?>" id="bank_acc_num" name="bank_acc_num" placeholder="Enter account number">

                                <?php if(isset($errors['bank_acc_num'])):?>
                                    <div id="bank_acc_num" class="invalid-feedback"><?=$errors['bank_acc_num']?></div>
                                <?php endif;?>
                            </div>
                            <div class="mb-3">
                                <label for="acc_name" class="form-label">Account Name</label>
                                <input type="text" class="form-control <?php if(isset($errors['acc_name'])):?>is-invalid<?php endif;?>" id="acc_name" name="acc_name" placeholder="Enter account name">

                                <?php if(isset($errors['acc_name'])):?>
                                    <div id="acc_name" class="invalid-feedback"><?=$errors['acc_name']?></div>
                                <?php endif;?>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Save Bank</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column (75%) -->
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <span>Bank Details</span>
                    </div>
                    <div class="card-body">
                    <div>
                        <?=flash('success')?>
                    </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Bank Name</th>
                                        <th>Account Name</th>
                                        <th>Account Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Example Data -->
                                     <?php foreach($bankList as $list):?>
                                    <tr>
                                        <td><?=$list['bank_name']?></td>
                                        <td><?=$list['acc_name']?></td>
                                        <td><?=$list['bank_acc_num']?></td>
                                        <td>
                                            <form action="<?= route('settlement/bank/delete')?>" method="post">
                                            <input 
                                                type="hidden"
                                                name="_method"
                                                value="DELETE"
                                            >
                                            <input type="hidden" value="<?=$list['id']?>" name="id">
                                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    
                                    <!-- More data dynamically inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
