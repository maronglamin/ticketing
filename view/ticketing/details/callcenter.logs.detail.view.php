<div class="container mt-3">
<?=flash('success')?>

<?php foreach($ticket_detail as $detail):?>
    <p class="fw-bold fs-4">REF/CCR/LOGS - APS IMS Ticketing::<?= $detail['ticketId']?></p>
    <div class="card mt-5">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Basic Ticket Information</h6>
                    <table class="table table-borderless">
                        <tr><td>Ticket Status:</td><td><?= $detail['status']?></td></tr>
                        <tr><td>Create Date:</td><td><?= cur_time($detail['created_at']) ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6>User Information</h6>
                    <table class="table table-borderless">
                        <tr><td>Name:</td><td><?= $detail['maker_id']?></td></tr>
                        <tr><td>Email:</td><td><?= $detail['email']?></td></tr>
                    </table>

                </div>


            </div>
            <div class="border-top pt-3">
                <h6>Ticket's Description</h6>
                <div class="mb-3 border p-3">
                    <strong><?= $detail['maker_id'] ?></strong> at <small class="text-muted"><?= $detail['created_at'] ?></small>
                    <p><?= nl2br($detail['description'])?></p>
                </div>
                
                 <?php if(! empty($ticket_comments)):?>
                    <h6>Comments</h6>
                    <?php foreach($ticket_comments as $comment):?>
                        <div class="mb-3 border p-3">
                        <img src="/public/img/undraw_profile.svg" class="rounded-circle m-2" alt="Profile" width="50">
                            <strong><?= $comment['maker_id'] ?></strong> at <small class="text-muted"><?= $comment['make_at'] ?></small>
                            <p><?= nl2br($comment['comment'])?></p>
                            <?php if($comment['upload_file'] !== 'null' ):?>
                                <img src="<?= $comment['upload_file']?>" alt="The uploaded file" style="margin: 0;padding: 0;width: 100%;height: auto;">
                            <?php endif;?>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>

                
            </div>
            <div class="mt-3">
                <form action="<?= route('ticket/comments/callcenterLog')?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $detail['ticketId']?>" name="ticketId">
                    <textarea class="form-control <?php if (isset($errors['comment']) ):?> is-invalid <?php endif;?>" id="comment" name="comment" rows="3" placeholder="Required to add a comment..."></textarea>
                        
                        <?php if (isset($errors['comment']) ) :?>
                            <div id="comment" class="invalid-feedback"> <?= $errors['comment'] ?> </div>
                        <?php endif;?>

                    <div class="mt-2">
                        <label for="upload_file"><strong>(optional) </strong>Attached screenshot</label>
                        <input type="file" class="form-control p-2 <?php if (isset($errors['upload_file']) ):?> is-invalid <?php endif;?>" name="upload_file" id="upload_file">
                            <?php if (isset($errors['upload_file']) ) :?>
                                <div id="upload_file" class="invalid-feedback"> <?= $errors['upload_file'] ?> </div>
                            <?php endif;?>
                        </div>

                    <div class="mt-2 d-flex justify-content-end">
                        <button class="btn btn-primary">Send Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach;?>
</div>

