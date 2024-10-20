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
                    <a href="<?= route('aps-request') ?>" class="btn btn-sm btn-primary">Back</a>
                </div>

                <div class="card-body">
                    <form action="<?= route("saved/ticket") ?>" method="post">
                        <div class="row">

                            <div class="col-lg-6 col-sm-12">
                                <label for="classification">Ticket Summary</label>
                                <input type="text" disabled class="form-control form-sm" value="<?= $ticket['summary']?>">
                            </div>


                            <div class="col-lg-6 col-sm-12">
                                <label for="department">Department</label>
                                <select name="department" id="department" disabled class="form-control form-sm">
                                <option value=""><?= $ticket['department']?></option>
                                    
                                </select>

                            </div>

                            <div class="col-lg-12 col-sm-10">
                                <label for="discription">Discription</label>
                                <textarea name="discription" id="discription" disabled placeholder="Narration..." style="height:260px" class="form-control"><?= $ticket['discription']?></textarea>

                            </div>

                            <div class="col-lg-10 col-sm-10 mt-5">
                                <?php if (!file_exists($ticket['file_path'])): ?>
                                    <p>The attachment file</p>
                                    <img src="<?= $ticket['file_path']?>" style="height:110px; width:300px" alt="Attachment">
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
                        <h4 class="text-uppercase">Change status</h2>
                </div>
                <div class="card-body">
                    <?php if(!empty(core\JsonGenerate::decodeText($ticket['comment']))):?>
                        <h5>Comment Initiated by:</h5>
                        <p><strong><?= core\JsonGenerate::decodeText($ticket['comment'])['username']?></strong></p>
                        <h5>Current Active Comment:</h5>
                        <p><strong><?= core\JsonGenerate::decodeText($ticket['comment'])['comment']?></strong></p>
                    <?php  endif;?>

                    <form action="<?= route("status/change") ?>" method="post" class="mb-2 p-2">
                        <input type="hidden" name="ticketid" value="<?= $ticket['ticketId']?>">
                        <input type="hidden" name="id" value="<?= $ticket['id']?>">

                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control form-sm">
                                <option value="">Choose Current status</option>
                                <option value="<?=core\Response::STATUS_ONHOLD?>"><?=core\Response::STATUS_ONHOLD?></option>
                                <option value="<?=core\Response::STATUS_IN_PROGRESS?>"><?=core\Response::STATUS_IN_PROGRESS?></option>
                                <option value="<?=core\Response::STATUS_RESOLVED?>"><?=core\Response::STATUS_RESOLVED?></option>
                                <option value="<?=core\Response::STATUS_CLOSED?>"><?=core\Response::STATUS_CLOSED?></option>
                            </select>
                            <?php if(isset($errors['status'])):?>
                                    <div><small style="color:red"><?=$errors['status']?></small></div>
                            <?php endif;?>

                            <label for="comment">Comment</label>
                                <textarea name="comment" id="comment" placeholder="comment..." style="height:80px" class="form-control mb-2"></textarea>

                        <input type="submit" class="btn btn-sm btn-primary" value="Update">
                    </form>

                        <ul class="list-group mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                 Ticket Status
                                <span class="badge badge-pill"><strong><?= $ticket['status'] ?></strong></span>
                            </li>
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
                                 Requested timstamp
                                <span class="badge badge-pill"><strong><?= $ticket['make_at'] ?></strong></span>
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
                                Assigned to
                                <span class="badge badge-pill"><strong><?= $ticket['ticket_assigned_to'] ?></strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ticket Cancel_at
                                <span class="badge badge-danger badge-pill"><strong><?= $ticket['ticket_cancel_at'] ?></strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Resolved timestamp
                                <span class="badge badge-pill"><strong><?= $ticket['ticket_resolved_at'] ?></strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ticket Resolved By
                                <span class="badge badge-pill"><strong><?= $ticket['ticket_resolved_by'] ?></strong</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ticket Close timestamp
                                <span class="badge badge-pill"><strong><?= $ticket['ticket_closed_at'] ?></strong</span>
                            </li>
                        </ul>

                </div>
            </div>
        </div>

    <?php endforeach;?>

    </div>

</div>