<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$instruction?></p>

    <div class="row">
    <?php foreach($ticket_detail as $ticket) : ?>
        <div class="col-lg-8">
            <div class="card mb-4">

                <div class="card-header">
                    <a href="<?= route('admin/ticketing') ?>" class="btn btn-sm btn-primary">Back</a>
                </div>

                <div class="card-body">
                    <form action="<?= route("admin/saved/ticket") ?>" method="post">
                        <div class="row">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="id" value="<?=$_GET['ticketing']?>">
                            <input type="hidden" name="ticketId" value="<?=$ticket['ticketId']?>">

                            <div class="col-lg-4 col-sm-12">
                                <label for="classification">Classification</label>
                                <select name="classification" id="classification" class="form-control form-sm mt-1 mb-1">
                                    <option value="<?= $ticket['classification']?>"><?= $ticket['classification']?></option>
                                    <option value="Request">Request</option>
                                    <option value="Incident">Incident</option>

                                    <?php if(isset($errors['classification'])):?>
                                        <div><small style="color:red"><?=$errors['classification']?></small></div>
                                    <?php endif;?>
                                </select>

                            </div>

                            <div class="col-lg-4 col-sm-12">
                                <label for="email">User's Email</label>
                                <select name="email" id="email" class="form-control form-sm mt-1 mb-1">
                                    <option value="<?= $ticket['email']?>"><?= $ticket['email']?></option>
                                </select>
                            </div>

                            <div class="col-lg-4 col-sm-12">
                                <label for="status">Change Status</label>
                                <select name="status" id="status" class="form-control form-sm mt-1 mb-1">
                                    <option value="<?= $ticket['status']?>"><?= $ticket['status']?></option>
                                    <option value="<?=core\Response::STATUS_ONHOLD?>"><?=core\Response::STATUS_ONHOLD?></option>
                                    <option value="<?=core\Response::STATUS_IN_PROGRESS?>"><?=core\Response::STATUS_IN_PROGRESS?></option>
                                    <option value="<?=core\Response::STATUS_RESOLVED?>"><?=core\Response::STATUS_RESOLVED?></option>
                                    <option value="<?=core\Response::STATUS_CLOSED?>"><?=core\Response::STATUS_CLOSED?></option>
                                    <option value="<?=core\Response::STATUS_CANCELLED?>"><?=core\Response::STATUS_CANCELLED?></option>

                                    <?php if(isset($errors['status'])):?>
                                        <div><small style="color:red"><?=$errors['status']?></small></div>
                                    <?php endif;?>
                                </select>

                            </div>

                            <div class="col-lg-3 col-sm-12">
                                <label for="priority">Priority</label>
                                <select name="priority" id="priority" class="form-control form-sm mt-1 mb-1">
                                    <option value="<?= $ticket['priority']?>"><?= $ticket['priority']?></option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>

                                </select>

                            </div>

                            <div class="col-lg-3 col-sm-12">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control form-sm mt-1 mb-1">
                                <option value="<?= $ticket['category']?>"><?= $ticket['category']?></option>
                                <?php foreach($parent as $category):?>
                                    <option value="<?=$category['category']?>"><?=$category['category']?></option>
                                <?php endforeach;?>

                                <?php if(isset($errors['category'])):?>
                                    <div><small style="color:red"><?=$errors['category']?></small></div>
                                <?php endif;?>
                                </select>
                            </div>
                            
                            <div class="col-lg-3 col-sm-12">
                                <label for="sub_category">Sub Category</label>
                                <select name="sub_category" id="sub_category" class="form-control form-sm mt-1 mb-1">
                                <option value="<?= $ticket['sub_category']?>"><?= $ticket['sub_category']?></option>
                                <?php foreach($child as $category):?>
                                    <option value="<?=$category['category']?>"><?=$category['category']?></option>
                                <?php endforeach;?>
                                <option value="OTHERS">OTHERS</option>
                                
                                <?php if(isset($errors['sub_category'])):?>
                                    <div><small style="color:red"><?=$errors['sub_category']?></small></div>
                                <?php endif;?>
                                </select>
                            </div>

                            <div class="col-lg-3 col-sm-12">
                                <label for="department">Department</label>
                                <select name="department" id="department" class="form-control form-sm mt-1 mb-1">
                                <option value="<?= $ticket['department']?>"><?= $ticket['department']?></option>
                                <?php foreach($dept as $ticketDept):?>
                                    <option value="<?= $ticketDept['department_name']?>"><?= $ticketDept['department_name']?></option>
                                <?php endforeach;?>
                                </select>

                                <?php if(isset($errors['department'])):?>
                                    <div><small style="color:red"><?=$errors['department']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-12">
                                <label for="discription">Discription</label>
                                <textarea name="discription" id="discription" style="height:260px" placeholder="Narration..." class="form-control"><?= $ticket['discription']?></textarea>

                                <?php if(isset($errors['discription'])):?>
                                    <div><small style="color:red"><?=$errors['discription']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-10">
                                <input type="submit" value="Update" class="btn btn-primary mt-3">
                            </div>

                            <div class="col-lg-10 mt-5">
                                <?php if (!empty($ticket['file_path']) && $ticket['file_path'] !== '/ticketing/'):?>
                                    <p>The attachment file</p>
                                    <img src="<?= $ticket['file_path']?>" style="height:auto; width:700px" alt="Attachment">
                                <?php endif;?>
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">

                <div class="card-header">
                        <h4 class="text-uppercase">Details</h2>
                </div>
                <div class="card-body">
                    

                        <ul class="list-group mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $ticket['classification'] ?>
                                <span class="badge badge-pill"><strong>Classified</strong></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $ticket['category'] ?>
                                <span class="badge badge-pill"><strong>IT Team</strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= $ticket['sub_category'] ?>
                                <span class="badge badge-pill"><strong>Specific Service</strong</span>
                            </li>
                        </ul>

                        <h5>Ticket Status changes</h5>
                        <ul class="list-group mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Ticket Status
                                <span class="badge badge-pill"><strong><?= $ticket['status'] ?></strong></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Requested timstamp
                                <span class="badge badge-pill"><strong><?= $ticket['make_at'] ?></strong></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Assigned to
                                <span class="badge badge-pill"><strong><?= $ticket['ticket_assigned_to'] ?></strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                On Hold At
                                <span class="badge badge-pill"><strong><?= $ticket['ticket_on_hold_at'] ?></strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Assigned timestamp
                                <span class="badge badge-pill"><strong><?= $ticket['ticket_assigned_at'] ?></strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Work in progress timestamp
                                <span class="badge badge-pill"><strong><?= $ticket['ticket_working_in_at'] ?></strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ticket Cancel_at
                                <span class="badge badge-danger badge-pill"><strong><?= $ticket['ticket_cancel_at'] ?></strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Resolved timestamp
                                <span class="badge badge-primary badge-pill"><strong><?= $ticket['ticket_resolved_at'] ?></strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ticket Resolved By
                                <span class="badge badge-pill"><strong><?= $ticket['ticket_resolved_by'] ?></strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ticket Close timestamp
                                <span class="badge badge-primary badge-pill"><strong><?= $ticket['ticket_closed_at'] ?></strong</span>
                            </li>
                        </ul>

                </div>
            </div>
        </div>

    <?php endforeach;?>

    </div>

</div>
