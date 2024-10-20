<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$message?></p>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header">
                    <?=flash('success')?>
                   
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table 
                            class="table 
                            table-borderless"
                            width="100%" 
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ticket_id</th>
                                    <th>Recipient</th>
                                    <th>Subject</th>
                                    <th>Mail Body</th>
                                    <th>Status</th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($queued as $value): ?>
                                    <tr>
                                        <td><a href="<?= route('status/ticket?ticketing='. $value['ticket_id']) ?>"><strong><?= $value['ticket_id'] ?></strong></a></td>
                                        <td><?= $value['recipient'] ?></td>
                                        <td><?= $value['subject'] ?></td>
                                        <td><?= $value['mail_body'] ?></td>
                                        <td><?= $value['email_sent'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        
                    </div>


                </div>
                
            </div>
        </div>
    </div>

</div>
