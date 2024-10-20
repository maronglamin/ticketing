<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$message?></p>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">

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
                                    <th>Raised By</th>
                                    <th>Raised Date</th>
                                    <th>Raised Time</th>
                                    <th>Summary</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($ticket as $value): ?>
                                    <tr>
                                        <td><a href="<?= route('status/ticket?ticketing='. $value['ticketId']) ?>"><strong><?= $value['ticketId'] ?></strong></a></td>
                                        <td><?= $value['maker_id'] ?></td>
                                        <td><?= readDate($value['make_at']) ?></td>
                                        <td><?= readTime($value['make_at']) ?></td>
                                        <td><?= $value['summary'] ?></td>
                                        <td><?= $value['status'] ?></td>
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
