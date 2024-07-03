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
                    <a href="<?= route('ticketing') ?>" class="btn btn-sm btn-primary">Back</a>
                </div>

                <div class="card-body">
                    <form action="<?= route("saved/ticket") ?>" method="post">
                        <div class="row">

                            <div class="col-lg-10">
                                <label for="classification">Classification</label>
                                <select name="classification" id="classification" disabled class="form-control form-sm mt-1 mb-1">
                                    <option value=""><?= $ticket['classification']?></option>
                                </select>

                            </div>

                            <div class="col-lg-10">
                                <label for="category">Category</label>
                                <select name="category" id="category" disabled class="form-control form-sm mt-1 mb-1">
                                <option value=""><?= $ticket['category']?></option>
                                    
                                </select>
                            </div>

                            <div class="col-lg-10">
                                <label for="category">Sub Category</label>
                                <select name="category" id="category" disabled class="form-control form-sm mt-1 mb-1">
                                <option value=""><?= $ticket['sub_category']?></option>
                                    
                                </select>
                            </div>

                            <div class="col-lg-10">
                                <label for="department">Department</label>
                                <select name="department" id="department" disabled class="form-control form-sm mt-1 mb-1">
                                <option value=""><?= $ticket['department']?></option>
                                    
                                </select>

                            </div>

                            <div class="col-lg-10">
                                <label for="discription">Discription</label>
                                <textarea name="discription" id="discription" disabled placeholder="Narration..." class="form-control"><?= $ticket['discription']?></textarea>

                            </div>

                            <div class="col-lg-10 mt-5">
                                <?php if (!empty($ticket['file_path']) && $ticket['file_path'] !== '/bianalysts/'):?>
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
                        <h4 class="text-uppercase">Details</h2>
                </div>
                <div class="card-body">
                    

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