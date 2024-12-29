 <!-- Main Content -->
 <?php foreach($ticket_detail as $ticket) : ?>
 <div class="container mt-4">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white text-center">
                        <h5>Update Ticket</h5>
                    </div>
                    <div class="card-body">
                        <?=flash('success')?>
                        <form action="<?= route("status/change") ?>" method="post">
                        <input type="hidden" name="ticketid" value="<?= $ticket['ticketId']?>">
                        <input type="hidden" name="id" value="<?= $ticket['id']?>">
                            <!-- Update Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option selected disabled value="">Select status...</option>
                                    <option value="<?=core\Response::STATUS_ONHOLD?>"><?=core\Response::STATUS_ONHOLD?></option>
                                    <option value="<?=core\Response::STATUS_RESOLVED?>"><?=core\Response::STATUS_RESOLVED?></option>
                                    <option value="<?=core\Response::STATUS_CLOSED?>"><?=core\Response::STATUS_CLOSED?></option>
                                    <option value="<?=core\Response::STATUS_ESCALATE?>"><?=core\Response::STATUS_ESCALATE?></option>
                                </select>
                            </div>

                            <!-- Add Note -->
                            <div class="mb-3">
                                <label for="comment" class="form-label">Add a Note</label>
                                <textarea id="comment" name="comment" class="form-control" rows="4" placeholder="Add a note about this ticket"></textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary mb-2">Update Ticket</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-9">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Ticket Information</h4>
                        <a href="<?= route('dashboard')?>" class="btn btn-light btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="row mb-2">
                            <div class="col-6 text-start"><strong>Ticket Ref#:</strong></div>
                            <div class="col-6 text-end"><?= $ticket['ticketId']?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-start"><strong>Ticket Summary/Subject:</strong></div>
                            <div class="col-6 text-end"><?= $ticket['summary']?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-start"><strong>Indended Department:</strong></div>
                            <div class="col-6 text-end"><?= $ticket['department']?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-start"><strong>Raised At:</strong></div>
                            <div class="col-6 text-end"><?= human($ticket['make_at'])?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-start"><strong>Raised By:</strong></div>
                            <div class="col-6 text-end"><?= $ticket['maker_id']?></div>
                        </div>
                            
                        </div>
                        <hr>
                        <h5>Detailed description:</h5>
                        <p><?= nl2br($ticket['description'])?></p>

                        <?php if(!empty(core\JsonGenerate::decodeText($ticket['comment']))):?>
                            <hr>
                            <h5>Comment Initiated by:</h5>
                            <p><strong><?= core\JsonGenerate::decodeText($ticket['comment'])['username']?></strong></p>
                            <h5>Current Active Comment:</h5>
                            <p><strong><?= nl2br(core\JsonGenerate::decodeText($ticket['comment'])['comment'])?></strong></p>
                        <?php  endif;?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
