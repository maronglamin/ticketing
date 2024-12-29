<div class="container mt-4">
        <div class="row">
<!-- Left Column -->
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5><?= department(); ?> Raised</h5>
                        <h3><?=$departmentCount['ticketCount']?></h3>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5>My Tickets</h5>
                        <h3><?= $userCount['username']?></h3>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5>Pending Tickets</h5>
                        <h3>_ _</h3>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h5>Escalated Tickets</h5>
                        <h3>_ _ </h3>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-9">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Raise a Concern</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= route("new/ticket/save") ?>" method="post">
                        <?php foreach($ticketing_id as $id): 
                            $tid = $id['ticket_id'];?>
                        <?php endforeach;?>

                            <input type="hidden" name="ticketId" value="<?= "APSW-T" . ($tid + 1) ?>">
                            <input type="hidden" name="host" value="<?= clientHost() ?>">
                            <input type="hidden" name="email" value="<?= http\model\ModelData::addUserEmail() ?>">

                            <!-- Reason for Concern -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Reason for Concern</label>
                                <select id="category" name="category" class="form-select">
                                    <option selected disabled value="">Choose a reason...</option>
                                    <?php foreach($parent as $reason): ?>
                                        <option value="<?= $reason['category']?>"><?= $reason['category']?></option>
                                    <?php endforeach;?>
                                    <option value="Other">Other</option>
                                </select>
                                <?php if(isset($errors['category'])):?>
                                    <div><small style="color:red"><?=$errors['category']?></small></div>
                                <?php endif;?>
                                
                            </div>

                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select id="department" name="department" class="form-select">
                                    <option selected disabled value="">Choose a department...</option>
                                    <?php foreach($ownDept as $deptmnt):?>
                                        <option value="<?=$deptmnt['department_name']?>"><?=$deptmnt['department_name']?></option>
                                    <?php endforeach;?>
                                </select>
                                <?php if(isset($errors['department'])):?>
                                    <div><small style="color:red"><?=$errors['department']?></small></div>
                                <?php endif;?>
                                
                            </div>

                            <div class="mb-3">
                                <label for="sub_category" class="form-label">SubCategory Type</label>
                                <select id="sub_category" name="sub_category" class="form-select">
                                    <option selected disabled value="">Choose a sub-category...</option>
                                    <?php foreach($child as $sub): ?>
                                        <option value="<?= $sub['category']?>"><?= $sub['category']?></option>
                                    <?php endforeach;?>
                                    <option value="Other">Other</option>
                                </select>
                                <?php if(isset($errors['sub_category'])):?>
                                    <div><small style="color:red"><?=$errors['sub_category']?></small></div>
                                <?php endif;?>
                            </div>

                            <!-- Customer Name -->
                            <div class="mb-3">
                                <label for="summary" class="form-label">Subject/Summary</label>
                                <input type="text" class="form-control" id="summary" name="summary" placeholder="Enter Ticket's subject">
                                <?php if(isset($errors['summary'])):?>
                                    <div><small style="color:red"><?=$errors['summary']?></small></div>
                                <?php endif;?>
                            </div>

                            <!-- Priority Type -->
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select id="priority" name="priority" class="form-select">
                                    <option selected disabled value="">Choose a Priority...</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                                <?php if(isset($errors['priority'])):?>
                                    <div><small style="color:red"><?=$errors['priority']?></small></div>
                                <?php endif;?>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="5" placeholder="Describe your concern in detail"></textarea>
                                <?php if(isset($errors['description'])):?>
                                    <div><small style="color:red"><?=$errors['description']?></small></div>
                                <?php endif;?>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>